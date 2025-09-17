<?php

namespace App\Services;

use App\Models\Reservation;
use App\Models\ServiceHasReservation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReservationService
{
    public function getByPyme(int $pymeId, string $startDate, string $endDate)
    {
        return Reservation::load('bookingSchedule', 'pyme', 'client')
            ->where('pyme_id', $pymeId)
            ->whereBetween('date', [$startDate, $endDate])
            ->get();
    }

    public function getByPaymentId(int $paymentId)
    {
        return Reservation::where('payment_id', $paymentId)->first();
    }

    public function getByClient(int $clientId, string $startDate, string $endDate)
    {
        return Reservation::with('bookingSchedule', 'pyme', 'services', 'bookingSchedule.schedule')
        ->where('client_id', $clientId)
        ->whereHas('bookingSchedule.schedule', function ($q) use ($startDate, $endDate) {
            $q->whereBetween('date', [$startDate, $endDate]);
        })->get();
    }
    
    public function create(array $data)
    {
        try {
            $payment = (new PaymentService())->create($data['servicesIds'], $data['payment_method_id'], $data['pyme_id']);

            $reservation = Reservation::create([
                'client_id' => $data['client_id'] ?? Auth::id(),
                'pyme_id' => $data['pyme_id'],
                'payment_id' => $payment->id,
                'status_id' => 1,
            ]);

            $serviceHasReservation = [];

            foreach ($data['servicesIds'] as $serviceId) {
                $serviceHasReservation[] = [
                    'service_id' => $serviceId,
                    'reservation_id' => $reservation->id,
                ];
            }

            DB::transaction(function () use ($serviceHasReservation) {
                ServiceHasReservation::insert($serviceHasReservation);
            });

            (new BookingScheduleService())->create($data['servicesIds'], $data['schedule_id'], $reservation->id, $data['start_time']);

            return $reservation;
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage());
        }
    }
}
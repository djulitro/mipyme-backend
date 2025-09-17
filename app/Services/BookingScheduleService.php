<?php

namespace App\Services;

use App\Models\BookingSchedule;
use Carbon\Carbon;

class BookingScheduleService
{
    public function create(array $serviceIds, int $scheduleId, int $reservationId, string $startTime)
    {
        $services = (new ServiceService())->getByIds($serviceIds);

        $totalDuration = $services->sum('time');

        // Calcular el end_time sumando la duración total al start_time con Carbon
        $startTimeCarbon = Carbon::createFromFormat('H:i:s', $startTime);
        $endTimeCarbon = $startTimeCarbon->copy()->addMinutes($totalDuration);

        $bookingSchedule = BookingSchedule::create([
            'schedule_id' => $scheduleId,
            'reservation_id' => $reservationId,
            'start_time' => $startTimeCarbon->format('H:i:s'),
            'end_time' => $endTimeCarbon->format('H:i:s'),
        ]);

        return $bookingSchedule;
    }
}
<?php

namespace App\Services;

use App\Models\Commission;
use App\Models\Payment;
use Carbon\Carbon;

class PaymentService
{
    public function create(array $serviceIds, int $paymentMethodId, int $pymeId)
    {
        $serviceService = new ServiceService();
        $now = Carbon::now();

        $services = $serviceService->getByIds($serviceIds, $pymeId);
        $commission = Commission::where('start_date', '<=', $now->format('Y-m-d'))->where('end_date', '>=', $now->format('Y-m-d'))->first();

        if (count($services) !== count($serviceIds)) {
            throw new \Exception('One or more services are invalid for the specified pyme.');
        }

        $totalAmount = $services->sum('price');

        // TODO: Implementar pasarela de pago si el tipo de pago es igual a 2 (tarjeta)
        if ($paymentMethodId === 2) {
            // Lógica de integración con la pasarela de pago
            $transactionId = 'txn_' . uniqid();
        }

        $payment = Payment::create([
            'pyme_id' => $pymeId,
            'total' => $totalAmount,
            'commission_id' => $commission ? $commission->id : null,
            'net_amount' => $commission ? $totalAmount * (1 - $commission->percentage / 100) : $totalAmount,
            'payment_method_id' => $paymentMethodId,
            'transaction_id' => $paymentMethodId === 2 ? $transactionId : null,
            'status_id' => 1,
            'date' => $now->format('Y-m-d'),
        ]);

        return $payment;
    }

    public function updateStatus(?string $transactionId = null, ?int $paymentId = null, string $status, string $callback = 'webpay')
    {
        if (!$transactionId && !$paymentId) {
            throw new \Exception('Either transaction ID or payment ID must be provided.');
        }

        $query = Payment::query();

        if ($transactionId) {
            $query->where('transaction_id', $transactionId);
        }

        if ($paymentId) {
            $query->where('id', $paymentId);
        }

        $payment = $query->first();

        if (!$payment) {
            throw new \Exception('Payment not found for the given ID.');
        }

        // Aquí se puede agregar lógica adicional para validar el estado recibido
        $statusMapping = [
            'webpay' => [
                'success' => 2, // Pagado
                'failed' => 3,  // Fallido
                'pending' => 4, // Pendiente
            ],
            'mercado_pago' => [
                'approved' => 2,
                'rejected' => 3,
                'in_process' => 4,
                'cancelled' => 5,
                'refunded' => 6,
            ],
            'flow' => [
                'paid' => 2,
                'declined' => 3,
                'pending' => 4,
                'cancelled' => 5,
                'refunded' => 6,
            ],
            'efectivo' => [
                'paid' => 2,
                'cancelled' => 5,
            ],
        ];

        if (isset($statusMapping[$callback][$status])) {
            $payment->status_id = $statusMapping[$callback][$status];
            $payment->save();

            if ($statusMapping[$callback][$status] === 2) {
                $reservation = (new ReservationService())->getByPaymentId($payment->id);

                if ($reservation) {
                    $reservation->status_id = 2; // Asumiendo que 2 es el estado "confirmado" para la reserva
                    $reservation->save();
                }
            }
        } else {
            throw new \Exception('Invalid status or callback provided.');
        }

        return $payment;
    }
}
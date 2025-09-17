<?php

namespace App\Http\Controllers;

use App\Http\Requests\Reservation\CreateReservationRequest;
use App\Services\ReservationService;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function getByPyme(int $pymeId, string $startDate, string $endDate)
    {
        $reservations = (new ReservationService())->getByPyme($pymeId, $startDate, $endDate);

        return response()->json([
            'message' => 'Reservations retrieved successfully',
            'reservations' => $reservations,
        ], 200);
    }

    public function getByClient(string $startDate, string $endDate)
    {
        $reservations = (new ReservationService())->getByClient(
            Auth::id(),
            $startDate,
            $endDate
        );

        return response()->json([
            'message' => 'Reservations retrieved successfully',
            'reservations' => $reservations,
        ], 200);
    }

    public function create(CreateReservationRequest $request)
    {
        $data = $request->safe()->all();

        $reservation = (new ReservationService())->create($data);

        return response()->json([
            'message' => 'Reservation created successfully',
            'reservation' => $reservation,
        ], 201);
    }
}

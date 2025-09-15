<?php

namespace App\Http\Controllers;

use App\Http\Requests\Schedule\ScheduleCreateRequest;
use App\Http\Requests\Schedule\ScheduleUpdateDateRequest;
use App\Services\ScheduleService;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function getByPymeAndDates(int $pymeId, string $startDate, string $endDate)
    {
        $scheduleService = new ScheduleService();

        return response()->json($scheduleService->getByDates($startDate, $endDate, $pymeId));
    }

    public function createRotativeSchedule(ScheduleCreateRequest $request, int $pymeId)
    {
        $data = $request->safe()->all();
        $scheduleService = new ScheduleService();

        $scheduleService->createRotativeSchedule($pymeId, $data);

        return response()->json(['message' => 'Horarios creados exitosamente.'], 201);
    }

    public function updateDateSchedule(ScheduleUpdateDateRequest $request, int $pymeId)
    {
        $data = $request->safe()->all();
        $scheduleService = new ScheduleService();

        $scheduleService->updateDateSchedule($pymeId, $data);

        return response()->json(['message' => 'Horarios actualizados exitosamente.'], 200);
    }

    public function deleteByPymeAndDates(string $startDate, string $endDate, int $pymeId)
    {
        $scheduleService = new ScheduleService();

        $scheduleService->getDeleteByDatesAndPyme($startDate, $endDate, $pymeId);

        return response()->json(['message' => 'Horarios eliminados exitosamente.'], 200);
    }
}

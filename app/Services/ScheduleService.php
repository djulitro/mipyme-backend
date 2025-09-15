<?php

namespace App\Services;

use App\Models\Holiday;
use App\Models\Schedule;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;

class ScheduleService
{
    public function getByDates(string $startDate, string $endDate, int $pymeId)
    {
        return Schedule::whereBetween('date', [$startDate, $endDate])
            ->where('pyme_id', $pymeId)
            ->where('is_active', true)
            ->get();
    }

    public function createRotativeSchedule(int $pymeId, array $data)
    {
        try {
            $schedulesData = [];
            $startDate = new Carbon($data['start_date']);
            $endDate = $startDate->copy()->addYear();

            $holidays = array_flip($this->holidaysByYear($startDate->year));

            for ($date = $startDate->copy(); $date->lessThanOrEqualTo($endDate); $date->addDay()) {
                if (in_array($date->dayOfWeek, $data['days_of_week'])) {
                    if (isset($data['exclude_dates']) && in_array($date->toDateString(), $data['exclude_dates'])) {
                        continue;
                    }

                    if (isset($holidays[$date->toDateString()]) && !$data['include_holidays']) {
                        continue;
                    }               

                    $schedulesData[] = [
                        'pyme_id' => $pymeId,
                        'date' => $date->toDateString(),
                        'start_time' => $data['start_time'],
                        'end_time' => $data['end_time'],
                        'is_active' => true,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }

            DB::transaction(function () use ($schedulesData) {
                Schedule::insert($schedulesData);
            });
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage());
        }
    }

    public function updateDateSchedule(int $pymeId, array $data)
    {
        try {
            $updateData = [];
            $ids = array_column($data['schedule'], 'id');
            
            // Verificamos que los schedules pertenezcan al pyme
            $existingSchedules = Schedule::where('pyme_id', $pymeId)
            ->whereIn('id', $ids)
            ->get();

            $existingSchedulesIds = $existingSchedules->pluck('id')->toArray();

            foreach ($data['schedule'] as $item) {
                if (in_array($item['id'], $existingSchedulesIds)) {
                    $schedule = $existingSchedules->firstWhere('id', $item['id']);
                    $updateData[] = [
                        'id' => $item['id'],
                        'pyme_id' => $pymeId,
                        'date' => $schedule->date,
                        'start_time' => $item['start_time'] ?? $schedule->start_time,
                        'end_time' => $item['end_time'] ?? $schedule->end_time,
                        'is_active' => $item['is_active'] ?? $schedule->is_active,
                        'updated_at' => now(),
                    ];
                }
            }

            if (!empty($updateData)) {
                DB::transaction(function () use ($updateData) {
                    // Usamos upsert para actualizar múltiples registros de una vez
                    Schedule::upsert(
                        $updateData,
                        ['id'], // columna única para identificar registros
                        ['start_time', 'end_time', 'is_active', 'updated_at'] // columnas a actualizar
                    );
                });
            }
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage());
        }
    }

    public function getDeleteByDatesAndPyme(string $startDate, string $endDate, int $pymeId)
    {
        try {
            DB::transaction(function () use ($startDate, $endDate, $pymeId) {
                Schedule::whereBetween('date', [$startDate, $endDate])
                    ->where('pyme_id', $pymeId)
                    ->delete();
            });
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage());
        }
    }

    private function holidaysByYear(int $year)
    {
        $holidays = Holiday::all();

        return $holidays->map(function ($holiday) use ($year) {
            return [
                'date' => Carbon::create($year, $holiday->month, $holiday->day)->toDateString(),
                'name' => $holiday->name,
            ];
        })->pluck('date')->toArray();
    }

}
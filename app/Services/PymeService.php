<?php

namespace App\Services;

use App\Models\Pyme;

class PymeService
{
    public function getPyme(int $userId)
    {
        return Pyme::where('user_id', $userId)->first();
    }

    public function updatePyme(int $userId, array $data)
    {
        $pyme = Pyme::updateOrCreate(
            ['user_id' => $userId],
            $data
        );

        return $pyme;
    }
}
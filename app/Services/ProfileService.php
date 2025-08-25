<?php

namespace App\Services;

use App\Models\Profile;

class ProfileService
{
    public function getProfile(int $userId)
    {
        return Profile::where('user_id', $userId)->first();
    }

    public function updateProfile(int $userId, array $data)
    {
        $profile = Profile::updateOrCreate(
            ['user_id' => $userId],
            $data
        );

        return $profile;
    }
}
<?php

namespace App\Services;

use App\Models\Profile;

class ProfileService
{
    public function getProfile(int $userId)
    {
        return Profile::where('user_id', $userId)->first();
    }
}
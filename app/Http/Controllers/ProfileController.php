<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Services\ProfileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function getProfile()
    {
        $user = Auth::user();

        $profile = (new ProfileService())->getProfile($user->id);

        return response()->json([
            'message' => 'Información del perfil obtenida correctamente',
            'profile' => $profile
        ]);
    }


}
<?php

namespace App\Http\Controllers;

use App\Http\Requests\Profile\UpdateProfileRequest;
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

    public function updateProfile(UpdateProfileRequest $request)
    {
        $data = $request->safe()->all();
        $user = Auth::user();
        
        // TODO: Se tiene que agregar la lógica para subir la imagen y obtener la URL
        $profile = (new ProfileService())->updateProfile($user->id, $data);

        return response()->json([
            'message' => 'Perfil actualizado correctamente',
            'profile' => $profile
        ]);
    }
}
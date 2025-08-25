<?php

namespace App\Http\Controllers;

use App\Http\Requests\Pyme\UpdatePymeRequest;
use App\Services\PymeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PymeController extends Controller
{
    public function getPyme()
    {
        $user = Auth::user();

        $pyme = (new PymeService())->getPyme($user->id);

        return response()->json([
            'message' => 'Información de la Pyme obtenida correctamente',
            'pyme' => $pyme
        ]);
    }

    public function updatePyme(UpdatePymeRequest $request)
    {
        $data = $request->safe()->all();
        $user = Auth::user();
        
        // TODO: Se tiene que agregar la lógica para subir la imagen y obtener la URL
        $pyme = (new PymeService())->updatePyme($user->id, $data);

        return response()->json([
            'message' => 'Pyme actualizada correctamente',
            'pyme' => $pyme
        ]);
    }
}

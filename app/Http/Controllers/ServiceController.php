<?php

namespace App\Http\Controllers;

use App\Http\Requests\Service\CreateServiceRequest;
use App\Http\Requests\Service\UpdateServiceRequest;
use App\Services\ServiceService;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public ServiceService $serviceService;
    
    public function __construct()
    {
        $this->serviceService = new ServiceService();    
    }

    public function getByPyme(int $pymeId)
    {
        $service = $this->serviceService->getByPyme($pymeId);

        return response()->json($service);
    }

    public function getAllByPyme(int $pymeId)
    {
        $service = $this->serviceService->getAllByPyme($pymeId);

        return response()->json($service);
    }

    public function getById(int $serviceId)
    {
        $service = $this->serviceService->getById($serviceId);

        return response()->json($service);
    }

    public function create(CreateServiceRequest $request)
    {
        $data = $request->safe()->all();
        $service = $this->serviceService->create($data);

        return response()->json($service, 201);
    }

    public function update(int $serviceId, UpdateServiceRequest $request)
    {
        $data = $request->safe()->all();
        $service = $this->serviceService->update($serviceId, $data);

        return response()->json($service);
    }

    public function changeStatus(int $serviceId, Request $request)
    {
        $request->validate([
            'status' => 'required|boolean',
        ]);

        $status = $request->input('status');

        $service = $this->serviceService->changeStatus($serviceId, $status);

        return response()->json($service);
    }

    public function delete(int $serviceId)
    {
        $this->serviceService->delete($serviceId);

        return response()->json([
            'message' => 'Servicio Eliminado correctamente.'
        ], 204);
    }
}

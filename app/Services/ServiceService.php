<?php

namespace App\Services;

use App\Models\Service;

class ServiceService
{
    public function getByPyme(int $pymeId)
    {
        return Service::where('pyme_id', $pymeId)->where('status', 1)->get();
    }

    public function getByIds(array $serviceIds, ?int $pymeId = null)
    {
        $services = Service::whereIn('id', $serviceIds)->where('status', 1);

        if (!is_null($pymeId)) {
            $services->where('pyme_id', $pymeId);
        }

        return $services->get();
    }

    public function getAllByPyme(int $pymeId)
    {
        return Service::where('pyme_id', $pymeId)->get();
    }

    public function getById(int $serviceId)
    {
        return Service::find($serviceId);
    }

    public function create(array $data)
    {
        $service = Service::create($data);
        
        return $service;
    }

    public function update(int $serviceId, array $data)
    {
        $service = Service::find($serviceId);

        if (!$service) {
            throw new \Exception('Service not found');
        }

        $service->update($data);

        return $service;
    }

    public function changeStatus(int $serviceId, string $status)
    {
        $service = Service::find($serviceId);

        if (!$service) {
            throw new \Exception('Service not found');
        }

        $service->status = $status ? 1 : 0;
        $service->save();

        return $service;
    }

    public function delete(int $serviceId)
    {
        $service = Service::find($serviceId);

        if (!$service) {
            throw new \Exception('Service not found');
        }

        $service->delete();

        return true;
    }
}
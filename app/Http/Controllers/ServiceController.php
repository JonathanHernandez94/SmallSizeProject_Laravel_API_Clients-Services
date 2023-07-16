<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceRequest;
use App\Models\Service;
use Illuminate\Http\JsonResponse;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $services = Service::all();
        return response()->json($services);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ServiceRequest $request): JsonResponse
    {
        $service = new Service();

        $service->name = $request->name;
        $service->description = $request->description;
        $service->price = $request->price;
        $service->save();

        $data = [
            'message' => 'service created successfully',
            'service'  => $service
        ];

        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ServiceRequest $request, Service $service): JsonResponse
    {
        $service = Service::findOrFail($request->service_id);
        $service->name = $request->name;
        $service->description = $request->description;
        $service->price = $request->price;
        $service->save();
        $data = [
            'message' => 'service updated successfully',
            'service'  => $service
        ];
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service): JsonResponse
    {
        $service = Service::findOrFail($service->id);
        $service->delete($service);
        $data = [
            'message' => 'service deleted successfully',
            'service'  => $service
        ];
        return response()->json($data);
    }
}

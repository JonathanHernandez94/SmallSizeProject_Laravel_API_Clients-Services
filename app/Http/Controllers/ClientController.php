<?php

namespace App\Http\Controllers;

use App\Http\Requests\BaseFormRequest;
use App\Models\Client;
use App\Http\Requests\ClientRequest;
use App\Utilities\Factories\PlanFactory;
use Illuminate\Http\JsonResponse;


class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $clients = Client::with('services')->get();
        return response()->json($clients);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClientRequest $request): JsonResponse
    {
        $client = new Client();

        $client->name = $request->name;
        $client->email = $request->email;
        $client->phone = $request->phone ?? null;
        $client->address = $request->address ?? null;
        $client->save();

        $data = [
            'message' => 'Client created successfully',
            'client'  => $client
        ];
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client): JsonResponse
    {
        $client = Client::findOrFail($client->id);
        $data = [
            'message' => 'Client details',
            'client' => $client,
            'services' => $client->services
        ];

        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClientRequest $request, Client $client)
    {
        $validatedData = $request->validated();
        $client = Client::findOrFail($client->id);

        $client->update($validatedData);

        $data = [
            'message' => 'Client updated successfully',
            'client'  => $client
        ];

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client): JsonResponse
    {
        $client = Client::findOrFail($client->id);
        $client->delete($client);
        $data = [
            'message' => 'Client deleted successfully',
            'client'  => $client
        ];
        return response()->json($data);
    }

    public function attach(BaseFormRequest $request): JsonResponse
    {
        $client = Client::findOrFail($request->client_id);
        $client->services()->attach($request->service_id);

        $data = [
            'message' => 'service successfuly attached',
            'client'  => $client
        ];
        return response()->json($data);
    }

    public function detach(BaseFormRequest $request): JsonResponse
    {
        $client = Client::findOrFail($request->client_id);
        $client->services()->detach($request->service_id);
        $data = [
            'message' => 'service successfully dettached',
            'client'  => $client
        ];
        return response()->json($data);
    }

    public function getClientDiscount(Client $client): JsonResponse
    {
        $client = Client::findOrFail($client->id);

        $planFactory = new PlanFactory;
        $plan = $planFactory->getPlan($client);
        $discount = $plan->getDiscount();

        $data = [
            'message' => 'service successfully dettached',
            'discount'  => $discount
        ];
        return response()->json($data);
    }
}

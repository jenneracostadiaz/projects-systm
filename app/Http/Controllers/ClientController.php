<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use App\Models\Client;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::all();
        return response()->json($clients);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClientRequest $request)
    {
        $client = new Client($request->input());
        $client->save();

        return response()->json(
            [
                'status' => true,
                'message' => 'Client created successfully',
                'data' => $client
            ],
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        return response()->json([
            'status' => true,
            'data' => $client
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClientRequest $request, Client $client)
    {

        $client->update($request->input());
        return response()->json(
            [
                'status' => true,
                'message' => 'Client updated successfully',
                'data' => $client
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $client->delete();
        return response()->json(
            [
                'status' => true,
                'message' => 'Client deleted successfully'
            ]
        );
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use App\Models\Client;

class ClientController extends Controller
{
    
    public function index()
    {
        $clients = Client::paginate(10);
        return $this->getResponse(true, 'Clients retrieved successfully', $clients);
    }

    public function store(ClientRequest $request)
    {
        $client = new Client($request->input());
        $client->save();
        return $this->getResponse(true, 'Client created successfully', $client);
    }

    public function show(Client $client)
    {
        return $this->getResponse(true, 'Client retrieved successfully', $client);
    }

    public function update(ClientRequest $request, Client $client)
    {
        $client->update($request->input());
        return $this->getResponse(true, 'Client updated successfully', $client);
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return $this->getResponse(true, 'Client deleted successfully');
    }
}

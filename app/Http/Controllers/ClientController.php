<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Http\Requests\ClientRequest;
use App\Http\Resources\ClientResource;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'status' => 200,
            'clients' => ClientResource::collection(Client::all())
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ClientRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientRequest $request)
    {
        $client = Client::create(([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'num_tel' => $request->input('num_tel'),
            'raison_sociale' => $request->input('raison_sociale'),
            'logo' => $request->input('logo'),
            'etat' => 'prospection'
        ]));

        return response()->json([
            'status' => 200,
            'client' => new ClientResource($client)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        if(!$client) {
            return response()->json([
                'status' => 401,
                'message' => 'The client data does not exist'
            ]);
        }
        else {
            return response()->json([
                'status' => 200,
                'client' => new ClientResource($client)
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ClientRequest  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(ClientRequest $request, Client $client)
    {
        if(!$client) {
            return response()->json([
                'status' => 401,
                'message' => 'The client data does not exist'
            ]);
        }
        else {
            $client->update(([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'num_tel' => $request->input('num_tel'),
                'raison_sociale' => $request->input('raison_sociale'),
                'logo' => $request->input('CV'),
                'etat' => $request->input('etat')
            ]));

            return response()->json([
                'status' => 200,
                'client' => new ClientResource($client)
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        if(!$client) {
            return response()->json([
                'status' => 401,
                'message' => 'The client data does not exist'
            ]);
        }
        else {
            $client->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Deleted successfully!'
            ]);
        }
    }
}

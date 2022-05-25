<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Client;
use App\Http\Resources\TicketResource;
use App\Http\Resources\ClientResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\TicketRequest;


class TicketController extends Controller
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
            'tickets' => TicketResource::collection(Ticket::all())
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
     * @param  \App\Http\Requests\TicketRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TicketRequest $request)
    {
        //$client = Client::find(Auth::client()->id);
        //if ($client->etat != "prospection"){
            $ticket = Ticket::create(([
                'client_id' => $request->input('client_id'),
                'projet_id' => $request->input('projet_id'),
                'titre' => $request->input('titre'),
                'description' => $request->input('description'),
                'file' => $request->input('file')
            ]));
        //}

        return response()->json([
            'status' => 200,
            'ticket' => new TicketResource($ticket)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        //$client = Client::find(Auth::client()->id);
        if(!$ticket) {
            return response()->json([
                'status' => 401,
                'message' => 'The ticket data does not exist'
            ]);
        }
        else {
            $client = $ticket->client;
            return response()->json([
                'status' => 200,
                'ticket' => new TicketResource($ticket),
                //'client' => new ClientResource($client)
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\TicketRequest  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(TicketRequest $request, Ticket $ticket)
    {
        //$client = Client::find(Auth::client()->id);
        if(!$ticket->client) {
            return response()->json([
                'status' => 401,
                'message' => 'The ticket data does not exist'
            ]);
        }
        else {
            $ticket = update(([
                'client_id' => $request->input('client_id'),
                'projet_id' => $request->input('projet_id'),
                'titre' => $request->input('titre'),
                'description' => $request->input('description'),
                'file' => $request->input('file')
            ]));

            return response()->json([
                'status' => 200,
                'ticket' => new TicketResource($ticket)
            ]);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        if(!$ticket) {
            return response()->json([
                'status' => 401,
                'message' => 'The ticket data does not exist'
            ]);
        }
        else {
            $ticket->delete();
            return response()->json([
                'status' => 204,
                'message' => 'Deleted successfully!'
            ]);
        }
    }
}

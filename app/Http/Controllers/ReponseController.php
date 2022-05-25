<?php

namespace App\Http\Controllers;

use App\Models\Reponse;
use App\Models\Ticket;
use App\Models\Client;
use App\Http\Resources\ReponseResource;
use App\Http\Resources\TicketResource;
use App\Http\Resources\ClientResource;
use App\Http\Requests\ReponseRequest;


class ReponseController extends Controller
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
            'reponses' => ReponseResource::collection(Reponse::all())
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
     * @param  \App\Http\Requests\ReponseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReponseRequest $request)
    {
        $reponse = Reponse::create(([
            'personnel_id' => $request->input('personnel_id'),
            'ticket_id' => $request->input('ticket_id'),
            'titre' => $request->input('titre'),
            'description' => $request->input('description'),
            'file' => $request->input('file'),
            'image' => $request->input('image'),
        ]));

        return response()->json([
            'status' => 200,
            'reponse' => new ReponseResource($reponse)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reponse  $reponse
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reponse = Reponse::where('id', $id)->first();
        if(!$reponse) {
            return response()->json([
                'status' => 401,
                'message' => 'The response data does not exist'
            ]);
        }
        else {
            $ticket = $reponse->ticket;
            return response()->json([
                'status' => 200,
                'reponse' => new ReponseResource($reponse),
                'ticket' => new ReponseResource($ticket)
            ]);
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reponse  $reponse
     * @return \Illuminate\Http\Response
     */
    public function edit(Reponse $reponse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ReponseRequest  $request
     * @param  \App\Models\Reponse  $reponse
     * @return \Illuminate\Http\Response
     */
    public function update(ReponseRequest $request, Reponse $reponse)
    {
        if(!$reponse) {
            return response()->json([
                'status' => 401,
                'message' => 'The response data does not exist'
            ]);
        }
        else {
            $reponse = update(([
                'ticket_id' => $request->input('ticket_id'),
                'titre' => $request->input('titre'),
                'description' => $request->input('description'),
                'file' => $request->input('file'),
                'image' => $request->input('image'),
            ]));

            return response()->json([
                'status' => 200,
                'reponse' => new ReponseResource($reponse)
            ]);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reponse  $reponse
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reponse $reponse)
    {
        if(!$reponse) {
            return response()->json([
                'status' => 401,
                'message' => 'The response data does not exist'
            ]);
        }
        else {
            $reponse->delete();
            return response()->json([
                'status' => 204,
                'message' => 'Deleted successfully!'
            ]);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Reponse;
use App\Http\Requests\StoreReponseRequest;
use App\Http\Requests\UpdateReponseRequest;

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
            'reponses' => ReponsesResource::collection(Reponse::all())
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
     * @param  \App\Http\Requests\StoreReponseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReponseRequest $request)
    {
        $reponse = Reponse::create(([
            'client_id' => $request->input('client_id'),
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
    public function show(Reponse $reponse)
    {
        if(!$reponse) {
            return response()->json([
                'status' => 401,
                'message' => 'The response data does not exist'
            ]);
        }
        else {
            return response()->json([
                'status' => 200,
                'reponse' => new ReponseResource($reponse)
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
     * @param  \App\Http\Requests\UpdateReponseRequest  $request
     * @param  \App\Models\Reponse  $reponse
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReponseRequest $request, Reponse $reponse)
    {
        if(!$reponse) {
            return response()->json([
                'status' => 401,
                'message' => 'The response data does not exist'
            ]);
        }
        else {
            $reponse = update(([
                'client_id' => $request->input('client_id'),
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

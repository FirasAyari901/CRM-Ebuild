<?php

namespace App\Http\Controllers;

use App\Models\Projet;
use App\Models\Equipe;
use App\Models\Ticket;
use App\Http\Resources\ProjetResource;
use App\Http\Resources\EquipeResource;
use App\Http\Resources\TicketResource;
use App\Http\Requests\ProjetRequest;

class ProjetController extends Controller
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
            'projets' => ProjetResource::collection(Projet::all())
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
     * @param  \App\Http\Requests\ProjetRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjetRequest $request)
    {
        $projet = Projet::create([
            'ticket_id' => $request->input('ticket_id'),
            'equipe_id' => $request->input('equipe_id'),
            'project_name' => $request->input('project_name'),
            'description'=> $request->input('description'),
            'deadline' => $request->input('deadline'),
            'date_debut' => $request->input('date_debut'),
            'etat' => $request->input('etat'),
            'file_cdc' => $request->input('file_cdc'),
            'capture_dc ' => $request->input('capture_dc')
        ]);
        
        return reponse()->json([
            'status' => 200,
            'projet' => new ProjetResource($projet)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Projet  $projet
     * @return \Illuminate\Http\Response
     */
    public function show(Projet $projet)
    {
        if(!$projet) {
            return response()->json([
                'status' => 401,
                'message' => 'The staff member data does not exist'
            ]);
        }
        else {
            $equipe = $projet->equipe();
            return response()->json([
                'status' => 200,
                'projet' => new ProjetResource($projet),
                'equipe' => new EquipeResource($equipe),
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Projet  $projet
     * @return \Illuminate\Http\Response
     */
    public function edit(Projet $projet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ProjetRequest  $request
     * @param  \App\Models\Projet  $projet
     * @return \Illuminate\Http\Response
     */
    public function update(ProjetRequest $request, Projet $projet)
    {
        if(!$projet) {
            return response()->json([
                'status' => 401,
                'message' => 'The project data does not exist'
            ]);
        }
        else {
            $projet = update([
                'equipe_id' => $request->input('equipe_id'),
                'project_name' => $request->input('project_name'),
                'description'=> $request->input('description'),
                'deadline' => $request->input('deadline'),
                'date_debut' => $request->input('date_debut'),
                'etat' => $request->input('etat'),
                'file_cdc' => $request->input('file_cdc'),
                'capture_dc ' => $request->input('capture_dc')
            ]);

            return response()->json([
                'status' => 200,
                'projet' => new ProjetResource($projet)
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Projet  $projet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Projet $projet)
    {
        if(!$projet) {
            return response()->json([
                'status' => 401,
                'message' => 'The project data does not exist'
            ]);
        }
        else {
            $projet->delete();
            return response()->json([
                'status' => 204,
                'message' => 'Deleted successfully!'
            ]);
        }
    }
}

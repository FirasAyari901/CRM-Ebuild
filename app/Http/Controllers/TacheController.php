<?php

namespace App\Http\Controllers;

use App\Models\Tache;
use App\Models\Projet;
use App\Models\Personnel;
use App\Models\SousTache;
use App\Models\Commentaire;
use App\Http\Resources\TacheResource;
use App\Http\Resources\SousTacheResource;
use App\Http\Resources\ProjetResource;
use App\Http\Resources\PersonnelResource;
use App\Http\Resources\CommentaireResource;
use App\Http\Requests\TacheRequest;

class TacheController extends Controller
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
            'taches' => TacheResource::collection(Tache::all())
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
     * @param  \App\Http\Requests\TacheRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TacheRequest $request)
    {
        $tache = Tache::create(([
            'projet_id' => $request->input('projet_id'),
            'personnel_id' => $request->input('personnel_id'),
            'titre' => $request->input('titre'),
            'deadline' => $request->input('deadline'),
            'description' => $request->input('description'),
            'etat' => $request->input('etat')
        ]));

        return response()->json([
            'status' => 200,
            'tache' => new TacheResource($tache)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tache  $tache
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tache = Tache::where('id', $id)->first();
        if(!$tache) {
            return response()->json([
                'status' => 401,
                'message' => 'The tache data does not exist'
            ]);
        }
        else {
            $projet = $tache->projet;
            $personnel = $tache->personnel;
            $soustaches = $tache->soustaches;
            $commentaires = array();
            foreach($tache->comments as $comment) {
                $commentaire = new CommentaireResource($comment);
                $commentaires [] = $commentaire;
            }
            return response()->json([
                'status' => 200,
                'tache' => new TacheResource($tache),
                'projet' => new ProjetResource($projet),
                'personnel' => new PersonnelResource($personnel),
                'soustaches' => SousTacheResource::collection($soustaches),
                'commentaires' => $commentaires
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tache  $tache
     * @return \Illuminate\Http\Response
     */
    public function edit(Tache $tache)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\TacheRequest  $request
     * @param  \App\Models\Tache  $tache
     * @return \Illuminate\Http\Response
     */
    public function update($id , TacheRequest $request)
    {
        $tache = Tache::where('id', $id)->first();
        if(!$tache) {
            return response()->json([
                'status' => 401,
                'message' => 'The tache data does not exist'
            ]);
        }
        else {
            $tache->update([
                'projet_id' => $request->input('projet_id'),
                'personnel_id' => $request->input('personnel_id'),
                'titre' => $request->input('titre'),
                'deadline' => $request->input('deadline'),
                'description' => $request->input('description'),
                'etat' => $request->input('etat')
            ]);

            return response()->json([
                'status' => 200, 
                'tache' => new TacheResource($tache),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tache  $tache
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tache = Tache::where('id', $id)->first();
        if(!$tache) {
            return response()->json([
                'status' => 401,
                'message' => 'The tache data does not exist'
            ]);
        }
        else {
            $tache->delete();
            return response()->json([
                'status' => 204,
                'message' => 'Deleted successfully!'
            ]);
        }
    }
}

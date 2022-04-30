<?php

namespace App\Http\Controllers;

use App\Models\Tache;
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
            'titre' => $request->input('titre'),
            'deadline' => $request->input('deadline'),
            'description' => $request->input('description'),
            'perso_id' => $request->input('perso_id')
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
    public function show(Tache $tache)
    {
        if(!$tache) {
            return response()->json([
                'status' => 401,
                'message' => 'The tache data does not exist'
            ]);
        }
        else {
            $projet = $tache->projet();
            $personnel = $tache->personnel();

            return response()->json([
                'status' => 200,
                'tache' => new TacheResource($tache),
                'projet' => new ProjetResource($projet),
                'personnel' => new PersonnelResource($personnel)
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
    public function update(TacheRequest $request, Tache $tache)
    {
        if(!$tache) {
            return response()->json([
                'status' => 401,
                'message' => 'The tache data does not exist'
            ]);
        }
        else {
            $tache->update([
                'projet_id' => $request->input('projet_id'),
                'titre' => $request->input('titre'),
                'deadline' => $request->input('deadline'),
                'description' => $request->input('description'),
                'perso_id' => $request->input('perso_id')
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
    public function destroy(Tache $tache)
    {
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

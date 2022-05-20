<?php

namespace App\Http\Controllers;

use App\Models\SousTache;
use App\Models\Personnel;
use App\Models\commentaire;
use App\Models\Projet;
use App\Http\Resources\SousTacheResource;
use App\Http\Resources\ProjetResource;
use App\Http\Resources\PersonnelResource;
use App\Http\Requests\SousTacheRequest;

class SousTacheController extends Controller
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
            'soustaches' => SousTacheResource::collection(SousTache::all())
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
     * @param  \App\Http\Requests\SousTacheRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SousTacheRequest $request)
    {
        $sousTache = SousTache::create(([
            'tache_id' => $request->input('tache_id'),
            'personnel_id' => $request->input('personnel_id'),
            'titre' => $request->input('titre'),
            'deadline' => $request->input('deadline'),
            'description' => $request->input('description'),
            'etat' => $request->input('etat')
        ]));

        return response()->json([
            'status' => 200,
            'soustache' => new SousTacheResource($sousTache)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SousTache  $sousTache
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sousTache = SousTache::where('id', $id)->first();
        if(!$sousTache) {
            return response()->json([
                'status' => 401,
                'message' => 'The subtask data does not exist'
            ]);
        }
        else {
            $personnel = $sousTache->personnel;
            return response()->json([
                'status' => 200,
                'soustache' => new SousTacheResource($sousTache),
                'personnel' => new PersonnelResource($personnel)
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SousTache  $sousTache
     * @return \Illuminate\Http\Response
     */
    public function edit(SousTache $sousTache)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\SousTacheRequest  $request
     * @param  \App\Models\SousTache  $sousTache
     * @return \Illuminate\Http\Response
     */
    public function update(SousTacheRequest $request, $id)
    {
        $sousTache = SousTache::where('id', $id)->first();
        if(!$sousTache) {
            return response()->json([
                'status' => 401,
                'message' => 'The subtask data does not exist'
            ]);
        }
        else {
            $sousTache->update([
                'tache_id' => $request->input('tache_id'),
                'titre' => $request->input('titre'),
                'deadline' => $request->input('deadline'),
                'description' => $request->input('description')
            ]);

            return response()->json([
                'status' => 200, 
                'sous-tache' => new SousTacheResource($sousTache),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SousTache  $sousTache
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sousTache = SousTache::where('id', $id)->first();
        if(!$sousTache) {
            return response()->json([
                'status' => 401,
                'message' => 'The subtask data does not exist'
            ]);
        }
        else {
            $sousTache->delete();
            return response()->json([
                'status' => 204,
                'message' => 'Deleted successfully!'
            ]);
        }
    }
}

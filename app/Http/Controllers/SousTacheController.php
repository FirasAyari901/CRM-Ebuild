<?php

namespace App\Http\Controllers;

use App\Models\SousTache;
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
            'sous-taches' => SousTacheResource::collection(SousTache::all())
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
            'titre' => $request->input('titre'),
            'deadline' => $request->input('deadline'),
            'description' => $request->input('description')
        ]));

        return response()->json([
            'status' => 200,
            'sous-tache' => new SousTacheResource($sousTache)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SousTache  $sousTache
     * @return \Illuminate\Http\Response
     */
    public function show(SousTache $sousTache)
    {
        if(!$sousTache) {
            return response()->json([
                'status' => 401,
                'message' => 'The subtask data does not exist'
            ]);
        }
        else {
            $tache = $sousTache->tache();

            return response()->json([
                'status' => 200,
                'tache' => $tache,
                'sous-tache' => new SousTacheResource($sousTache)
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
     * @param  \App\Http\Requests\UpdateSousTacheRequest  $request
     * @param  \App\Models\SousTache  $sousTache
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSousTacheRequest $request, SousTache $sousTache)
    {
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
    public function destroy(SousTache $sousTache)
    {
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

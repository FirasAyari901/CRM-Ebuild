<?php

namespace App\Http\Controllers;

use App\Models\Equipe;
use App\Models\Personnel;
use App\Http\Resources\EquipeResource;
use App\Http\Resources\PersonnelResource;
use App\Http\Requests\EquipeRequest;

class EquipeController extends Controller
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
            'Equipes' => EquipeResource::collection(Equipe::all())
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
     * @param  \App\Http\Requests\EquipeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EquipeRequest $request)
    {
        $equipe = Equipe::create([
            'pseudo' => $request->input('pseudo'),
        ]);
        $members = array();
        $members = $request->input("personnels");
        foreach($members as $personnel) {
            $equipe->personnels()->attach($personnel);
        }
        return response()->json([
            'status' => 200,
            'equipe' => new EquipeResource($equipe),
            'personnels' => PersonnelResource::collection($equipe->personnels)
        ]);
  
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Equipe  $equipe
     * @return \Illuminate\Http\Response
     */
    public function show(Equipe $equipe )
    {
        if(!$equipe) {
            return response()->json([
                'status' => 401,
                'message' => 'The team data does not exist'
            ]);
        }
        $members = array();
        foreach($equipe->personnels as $personnel) {
            $member = new PersonnelResource($personnel);
            $members [] = $member;
        }
        return response()->json([
            'status' => 200,
            'equipe' => new EquipeResource($equipe),
            'members' => $members
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Equipe  $equipe
     * @return \Illuminate\Http\Response
     */
    public function edit(Equipe $equipe)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\EquipeRequest  $request
     * @param  \App\Models\Equipe  $equipe
     * @return \Illuminate\Http\Response
     */
    public function update(EquipeRequest $request, Equipe $equipe)
    {
        if(!$equipe) {
            return response()->json([
                'status' => 401,
                'message' => 'The team data does not exist'
            ]);
        }
        else {
            $equipe->update([
                'pseudo' => $request->input('pseudo'),
            ]);
            $members = array();
            $members = $request->input("personnels");
            foreach($members as $personnel) {
                $equipe->personnels()->attach($personnel);
            }
            return response()->json([
                'status' => 200,
                'equipe' => new EquipeResource($equipe),
                'personnels' => PersonnelResource::collection($equipe->personnels)
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Equipe  $equipe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Equipe $equipe)
    {
        if(!$equipe) {
            return response()->json([
                'status' => 401,
                'message' => 'The team data does not exist'
            ]);
        }
        else {
            $equipe->delete();
            return response()->json([
                'status' => 204,
                'message' => 'Deleted successfully!'
            ]);
        }
    }
}

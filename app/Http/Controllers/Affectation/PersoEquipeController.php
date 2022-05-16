<?php

namespace App\Http\Controllers\Affectation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Equipe;
use App\Models\Personnel;
use App\Http\Resources\EquipeResource;
use App\Http\Resources\PersonnelResource;
use App\Http\Requests\PersoEquipeRequest;

class PersoEquipeController extends Controller
{
     /**
     * attach an existing personnel to an existing team in storage.
     *
     * @param  \App\Http\Requests\PersoEquipeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function attachPerso(PersoEquipeRequest $request)
    {
        $request->validate([
            'personnel_id' => 'required',
            'equipe_id' => 'required',
        ]);
        $equipe = Equipe::where('id', $request->equipe_id)->first();
        $equipe->personnels()->attach($request->personnel_id);
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
     * detach an existing personnel from an existing team in storage.
     *
     * @param  \App\Http\Requests\PersoEquipeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function detachPerso(PersoEquipeRequest $request) {
        $request->validate([
            'personnel_id' => 'required',
            'equipe_id' => 'required',
        ]);
        $equipe = Equipe::where('id', $request->equipe_id)->first();
        $equipe->personnels()->detach($request->personnel_id);
        $members = array();
        $member = "No members added yet !";
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

}
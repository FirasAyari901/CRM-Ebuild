<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use App\Models\Tache;
use App\Models\SousTache;
use App\Models\Personnel;
use App\Http\Resources\PersonnelResource;
use App\Http\Resources\SousTacheResource;
use App\Http\Resources\CommentaireResource;
use App\Http\Resources\TacheResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CommentaireRequest;

class CommentaireController extends Controller
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
            'commentaires' => CommentaireResource::collection(Commentaire::all())
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CommentaireRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentaireRequest $request)
    {
        $commentaire = Commentaire::create(([
            'tache_id' => $request->input('tache_id'),
            'soustache_id' => $request->input('soustache_id'),
            'personnel_id' => Auth::personnel()->id,
            'file' => $request->input('file'),
            'image' => $request->input('image'),
            'description' => $request->input('description')
        ]));

        return response()->json([
            'status' => 200,
            'commentaire' => new CommentaireResource($commentaire)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Commentaire  $commentaire
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $commentaire = Commentaire::where('id', $id)->first();
        if(!commentaire) {
            return response()->json([
                'status' => 401,
                'message' => 'The comment data does not exist'
            ]);
        }
        else {
            $tache = $commentaire->tache;
            $sousTache = $commentaire->soustache;
            return response()->json([
                'status' => 200,
                'tache'  => new TacheResource($tache),
                'sous-tache' => new SousTacheResource($sousTache),
                'commentaire' => new CommentaireResource($commentaire)
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Commentaire  $commentaire
     * @return \Illuminate\Http\Response
     */
    public function edit(Commentaire $commentaire)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CommentaireRequest  $request
     * @param  \App\Models\Commentaire  $commentaire
     * @return \Illuminate\Http\Response
     */
    public function update(CommentaireRequest $request, $id)
    {
        $commentaire = Commentaire::where('id', $id)->first();
        if(!commentaire) {
            return response()->json([
                'status' => 401,
                'message' => 'The comment data does not exist'
            ]);
        }
        else {
            $commentaire = update(([
                'tache_id' => $request->input('tache_id'),
                'soustache_id' => $request->input('soustache_id'),
                'personnel_id' => Auth::personnel()->id,
                'file' => $request->input('file'),
                'image' => $request->input('image'),
                'description' => $request->input('description')
            ]));

            return response()->json([
                'status' => 200,
                'commentaire' => new CommentaireResource($commentaire)
            ]);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Commentaire  $commentaire
     * @return \Illuminate\Http\Response
     */
    public function destroy(Commentaire $commentaire)
    {
        $commentaire = Commentaire::where('id', $id)->first();
        if(!$commentaire) {
            return response()->json([
                'status' => 401,
                'message' => 'The comment data does not exist'
            ]);
        }
        else {
            $commentaire->delete();
            return response()->json([
                'status' => 204,
                'message' => 'Deleted successfully!'
            ]);
        }
    }
}

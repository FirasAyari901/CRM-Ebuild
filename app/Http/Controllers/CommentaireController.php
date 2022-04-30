<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use App\Http\Requests\StoreCommentaireRequest;
use App\Http\Requests\UpdateCommentaireRequest;

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
     * @param  \App\Http\Requests\StoreCommentaireRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCommentaireRequest $request)
    {
        $commentaire = Commentaire::create(([
            'tache_id' => $request->input('tache_id'),
            'soustache_id' => $request->input('soustache_id'),
            'file' => $request->input('file'),
            'image' => $request->input('image'),
            'description' => $request->input('description'),
            'perso_id' => $request->input('perso_id')
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
    public function show(Commentaire $commentaire)
    {
        if(!commentaire) {
            return response()->json([
                'status' => 401,
                'message' => 'The comment data does not exist'
            ]);
        }
        else {
            $tache = $commentaire->tache();
            $sousTache = $commentaire->soustache();
            $client = $commentaire->client();
            $user = $client->user();

            return response()->json([
                'status' => 200,
                'comment left for the client' => new UserResource($user),
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
     * @param  \App\Http\Requests\UpdateCommentaireRequest  $request
     * @param  \App\Models\Commentaire  $commentaire
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCommentaireRequest $request, Commentaire $commentaire)
    {
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
                'file' => $request->input('file'),
                'image' => $request->input('image'),
                'description' => $request->input('description'),
                'perso_id' => $request->input('perso_id')
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

<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Operation;
use App\Http\Resources\DocumentResource;
use App\Http\Resources\OperationResource;
use App\Http\Requests\DocumentRequest;

class DocumentController extends Controller
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
            'documents' => DocumentResource::collection(Document::all())
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
     * @param  \App\Http\Requests\DocumentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DocumentRequest $request)
    {
        $document = Document::create([
            'client_id' => $request->input('client_id'),
            'type_doc' => $request->input('type_doc'),
            'info_supp' => $request->input('info_supp'),
            'etat' => $request->input('etat')
        ]);
        $operations = array();
        $operations = $request->input('operations');
        foreach($operations as $op) {
            $operation = Operation::create([
                'document_id' => $document->id,
                'nature_operation' => $op['nature_operation'],
                'montant_HT' => $op['montant_HT'],
                'montant_TVA' => $op['montant_TVA']
            ]);
        }
        return response()->json([
            'status' => 200,
            'document' => new DocumentResource($document),
            'operations' => OperationResource::collection($document->operations)
        ]);
  
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function show(Document $document)
    {
        if(!$document) {
            return response()->json([
                'status' => 401,
                'message' => 'The document data does not exist'
            ]);
        }
        return response()->json([
            'status' => 200,
            'document' => new DocumentResource($document),
            'operations' => OperationResource::collection($document->operations)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function edit(Document $document)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\DocumentRequest  $request
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function update(DocumentRequest $request, Document $document)
    {
        if(!$equipe) {
            return response()->json([
                'status' => 401,
                'message' => 'The document data does not exist'
            ]);
        }
        $document->update([
            'client_id' => $request->input('client_id'),
            'type_doc' => $request->input('type_doc'),
            'info_supp' => $request->input('info_supp'),
            'etat' => $request->input('etat')
        ]);
        $operations = array();
        $operations = $request->input('operations');
        foreach($operations as $op) {
            $operation = Operation::create([
                'document_id' => $document->id,
                'nature_operation' => $op->nature_operation,
                'montant_HT' => $op->montant_HT,
                'montant_TVA' => $op->montant_TVA
            ]);
        }
        return response()->json([
            'status' => 200,
            'document' => new DocumentResource($document),
            'operations' => OperationResource::collection($document->operations)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(Document $document)
    {
        if(!$document) {
            return response()->json([
                'status' => 401,
                'message' => 'The document data does not exist'
            ]);
        }
        else {
            $document->delete();
            return response()->json([
                'status' => 204,
                'message' => 'Deleted successfully!'
            ]);
        }
    }
}

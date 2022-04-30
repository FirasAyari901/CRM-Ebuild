<?php

namespace App\Http\Controllers;

use App\Models\Personnel;
use App\Http\Requests\PersonnelRequest;
use App\Http\Resources\PersonnelResource;
use Illuminate\Support\Facades\Hash;

class PersonnelController extends Controller
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
            'staff' => PersonnelResource::collection(Personnel::all())
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
     * @param  \App\Http\Requests\PersonnelRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PersonnelRequest $request)
    {
        $personnel = Personnel::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'num_tel' => $request->input('num_tel'),
            'role' => $request->input('role'),
            'CV' => $request->input('CV'),
            'image' => $request->input('image')
        ]);

        return response()->json([
            'status' => 200,
            'personnel' => new PersonnelResource($personnel)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Personnel  $personnel
     * @return \Illuminate\Http\Response
     */
    public function show(Personnel $personnel)
    {
        if(!$personnel) {
            return response()->json([
                'status' => 401,
                'message' => 'The staff member data does not exist'
            ]);
        }
        else{
            return response()->json([
                'status' => 200,
                'personnel' => new PersonnelResource($personnel)
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Personnel  $personnel
     * @return \Illuminate\Http\Response
     */
    public function edit(Personnel $personnel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PersonnelRequest  $request
     * @param  \App\Models\Personnel  $personnel
     * @return \Illuminate\Http\Response
     */
    public function update(PersonnelRequest $request, Personnel $personnel)
    {
        if(!$personnel) {
            return response()->json([
                'status' => 401,
                'message' => 'The staff member data does not exist'
            ]);
        }
        else {
            $personnel->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
                'num_tel' => $request->input('num_tel'),
                'role' => $request->input('role'),
                'CV' => $request->input('CV'),
                'image' => $request->input('image')
            ]);

            return response()->json([
                'status' => 200,
                'personnel' => new PersonnelResource($personnel)
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Personnel  $personnel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Personnel $personnel)
    {   
        if(!$personnel) {
            return response()->json([
                'status' => 401,
                'message' => 'The staff member data does not exist'
            ]);
        }
        else {
            $personnel->delete();
            return response()->json([
                'status' => 204,
                'message' => 'Deleted successfully!'
            ]);
        }
    }
}
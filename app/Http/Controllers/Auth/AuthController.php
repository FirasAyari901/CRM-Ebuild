<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Client;
use App\Http\Resources\ClientResource;
use App\Models\Personnel;
use App\Http\Resources\PersonnelResource;
use Illuminate\Support\Facades\Hash;
use App\Notifications\PasswordReset;
use Illuminate\Support\Facades\Notification;

class AuthController extends Controller
{
    public function login(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $personnel = Personnel::where('email', $request->email)->first();
        if (!$personnel || !Hash::check($request->password, $personnel->password)) {
            $client = Client::where('email', $request->email)->first();
            if (!$client || !Hash::check($request->password, $client->password)) {
                return response()->json([
                    'status' => 401,
                    'message' => 'The provided credentials are incorrect.'
                ]);
            }
            else {
                return response()->json([
                    'status' => 200,
                    'client' => new ClientResource($client),
                    'token' => $client->createToken('ebuild', ['role:client'])->plainTextToken
                ]);
            }
        }
        else {
            if($personnel->role == 'admin') {
                return response()->json([
                    'status' => 200,
                    'personnel' => new PersonnelResource($personnel),
                    'token' => $personnel->createToken('ebuild', ['role:admin'])->plainTextToken
                ]);
            }
            else {
                return response()->json([
                    'status' => 200,
                    'personnel' => new PersonnelResource($personnel),
                    'token' => $personnel->createToken('ebuild', ['role:personnel'])->plainTextToken
                ]);
            }
        }
    }

    public function resetNotif(Request $request) {
        $request->validate([
            'email' => 'required'
        ]);
        $personnel = Personnel::where('email', $request->email)->first();
        if (!$personnel) {
            $client = Client::where('email', $request->email)->first();
            if($client) {
                $details = [
                    'greeting' => 'Hi '.$client->name,
                    'body' => 'Follow this link to reset your account password !',
                    'url' => 'http://127.0.0.1:8000/clientpassReset/'.$client->id,
                    'thanks' => 'Thank you for using our CRM !',
                ];
                Notification::send($client, new PasswordReset($details));
                return response()->json([
                    'status' => 200,
                    'message' => 'Email sent !'
                ]);
            }
            else {
                return response()->json([
                    'status' => 404,
                    'message' => 'user not found !'
                ]);
            }
        }
        else {
            if($personnel->role == 'admin') {
                return response()->json([
                    'status' => 403,
                    'message' => 'Admin Privileges'
                ]);
            }
            else {
                $details = [
                    'greeting' => 'Hi '.$personnel->name,
                    'body' => 'Follow this link to reset your account password !',
                    'url' => 'http://127.0.0.1:8000/personnelpassReset/'.$personnel->id,
                    'thanks' => 'Thank you for using our CRM !',
                ];
                Notification::send($personnel, new PasswordReset($details));
                return response()->json([
                    'status' => 200,
                    'message' => 'Email sent !'
                ]);
            }   
        }
    }

    public function logout (Request $request) {
        auth()->user()->tokens()->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Logged out !'
        ]);
    }
}

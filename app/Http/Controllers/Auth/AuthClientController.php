<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Client;
use App\Http\Resources\ClientResource;
use Illuminate\Support\Facades\Hash;
use App\Notifications\PasswordReset;
use Illuminate\Support\Facades\Notification;

class AuthClientController extends Controller
{
    public function changePassword(Request $request) {
        $this->validate($request,[
            'newPassword' => 'required',
            'confirmPassword' => 'required'
            ]);
        if($request->newPassword != $request->confirmPassword) {
            return response()->json([
                'status' => 406,
                'message' => 'Passwords do not match!'
            ]);   
        }   
        else { 
            $client = Client::find(Auth::client()->id);
            $hashedPassword = $client->password;
            if (!\Hash::check($request->newPassword , $hashedPassword)) {
                    $client->password = bcrypt($request->newPassword);
                    Client::where( 'id' , Auth::client()->id)->update(array( 'password' =>  $client->password));
                    return response()->json([
                    'status' => 200,
                    'client' => new ClientResource($client),
                    'message' => 'Password changed !'
                    ]);
            }
            else {
                return response()->json([
                    'status' => 406,
                    'message' => 'Same password, please enter a new password !'
                ]);
            }   
        }
    }

    public function reset(Request $request, $id) {
        $request->validate([
            'newPassword' => 'required',
            'confirmPassword' => 'required'
        ]);
        if ($request->newPassword != $request->confirmPassword) {
            return response()->json([
                'status' => 406,
                'message' => 'Same password, please enter a new password !'
            ]);
        }
        else {
            $client = Client::where('id', $id)->first(); 
            $client->password = bcrypt($request->newPassword);
            Client::where( 'id' , $client->id)->update( array( 'password' =>  $client->password));
            return response()->json([
                'status' => 200,
                'message' => 'Password changed !'
            ]);
        }
    }
}

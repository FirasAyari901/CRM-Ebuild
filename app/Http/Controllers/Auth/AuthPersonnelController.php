<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Personnel;
use App\Http\Resources\PersonnelResource;
use Illuminate\Support\Facades\Hash;
use App\Notifications\PasswordReset;
use Illuminate\Support\Facades\Notification;

class AuthPersonnelController extends Controller
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
            $personnel = Personnel::find(Auth::personnel()->id);
            $hashedPassword = $personnel->password;
            if (!\Hash::check($request->newPassword , $hashedPassword)) {
                    $personnel->password = bcrypt($request->newPassword);
                    Personnel::where( 'id' , Auth::personnel()->id)->update(array( 'password' =>  $personnel->password));
                    return response()->json([
                    'status' => 200,
                    'personnel' => $personnel,
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
            $personnel = Personnel::where('id', $id)->first(); 
            $personnel->password = bcrypt($request->newPassword);
            Personnel::where( 'id' , $personnel->id)->update( array( 'password' =>  $personnel->password));
            return response()->json([
                'status' => 200,
                'message' => 'Password changed !'
            ]);
        }
    }

}

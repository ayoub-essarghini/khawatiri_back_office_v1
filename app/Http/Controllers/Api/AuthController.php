<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $creds = $request->only([
            'email', 'password'
        ]);

        if (!$token = auth('api')->attempt($creds)) {
            return response()->json([
                'success' => false,
                'message' => 'invalid credentials'
            ]);
        }
        $user = auth()->guard('api')->user();

        return response()->json([
            'success' => true,
            'token' => $token,
            'user' => $user,
        ]);
    }
    public function register(Request $request)
    {
        $encryptedPass = Hash::make($request->password);
        $user = new Admin();
        try {
            $user->email = $request->email;
            $user->password = $encryptedPass;
            $user->save();
            return $this->login($request);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => '' . $e
            ]);
        }
    }
    public function logout(Request $request)
    {
        try {

            JWTAuth::invalidate(JWTAuth::parseToken($request->token));

            return response()->json([
                'success' => true,
                'message' => 'logout success'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => '' . $e
            ]);
        }
    }
    public function saveUserInfo(Request $request){
            $user = Admin::find(Auth::user()->id);
            $user->name = $request->name;
            $photo = '';

            //check if user provide photo
            if($request->photo!=''){
                $photo = time().'.jpg';
                file_put_contents('storage/profiles/'.$photo,base64_decode($request->photo));
                $user->photo = $photo;
            }
            $user->update();

            return response()->json([
                'success'=>true,
                'photo'=>$photo

            ]);
    }

    public function updateUserInfo(Request $request){
        $user = Admin::find(Auth::user()->id);
        $user->name = $request->name;
      //  $user->lname = $request->lname;
        $photo = '';

        //check if user provide photo
        if($request->photo!=''){
            if(Storage::exists('storage/profiles/'.$user->photo)){
                Storage::delete('storage/profiles/'.$user->photo);
                $photo = time().'.jpg';
                file_put_contents('storage/profiles/'.$photo,base64_decode($request->photo));
                $user->photo = $photo;
            }else{
                $photo = time().'.jpg';
                file_put_contents('storage/profiles/'.$photo,base64_decode($request->photo));
                $user->photo = $photo;
            }
           
        }
        $user->update();

        return response()->json([
            'success'=>true,
            'photo'=>$photo

        ]);
}
}

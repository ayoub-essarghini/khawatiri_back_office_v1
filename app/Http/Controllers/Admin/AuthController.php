<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public  function  login()
    {
        return view('admin.login');
    }
    public  function LoginDashboard(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user) {

          
           if ($user->status == 0) {
                Auth::logout();
                return  redirect()->route('admin.login')->with('error', __('User is blocked by admin.'));
            }
            if (Hash::check($request->password, $user->password)) {
                if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                    if (Auth::user()->is_admin == 1) {
                        return redirect()->route('admin.dashboard');
                    } else {

                        return redirect()->route('editor.dashboard');

                       // Auth::logout();
                       // return redirect()->back()->with('error', __('Something went wrong!'));
                    }
                }
            }
            
        }
        return  redirect()->route('admin.login')->with('error', __('Wrong Credential'));
    }
    public function logout()
    {
        if (Auth::check()) {
            Auth::logout();
            return redirect()->route('admin.login');
        }
        return redirect()->back()->with('error', __('Something went wrong!'));
    }
}

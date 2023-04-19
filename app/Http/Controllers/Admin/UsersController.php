<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', [
            'data' => $users
        ]);
    }

    public function show($id)
    {

        $data = User::findOrFail($id);


        return view('admin.users.update', [
            'data' => $data
        ]);
    }
    public function showProfile()
    {

        $users = User::find(Auth::user()->id);


        return view('admin.profile.index', [
            'data' => $users
        ]);
    }
    public function updateProfile(Request $request){

        
        $request->validate([

            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|email|max:255',
            'password' => 'required|min:8',

        ]);

        $data = User::findOrFail($request->input('id'));

        $data->fname = strip_tags($request->input('fname'));
        $data->lname = strip_tags($request->input('lname'));
        $data->email = strip_tags($request->input('email'));
        $data->password = Hash::make($request->input('password'));

        if ($request->hasFile('profile_pic')) {
            $destination = 'assets/images/admin/' . $data->image_path;
            if (File::exists($destination)) {
                File::delete($destination);
            }

            $file = $request->file('profile_pic');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('assets/images/admin/', $filename);
            $data->image_path = $filename;
        }

        $data->update();




        return redirect()->route('users.profile')->with('success', 'Profile Updated successfully');

    }
    public function update(Request $request)
    {

        $request->validate([

            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|email|max:255',
            'password' => 'required|min:8',

        ]);

        $data = User::findOrFail($request->input('id'));

        $data->fname = strip_tags($request->input('fname'));
        $data->lname = strip_tags($request->input('lname'));
        $data->email = strip_tags($request->input('email'));
        $data->password = Hash::make($request->input('password'));

        if ($request->hasFile('profile_pic')) {
            $destination = 'assets/images/admin/' . $data->image_path;
            if (File::exists($destination)) {
                File::delete($destination);
            }

            $file = $request->file('profile_pic');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('assets/images/admin/', $filename);
            $data->image_path = $filename;
        }

        $data->update();




        return redirect()->route('users.index')->with('success', 'User Updated successfully');
    }

    public function add()
    {

        return view('admin.users.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'profile_pic' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|email|max:255',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password|min:8'

        ]);
        $data = new User();
        $data->fname = strip_tags($request->input('fname'));
        $data->lname = strip_tags($request->input('lname'));
        $data->email = strip_tags($request->input('email'));
        $data->password = Hash::make($request->input('password'));

        if ($request->hasFile('profile_pic')) {
            $file = $request->file('profile_pic');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('assets/images/admin/', $filename);
            $data->image_path = $filename;
        }

        $data->save();

        return redirect()->route('users.index')->with('success', 'User added successfully');
    }

    public function delete($id)
    {
        $data = User::findOrFail($id);

        if($data->image_path !=""){
            $destination = 'assets/images/admin/' . $data->image_path;
            if (File::exists($destination)) {
                File::delete($destination);
            }
        }

    
        $data->delete();

        return response()->json([
            'status' => 'User deleted successfully !'
        ]);
    }
}

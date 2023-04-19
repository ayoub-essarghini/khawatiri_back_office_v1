<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Quote;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){

        $users = User::All();
        $categories = Category::All();
        $quotes = Quote::All();

        return view('admin.index',[
            'users'=>$users,
            'categories'=>$categories,
            'quotes'=>$quotes
        ]);
    }

    public function editor(){

        return view('editor');
    }
}

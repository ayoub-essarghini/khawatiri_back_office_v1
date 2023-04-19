<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function categories(){
        $categories = Category::orderBy('id','desc')->get();
       
        return response()->json([
            'success'=>true,
            'categories'=>$categories
        ]);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikesController extends Controller
{
    public function like(Request $request){
        $like = Like::where('quote_id',$request->id)->where('user_id',Auth::user()->id)->get();

        if(count($like)>0){
            $like[0]->delete();

            return response()->json([
                'success'=>true,
                'message'=>'unliked'
            ]);
        }

        $like = new Like;
        $like->user_id = Auth::user()->id;
        $like->quote_id = $request->id;
        $like->save();
        return response()->json([
            'success'=>true,
            'message'=>'liked'
        ]);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Quote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class QuotesController extends Controller
{
    public function create(Request $request){
        $post = new Quote;
        $post->user_id = Auth::user()->id;
        $post->quote = $request->quote;
        $post->category_id = $request->category_id;
       

        $post->save();
        $post->user;
        return response()->json([
            'success'=>true,
            'message'=>'quote posted',
            'quote'=>$post
        ]);
    }
    public function update(Request $request){
        $post = Quote::find($request->id);
        //check if user is editing his own post
        if(Auth::user()->id != $post->user_id){
            return response()->json([
                'success'=>false,
                'message'=> 'unautorized access'
            ]);
        }
        $post->quote = $request->quote;
        $post->category_id = $request->category_id;
        $post->update();
        return response()->json([
            'success'=>true,
            'message'=>'post edited '
        ]);
    }

    public function delete(Request $request){
        $post = Quote::find($request->id);
        //check if user is editing his own post
        if(Auth::user()->id != $post->user_id){
            return response()->json([
                'success'=>false,
                'message'=> 'unautorized access'
            ]);
        }
            
        $post->delete();
        return response()->json([
            'success'=>true,
            'message'=>'post deleted'
        ]);
    }
    public function quotes(){
        $quotes = Quote::orderBy('id','desc')->get();
        foreach($quotes as $post){
            $post->user;
            $post['commentCount']= count($post->comments);
            $post['likesCount'] = count($post->likes);
            $post['selfLike']=false;
            foreach($post->likes as $like){
                if($like->user_id == Auth::user()->id){
                    $post['selfLike']=true;
                }
            }
        }
        return response()->json([
            'success'=>true,
            'quotes'=>$quotes
        ]);
    }
    public function myQuotes(){
        $quotes = Quote::where('user_id',Auth::user()->id)->orderBy('id','desc')->get();
        foreach($quotes as $post){
            $post['commentCount']= count($post->comments);
            $post['likesCount'] = count($post->likes);
            $post['selfLike']=false;
            foreach($post->likes as $like){
                if($like->user_id == Auth::user()->id){
                    $post['selfLike']=true;
                }
            }
        }
        return response()->json([
            'success'=>true,
            'quotes'=>$quotes,
            'user'=> $post->user

         
        ]);
    }
}

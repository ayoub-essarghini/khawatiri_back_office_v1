<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;

    
    protected $fillable =  [
        'category_id',
        'quote'
];
public function user(){

    return $this->belongsTo(Admin::class);
}
public function category(){
    return $this->belongsTo(Category::class,'category_id');

}
public function comments(){
    return $this->hasMany(Comment::class);
}
public function likes(){
    return $this->hasMany(Like::class);
}
}

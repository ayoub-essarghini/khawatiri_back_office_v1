<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;



    public function user(){

        return $this->belongsTo(Admin::class);
    }

    public function quote(){

        return $this->belongsTo(Quote::class);
    }
   

    
}

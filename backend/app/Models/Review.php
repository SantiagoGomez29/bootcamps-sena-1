<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
     //Fillable: Permite insertar varias instancias al tiempo
     protected $fillable=[ 'title' , 'text' , 'rating' , 'bootcamp_id', 'user_id'];
}

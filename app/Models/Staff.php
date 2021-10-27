<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{

    protected $fillable=['staffID','image','firstName','lastName','ICNumber','position','livingAddress','city','state','zipcode','contactNumber','emailAddress','status'];

    public function product(){

        return $this->hasMany('App\Models\Product');
    }

    use HasFactory;
}

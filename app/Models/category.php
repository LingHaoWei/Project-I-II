<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{

    protected $fillable=['name','categoryID','status'];

    public function product(){

        return $this->hasMany('App\Models\Product');
    }
    
    use HasFactory;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class brand extends Model
{
    protected $fillable=['name','brandID','status'];

    public function product(){

        return $this->hasMany('App\Models\Product');
    }

    use HasFactory;
}

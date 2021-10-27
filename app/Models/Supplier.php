<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable=['supplierID','supplierName','address','state','city','zipcode','companyEmail','contactPerson','contactNumber','emailAddress','status'];

    public function product(){

        return $this->hasMany('App\Models\Product');
    }

    use HasFactory;
}

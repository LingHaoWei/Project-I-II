<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    protected $fillable=['name','productID','description','quantity','price','unitPrice','productVariety','productSKU','image','categoryID','brandID', 'supplierID', 'status'];

    public function category(){

        return $this->belongsTo('App\Models\category');
    }

    public function brand(){

        return $this->belongsTo('App\Models\brand');
    }

    public function supplier(){

        return $this->belongsTo('App\Models\Supplier');
    }

}

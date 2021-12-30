<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable=['orderID','image','userID','price','name','quantity','productID','status'];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public function setProductAttribute($value)
    {
        $this->attributes['productID'] = json_encode($value);
    }

    public function getProductAttribute($value)
    {
        return $this->attributes['productID'] = json_decode($value);
    }
    protected $table = 'order_details';
    use HasFactory;
}

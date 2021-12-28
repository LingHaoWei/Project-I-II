<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    public $selectedProducts = [];

    protected $fillable=[
        'orderID',
        'userID',
        'productID',
        'productCartID',
        'quantity'];

    public function product(){
        return $this->belongsTo('App\Models\Product');
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    protected $table = 'carts';
}

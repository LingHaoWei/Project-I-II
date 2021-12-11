<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable=['orderID','userID','paymentStatus','amount'];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    use HasFactory;
}

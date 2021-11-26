<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class purchaseOrder extends Model
{
    use HasFactory;

    protected $table = 'purchase_orders';

    public function purchaseOrderR(){

        return $this->belongsTo('App\Models\purchaseOrderR', foreignkey: 'purchaseID');
    }

    public function product(){

        return $this->belongsTo('App\Models\Product');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class purchaseOderR extends Model
{
    use HasFactory;

    protected $fillable=['invoiceNo','total','supplierID','active','status','userModified','date','information'];

    public function userModify(){
        return $this->belongsTo('App\Models\Admin', foreignKey: 'userModified');
    }

    public function supplier(){
        return $this->belongsTo('App\Models\Supplier', foreignKey: 'supplierID');
    }
}

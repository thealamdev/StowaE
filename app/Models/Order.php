<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded =[
        'id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function inventory_order(){
        return $this->belongsToMany(Inventory::class);
    }

    public function invoice(){
        return $this->hasOne(Invoice::class);
    }

    public function shipping_address(){
        return $this->hasOne(Shipping_address::class);
    }

    
}

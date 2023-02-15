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

    public function inventory_order(){
        return $this->belongsToMany(Inventory::class);
    }
}

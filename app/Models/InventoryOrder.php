<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryOrder extends Model
{
    protected $table = 'inventory_order';
    use HasFactory;

    public function inventories(){
        return $this->belongsTo(Inventory::class);
    }

     
     
}

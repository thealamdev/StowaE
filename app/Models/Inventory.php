<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;
    protected $guarded =[
        'id'
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }
    
    public function color(){
        return $this->belongsTo(Color::class);
    }

    public function size(){
        return $this->belongsTo(Size::class);
    }

    public function cart(){
        return $this->hasOne(Cart::class);
    }
}

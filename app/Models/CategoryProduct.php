<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{
    use HasFactory;
    protected $table = 'category_product';

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'product_photo',
        'product_name',
        'product_code',
        'product_price',
        'product_description',
        'product_stock',
        'is_active',
    ];

    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }

    public function Orders()
    {
        return $this->hasMany(OrderDetails::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $fillable = [
        'order_id',
        'order_code',
        'order_mount',
        'order_change',
        'payment_amount',
        'order_status',
    ];

    public function category()
    {
        return $this->hasMany(Categories::class, 'id', 'category_id');
    }

    public function orderDetails()
    {
        return $this->hasMany(orderDetails::class, 'order_id', 'id');
    }

    public function product()
    {
        return $this->hasMany(Product::class, 'id', 'product_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'order_price',
        'qty',
        'order_subtotal',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function order()
    {
        return $this->belongsTo(Orders::class, 'order_id', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderProduct extends Model
{
    use SoftDeletes;

    protected $table = 'order_product';

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity'
    ];

    /**
     * Relacionamento com o model Pedido (Order).
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Relacionamento com o model Produto (Product).
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

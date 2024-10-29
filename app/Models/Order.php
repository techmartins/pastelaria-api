<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $table = 'orders';

    protected $fillable = [
        'customer_id',
        'creation_date'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}


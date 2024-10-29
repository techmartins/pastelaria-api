<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;

    protected $table = 'customers';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'birthday',
        'address',
        'complement',
        'neighborhood',
        'zipcode',
        'register_in'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}

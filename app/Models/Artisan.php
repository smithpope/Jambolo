<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artisan extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstname',
        'lastname',
        'business_name',
        'phone_number',
        'email',
        'country',
        'state',
        'city',
        'address',
        'category',
        'association',
        'bank_name',
        'account_number',
        'bank',
        'passport'
    ];

    public function product(){
        return $this->hasMany(Product::class);
    }
}

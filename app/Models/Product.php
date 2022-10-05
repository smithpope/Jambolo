<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'artisan_id',
        'product_name',
        'category',
        'description',
        'amount',
        //'product_picture'
    ];

    protected $hidden = [
        
    ];

    public function artisan() {
        return $this->belongsTo(Artisan::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $table = 'image';

    protected $fillable = [
        'url',
        'product_id'
    ];

    public function product(){
        return $this->belongsTo('public\products', 'product_id');
    }
}

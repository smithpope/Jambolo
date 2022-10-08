<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class location extends Model
{
    use HasFactory;

    protected $fillable = [
        'country',
        'state',
        'city'
    ];

    public function artisan(){
        return $this->belongsTo(Artisan::class);
    }
}

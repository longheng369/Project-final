<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory;

    protected $table = 'rates';

    protected $fillable = ['product_id','user_id','rate'];

    public function product()
    {
        return $this->belongsTo(Products::class);
    }
}

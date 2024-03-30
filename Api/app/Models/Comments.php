<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;

    protected $table = 'comments';

    protected $fillable = ['product_id','user_id','body'];

    public function product()
    {
        return $this->belongsTo(Products::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = ['image','header','title','price','details','quantity','scale','category_type','published_at','active'];

    public function comment()
    {
        return $this->hasMany(Comment::class);
    }

    public function rate()
    {
        return $this->hasMany(Rate::class);
    }

    public function vote()
    {
        return $this->hasMany(Vote::class);
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    public function upvotes()
    {
        return $this->hasMany(Vote::class)->where('is_upvote',true);
    }

    public function downvotes()
    {
        return $this->hasMany(Vote::class)->where('is_upvote',false);
    }

}

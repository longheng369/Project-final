<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = ['image','header','title','price','details','category_type'];

    public function category()
    {
        return $this->belongsTo(Category::class);
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

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function rate()
    {
        return $this->hasMany(Rate::class);
    }
}

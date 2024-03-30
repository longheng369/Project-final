<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use App\Models\Products;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Products $product)
    {
        $request->validate([
            'body' => 'required|string',
        ]);

        $comment = Comments::create([
            'post_id' => $product->id,
            'user_id' => $request->user()->id,
            'body' => $request->body
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //
    public function index()
    {
        $comment = Comment::all();

        return response()->json(['comments' => $comment]);
    }


    public function store(Request $request, Post $post)
    {
        $request->validate([
            'body' => 'required|string',
        ]);


        $comment = Comment::create([
            'body' => $request->body,
            'post_id' => $post->id,
            'user_id' => $request->user()->id
        ]);


        return response()->json($comment, 201);
    }
}

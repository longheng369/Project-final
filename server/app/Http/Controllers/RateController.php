<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Rate;
use Illuminate\Http\Request;

class RateController extends Controller
{
    //
    public function index()
    {
        $stars = Rate::all();

        return response()->json(['stars' => $stars]);
    }


    public function store(Request $request, Post $post)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5', // Adjust validation as needed
        ]);

        $rating = Rate::updateOrCreate(
            ['post_id' => $post->id, 'user_id' => $request->user()->id],
            ['rating' => $request->rating]
        );

        return response()->json($rating, 200);
    }
}

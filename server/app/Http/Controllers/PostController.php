<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index(): JsonResponse
    {
        $posts = Post::all();

        return response()->json(['status' => 200, "posts" => $posts]);
    }

    public function store(Request $request) : JsonResponse
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
            'header' => 'required|string|min:6|max:45',
            'title' => 'required|string|min:6|max:45',
            'price' => 'required|numeric',
            'details' => 'required|string|max:5000',
            'category_type' => 'required|string',
        ]);

        $url = null;
        if($request->hasFile('image')){
            $image = $request->file('image')->store('public/images');
            $url = Storage::url($image);
        }

        $post = Post::create([
            'image' => $url,
            'header' => $request->header,
            'title' => $request->title,
            'price' => $request->price,
            'details' => $request->details,
            'category' => $request->category
        ]);

        return response()->json(['status'=>200, 'message'=>'post create successfully', 'post'=> $post]);
    }

    public function card_information ()
    {
        $posts = Post::with(['votes', 'comments','rate'])
        ->withCount([
            'votes as upvotes_count' => function ($query) {
                $query->where('is_upvote', true);
            },
            'votes as downvotes_count' => function ($query) {
                $query->where('is_upvote', false);
            }
        ])->get()
        ->map(function ($post) {

            $vote = $post->votes->first(function ($vote) {
                return $vote->is_upvote;
            });

            return [
                'id' => $post->id,
                'title' => $post->title,
                'desc' => $post->desc,
                'created_at' => $post->created_at,
                'updated_at' => $post->updated_at,
                'upvotes_count' => $post->upvotes_count,
                'downvotes_count' => $post->downvotes_count,
                'vote' => $vote,
                'comments' => $post->comments->isNotEmpty() ? $post->comments->first()->body: null,
                'rating' => $post->rate->isNotEmpty() ? $post->rate->first()->rating : null,
            ];
        });

        return response()->json(['data' => $posts]);
    }
}

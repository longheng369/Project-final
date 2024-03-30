<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Votes;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function index()
    {
        $product = Products::with(['votes', 'comments','rate'])
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

        return response()->json(['data' => $product]);
    }

    public function upvote(Request $request, Products $product)
    {
        return $this->handleVote($request->user(), $product, true);
    }

    public function downvote(Request $request, Products $product)
    {
        return $this->handleVote($request->user(), $product, false);
    }

    protected function handleVote($user, Products $post, $upvote)
    {
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $vote = Votes::firstOrNew(
            ['post_id' => $post->id, 'user_id' => $user->id],
            ['is_upvote' => $upvote]
        );

        if ($vote->exists && $vote->is_upvote == $upvote) {
            $vote->delete();
            $action = 'removed';
        } else {
            $vote->is_upvote = $upvote;
            $vote->save();
            $action = 'added';
        }

        return response()->json(['message' => "Vote {$action} successfully."], 200);
    }

    public function voteCounts(Products $product)
    {

        $upvotes = Votes::where('post_id', $product->id)->where('is_upvote', true)->count();
        $downvotes = Votes::where('post_id', $product->id)->where('is_upvote', false)->count();

        return response()->json([
            'upvotes' => $upvotes,
            'downvotes' => $downvotes,
            'postData' => $product
        ]);
    }
}

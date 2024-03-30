<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Vote;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function index()
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

    public function upvote(Request $request, Post $post)
    {
        return $this->handleVote($request->user(), $post, true);
    }

    public function downvote(Request $request, Post $post)
    {
        return $this->handleVote($request->user(), $post, false);
    }

    protected function handleVote($user, Post $post, $upvote)
    {
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $vote = Vote::firstOrNew(
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

    public function voteCounts(Post $post)
    {

        $upvotes = Vote::where('post_id', $post->id)->where('is_upvote', true)->count();
        $downvotes = Vote::where('post_id', $post->id)->where('is_upvote', false)->count();

        return response()->json([
            'upvotes' => $upvotes,
            'downvotes' => $downvotes,
            'postData' => $post
        ]);
    }
}

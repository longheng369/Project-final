<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function index()
    {
        $products = Products::with(['votes', 'comments','rate'])
        ->withCount([
            'votes as upvotes_count' => function ($query) {
                $query->where('is_upvote', true);
            },
            'votes as downvotes_count' => function ($query) {
                $query->where('is_upvote', false);
            }
        ])->get()
        ->map(function ($product) {

            $vote = $product->votes->first(function ($vote) {
                return $vote->is_upvote;
            });

            return [
                'id' => $product->id,
                'title' => $product->title,
                'desc' => $product->desc,
                'created_at' => $product->created_at,
                'updated_at' => $product->updated_at,
                'upvotes_count' => $product->upvotes_count,
                'downvotes_count' => $product->downvotes_count,
                'vote' => $vote,
                'comments' => $product->comments->isNotEmpty() ? $product->comments->first()->body: null,
                'rating' => $product->rate->isNotEmpty() ? $product->rate->first()->rating : null,
            ];
        });

        return response()->json(['data' => $products]);
    }

}

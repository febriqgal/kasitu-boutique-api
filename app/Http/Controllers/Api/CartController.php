<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $posts = Cart::with('user', 'product')->orderBy('created_at', 'desc')->get();
        return new CartResource($posts);
    }
    public function store(Request $request)
    {
        $post = Cart::create([
            'user_id'   => $request->user_id,
            'product_id'   => $request->product_id,

        ]);
        return new CartResource($post);
    }
}

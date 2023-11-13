<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    public function index()
    {
        $posts = Product::with('user')->orderBy('created_at', 'desc')->get();
        return new ProductResource($posts);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'     => 'required',
            'desc'   => 'required',
            'user_id'   => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $post = Product::create([
            'image'     => $request->image,
            'title'     => $request->title,
            'desc'      => $request->desc,
            'user_id'   => $request->user_id,
            'price'     => $request->price,
            'stock'     => $request->stock,
            'discount'  => $request->discount,
            'sold'      => $request->sold,
            'total'     => $request->price - ($request->price * ($request->discount / 100)),
        ]);
        return new ProductResource($post);
    }
    public function destroy($id)
    {
        $post = Product::find($id);
        $post->delete();
        return response()->json([
            'message' => 'Berhasil Dihapus',
        ]);
    }
    public function show($id)
    {
        $user = Product::find($id);
        if ($user) {
            return new ProductResource($user);
        } else {
            return response()->json(['message' => 'User not found'], 404);
        }
    }
}

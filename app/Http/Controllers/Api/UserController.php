<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        //get all posts
        $posts = User::get();

        //return collection of posts as a resource
        return new UserResource($posts);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'     => 'required|unique:users,email',
            'password'   => 'required',
            'name'   => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $post = User::create([
            'name'     => $request->name,
            'email'   => $request->email,
            'password'   => $request->password,
        ]);
        return new UserResource($post);
    }
    public function show($email)
    {
        $user = User::where('email', $email)->first();
        if ($user) {
            return new UserResource($user);
        } else {
            return response()->json(['message' => 'User not found'], 404);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserPostController extends Controller
{
    public function index($userId)
    {
        // Eager load posts when user is fetched
        $user = User::with('posts')->findOrFail($userId);

        $posts = $user->posts()->paginate(5);

        return view('posts.user-posts', compact('user', 'posts'));
    }
}

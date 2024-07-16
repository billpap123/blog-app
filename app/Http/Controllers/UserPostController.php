<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserPostController extends Controller
{
    public function index($userId)
    {
        // Eager load posts when user is fetched
        $user = User::with('posts')->findOrFail($userId);

        // Enable query logging
        DB::enableQueryLog();

        // Fetch paginated posts
        $posts = $user->posts()->paginate(10);

        // Retrieve logged queries
        $queries = DB::getQueryLog();

        // Pass data to the view
        return view('posts.user-posts', compact('user', 'posts', 'queries'));
    }
}

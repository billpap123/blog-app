<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserPostController extends Controller
{
    public function index($userId)
    {
        // Ensure eager loading of posts
        $user = User::with('posts')->findOrFail($userId);

        // Enable query logging
        DB::enableQueryLog();

        // Fetch paginated posts pagination = 1 query
        $posts = $user->posts()->paginate(5);

        // Retrieve logged queries
        $queries = DB::getQueryLog();

        // Make sure that no more than 3 queries are executed
        $this->assertCount(3, $queries);

        // Pass data to the view
        return view('posts.user-posts', compact('user', 'posts'));
    }
}

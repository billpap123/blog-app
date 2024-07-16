<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserPostController extends Controller
{
    public function index($userId)
    {
        DB::flushQueryLog();
        DB::enableQueryLog();

        $user = User::with('posts')->findOrFail($userId);

        $posts = $user->posts()->paginate(10);

        // Retrieve logged queries
        $queries = DB::getQueryLog();

        // Log the queries for debugging
        foreach ($queries as $query) {
            \Log::info(json_encode($query));
        }

        // Pass data to the view
        return view('posts.user-posts', compact('user', 'posts', 'queries'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class UserPostController extends Controller
{
    public function index($userId){
        $user = User::findOrFail($userId);

        $posts = $user->posts()->paginate(5);

        return view('posts.user-posts',compact('user','posts'));
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class UserPostController extends Controller
{
    public function index($userId){
        // Eager load posts when  user is fetched 
        $user = User::with(['posts' => function($query) {
            $query->paginate(5);
        }])->findOrFail($userId);

        $posts = $user->posts()->paginate(5);

     
        return view('posts.user-posts', compact('user', 'posts'));
    }
}

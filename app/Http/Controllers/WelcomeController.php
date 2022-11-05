<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    /**
     * 피드
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function __invoke(Request $request)
    {
        $posts = Post::latest()->limit(20)->get();

        $user = $request->user();

        if ($user->subscriptions()->exists()) {
            $posts = $user->feed(5);
        }

        return view('welcome', [
            'posts' => $posts->paginate(5, $request->page ?? 1),
            //'posts' => $this->paginate($posts, $posts->count(), 5, $request->page ?? 1)
        ]);
    }
}

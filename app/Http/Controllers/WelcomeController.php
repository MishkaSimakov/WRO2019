<?php

namespace App\Http\Controllers;

use App\Current;
use App\Post;
use function dd;
use Illuminate\Http\Request;
use function var_dump;

class WelcomeController extends Controller
{
    public function index()
    {
        $posts = Post::all();

        return view('welcome', compact('posts'));
    }

    public function update(Request $request)
    {
        return $request->input('hello');
    }
}
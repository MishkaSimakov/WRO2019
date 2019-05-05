<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Current;
use App\Post;
use App\Sensor;
use App\User;
use function dd;
use Illuminate\Http\Request;
use function json_encode;
use mysqli_result;
use function var_dump;

class WelcomeController extends Controller
{
    public function index()
    {
        $posts = Post::all();

        return view('welcome', compact('posts'));
    }

    public function search(Request $request)
    {
        $query = '%' . $request->get('query') . '%';
        $html = '<h1 class="text-center">Результаты поиска по "' . $request->get('query') . '"</h1>';

        $posts = Post::where('name', 'like', $query)->get();

        if ($posts->count() == 0) {
            $html .= '<h1 class="text-center">Ничего не найдено</h1>';
        } else {
            $html .= '<h1 class="text-center">Посты</h1>';

            foreach ($posts as $post) {
                $html .= '<h2 class="ml-2"><a href="' . $post->url . '">' . $post->name . '</a></h2>';
            }
        }

        echo json_encode($html);
    }

    public function update(Request $request)
    {
        return $request->input('hello');
    }
}
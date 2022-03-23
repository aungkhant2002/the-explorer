<?php

namespace App\Http\Controllers;

use App\Jobs\CreateFile;
use App\Models\Post;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $posts = Post::latest("id")->get();
        return view('index', ["posts" => $posts]);
    }

    public function detail($slug)
    {
        $post = Post::where("slug", $slug)->firstOrFail();
        return view('post.detail', compact('post'));
    }

    public function jobTest()
    {
//         store in job
//        dispatch(function () {
////            sleep(5);
//
//            logger("san kyi tar");
//        })->delay(now()->addSecond(5));

//        dispatch(new CreateFile());
        CreateFile::dispatch();
        return "job test";
    }
}

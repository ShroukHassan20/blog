<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
   public function index()
{
    $posts = \App\Models\Post::latest()->get();
    return view('index', compact('posts'));
}

}

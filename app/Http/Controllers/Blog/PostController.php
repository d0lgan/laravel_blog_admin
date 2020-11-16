<?php

namespace App\Http\Controllers\Blog;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use App\Http\Controllers\Blog\BaseController;

class PostController extends BaseController
{
    public function index() {
    	$items = BlogPost::all();

    	return view('blog.posts.index', compact('items'));
    }
}

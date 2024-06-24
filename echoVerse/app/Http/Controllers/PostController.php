<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function storeFormData(Request $request){
        $incomingsFields = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);
        $incomingsFields['title'] = strip_tags($incomingsFields['title']);
        $incomingsFields['body'] = strip_tags($incomingsFields['body']);
        $incomingsFields['user_id'] = auth()->id();

        Post::create($incomingsFields);

        return "hey!!";
    }
    public function showCreateForm(){
        return view('create-post');
    }
}

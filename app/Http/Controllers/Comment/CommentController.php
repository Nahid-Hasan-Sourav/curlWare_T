<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'comment' => 'required|string',
        'blog_id' => 'required|exists:blogs,id',
    ]);

    $comment = new Comment();
    $comment->user_id = auth()->id(); // Assuming users are authenticated
    $comment->blog_id = $request->blog_id;
    $comment->comment = $request->comment;
    $comment->save();

    return back()->with('success', 'Comment added successfully!');
}
}

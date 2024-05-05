<?php

namespace App\Http\Controllers\Reply;

use App\Http\Controllers\Controller;
use App\Models\Replie;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'comment_id' => 'required|exists:comments,id',
            'reply' => 'required|string|max:255',
        ]);

        $reply = new Replie();
        $reply->comment_id = $request->comment_id;
        $reply->user_id = auth()->id(); 
        $reply->reply = $request->reply;
        $reply->save();

        return redirect()->back()->with('success', 'Reply added successfully.');
    }
}

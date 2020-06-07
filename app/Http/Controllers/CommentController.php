<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Customer;
use App\Deal;
use Illuminate\Http\Request;


class CommentController extends Controller
{

    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function storeLeadComment(Request $request, $id, $user)
    {
        $lead = Customer::find($id);
        $validatedComment = $request->validate([
            'message' => 'required|string',
        ]);
        $lead->comments()->create([
            'message' => $validatedComment['message'],
            'user_id' => $user,
        ]);

        $request->session()->flash('status', 'Comment added!');
        return redirect()->route('view.lead', $id);
    }

    public function storeDealComment(Request $request, $id, $user)
    {
        $deal = Deal::find($id);
        $validatedComment = $request->validate([
            'message' => 'required|string',
        ]);
        $deal->comments()->create([
            'message' => $validatedComment['message'],
            'user_id' => $user,
        ]);

        $request->session()->flash('status', 'Comment added!');
        return redirect()->route('view.deal', $id);
    }
    public function deleteComment(Request $request, $id)
    {
        $comment = Comment::findorfail($id);
        // dd($comment, $id);
        $comment->delete();

        return redirect()->back()->with('status', 'Comment Deleted!');
    }
}

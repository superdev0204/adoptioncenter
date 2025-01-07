<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Comments;

class CommentController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if(isset($user->type) && $user->type == 'ADMIN'){
            $comments = Comments::with('agency')->where('approved', 0)->orderByDesc('created')->get();

            return view('admin.commentlog', compact('comments', 'user'));
        }
        else{
            return redirect('/user/login');
        }
    }

    public function approve(Request $request)
    {
        if (!$request->isMethod('post')){

            return response()->json(['error' => true, 'data' => []], 404);
        }

        $comment = Comments::where('id', $request->id)->first();
        $comment->update(['approved' => 1]);

        return redirect()->route('admin.comment');

    }

    public function disapprove(Request $request)
    {
        if (!$request->isMethod('post')) {

            return response()->json(['error' => true, 'data' => []], 404);
        }

        $comment = Comments::where('id', $request->id)->first();
        $comment->update(['approved' => -2]);

        return redirect()->route('admin.comment');
    }

    public function delete(Request $request)
    {
        if (!$request->isMethod('post')) {

            return response()->json(['error' => true, 'data' => []], 404);
        }

        $comment = Comments::where('id', $request->id)->first();

        $comment->delete($comment->id);

        return redirect()->route('admin.comment');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateCommentRequest;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index']]);
    }

    public function index($id)
    {
        return Comment::where('gallery_id', $id)->with('user')->get();
    }

    public function store(CreateCommentRequest $request, $id)
    {
        return Comment::create([
            'body' => $request->validated()['body'],
            'gallery_id' => $id,
            'user_id' => Auth::user()->id,
        ]);
    }

    public function destroy($gId, $cId)
    {
        $user = Auth::user();
        $owner = Comment::with('user')->find($cId);

        if ($user->id === $owner->user->id) {
            Comment::destroy($cId);
            return response()->json([
                'status' => 'success',
                'message' => 'Comment successfuly deleted',
            ], 200);
        } else {   
            return response()->json([
                'status' => 'error',
                'message' => 'Not Authorized',
            ], 403);
        }
    }
}

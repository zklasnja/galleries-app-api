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

    public function store(CreateCommentRequest $request)
    {
        return Comment::create([
            'body' => $request->validated()['body'],
            'gallery_id' => $request->validated()['gallery_id'],
            'user_id' => Auth::user()->id,
        ]);
    }
}

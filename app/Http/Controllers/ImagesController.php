<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddImageRequest;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;


class ImagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function store(AddImageRequest $request)
    {
        return Image::create([
            'urls' => $request->validated()['url'],
            'gallery_id' => $request->validated()['gallery_id'],
            'user_id' => Auth::user()->id,
        ]);
    }
}

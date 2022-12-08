<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddImageRequest;
use App\Http\Requests\CreateGalleryRequest;
use App\Models\Gallery;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;

class GalleriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index', 'show']]);
    }

    public function index()
    {
        $perPage = request('perPage', 10);
        $searchTerm = request('searchTerm', '');

        return Gallery::with('images', 'user')
            ->SearchByName($searchTerm)
            ->SearchByDescription($searchTerm)
            ->paginate($perPage);
    }

    public function store(CreateGalleryRequest $gallRequest)
    {
        $gallery = Gallery::create([
            'name' => $gallRequest->validated()['name'],
            'description' => $gallRequest->validated()['description'],
            'user_id' => Auth::user()->id,
        ]);

        $gallery->save();
        $urls = $gallRequest->validated()['urls'];

        foreach ($urls as $url) {
            $image = new Image();
            $image->urls = $url;
            $image->gallery_id = $gallery->id;
            $image->user_id = Auth::user()->id;

            $image->save();
        }

        return $gallery->images()->get();
    }

    public function show($id)
    {
        return Gallery::with('images', 'user', 'comments')->findOrFail($id);
    }

    public function getMyGalleries()
    {
        $perPage = request('perPage', 10);
        $searchTerm = request('searchTerm', '');
        $user = Auth::user();

        return Gallery::where('user_id', $user->id)
            ->with('images', 'user')
            ->SearchByName($searchTerm)
            ->SearchByDescription($searchTerm)
            ->paginate($perPage);
    }

    public function getAuthorsGalleries($id)
    {
        $perPage = request('perPage', 10);
        $searchTerm = request('searchTerm', '');

        return Gallery::where('user_id', $id)
            ->with('images', 'user')
            ->SearchByName($searchTerm)
            ->SearchByDescription($searchTerm)
            ->paginate($perPage);
    }

    public function destroy($id)
    {
        Gallery::destroy($id);
        return response()->json([
            'status' => 'success',
            'message' => 'Gallery successfuly deleted',
        ], 200);
    }
}

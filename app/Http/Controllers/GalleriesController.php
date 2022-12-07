<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateGalleryRequest;
use App\Models\Gallery;
use Illuminate\Support\Facades\Auth;

class GalleriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index']]);
    }

    public function index()
    {
        $perPage = request('perPage', 10);
        $searchTerm = request('searchTerm', '');

        return Gallery::with('images')
            ->with('user')
            ->SearchByName($searchTerm)
            ->SearchByDescription($searchTerm)
            ->paginate($perPage);
    }

    public function store(CreateGalleryRequest $request)
    {
        return Gallery::create([
            'name' => $request->validated()['name'],
            'description' => $request->validated()['description'],
            'user_id' => Auth::user()->id,
        ]);
    }

    public function show($id)
    {
        return Gallery::findOrFail($id);
    }

    public function getAuthorGalleries()
    {
        $perPage = request('perPage', 10);
        $searchTerm = request('searchTerm', '');
        $user = Auth::user();

        return Gallery::with('images')
            ->where('user_id', $user->id)
            ->with('user')
            ->SearchByName($searchTerm)
            ->SearchByDescription($searchTerm)
            ->paginate($perPage);
    }
}

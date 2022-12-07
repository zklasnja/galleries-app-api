<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;

class GalleriesController extends Controller
{
    public function index()
    {
        $perPage = request('per_page', 10);
        $searchTerm = request('searchTerm', '');

        return Gallery::with('images')
            ->with('user')
            ->SearchByName($searchTerm)
            ->SearchByDescription($searchTerm)
            ->paginate($perPage);
    }
}

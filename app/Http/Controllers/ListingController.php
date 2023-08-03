<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    public function index() {
        $tag = request('tag');

        return view('listings.index', [
            'listings' => Listing::latest()->where('tags', 'like', '%' . request('tag') . '%')->get()
        ]);
    }

    public function show(Listing $listing) {
        return view('listings.show' ,  [
            'listing' => $listing
        ]);
    }
}

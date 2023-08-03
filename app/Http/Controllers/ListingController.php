<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    public function index() {
       $query = Listing::latest();

       if (request('tag')) {
        $query->where('tags', 'like', '%' . request('tag') . '%');
       }

       if (request('search')) {
        $searchTerm = '%' . request('search') . '%';
        $query->where(function ($query) use ($searchTerm) {
            $query->where('tags', 'like', $searchTerm)
            ->orWhere('title', 'like', $searchTerm)
            ->orWhere('description', 'like', $searchTerm);
        });
       }

       $listings = $query->get();

       return view('listings.index', [
        'listings' => $listings
       ]);
    }

    public function show(Listing $listing) {
        return view('listings.show' ,  [
            'listing' => $listing
        ]);
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ListingController extends Controller
{
    #Show all listings
    public function index(){
        // dd(request()->tag);
        return view('listings.index',[
            'heading'=> "Latest listings",
            // 'listings' => Listing::all() # Usamos el modelo que hubo que importar
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->get() # Usamos el modelo que hubo que importar

        ]);
    }

    #Show single listing
    public function show(Listing $listing){
        return view('listing.show',[
            'listing' => $listing
        ]);
    }

    # Show create form
    public function create(){
        return view('listings.create');
    }
}

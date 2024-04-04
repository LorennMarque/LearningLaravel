<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class ListingController extends Controller
{
    #Show all listings
    public function index(){
        // dd(request()->tag);
        return view('listings.index',[
            'heading'=> "Latest listings",
            // 'listings' => Listing::all() # Usamos el modelo que hubo que importar
            // 'listings' => Listing::latest()->filter(request(['tag', 'search']))->get() # Usamos el modelo que hubo que importar
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->paginate(6) # Usamos el modelo que hubo que importar
            // 'listings' => Listing::latest()->filter(request(['tag', 'search']))->simplePaginate(2) # Usamos el modelo que hubo que importar

            // php artisan vendor publish and select pagination providor
        ]);
    }

    #Show single listing
    public function show(Listing $listing){
        return view('listings.show',[
            'listing' => $listing
        ]);
    }

    # Show create form
    public function create(){
        return view('listings.create');
    }

    # Store listing Data
    public function store(Request $request){

        // check Fylesystems.php
        // dd($request->file('logo')->store());

        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required',
        ]);

        
        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos','public');
        }

        // php artisan storage:link

        Listing::create($formFields);

        // return redirect('/listings');
        return redirect('/listings')->with('message','Listing created successfully');
    }

    public function edit(Listing $listing){
        return view('listings.edit',[
            'listing' => $listing
        ]);
    }

    public function update(Request $request, Listing $listing){
        // check Fylesystems.php
        // dd($request->file('logo')->store());

        $formFields = $request->validate([
            'title' => 'required',
            'company' => 'required',
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required',
        ]);

        
        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos','public');
        }

        // php artisan storage:link

        $listing->update($formFields);

        // return redirect('/listings');
        return back()->with('message','Listing updated successfully');
    }

    public function destroy(Listing $listing){
        $listing->delete();
        return redirect("/listings")->with('message','Listing deleted successfully');
    }

    }

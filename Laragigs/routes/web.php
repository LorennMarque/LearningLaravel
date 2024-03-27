<?php

use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Models\Listing;
Route::get('/', function () {
    return view('welcome');
});

// Route::get('/hello', function(){
//     return response("<h1>Hello world</h1>", 200)
//     ->header('Content-Type', 'text/plain')
//     ->header('Test', 'hola mundo');
// });

// Route::get('/posts/{id}', function($id){
//     return response("Post " . $id);
// })->where('id', '[0-9]+');

// Route::get('/search', function(Request $request){
//     return response($request->q. ' es la busqueda');
// });

// Route::get('/', function(){
// return view('listings',[
//     'heading'=> "Latest listings",
//     'listings' => [[
//         'id' => 1,
//         'title' => 'Listing one',
//         'description' => "lorem ipsum dolor sit amet concactenur"
//     ],
//     [
//         'id' => 2,
//         'title' => 'Listing one',
//         'description' => "lorem ipsum dolor sit amet concactenur"
//     ],
//     [
//         'id' => 3,
//         'title' => 'Listing one',
//         'description' => "lorem ipsum dolor sit amet concactenur"
//     ],
//     [
//         'id' => 4,
//         'title' => 'Listing one',
//         'description' => "lorem ipsum dolor sit amet concactenur"
//     ]]
// ]);
// });

Route::get('/', function(){
    return view('listings',[
        'heading'=> "Latest listings",
        'listings' => Listing::all() # Usamos el modelo que hubo que importar
    ]);
});

// Route::get('listings/{id}', function($id){
//     $listing = Listing::find($id); # Usamos el modelo que hubo que importar

//     # Check if exists
//     if($listing){
//         return view('listing',[
//             'listing' => $listing
//         ]);
//     }else{
//         abort('404');
//     }
// });

# ALternative way. Model listing
Route::get('listings/{listing}', function(Listing $listing){
    return view('listing',[
        'listing' => $listing
    ]);
});
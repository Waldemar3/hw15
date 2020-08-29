<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', '\\'.\App\Http\Controllers\HomeController::class)->name('home');

Route::get('/login', '\\'.\App\Http\Controllers\AuthController::class.'@login')->name('login')->middleware('guest');
Route::post('/login', '\\'.\App\Http\Controllers\AuthController::class.'@check')->middleware('guest');

Route::get('/logout', '\\'.\App\Http\Controllers\AuthController::class.'@logout')->name('logout')->middleware('auth');

Route::get('/create', function (){
    return view('ad-form');
})->name('ad.create');

Route::get('/showAd/{id}', function(){
    $ad = \App\Ad::where('id', request()->id)->first();
    return view('showAd', ['ad' => $ad]);
});

Route::get('/delete/{id}', function(){
    $ad = \App\Ad::where('id', request()->id)->first();
    if(auth()->user()->can('delete', $ad)){
        $ad->delete();

        return redirect()
            ->route('home')
            ->with("success", "Ad \"{$ad->title}\" was successfully deleted");
    }
});

Route::post('/create', function (){
    $validator = \Illuminate\Support\Facades\Validator::make(
        request()->all(),
        [
            'title' => 'required|min:10|max:255',
            'description' => 'required|min:25|max:65535',
        ]
    );

    if($validator->fails()){
        return redirect('/create')
            ->withErrors($validator->errors())
            ->withInput(request()->all()
        );
    }

    $ad = new \App\Ad();
    $ad->title = request()->get('title');
    $ad->description = request()->get('description');

    auth()->user()->ads()->save($ad);

    return redirect()
        ->route('home')
        ->with("success", "Ad \"{$ad->title}\" was successfully created");
});

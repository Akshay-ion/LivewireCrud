<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('insert-posts', function(){

    $posts = [];

    for($i=1; $i<=100; $i++){
        $posts[] = [
            'user_id' => 1,
            'title' => "Post Title $i",
            'body' => "This is the body of post $i",
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    App\Models\Post::insert($posts);

    return "Posts Inserted Successfully";
});

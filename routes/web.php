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
/* 
Route::get('/', function () {

    return view('welcome');
   /* try {
       DB::connection()->getpdo();
       echo "entro";
   } catch (\Exception $e) {
       die ("ERROR:" . $e);
   }
})->middleware('languaje'); */

Route::get('/', function () { 
    return view('welcome');
})->middleware('language');

// Route::get('/post','PostController@index');


/* Route::resource('posts', 'PostController')->only([
    'index','create'
]); */
/* Route::resource('posts', 'PostController')->except([
    'destroy'
    ]);
    */
/* Route::resource('posts', 'PostController')->only([
    'index','create'
]); */

Route::get('/users', function () {
    // 1
    // dd(App\User::with(['posts'])->get());
    // 2
    // dd(App\User::with(['posts'])->first()->posts->first()->id);
    // 3
    $user =App\User::with(['posts' =>function($query){
        $query->where('id',1);
    }])->where('id',1)->get();
    dd($user);

});

use Illuminate\Support\Facades\DB;

Route::get('/query', function () {
    $users = DB::table('users')->get();
    dd($users);
});
Route::get('/query2', function () {
    $users = DB::table('users')->where('email', 'tfeil@example.org')->get();
    dd($users);
});
Route::get('/query3', function () {
    $users = DB::table('users')
    ->join('posts','users.id','posts.user_id')
    ->select('users.id','users.name','posts.title','posts.content')->get();
    dd($users);
});

/* *********************+ */

Route::get('/paypal', function () {
    // $paypal = resolve('App\Models\Paypal');
    return Payment::doSomething();
});





Auth::routes(['verify' => true]);

Route::group(['middleware' => 'verified'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('posts', 'PostController');
    Route::get('/my/posts', 'PostController@myPosts')->name('posts.my');
});



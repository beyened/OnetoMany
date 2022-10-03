<?php

use App\Models\Post;
use App\Models\User;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/addUser', function (){
    $user = new App\Models\User;

    $user->name = "Desta Dabi";
    $user->email = "d@gmail.com";
    $user->password = bcrypt("123");

    $user->save();

});

Route::get('/insert', function (){
    $user = User::find(1);

    $post = new Post(['title'=>'2nd Title', 'body'=>'2nd body']);
    $user->posts()->save($post);
});

Route::get('/user/{id}/post', function ($id){
    $user = User::find($id);

//    dd($user->posts);

    foreach ($user->posts as $post){
        echo $post->title."</br>";
    }

});

Route::get('user/{id}', function ($id){
    $user = User::find($id);

    return $user->email;
});

Route::get('update/{id}/post', function ($id){

    $user = User::find($id);
    $post = $user->posts()->where('id', 10)->update(['title'=>'Updated 3rd Title', 'body'=>'Updated 3rd body']);

   if($post){
       echo "Users Post Updated";
   }else{
       echo "Error in Users Post";
   }
});

Route::get('delete/{id}/post', function ($id){
    $user = User::find($id);
    $user->posts()->delete();
});

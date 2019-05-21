<?php

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

Route::group(['middleware' => ['web']], function(){   // web chilo age auth:admin er jaigai

    // Authentication routes login/logout
    Route::get('auth/login', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
    //Route::post('auth/login',function (){ return view('/'); })->name('auth/login');
    Route::post('auth/login/', 'Auth\LoginController@login')->name('login');
    Route::get('auth/logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);




    //Authentication routes Register
    Route::get('auth/register', 'Auth\RegisterController@showRegistrationForm');
    Route::post('auth/register', 'Auth\RegisterController@register');


    // Reset password controller
    Route::get('password/reset/{token?}', 'Auth\ResetPasswordController@showResetForm');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');


    // Categories routes
    Route::resource('categories', 'CategoryController', ['except' => ['create']]);

    //
    Route::resource('tags', 'TagController', ['except' => ['create']]);




    // Slug route 
    Route::get('blog/{slug}', [ 'as'=> 'blog.single', 'uses'=> 'BlogController@getSingle'])
            ->where('slug', '[\w\d\-\_]+');
    Route::get('blog', [ 'as'=> 'blog.index', 'uses'=> 'BlogController@getIndex']);



    //pages
    Route::get('/', ['as' => '/', 'uses' => 'PagesController@getIndex']);
    Route::get('contact', 'PagesController@getContact');
    Route::post('contact', 'PagesController@postContact');
    Route::get('about', 'PagesController@getAbout');

    //Comments
    Route::post('comments/{post_id}', ['uses' => 'CommentsController@store', 'as' => 'comments.store']);
    Route::get('comments/{id}/edit', ['uses' => 'CommentsController@edit', 'as' => 'comments.edit']);
	Route::put('comments/{id}', ['uses' => 'CommentsController@update', 'as' => 'comments.update']);
	Route::delete('comments/{id}', ['uses' => 'CommentsController@destroy', 'as' => 'comments.destroy']);
	Route::get('comments/delete/{id}', ['uses' => 'CommentsController@delete', 'as' => 'comments.delete']);

    

    
    //posts
    Route::get('/posts', 'PostController@getIndex')->name('posts.index');
    Route::get('/posts/create', 'PostController@getCreate')->name('posts.create');
    Route::post('/posts/store', 'PostController@store')->name('posts.store');
    Route::get('/posts/show/{id}','PostController@show')->name('posts.show');
    //Route::get('/view-posts/{id}', 'PostController@ViewPosts');
    Route::get('/posts/edit/{id}', 'PostController@edit')->name('posts.edit');
    Route::put('/update-post/{id}', 'PostController@update')->name('posts.update');
    Route::get('/delete-posts/{id}', 'PostController@destroy')->name('posts.destroy');

   
    


    //Route::get('/posts','PostController@posts');
    //Route::resource('posts', 'PostController');
    //Route::get('/posts/show', 'PostController@store')

});



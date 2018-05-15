<?php

Auth::routes();
Route::get('/home', 'UserController@books');

//Hard Coded Login and Registration
//Route::get('/register','RegistrationController@create');
//Route::post('/register','RegistrationController@store');
//Route::get('/login','SessionsController@create');
//Route::post('/logIn','SessionsController@store');
Route::get('/logout', 'SessionsController@destroy');

Route::get('/', 'UserController@books')->name('home');

Route::prefix('posts')->group(function () {
    Route::get('/old', 'PostsController@index_oldest');
    Route::get('/create', 'PostsController@create');
    Route::post('/store', 'PostsController@store');
    Route::get('/{post}', 'PostsController@show');
    Route::post('/{post}/comments', 'CommentsController@store');
});


Route::group(['middleware' => ['admin']], function () {
    Route::prefix('admin')->group(function () {
        Route::any('/', 'AdminController@index');

        Route::get('/{admin}/profile','AdminController@show');

        Route::get('/{id}/show', 'AdminController@show');
        Route::get('/{id}/edit', 'AdminController@edit');
        Route::post('/{id}/update', 'AdminController@update');
        Route::post('/{id}/destroy', 'AdminController@destroy');

        Route::post('/store/user', 'AdminController@createUser');
        Route::get('/create/user', 'AdminController@getUserField');


        Route::get('/books', 'AdminController@books');
        Route::post('/store/book', 'AdminController@createBook');
        Route::get('/create/book', 'AdminController@getBookField');
        Route::get('/{post}/editBook', 'AdminController@editBook');
        Route::post('/{post}/updateBook', 'AdminController@updateBook');
        Route::get('/{post}/availableBook', 'AdminController@availableBook');
        Route::get('/{post}/unavailableBook', 'AdminController@unavailableBook');
        Route::get('/{post}/destroyBook', 'AdminController@destroyBook');

        Route::get('/borrows', 'AdminController@borrows');
        Route::get('{borrow}/destroyBorrow', 'AdminController@destroyBorrow');
    });
});





Route::prefix('user')->group(function () {

    Route::get('/{id}/profile', 'UserController@profile');

    Route::get('/{id}/edit', 'UserController@edit');
    Route::post('/{id}/update', 'UserController@update');
    Route::get('/{id}/destroy', 'UserController@destroy');

    Route::get('/books', 'UserController@books');
    Route::any('/{user}/{book}/borrowBook', 'UserController@borrowBook');
    Route::get('/{user}/{borrow}/returnBook', 'UserController@returnBook');

    Route::get('/{id}/borrows', 'UserController@borrows');
    Route::get('/borrows', 'UserController@userBorrows');
    Route::get('/{user}/{book}/addTime', 'UserController@addTime');


});

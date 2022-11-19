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
// Home
Route::get('/', 'HomeController@home')->name('/');

// API

// Users
//Route::get('/profile', 'UserController@show')->name('profile');
Route::get('/profile/{username}', 'UserController@showUser')->name('profile');
Route::get('/profile/{username}/mydetails', 'UserController@details')->name('details');
Route::get('/profile/{username}/balance', 'UserController@balance')->name('balance');
Route::post('profile/{username}/balance', 'UserController@addFunds')->name('addFunds');
Route::get('/profile/{username}/myauctions', 'UserController@myAuctions')->name('myauctions');
Route::get('/profile/{username}/mybids', 'UserController@myBids')->name('mybids');
Route::get('/admin', 'AdminController@admin')->name('admin');
Route::get('/admin/users', 'AdminController@getUsers')->name('manusers');
Route::get('/admin/auctions', 'AdminController@getAuctions')->name('manauctions');
Route::get('/admin/bids', 'AdminController@getBids')->name('manbids');
Route::get('/auction/{id}/edit', 'AuctionController@edit')->name('edit');



//Others
Route::get('/FAQs', 'FAQController@faqs')->name('FAQs');
Route::post('/auction/{id}','UserController@createBid')->name('addbid');
Route::delete('/auction/{id}', 'AuctionController@destroy')->name('deleteAuction');
Route::put('/auction/{id}/edit','AuctionController@update')->name('updateAuction');
Route::put('/profile/{username}/mydetails', 'UserController@update')->name('updetails');

// Authentication
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@authenticate');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('/register', 'Auth\RegisterController@register');


// Search
Route::get('/search/user/api', 'SearchController@getSearchUserResultsJson');
Route::get('/search/auction/api', 'SearchController@getSearchActionsResultsJson');
Route::get('/search', 'SearchController@home')->name('search');
Route::get('/auction/{id}','AuctionController@show')->name('auction');

Route::get('/search/api', 'SearchController@getSearchResultsJson');
Route::get('/search', 'SearchController@home')->name('search');
Route::get('/search/{category}', 'SearchController@homeCatgorySearch')->name('categorySearch');

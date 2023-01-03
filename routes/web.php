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
Route::get('/profile/{username}/myfavourites', 'UserController@favAuctions')->name('myfav');
Route::get('/profile/{username}/mybids', 'UserController@myBids')->name('mybids');
Route::get('/profile/{username}/mywins', 'UserController@myWinnings')->name('mywins');
Route::put('/profile/{username}/mydetails', 'UserController@update')->name('updetails');
Route::put('/profile/{username}/mypassword', 'UserController@updatePassword')->name('updatePassword');

//admin
Route::get('/admin', 'AdminController@admin')->name('admin');
Route::get('/admin/users', 'AdminController@getUsers')->name('manusers');
Route::get('/admin/createuser', 'AdminController@createUser')->name('createuser');
Route::get('/admin/auctions', 'AdminController@getAuctions')->name('manauctions');
Route::get('/admin/bids', 'AdminController@getBids')->name('manbids');
Route::get('/admin/logs', 'AdminController@getLogs')->name('adminlogs');
Route::get('/admin/sellerreports', 'AdminController@getSellerReports')->name('sellreports');
Route::get('/admin/auctionreports', 'AdminController@getAuctionReports')->name('auctionreports');
Route::delete('/admin/users/{id}', 'UserController@destroy')->name('deleteUser');
Route::delete('/suicide/{id}', 'UserController@suicide')->name('suicideUser');
Route::get('/profile/{username}/edit', 'AdminController@editUser')->name('editusers');
Route::post('/admin/createuser', 'Auth\RegisterController@createAdm')->name('admregister');
Route::put('/admin/sellerreports/{id}', 'ReportController@changeStatus')->name('changeStatus');
Route::put('/admin/auctionreports/{id}', 'ReportController@changeStatus2')->name('changeStatus2');
Route::get('/admin/banappeals', 'AdminController@getBanAppeals')->name('banappeals');
Route::put('/admin/ban/{id}', 'AdminController@banUser')->name('ban');
Route::put('/admin/unban/{id}/{idbanappeal}', 'AdminController@unbanUser')->name('unban');
Route::delete('/admin/rejectAppeal/{id}/{unban}', 'AdminController@destroyBanAppeal')->name('rejectAppeal');

//auctions
Route::get('/auction/{id}/edit', 'AuctionController@edit')->name('edit');
Route::get('/auction/create', 'AuctionController@create')->name('createAuction');
Route::post('/auction', 'AuctionController@store')->name('submitNewAuc');
Route::post('/readnotification', 'UserController@readNotif')->name('readnotif');
Route::post('/auction/{id}','BidController@createBid')->name('addbid');
Route::post('/profile/{id}/createReview','ReviewController@createReview')->name('createReview');
Route::post('/profile/{id}/createReport','ReportController@createSellerReport')->name('createSellerReport');
Route::post('/auction/{id}/createReport','ReportController@createAuctionReport')->name('createAuctionReport');
Route::post('/auction/{id}/favorite','AuctionController@favorite');
Route::delete('/auction/{id}', 'AuctionController@destroy')->name('deleteAuction');
Route::get('/auction/{id}','AuctionController@show')->name('auction');
Route::put('/auction/{id}/edit','AuctionController@update')->name('updateAuction');

//Others
Route::get('/FAQs', 'FAQController@faqs')->name('FAQs');
Route::get('/AboutUs', 'AboutUsController@aboutus')->name('AboutUs');
Route::get('/ContactUs', 'ContactUsController@contactus')->name('ContactUs');
Route::get('/BanAppeal', 'BanAppealController@banappeal')->name('BanAppeal');
Route::post('/BanAppeal', 'BanAppealController@submit')->name('submitBanAppeal');


// Authentication
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@authenticate');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('/register', 'Auth\RegisterController@register');
Route::get('/forgot-password', 'Auth\PasswordRecoveryController@showRecoveryForm')->middleware('guest')->name('recovery');  //new
Route::post('/forgot-password', 'Auth\PasswordRecoveryController@recoverPass')->middleware('guest')->name('password.email'); //new
Route::get('/reset-password/{token}', 'Auth\PasswordRecoveryController@resetPass')->middleware('guest')->name('password.reset'); //new
Route::post('/reset-password', 'Auth\PasswordRecoveryController@updatePass')->middleware('guest')->name('password.update');


// Search
Route::get('/search/user/api', 'SearchController@getSearchUserResultsJson');
Route::get('/search/auction/api', 'SearchController@getSearchAuctionsResultsJson');
Route::get('/search', 'SearchController@home')->name('search');
Route::get('/search/api', 'SearchController@getSearchResultsJson');
Route::get('/search/{category}', 'SearchController@homeCatgorySearch')->name('categorySearch');

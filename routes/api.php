<?php

use App\Http\Controllers\API\CustomerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::get('test', 'MainController@test');

// Authentication
// Route::post('forgotPassword', '\App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail');



//////////////////////////////////////////////////////////////////////////////
//////////////////////////////// Start Page //////////////////////////////////
//////////////////////////////////////////////////////////////////////////////

Route::get('pages/{id}', 'MainController@pages');
Route::get('informations', 'MainController@informations');
Route::get('metas', 'MainController@metas');
Route::get('blogs', 'MainController@blogs');
Route::get('blog/{id}', 'MainController@blog');
Route::get('faqs', 'MainController@faqs');
Route::post('send-contact', 'MainController@send_contact_message');
Route::post('newsletter', 'MainController@newsletter');
Route::get('landing-page', 'MainController@landing_page');

// Auth

Route::post('user/register', 'AuthController@register_user');
Route::post('user/login', 'AuthController@login_user');
Route::post('user/verify-code', 'AuthController@verify_code_user');

//////////////////////////////////////////////////////////////////////////////
///////////////////////////////// End Page ///////////////////////////////////
//////////////////////////////////////////////////////////////////////////////

Route::group(['middleware' => ['auth:api']], function () {

    Route::post('academy-subscribe', [CustomerController::class, 'academySubscribe']);
});

//////////////////////////////////////////////////////////////////////////////
/////////////////////////////// End User /////////////////////////////////
//////////////////////////////////////////////////////////////////////////////

<?php

use App\Http\Controllers\API\CustomerController;
use App\Http\Controllers\API\MainController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Test
Route::get('test', [MainController::class, 'test']);

// Webhooks
Route::post('user/insert', [MainController::class, 'insertUsers']);
Route::post('user/update', [MainController::class, 'updateUsers']);
Route::post('user/delete', [MainController::class, 'deleteUsers']);
// Route::post('test-webhook', [MainController::class, 'testWebhook']);

// Route::webhooks('test-webhook');

// Route::post('test-webhook', [MainController::class, 'testWebhook']);

//////////////////////////////// Start Auth //////////////////////////////////
    Route::post('user/register', 'AuthController@register_user');
    Route::post('user/check-mobile-status', 'AuthController@checkMobileStatus');
    Route::post('user/code-verification', 'AuthController@codeVerification');
    Route::post('user/create-password', 'AuthController@createPassword');
    Route::post('user/forgot-password', 'AuthController@forgotPassword');
    Route::post('user/login', 'AuthController@login_user');
    // Route::post('user/verify-code', 'AuthController@verify_code_user');
//////////////////////////////// End Auth //////////////////////////////////

//////////////////////////////// Start Pages //////////////////////////////////
    Route::get('pages/{id}', 'MainController@pages');
    Route::get('informations', 'MainController@informations');
    Route::get('metas', 'MainController@metas');
    Route::get('blogs', 'MainController@blogs');
    Route::get('blog/{id}', 'MainController@blog');
    Route::get('faqs', 'MainController@faqs');
    Route::post('send-contact', 'MainController@send_contact_message');
    Route::post('newsletter', 'MainController@newsletter');
    Route::get('landing-page', 'MainController@landing_page');
///////////////////////////////// End Pages //////////////////////////////////

//////////////////////////////// Start Academy //////////////////////////////////
    Route::get('academies/academy-schedule/{academy}', [MainController::class, 'academySchedule']);
    Route::post('academies/academy-subscribe', [CustomerController::class, 'academySubscribe']);
    Route::get('academies', [MainController::class, 'academies']);
//////////////////////////////// End Academy //////////////////////////////////

//////////////////////////////// Start Events //////////////////////////////////
    Route::post('events/event-reservation', [CustomerController::class, 'eventReservation']);
    Route::get('events/upcoming-event', [MainController::class, 'upcominEvent']);
    Route::get('events', [MainController::class, 'events']);
    Route::get('events/{event}', [MainController::class, 'event']);
//////////////////////////////// End Events //////////////////////////////////

//////////////////////////////// Start playgrounds //////////////////////////////////
    Route::post('playgrounds/reservation', [CustomerController::class, 'playgroundReservation']);
    Route::get('playgrounds/{playground}/reserved-times', [CustomerController::class, 'playgroundReservedTimes']);
    Route::get('playgrounds', [MainController::class, 'playgrounds']);
    Route::get('playground-types', [MainController::class, 'playgroundTypes']);
//////////////////////////////// End playgrounds //////////////////////////////////

//////////////////////////////// Start Tickets //////////////////////////////////
    Route::post('tickets/reservation', [CustomerController::class, 'ticketReservation']);
//////////////////////////////// End Tickets //////////////////////////////////

//////////////////////////////// Start User //////////////////////////////////
    Route::group(['middleware' => ['auth:api']], function () {
        Route::post('logout', 'AuthController@logout');
    });
////////////////////////////////// End User //////////////////////////////////


<?php

use App\Http\Controllers\API\CustomerController;
use App\Http\Controllers\API\MainController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//////////////////////////////// Start Auth //////////////////////////////////
    Route::post('user/register', 'AuthController@register_user');
    Route::post('user/login', 'AuthController@login_user');
    Route::post('user/verify-code', 'AuthController@verify_code_user');
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
    Route::get('playgrounds/{playground}/reserved-times', [MainController::class, 'playgroundReservedTimes']);
    Route::get('playgrounds', [MainController::class, 'playgrounds']);
//////////////////////////////// End playgrounds //////////////////////////////////

//////////////////////////////// Start User //////////////////////////////////
    Route::group(['middleware' => ['auth:api']], function () {

    });
////////////////////////////////// End User //////////////////////////////////


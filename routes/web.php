<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

// Custom Routs

// Route::get('/mfs', function () {
//     Artisan::call('migrate:fresh --seed');
//     return 'done';
// });


Route::get('generator_builder', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@builder')->name('io_generator_builder');

Route::get('field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@fieldTemplate')->name('io_field_template');

Route::get('relation_field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@relationFieldTemplate')->name('io_relation_field_template');

Route::post('generator_builder/generate', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generate')->name('io_generator_builder_generate');

Route::post('generator_builder/rollback', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@rollback')->name('io_generator_builder_rollback');

Route::post(
    'generator_builder/generate-from-file',
    '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generateFromFile'
)->name('io_generator_builder_generate_from_file');

Route::get('/', function () {
    return view('welcome');
});

// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| Admin Panel Routes
|--------------------------------------------------------------------------
*/

Route::group(
    [
        'prefix' => 'adminPanel',
        'namespace' => 'App\Http\Controllers\AdminPanel',
        'as' => 'adminPanel.'
    ],
    function () {

        Route::group(['middleware' => ['guest']], function () {

            Route::get('/login', 'AuthController@login')->name('login');
            Route::post('/login', 'AuthController@postLogin')->name('postLogin');
        });


        Route::group(['middleware' => ['auth:admin', 'permissionHandler']], function () {

            Route::get('logout', 'AuthController@logout')->name('logout');
            Route::get('/', 'DashboardController@dashboard')->name('dashboard');
            Route::resource('roles', 'RolesController');
            Route::get('updatePermissions', 'RolesController@updatePermissions')->name('roles.updatePermissions');


            Route::resource('admins', AdminController::class);
            Route::resource('users', UserController::class)->only(['index', 'show']);
            Route::patch('users/add-member-id/{user}', 'UserController@addMemberId')->name('users.addMemberId');
            Route::post('users/date-filter', 'UserController@dateFilter')->name('users.dateFilter');

            Route::resource('metas', MetaController::class);

            Route::resource('socialLinks', SocialLinkController::class);
            Route::post('ckeditor/upload', 'CkeditorController@upload')->name('ckeditor.upload');
            Route::resource('information', InformationController::class);
            Route::resource('sliders', SliderController::class);
            Route::resource('contacts', ContactController::class);
            Route::get('newsletters', 'NewsletterController@index')->name('newsletters.index');
            Route::resource('blogs', BlogController::class);
            Route::resource('faqCategories', FaqCategoryController::class);
            Route::resource('faqs', FaqController::class);
            // Pages CRUD
            Route::resource('pages', 'PageController');
            Route::resource('pages.paragraphs', 'ParagraphController')->shallow();
            Route::resource('pages.images', 'imagesController')->shallow();

            Route::resource('options', OptionController::class);

            Route::resource('notifications', NotificationController::class);

            Route::resource('branches', BranchController::class);

            Route::get('academies/requests', 'AcademyController@requests')->name('academies.requests');
            Route::post('academies/requests-date-filter', 'AcademyController@dateFilter')->name('academies.requests.dateFilter');
            Route::patch('academies/change-request-status/{subscription}', 'AcademyController@changeRequestStatus')->name('academies.changeRequestStatus');
            Route::get('academies/destroy-photo/{id}', 'AcademyController@destroyPhoto')->name('academies.destroyPhoto');
            Route::delete('academies/delete-time/{id}', 'AcademyController@destroyTime')->name('academies.destroy.time');
            Route::resource('academies', AcademyController::class);

            Route::resource('eventCategories', EventCategoryController::class);

            Route::post('events/reservations-date-filter', 'EventController@dateFilter')->name('events.reservations.dateFilter');
            Route::patch('events/reservations-status/{reservation}', 'EventController@changeReservationStatus')->name('events.reservations.changeReservationStatus');
            Route::get('events/reservations', 'EventController@reservations')->name('events.reservations');
            Route::resource('events', EventController::class);

            Route::resource('playgroundTypes', PlaygroundTypeController::class);
            Route::resource('playgrounds', PlaygroundController::class);
            Route::resource('playgroundReservations', PlaygroundReservationController::class)->only(['show', 'index']);

            Route::resource('ticketReservations', TicketReservationController::class)->only(['show', 'index']);
        });
    }
);

///////////////////////////////////////////////////////////////////////////
///								End admin panel routes 					///
///////////////////////////////////////////////////////////////////////////

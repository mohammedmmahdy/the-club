<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\EventReservation;
use App\Models\PlaygroundReservation;
use App\Models\TicketReservation;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Relation::enforceMorphMap([
            'event_reservation' => EventReservation::class,
            'playground_reservation' => PlaygroundReservation::class,
            'ticket_reservation' => TicketReservation::class,
            'admin'  => Admin::class
        ]);
    }
}

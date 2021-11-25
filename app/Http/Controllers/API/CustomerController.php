<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Academy;
use App\Models\DriverRate;
use App\Models\CustomerRate;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\AcademySchedule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\EventReservation;
use App\Models\Playground;
use Faker\Provider\Uuid;
use Illuminate\Validation\ValidationException;

use function PHPUnit\Framework\throwException;

class CustomerController extends Controller
{

    ##################################################################
    # Main
    ##################################################################

        public function update_information(Request $request)
        {
            $customer = auth('api.customer')->user();
            $data = $request->validate([
                'name'  => 'required|string|min:3|max:191',
                'email'  => 'required|email|unique:customers,email,' . $customer->id,
                'photo' => 'nullable|image|mimes:jpeg,jpg,png',
            ]);

            $customer->update($data);

            return response()->json(compact('customer'));
        }

        public function wallet()
        {
            $customer = auth('api.customer')->user();
            $balance = $customer->balance;

            return response()->json(compact('balance'));
        }

    //------------------------- End Main --------------------------//

    ##################################################################
    # Academies
    ##################################################################

        public function academySubscribe()
        {
            $attributes = request()->validate([
                'academy_id'            => 'required|exists:academies,id',
                'academy_schedule_id'   => 'required|exists:academy_schedules,id',
                'first_name'            => 'required|string|max:191',
                'last_name'             => 'required|string|max:191',
                'phone'                 => 'required|numeric',
                'age'                   => 'required|integer',
                'gender'                => 'required|integer|in:1,2'
            ]);

            $schedule = AcademySchedule::find($attributes['academy_schedule_id'])->only('day', 'from', 'to');

            if (auth('api')->user()) {
                $data['user'] = auth('api')->user();

                // Check If Appointment Time Is Available
                $scheduleFrom = date('Y-m-d', strtotime($schedule['from']));
                $scheduleTo = date('Y-m-d', strtotime($schedule['to']));
                $data['user']->academies->each(function ($subscription, $key) use ($schedule, $scheduleFrom, $scheduleTo) {

                    $subscriptionFrom = date('Y-m-d', strtotime($subscription->appointment->from));
                    $subscriptionTo = date('Y-m-d', strtotime($subscription->appointment->to));

                    if ($scheduleFrom >= $subscriptionFrom && $scheduleFrom <= $subscriptionTo){
                        if ($scheduleTo >= $subscriptionFrom && $scheduleFrom <= $subscriptionTo) {
                            if ($schedule['day'] == $subscription->appointment->day) {
                                throw(ValidationException::withMessages(['appointment' => 'You have another appointment in this time']));
                            }
                        }
                    }
                });
                // End Check If Appointment Time Is Available

            } else {
                $data['user'] = User::create([
                    'first_name'            => $attributes['first_name'],
                    'last_name'             => $attributes['last_name'],
                    'phone'                 => $attributes['phone'],
                ]);
            }

            $data['academy'] = $data['user']->academies()->create($attributes);
            $data['user']->load('academies');

            return response()->json($data);
        }


    //------------------------- End Academies --------------------------//

    ##################################################################
    # Events
    ##################################################################

        public function eventReservation()
        {
            $attributes = request()->validate([
                'event_id'              => 'required|exists:events,id',
                'first_name'            => 'required|string|max:191',
                'last_name'             => 'required|string|max:191',
                'phone'                 => 'required|numeric',
                'number_of_tickets'     => 'nullable|numeric',
            ]);

            if (auth('api')->user()) {
                $data['user'] = auth('api')->user();
                $data['user']->load('events');
                $attributes['user_id'] = $data['user']->id;
            }
            // else {
            //     $data['user'] = User::create([
            //         'first_name'            => $attributes['first_name'],
            //         'last_name'             => $attributes['last_name'],
            //         'phone'                 => $attributes['phone'],
            //     ]);
            // }

            $data['event'] = EventReservation::create($attributes);

            return response()->json($data);
        }


    //------------------------- End Events --------------------------//

    ##################################################################
    # Playgrounds
    ##################################################################

        public function playgroundReservation()
        {
            $attributes = request()->validate([
                'playground_id'         => 'required|exists:playgrounds,id',
                'first_name'            => 'required|string|max:191',
                'last_name'             => 'required|string|max:191',
                'phone'                 => 'required|numeric',
                'date'                  => 'required|date',
                'time'                  => 'required|date_format:H:i:s',
                'number_of_people'      => 'required|numeric',
            ]);

            if (auth('api')->user()) {
                $data['user'] = auth('api')->user();
            } else {
                $data['user'] = User::create([
                    'first_name'       => $attributes['first_name'],
                    'last_name'        => $attributes['last_name'],
                    'phone'            => $attributes['phone'],
                ]);
            }

            $playground = Playground::findOrFail($attributes['playground_id']);

            if ( in_array($attributes['date'],$playground->reservations->pluck('date')->toArray()) ) {
                if (in_array($attributes['time'],$playground->reservations->where('date', $attributes['date'])->pluck('time')->toArray())) {
                    throw ValidationException::withMessages(['time' => 'This time is not available.']);
                }
            }

            $attributes['price'] = $playground->price;

            $data['playground'] = $data['user']->playgrounds()->create($attributes);
            $data['user']->load('playgrounds');

            return response()->json($data);
        }



        public function playgroundReservedTimes(Playground $playground)
        {

            $reservedTimes = $playground->reservations
            ->mapToGroups(function ($item, $key) {
                return [$item['date'] => $item['time']];
            });

            return response()->json(compact('reservedTimes'));
        }

    //------------------------- End Playgrounds --------------------------//

    ##################################################################
    # Tickets
    ##################################################################

        public function ticketReservation()
        {
            $attributes = request()->validate([
                'first_name'            => 'required|string|max:191',
                'last_name'             => 'required|string|max:191',
                'phone'                 => 'required|numeric',
                'date'                  => 'required|date',
                'number_of_people'      => 'required|numeric',
            ]);

            if (auth('api')->user()) {
                $data['user'] = auth('api')->user();
            } else {
                $data['user'] = User::create([
                    'first_name'       => $attributes['first_name'],
                    'last_name'        => $attributes['last_name'],
                    'phone'            => $attributes['phone'],
                ]);
            }

            $data['ticket'] = $data['user']->tickets()->create($attributes);
            $data['user']->load('tickets');

            return response()->json($data);
        }

    //------------------------- End Tickets --------------------------//

}

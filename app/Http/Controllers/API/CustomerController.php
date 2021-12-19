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
use App\Models\Option;
use App\Models\Playground;
use App\Models\PlaygroundReservation;
use Faker\Provider\Uuid;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

use function PHPUnit\Framework\throwException;

class CustomerController extends Controller
{

    ##################################################################
    # Main
    ##################################################################

        // public function update_information(Request $request)
        // {
        //     $customer = auth('api.customer')->user();
        //     $data = $request->validate([
        //         'name'  => 'required|string|min:3|max:191',
        //         'email' => 'required|email|unique:customers,email,' . $customer->id,
        //         'photo' => 'nullable|image|mimes:jpeg,jpg,png',
        //     ]);

        //     $customer->update($data);

        //     return response()->json(compact('customer'));
        // }

        // public function wallet()
        // {
        //     $customer = auth('api.customer')->user();
        //     $balance = $customer->balance;

        //     return response()->json(compact('balance'));
        // }

        public function updatePassword()
        {
            request()->validate([
                'old_password' => 'required|string|max:191',
                'password'     => 'required|string|max:191|confirmed'
            ]);

            $user = auth('api')->user();
            if (Hash::check(request('old_password'), $user->password)) {
                $user->update([ 'password' => request('password')]);
                return response()->json([
                    'message' => 'Password Updated Successfully'
                ]);
            }

            return response()->json([
                'message' => 'Wrong Old Password'
            ], 403);
        }

        public function updateEmail()
        {
            request()->validate([
                'password'     => 'required|string|max:191',
                'email'        => "required|string|email|unique:users,email," . auth('api')->id(),
            ]);

            $user = auth('api')->user();
            if (Hash::check(request('password'), $user->password)) {
                $user->update([ 'email' => request('email')]);
                return response()->json([
                    'message' => 'Email Updated Successfully'
                ]);
            }

            return response()->json([
                'message' => 'Wrong Password'
            ], 403);
        }

        public function loginQR()
        {
            $user = auth('api')->user();

            // Handle if the user not a member Or academy member ( 0 (Main) / 1 (Sub) / 2 (Academic) )
            if (!$user->iMemberId) {
                return response()->json(['msg' => 'You are not a member'], 403);
            }
            // Handle account status True (Active) / False (Hold)
            if (!$user->boolMemberStatus) {
                return response()->json(['msg' => 'Your account is not active'], 403);
            }

            $QRdata = $user->only('iMemberId', 'strCardNumber', 'strMemberName');
            $QRdata['QRId'] = $this->randomCode(10);

            return response()->json(compact('QRdata'));
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
                'strMemberName'         => 'required|string|max:191',
                'member_mobile'         => 'required|numeric',
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
                    'strMemberName'        => $attributes['strMemberName'],
                    'member_mobile'        => $attributes['member_mobile'],
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
                'strMemberName'         => 'required|string|max:191',
                'member_mobile'         => 'required|numeric',
                'number_of_tickets'     => 'nullable|numeric',
            ]);

            if (auth('api')->user()) {
                $attributes['user_id'] = auth('api')->id();
            }

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
                'strMemberName'         => 'required|string|max:191',
                'member_mobile'         => 'required|numeric',
                'date'                  => 'required|date',
                'time'                  => 'required|date_format:H:i:s',
                'number_of_hours'      => 'required|numeric',
                'number_of_people'      => 'required|numeric',
            ]);

            $attributes['reservation_code'] = $this->randomCode();

            if (auth('api')->user()) {
                $attributes['user_id'] = auth('api')->id();
            }

            $playground = Playground::findOrFail($attributes['playground_id']);

            if ( in_array($attributes['date'],$playground->reservations->pluck('date')->toArray()) ) {
                if (in_array($attributes['time'],$playground->reservations->where('date', $attributes['date'])->pluck('time')->toArray())) {
                    throw ValidationException::withMessages(['time' => 'This time is not available.']);
                }
            }

            $attributes['price'] = $playground->price;

            if (request('number_of_hours') > 1 ) {
                for ($i= 0; $i < request('number_of_hours') ; $i++) {
                    $data['playground'] = PlaygroundReservation::create($attributes);
                    $attributes['time'] = (int) $attributes['time'];
                    $attributes['time']++;
                    $attributes['time'] = (string) $attributes['time'] . ":00:00";
                }
            }else{
                $data['playground'] = PlaygroundReservation::create($attributes);
            }

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
                'strMemberName'         => 'required|string|max:191',
                'member_mobile'         => 'required|numeric',
                'date'                  => 'required|date',
                'number_of_people'      => 'required|numeric',
            ]);

            $attributes['price'] = Option::first()->visit_ticket_price;
            $data['user'] = auth('api')->user();

            // Handle if the user not a member Or academy member ( 0 (Main) / 1 (Sub) / 2 (Academic) )
            if (!$data['user']->iMemberId) {
                return response()->json(['msg' => 'You are not a member'], 403);
            }
            // Handle account status True (Active) / False (Hold)
            if (!$data['user']->boolMemberStatus) {
                return response()->json(['msg' => 'Your account is not active'], 403);
            }

            $data['ticket'] = $data['user']->tickets()->create($attributes);
            $data['user']->load('tickets');

            return response()->json($data);
        }

    //------------------------- End Tickets --------------------------//





    ///////////////////////////////////////// Helpers  /////////////////////////////////////////

    public function randomCode($length = 8)
    {
        // 0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }

}

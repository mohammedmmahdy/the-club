<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Option;
use App\Models\Academy;
use Faker\Provider\Uuid;
use App\Models\DriverRate;
use App\Models\Playground;
use App\Models\CustomerRate;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\AcademyReview;
use App\Models\PaymentHistory;
use App\Models\AcademySchedule;
use App\Models\AcademyComplaint;
use App\Models\EventReservation;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use App\Models\PlaygroundReservation;

use function PHPUnit\Framework\throwException;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class CustomerController extends Controller
{

    ##################################################################
    # Main
    ##################################################################

    public function updatePassword()
    {
        request()->validate([
            'old_password' => 'required|string|max:191',
            'password'     => 'required|string|max:191|confirmed'
        ]);

        $user = auth('api')->user();
        if (Hash::check(request('old_password'), $user->password)) {
            $user->update(['password' => request('password')]);
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
            $user->update(['email' => request('email')]);

            // Update Email in ERP
            $name       = $user->strMemberName;
            $url        = 'http://103.136.40.46:72/api/resource/Address/' . $name;
            $headers    = ['Authorization' => 'token dfc4dbec3968677:daad250857fc081'];
            $body       = ['email_id' => request('email')];

            Http::withHeaders($headers)->put($url, $body);

            return response()->json(['message' => 'Email Updated Successfully']);
        }

        return response()->json([
            'message' => 'Wrong Password'
        ], 403);
    }

    public function getSubscriptions()
    {
        $url = 'http://103.136.40.46:72/api/resource/Sales Invoice';
        $headers = [
            'Authorization' => 'token dfc4dbec3968677:daad250857fc081'
        ];

        $params = [
            'filters' => [
                'status' => request('status'),
                'customer' => auth('api')->user()->strMemberName
            ],
            // "filters['status']"     => request('filter'),
            // "filters['customer']"   => auth('api')->user()->strMemberName,
            'fields'                => '["name", "grand_total"]'
        ];

        // dd(request('filter'));

        $response = Http::withHeaders($headers)
                        ->get($url, $params);

                        // dd($response);

        return $response->json();

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

    public function paymentHistory()
    {
        $user = auth('api')->user();
        $data['paymentHistory'] = $user->paymentHistory()
            ->with(['reservable' => function (MorphTo $morphTo) {
                $morphTo->morphWith([
                    PlaygroundReservation::class => ['playground'],
                    EventReservation::class => ['event','eventCategory'],
                ]);
        }])->get();

        return response()->json($data);
    }

    public function renewSubscription()
    {
        $user = auth()->user();

        // After payment will add 1 year to his subscription
        $user->update([
            'dateCardDateValidFrom' => now(),
            'dateCardDateExpire'    => Carbon::parse($user->dateCardDateExpire)->addYear()
        ]);

        foreach ($user->submembers as $submember) {
            $submember->update([
                'dateCardDateValidFrom' => now(),
                'dateCardDateExpire'    => Carbon::parse($user->dateCardDateExpire)->addYear()
            ]);
        }

        $user->load('submembers');

        return response()->json(compact('user'));
    }

    public function updateOrCreateReview()
    {
        request()->validate([
            'academy_id' => 'required|integer|exists:academies,id',
            'rate'       => 'required|integer',
            'comment'    => 'nullable|string|max:191'
        ]);

        $review = AcademyReview::updateOrCreate(
            [
                'academy_id' => request('academy_id'),
                'user_id'    => auth('api')->id(),
            ],
            [
                'rate'       => request('rate'),
                'comment'    => request('comment'),
            ]
        );

        return response()->json(compact('review'));
    }

    public function createComplaint()
    {
        request()->validate([
            'academy_id'   => 'required|integer|exists:academies,id',
            'complaint'    => 'required|string'
        ]);

        $review = AcademyComplaint::create([
            'user_id'    => auth('api')->id(),
            'academy_id' => request('academy_id'),
            'complaint'  => request('complaint'),
        ]);

        return response()->json(compact('review'));
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

                if ($scheduleFrom >= $subscriptionFrom && $scheduleFrom <= $subscriptionTo) {
                    if ($scheduleTo >= $subscriptionFrom && $scheduleFrom <= $subscriptionTo) {
                        if ($schedule['day'] == $subscription->appointment->day) {
                            throw (ValidationException::withMessages(['appointment' => 'You have another appointment in this time']));
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


        // Store Academy in ERP
        $url = 'http://103.136.40.46:72/api/resource/Student Applicant';
        $headers = ['Authorization' => 'token dfc4dbec3968677:daad250857fc081'];
        $body = [
            'academic_term'         =>$data['academy']->name,
            'first_name'            =>$data['user']->strMemberName,
            'customer_gender'       => request('gender') == 1 ? 'ذكر' : 'انثى',
            'student_email_id'      =>$data['user']->email,
            'student_mobile_number' =>$data['user']->member_mobile,

            // Dummy Data
            'program'               => "برنامج ايجار ملعب",

        ];

        $response = Http::withHeaders($headers)->post($url, $body);

        // return $response->json();

        return response()->json($data);
    }

    public function myAcademies()
    {
        return response()->json([
            'academies' => auth()->user()->academies()->active()->with('academy.photos', 'academy.schedules')->get()
        ]);
    }


    //------------------------- End Academies --------------------------//

    ##################################################################
    # Events
    ##################################################################

    public function eventReservation()
    {
        $attributes = request()->validate([
            'event_id'              => 'required|exists:events,id',
            'event_category_id'     => 'required|exists:event_categories,id',
            'strMemberName'         => 'required|string|max:191',
            'member_mobile'         => 'required|numeric',
            'total_price'           => 'required|integer',
            'number_of_tickets'     => 'nullable|numeric',
        ]);

        $data['user'] = auth('api')->user();

        if ($data['user']) {
            $attributes['user_id'] = auth('api')->id();
        }

        $data['event'] = EventReservation::create($attributes);
        if ($data['user']) {
            // record payment history
            $data['user']->paymentHistory()->create([
                'reservable_type'    => 'event_reservation',
                'reservable_id'      => $data['event']->id,
                'amount'             => request('total_price'),
            ]);
        }

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
            'number_of_hours'       => 'required|numeric',
            'number_of_people'      => 'required|numeric',
        ]);

        $attributes['reservation_code'] = $this->randomCode();
        $data['user'] = auth('api')->user();
        if ($data['user']) {
            $attributes['user_id'] = auth('api')->id();
        }

        $playground = Playground::findOrFail($attributes['playground_id']);

        if (in_array($attributes['date'], $playground->reservations->pluck('date')->toArray())) {
            if (in_array($attributes['time'], $playground->reservations->where('date', $attributes['date'])->pluck('time')->toArray())) {
                throw ValidationException::withMessages(['time' => 'This time is not available.']);
            }
        }

        $attributes['price'] = $playground->price;

        if (request('number_of_hours') > 1) {
            for ($i = 0; $i < request('number_of_hours'); $i++) {
                $data['playground'] = PlaygroundReservation::create($attributes);
                $attributes['time'] = (int) $attributes['time'];
                $attributes['time']++;
                $attributes['time'] = (string) $attributes['time'] . ":00:00";
            }
        } else {
            $data['playground'] = PlaygroundReservation::create($attributes);
        }

        if ($data['user']) {
            // record payment history
            $data['user']->paymentHistory()->create([
                'reservable_type'  => 'playground_reservation',
                'reservable_id'    => $data['playground']->id,
                'amount'           => $attributes['price'] * request('number_of_hours'),
            ]);
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

        // record payment history
        $data['user']->paymentHistory()->create([
            'reservable_type' => 'ticket_reservation',
            'reservable_id'      => $data['ticket']->id,
            'amount'    => $attributes['price']
        ]);

        $data['user']->load('tickets');

        return response()->json($data);
    }

    //------------------------- End Tickets --------------------------//



    ##################################################################
    # Notifications
    ##################################################################

    public function notifications()
    {
        $notifications = Notification::whereIn('receiver_type', [auth('api')->user()->iMemberType, 4])
            ->latest()
            ->get();

        return response()->json($notifications);
    }

    public function notification(Notification $notification)
    {
        return response()->json($notification);
    }

    //--------------------- End Notifications -----------------------//



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

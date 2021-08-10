<?php

namespace App\Http\Controllers\API;

use App\Models\Seek;
use App\Models\Trip;
use App\Models\Option;
use App\Models\Reward;
use App\Models\DriverRate;
use App\Models\CustomerRate;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Helpers\CapServiceTrait;
use App\Helpers\TowingTruckTrait;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    use CapServiceTrait, TowingTruckTrait;

    public function test()
    {
        return ('test home');
    }

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
    # Trips
    ##################################################################
    public function trips()
    {
        $tripsQuery = Trip::where('customer_id', auth('api.customer')->id());

        if (request()->filled('year')) {
            $tripsQuery->whereYear('created_at', request('year'));
        }
        if (request()->filled('month')) {
            $tripsQuery->whereMonth('created_at', request('month'));
        }

        $trips = $tripsQuery->latest()->paginate(10);

        return response()->json(compact('trips'));
    }


    //------------------------- End Trips --------------------------//

    ##################################################################
    # Cap Service
    ##################################################################

    function find_captain(Request $request)
    {
        // Find captain available for a new trip
        $data['request'] = $request->validate(Seek::$rules);

        // $data['message'] = 'will coming after 2 minutes';

        $data['seek'] = $seek = $this->set_seek($request);

        $data['data'] = $this->get_drivers_near($seek->from_location, '3mb', $seek);

        return response()->json($data);
    }

    function cancel_find_captian(Request $request, Seek $seek)
    {
        // Cancel find captain available for a new trip
        $request->validate(['reason_id'  => 'nullable']);

        $this->cancel_seek($request, $seek);

        $data['message'] = 'Cancellations Successful';

        return response()->json($data);
    }

    function cancel_trip(Request $request, Trip $trip)
    {

        $data['request'] = $request->validate([
            'reason'  => 'required|string|min:3|max:191',
            'description'  => ''
        ]);

        $trip->updated(['status' => 'cancel', 'reason' => $request->reason, 'description' => $request->description ?? '']);
        $data['message'] = 'Cancellations Successful';

        return response()->json($data);
    }

    function change_location_trip(Request $request, Trip $trip)
    {

        $data['request'] = $request->validate([
            'reason'  => 'required|string|min:3|max:191',
            'description'  => ''
        ]);

        $trip->updated(['status' => 'cancel', 'reason' => $request->reason, 'description' => $request->description ?? '']);
        $data['message'] = 'Cancellations Successful';

        return response()->json($data);
    }

    //---------------------- End Cap Service ------------------------//


    ##################################################################
    # Towing Truck Service
    ##################################################################

    function towing_find_truck(Request $request)
    {
        // Find truck available for a new trip
        $data['request'] = $request->validate(Seek::$rules);
        $min_balance = Option::first()->towing_min_balance;
        if (auth('api.customer')->user()->balance < $min_balance) {
            return  'Sorry, your balance less than the minimum balance';
        }
        // $data['message'] = 'will coming after 2 minutes';

        $data['seek'] = $seek = $this->towing_set_seek($request);

        $data['message'] = $this->towing_get_drivers_near($seek->from_location, 1, $seek);

        return response()->json($data);
    }

    function towing_cancel_find_truck(Request $request, Seek $seek)
    {
        // Cancel find truck available for a new trip
        $request->validate(['reason_id'  => 'nullable']);

        $this->towing_cancel_seek($request, $seek);

        $data['message'] = 'Cancellations Successful';

        return response()->json($data);
    }

    function towing_cancel_trip(Request $request, Trip $trip)
    {
        $data['request'] = $request->validate([
            'reason_id'             => 'nullable',
            'cancellation_notes'    => 'nullable|max:191'
        ]);

        $trip->update([
            'status'                => 2, // Canceled
            'reason_id'             => $request->reason_id,
            'cancellation_notes'    => $request->cancellation_notes
        ]);

        $data['message'] = 'Cancellations Successful';

        return response()->json($data);
    }

    function towing_change_trip_location(Request $request, Trip $trip)
    {

        $data['request'] = $request->validate([
            'latitude_to'   => 'required',
            'longitude_to'  => 'required',
        ]);

        $trip->update([
            'to_location' => new Point($request->latitude_to, $request->longitude_to)
        ]);

        $data['message'] = 'Location Changed Successfully';

        return response()->json($data);
    }

    //---------------------- End Towing Truck Service ------------------------//


    ##################################################################
    # Notifications
    ##################################################################

    public function notifications()
    {
        $notifications = Notification::customer()->get();

        return response()->json($notifications, 200);
    }

    public function notification(Notification $notification)
    {
        return response()->json($notification, 200);
    }

    //--------------------- End Notifications -----------------------//

    ##################################################################
    # Rewards
    ##################################################################

    public function rewards()
    {
        $rewards = Reward::customer()->get();

        return response()->json($rewards);
    }

    public function reward(Reward $reward)
    {
        return response()->json($reward);
    }

    //--------------------- End Rewards -----------------------//

    ##################################################################
    # Rates
    ##################################################################

    public function rates($customerId)
    {
        $data['rates'] = CustomerRate::where('customer_id', $customerId)->get();
        $data['rates']->load('customer', 'driver');
        return response()->json($data);
    }

    public function rate(CustomerRate $customerRate)
    {
        $customerRate->load('customer', 'driver');
        return response()->json($customerRate);
    }

    public function addOrUpdateRate()
    {
        $validated = request()->validate([
            'driver_id'         => 'required',
            'rate'              => 'required',
            'report'            => 'required',
        ]);

        $validated['customer_id'] =  auth('api.customer')->id();

        $data['rate'] = DriverRate::updateOrCreate([
            'customer_id'   => auth('api.customer')->id(),
            'driver_id'     => request('driver_id')
        ], $validated);
        $data['rate']->load('customer', 'driver');
        return response()->json($data);
    }

    //--------------------- End Rates -----------------------//



}

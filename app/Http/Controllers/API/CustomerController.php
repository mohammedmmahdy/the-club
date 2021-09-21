<?php

namespace App\Http\Controllers\API;

use App\Models\DriverRate;
use App\Models\CustomerRate;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

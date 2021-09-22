<?php

namespace App\Http\Controllers\API;

use App\Models\DriverRate;
use App\Models\CustomerRate;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Academy;
use App\Models\User;

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
                    'name'                  => 'nullable|string|min:3|max:191',
                    'age'                   => 'required|integer',
                    'gender'                => 'required|integer|in:1,2'
                ]);

                $data['user'] = auth('api')->user();

                $data['academy'] = $data['user']->academies()->create($attributes);
                $data['user']->load('academies');

                return response()->json($data);
        }

        public function academySchedule(Academy $academy)
        {
            $schedules = $academy->schedules;
            return response()->json(compact('schedules'));
        }

    //------------------------- End Academies --------------------------//


}

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
                'first_name'            => 'required|string|max:191',
                'last_name'             => 'required|string|max:191',
                'phone'                 => 'required|numeric',
                'age'                   => 'required|integer',
                'gender'                => 'required|integer|in:1,2'
            ]);

            if (auth('api')->user()) {
                if (in_array($attributes['academy_schedule_id'], auth('api')->user()->academies->pluck('academy_schedule_id')->toArray())) {
                    return response()->json(['msg' => 'You have another appointment in this time'], 420);
                }
                $data['user'] = auth('api')->user();
            }else{
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

        public function academySchedule(Academy $academy)
        {
            $schedules = $academy->schedules;
            return response()->json(compact('schedules'));
        }

    //------------------------- End Academies --------------------------//


}

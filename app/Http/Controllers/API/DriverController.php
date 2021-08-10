<?php

namespace App\Http\Controllers\API;


use App\Models\Seek;
use App\Models\Trip;
use App\Models\Reward;
use App\Models\Vehicle;
use App\Models\DriverRate;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\VehiclePhotos;
use App\Helpers\CapServiceTrait;
use App\Helpers\TowingTruckTrait;
use App\Models\DriverBankAccount;
use App\Http\Controllers\Controller;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use App\Models\CustomerRate;

class DriverController extends Controller
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
        $driver = auth('api.driver')->user();
        if (!$driver->status) {
            $data = $request->validate([
                'name'                              => 'required|string|max:191',
                'address'                           => 'required|string|max:191',
                'phone'                             => 'nullable|string|min:6|max:191|unique:drivers,phone,' . $driver->id,
                'email'                             => 'nullable|email|max:191|unique:drivers,email,' . $driver->id,
                'medical_report'                    => 'nullable|image|mimes:jpeg,jpg,png',
                'front_identity_card'               => 'nullable|image|mimes:jpeg,jpg,png',
                'back_identity_card'                => 'nullable|image|mimes:jpeg,jpg,png',
                'police_clearance_certificate'      => 'nullable|image|mimes:jpeg,jpg,png',
                'front_driver_licence'              => 'required|image|mimes:jpeg,jpg,png',
                'back_driver_licence'               => 'required|image|mimes:jpeg,jpg,png',
                'photo'                             => 'required|image|mimes:jpeg,jpg,png',
            ]);
        } else {
            $data = $request->validate([
                'name'                              => 'required|string|max:191',
                'address'                           => 'required|string|max:191',
                'phone'                             => 'nullable|string|min:6|max:191|unique:drivers,phone,' . $driver->id,
                'email'                             => 'nullable|email|max:191|unique:drivers,email,' . $driver->id,
                'medical_report'                    => 'nullable|image|mimes:jpeg,jpg,png',
                'front_identity_card'               => 'nullable|image|mimes:jpeg,jpg,png',
                'back_identity_card'                => 'nullable|image|mimes:jpeg,jpg,png',
                'police_clearance_certificate'      => 'nullable|image|mimes:jpeg,jpg,png',
                'front_driver_licence'              => 'nullable|image|mimes:jpeg,jpg,png',
                'back_driver_licence'               => 'nullable|image|mimes:jpeg,jpg,png',
                'photo'                             => 'nullable|image|mimes:jpeg,jpg,png',
            ]);
        }

        $data['status'] = $driver->status == 0 ? 1 : $driver->status;
        $driver->update($data);
        return response()->json(['msg' =>  'Update Information Success', 'driver' => $driver]);
    }

    public function wallet()
    {
        $driver = auth('api.driver')->user();
        $balance = $driver->balance;

        return response()->json(compact('balance'));
    }

    public function bank_account_store()
    {
        $validated = request()->validate(DriverBankAccount::$rules);
        $validated['driver_id'] = auth('api.driver')->id();

        $data['bank_account'] = DriverBankAccount::create($validated);

        return response()->json($data);
    }

    public function bank_account()
    {
        $data['bank_account'] = DriverBankAccount::where('driver_id', auth('api.driver')->id())->latest()->first();

        return response()->json($data);
    }

    public function revenue(Request $request)
    {
        $driver = auth('api.driver')->user();
        $query = Trip::query()
            ->groupBy('driver_id')
            ->selectRaw('count(id) as trips_count, sum(price) as total')
            ->where('driver_id', $driver->id);


        $from = request()->filled('from') ? request('from') : '2000-01-01';
        $to = request()->filled('to') ? request('to') : now();

        if (request()->filled('from') || request()->filled('to')) {
            $query->whereBetween('created_at', [$from, $to]);
        }

        $revenue = $query->get();

        return response()->json(compact('revenue'));
    }

    //------------------------- End Main ---------------------------//


    ##################################################################
    #--------------------------   Vehicle  -------------------------#
    ##################################################################

    public function vehicle()
    {
        $driver = auth('api.driver')->user();
        $vehicle = $driver->vehicles->first();
        if (empty($vehicle)) {

            return response()->json(['message' => 'Not found your vehicle go to create one'], 404);
        }
        $vehicle->load('photos', 'brand', 'model', 'type', 'service', 'company', 'color');

        return response()->json(compact('vehicle'));
    }

    public function vehicle_store(Request $request)
    {
        request()->validate([
            'vehicle_photos' => 'required|array',
            'vehicle_photos.*' => 'required|image|mimes:jpeg,jpg,png',
        ]);

        $driver = auth('api.driver')->user();
        $inputs = $request->validate(Vehicle::$rules);
        $inputs['driver_id'] = $driver->id;
        $inputs['status'] = 2;

        $oldVehicle = $driver->vehicles->first();

        if ($oldVehicle) {
            $oldVehicle->update(['status' => 0]);
        }

        $vehicle = Vehicle::create($inputs);

        foreach ($request->vehicle_photos as $photo) {

            VehiclePhotos::create([
                'vehicle_id' => $vehicle->id,
                'photo'      => $photo
            ]);
        }

        $vehicle->load('photos', 'brand', 'model', 'type', 'service', 'company', 'color');


        $driver->vehicles()->sync([$vehicle->id]);

        return response()->json(compact('vehicle'));
    }


    public function vehicle_update(Request $request, $id)
    {
        $driver = auth('api.driver')->user();

        $vehicle = Vehicle::whereIn('id', $driver->vehicles->pluck('id')->toArray())
            ->where('id', $id)
            ->first();

        if (empty($vehicle)) {
            return response()->json(['msg' => 'The vehicle is not found, Please check your data'], 404);
        }

        $inputs = $request->validate([

            'company_id' => 'nullable',
            'brand_id' => 'required',
            'service_id' => 'required',
            'brand_id' => 'required',
            'model_id' => 'required',
            'color_id' => 'required',
            'vehicle_type_id' => 'required',
            'model_year' => 'required',
            'engine_serial_number' => 'required|unique:vehicles,engine_serial_number,' . $vehicle->id,
            'chassis_number' => 'required|unique:vehicles,chassis_number,' . $vehicle->id,
            'license_plate' => 'required|string|max:191|unique:vehicles,license_plate,' . $vehicle->id,
            'front_vehicle_license' => 'required|image|mimes:jpeg,jpg,png',
            'back_vehicle_license' => 'required|image|mimes:jpeg,jpg,png',
            'technical_report' => 'required|image|mimes:jpeg,jpg,png',
            'vehicle_photos' => 'required|array',
            'vehicle_photos.*' => 'required|image|mimes:jpeg,jpg,png',

        ]);

        $vehicle->update($inputs);

        VehiclePhotos::where('vehicle_id', $vehicle->id)->delete();

        foreach ($request->vehicle_photos as $photo) {
            VehiclePhotos::create([
                'vehicle_id' => $vehicle->id,
                'photo'      => $photo
            ]);
        }

        $vehicle->load('photos');

        return response()->json(compact('vehicle'));
    }

    //------------------------ End Vehicle ------------------------//



    ##################################################################
    # Trips
    ##################################################################

    public function trips()
    {
        $query = Trip::where('driver_id', auth('api.driver')->id());

        $from = request()->filled('from') ? request('from') : '2000-5-22';
        $to = request()->filled('to') ? request('to') : now();
        if (request()->filled('from') || request()->filled('to')) {

            $query->whereBetween('created_at', [$from, $to]);
        }

        $trips = $query->latest()->with('driver')->paginate(10);

        return response()->json(compact('trips'));
    }

    //------------------------- End Trips --------------------------//

    ##################################################################
    # Cap Service
    ##################################################################

    public function online()
    {
        $data['message'] = $this->online_driver();

        return response()->json($data);
    }

    public function offline()
    {
        $data['message'] = $this->offline_driver();

        return response()->json($data);
    }

    public function update_my_location(Request $request)
    {
        $request->validate(['lat' => 'required', 'lng' => 'required']);
        $data['my_location'] = $this->update_driver_location($request);
        $data['message'] = 'Update location Success';

        return response()->json($data);
    }

    public function confirm_request($id)
    {
        $seek = Seek::findOrFail($id);

        $data['message'] = $this->driver_confirm_request($seek);

        return response()->json($data);
    }

    public function reject_request($id)
    {
        $seek = Seek::findOrFail($id);

        $data['message'] = $this->driver_reject_request($seek);

        return response()->json($data);
    }

    public function start_trip($id)
    {
        $seek = Seek::findOrFail($id);
        $data['trip'] = $this->driver_start_trip($seek);
        $data['message'] = 'Start Trip';

        return response()->json($data);
    }

    public function end_trip(Request $request, $id)
    {
        // End a journey and start calculating the trip value cash
        $trip = Trip::findOrFail($id);

        $request->validate(['latitude_to'  => 'required', 'longitude_to'  => 'required']);
        $to_location = new Point($request->latitude_to, $request->longitude_to);
        $data['trip'] = $this->driver_end_trip($trip, $to_location);
        $data['message'] = 'End Trip';

        return response()->json($data);
    }

    //---------------------- End Cap Service ------------------------//


    ##################################################################
    # Towing Truck Service
    ##################################################################

    public function towing_online()
    {
        $data['message'] = $this->towing_online_driver();

        return response()->json($data);
    }

    public function towing_update_my_location(Request $request)
    {
        $request->validate(['lat' => 'required', 'lng' => 'required']);
        $data['my_location'] = $this->towing_update_driver_location($request);
        $data['message'] = 'Update location Success';

        return response()->json($data);
    }

    public function towing_confirm_request(Seek $seek)
    {
        $data['message'] = $this->towing_driver_confirm_request($seek);

        return response()->json($data);
    }

    public function towing_reject_request(Seek $seek)
    {
        $data['message'] = $this->towing_driver_reject_request($seek);

        return response()->json($data);
    }

    public function towing_start_trip(Seek $seek)
    {
        $data['trip'] = $this->towing_driver_start_trip($seek);
        $data['message'] = 'Start Trip';

        return response()->json($data);
    }

    public function towing_end_trip(Request $request, Trip $trip)
    {
        // End a journey and start calculating the trip value cash

        $request->validate(['latitude_to'  => 'required', 'longitude_to'  => 'required']);
        $to_location = new Point($request->latitude_to, $request->longitude_to);
        $data['trip'] = $this->towing_driver_end_trip($trip, $to_location);
        $data['message'] = 'End Trip';

        return response()->json($data);
    }

    //---------------------- End Towing Truck Service ------------------------//


    ##################################################################
    # Notifications
    ##################################################################

    public function notifications()
    {
        $notifications = Notification::driver()->get();

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
        $rewards = Reward::driver()->get();

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

    public function rates($driverId)
    {
        $data['rates'] = DriverRate::rates()->get();
        $data['rates']->load('customer', 'driver');
        return response()->json($data);
    }

    public function rate(DriverRate $driverRate)
    {
        $driverRate->load('customer', 'driver');
        return response()->json($driverRate);
    }

    public function addOrUpdateRate()
    {
        $validated = request()->validate([
            'customer_id'         => 'required',
            'rate'              => 'required',
            'report'            => 'required',
        ]);

        $validated['driver_id'] =  auth('api.driver')->id();

        $data['rate'] = CustomerRate::updateOrCreate([
            'driver_id'   => auth('api.driver')->id(),
            'customer_id'     => request('customer_id')
        ], $validated);
        $data['rate']->load('customer', 'driver');
        return response()->json($data);
    }

    //--------------------- End Rates -----------------------//

}

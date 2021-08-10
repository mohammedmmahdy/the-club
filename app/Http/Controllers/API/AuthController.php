<?php

namespace App\Http\Controllers\API;

use Auth;
use App\Models\Driver;
use App\Models\Customer;
use App\Models\Company;
use App\Helpers\MailsTrait;
use Illuminate\Http\Request;
use App\Mail\RegistrationMail;
use App\Helpers\HelperFunctionTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use phpDocumentor\Reflection\DocBlock\Tags\Uses;

class AuthController extends Controller
{
    use HelperFunctionTrait, MailsTrait, AuthenticatesUsers;

    // Start Customer

    public function login_or_register_customer(Request $request)
    {
        $phone = $request->validate(['phone' => 'required|numeric']);

        $customer = Customer::where($phone)->firstOr(function () {
            return Customer::create(['phone' => request('phone')]);
        });

        $customer->update(['verify_code' => $this->randomCode(4)]);

        return response()->json(['msg' => 'A confirmation code has been sent, check your inbox', 'code' => $customer->verify_code]);
    }


    public function verify_code_customer(Request $request)
    {
        $inputs = $request->validate(['phone' => 'required|numeric', 'verify_code' => 'required|min:4|max:5']);

        $customer = Customer::firstWhere($inputs);

        if (empty($customer)) {
            return response()->json(['msg' => 'Verify code is not correct'], 403);
        }

        $token = auth('api.customer')->tokenById($customer->id);

        return response()->json(compact('customer', 'token'));
    }

    // End Customer

    // Start Driver

    public function login_or_register_driver(Request $request)
    {
        $phone = $request->validate(['phone' => 'required|numeric']);

        $driver = Driver::where($phone)->firstOr(function () {
            return Driver::create(['phone' => request('phone')]);
        });

        $driver->update(['verify_code' => $this->randomCode(4)]);

        return response()->json(['msg' => 'A confirmation code has been sent, check your inbox', 'code' => $driver->verify_code]);

    }

    public function verify_code_driver(Request $request)
    {
        $inputs = $request->validate(['phone' => 'required|numeric', 'verify_code' => 'required|min:4|max:5']);

        $driver = Driver::firstWhere($inputs);

        if (empty($driver)) {
            return response()->json(['msg' => 'Verify code is not correct'], 403);
        }

        $token = auth('api.driver')->tokenById($driver->id);

        return response()->json(compact('driver', 'token'));
    }

    // End Driver

    // Start Company

    public function login_or_register_company(Request $request)
    {
        $phone = $request->validate(['phone' => 'required|numeric']);

        $company = Company::where($phone)->firstOr(function () {
            return Company::create(['phone' => request('phone')]);
        });

        $company->update(['verify_code' => $this->randomCode(4)]);

        return response()->json(['msg' => 'A confirmation code has been sent, check your inbox', 'code' => $company->verify_code]);
    }

    public function verify_code_company(Request $request)
    {

        $inputs = $request->validate(['phone' => 'required|numeric', 'verify_code' => 'required|min:4|max:5']);

        $company = Company::firstWhere($inputs);

        if (empty($company)) {
            return response()->json(['msg' => 'Verify code is not correct'], 403);
        }

        $token = auth('api.company')->tokenById($company->id);

        return response()->json(compact('company', 'token'));
    }

    // End Company

    public function logout()
    {
        auth()->logout();

        return response()->json(['msg' => 'success'], 200);
    }


    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'phone';
    }
}

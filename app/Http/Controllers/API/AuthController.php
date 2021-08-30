<?php

namespace App\Http\Controllers\API;

use Auth;
use App\Models\User;
use App\Models\Driver;
use App\Models\Company;
use App\Helpers\MailsTrait;
use Illuminate\Http\Request;
use App\Mail\RegistrationMail;
use App\Helpers\HelperFunctionTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;
use phpDocumentor\Reflection\DocBlock\Tags\Uses;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use  AuthenticatesUsers;

    // Start user

    public function register_user(Request $request)
    {
        $data = $request->validate([
            'first_name'        => 'required|string|max:191',
            'last_name'         => 'required|string|max:191',
            'email'             => 'required|email|max:191|unique:users,email',
            'phone'             => 'required|numeric|unique:users,phone',
        ]);

        // Make User Credintials Till Take Them form System.
        // $data['member_id'] = request('phone');
        $data['password'] = Hash::make('password');
        //////////////////////////////////////////


        $user = User::create($data);

        // return response()->json(['msg' => 'A confirmation code has been sent, check your inbox', 'code' => $user->verify_code]);
        return response()->json(['msg' => 'Success Registration', 'user' => $user]);
    }

    public function login_user(Request $request)
    {
        // dd(Hash::make('password'));
        $credentials = $request->validate(['member_id' => 'required|numeric', 'password' => 'required|string|max:191']);

        $user = User::firstWhere($credentials);

        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json(['msg' => __('lang.wrongCredential')], 401);
        }

        // $user->update(['verify_code' => $this->randomCode(4)]);

        // $token = auth('api')->tokenById($user->id);
        $user = auth('api')->user();

        return response()->json(compact('user', 'token'));
    }


    // public function verify_code_user(Request $request)
    // {
    //     $inputs = $request->validate(['phone' => 'required|numeric', 'verify_code' => 'required|min:4|max:5']);

    //     $user = User::firstWhere($inputs);

    //     if (empty($user)) {
    //         return response()->json(['msg' => 'Verify code is not correct'], 403);
    //     }

    //     $token = auth('api.user')->tokenById($user->id);

    //     return response()->json(compact('user', 'token'));
    // }

    // End user


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













    ///////////////////////////////////////// Helpeers  /////////////////////////////////////////

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

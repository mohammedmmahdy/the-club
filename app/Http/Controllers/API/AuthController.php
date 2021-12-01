<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    use  AuthenticatesUsers;

    public function register_user(Request $request)
    {
        $data = $request->validate([
            'strMemberName'     => 'required|string|max:191',
            'member_mobile'     => 'required|numeric|unique:users,member_mobile',
            'email'             => 'required|email|max:191|unique:users,email',
            // 'password'          => 'required|string|min:3|max:191|confirmed',
            'social_status'     => 'required|in:1,2',
            'num_of_children'   => 'nullable|required_if:social_status,2|numeric'
        ]);

        $user = User::create($data);
        $userData = User::findOrFail($user->id);

        return response()->json(['msg' => 'Success Registration', 'user' => $userData]);
    }

    public function checkMobileStatus()
    {
        // validate if mobile is numeric and exist in our users
        request()->validate([
            'member_mobile'     => 'required|numeric|exists:users,member_mobile',
        ]);
        // define user
        $user = User::where('member_mobile', request('member_mobile'))->first();

        // handle if user don't registered as a member yet
        if ($user->iMemberId == null) {
            return response()->json([
                'message'       => 'you are not a member, wait for approval',
            ], 421);
        }
        // handle if user don't create his password
        if ($user->password == null) {
            $user->update(['verification_code' => $this->randomCode(4)]);
            return response()->json([
                'message'           => 'You have to setup your password before first login',
                'verification_code' => $user->verification_code
            ], 420);
        }
        // handle if user already has password
        return response()->json(['message' => 'Valid user and can login now']);
    }

    public function forgotPassword()
    {
        // validate if mobile is numeric and exist in our users
        request()->validate([
            'member_mobile'     => 'required|numeric|exists:users,member_mobile',
        ]);
        // define user
        $user = User::where('member_mobile', request('member_mobile'))->first();

        // handle if user don't registered as a member yet
        if ($user->iMemberId == null) {
            return response()->json([
                'message'       => 'you are not a member, wait for approval',
            ], 421);
        }
        // update verification code
        $user->update(['verification_code' => $this->randomCode(4)]);

        // return data
        return response()->json([
            'message'           => 'Use the verification code to verify your mobile number',
            'verification_code' => $user->verification_code
        ]);

    }

    public function codeVerification()
    {
        // validate mobile and verification code
        $credentials = request()->validate([
            'member_mobile'     => 'required|numeric',
            'verification_code' => 'required|string|max:191',
        ]);

        $user = User::where($credentials)->first();
        if (!$user) {
            return response()->json([
                'message' => 'Sorry ,wrong verification code'
            ], 403);
        }

        return response()->json(['user' => $user]);
    }

    public function createPassword()
    {
        // validate mobile and verification code
        $credentials = request()->validate([
            'member_mobile'     => 'required|numeric',
            'verification_code' => 'required|string|max:191',
            'password'          => 'required|string|min:3|max:191|confirmed',
        ]);
        $user = User::where('member_mobile', request('member_mobile'))->first();
        // create a new password
        $user->update(['password' => request('password')]);
        // login user
        return $this->doLogin($credentials);
    }

    public function login_user(Request $request)
    {
        $credentials = $request->validate(['member_mobile' => 'required|numeric', 'password' => 'required|string|max:191']);

        return $this->doLogin($credentials);
    }

    public function logout()
    {
        auth('api')->logout();

        return response()->json(['msg' => 'success'], 200);
    }







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

    private function doLogin($credentials)
    {
        if (!$data['token'] = auth('api')->attempt($credentials)) {
            return response()->json(['msg' => __('lang.wrongCredential')], 401);
        }
        $data['user'] = auth('api')->user();

        // Handle if the user not a member Or academy member ( 0 (Main) / 1 (Sub) / 2 (Academic) )
        if (!$data['user']->iMemberType) {
            return response()->json(['msg' => 'You are not a member'], 403);
        }
        // Handle account status True (Active) / False (Hold)
        if (!$data['user']->iMemberType) {
            return response()->json(['msg' => 'Your account is not active'], 403);
        }

        return response()->json($data);

    }
}

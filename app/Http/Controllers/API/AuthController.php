<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AuthController extends Controller
{
    use  AuthenticatesUsers;

        public function register_user(Request $request)
        {
            $data = $request->validate([
                'first_name'        => 'required|string|max:191',
                'last_name'         => 'required|string|max:191',
                'phone'             => 'required|numeric|unique:users,phone',
                'email'             => 'required|email|max:191|unique:users,email',
                'password'          => 'required|string|min:3|max:191|confirmed',
                'social_status'     => 'required|in:1,2',
                'num_of_children'   => 'nullable|required_if:social_status,2|numeric'
            ]);

            $user = User::create($data);
            $userData = User::findOrFail($user->id);

            return response()->json(['msg' => 'Success Registration', 'user' => $userData]);
        }

        public function login_user(Request $request)
        {
            $credentials = $request->validate(['phone' => 'required|numeric', 'password' => 'required|string|max:191']);

            if (!$token = auth('api')->attempt($credentials)) {
                return response()->json(['msg' => __('lang.wrongCredential')], 401);
            }
            $user = auth('api')->user();

            // Handle if the user not a member Or academy member ( 2 => member, 3 => academy member )
            if (!in_array( $user->status, [2, 3])) {
                return response()->json(['msg' => 'You are not a member'], 403);
            }
            return response()->json(compact('user', 'token'));
        }

        public function logout()
        {
            auth()->logout();

            return response()->json(['msg' => 'success'], 200);
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

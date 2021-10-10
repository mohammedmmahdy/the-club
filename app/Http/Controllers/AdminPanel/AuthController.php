<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
    	return view('adminPanel.auth.login');
    }

    public function postLogin(Request $request)
    {
    	$credentials = $request->validate([
    		'email' => 'required|email:rfc,dns',
    		'password' => 'required',
    	]);
    	if (Auth::guard('admin')->attempt($credentials)) {

			// return response()->json(['url'=>route('adminPanel.dashboard')], 200);
    		return redirect(route('adminPanel.dashboard'));
    	}

		// return response()->json(['url'=>route('adminPanel.login')], 404);
    	Flash::error(__('auth.failed'));
    	return back();
	}

    public function logout()
    {
    	Auth::guard('admin')->logout();

    	return redirect(route('adminPanel.login'));
    }
}

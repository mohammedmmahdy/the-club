<?php

namespace App\Http\Controllers\AdminPanel;

use App\Models\Area;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Distributor;

class DashboardController extends Controller
{
    public function dashboard()
    {
    	return view('adminPanel.home');
    }
}

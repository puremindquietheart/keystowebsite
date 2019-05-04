<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard() {
        if (Auth::check()) {
            return view('dashboard-views.dashboard');
        } else {
            return redirect()->intended('/keysto-admin-login');
        } 
    }
}

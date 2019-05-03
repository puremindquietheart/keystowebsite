<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Photos;
use App\Model\AdminModel\Photos as PhotoModel;

class AdminDashboardController extends Controller
{
    public function index()
    {
        
    }

    public function store(Request $request)
    {
        $new_upload_bike = new PhotoModel();

        $new_upload_bike = $request->input('input_photo_bike_name');
        $new_upload_bike = $request->input('input_photo_bike_description');
        $new_upload_bike = $request->input('input_photo_name');

        return $new_upload_bike;
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }
    
    public function destroy($id)
    {
        //
    }

    public function dashboard() {
        if (Auth::check()) {
            return view('dashboard-views.dashboard');
        } else {
            return redirect()->intended('/keysto-admin-login');
        } 
        
    }
}

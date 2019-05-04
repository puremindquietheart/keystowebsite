<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Resources\Photos;
use App\Model\AdminModel\Photos as PhotoModel;

use Illuminate\Validation\ValidationException;

class AdminDashboardController extends Controller
{
    public function index()
    {
        
    }

    public function store(Request $request)
    {   
        $validate_inputs = $request->validate([
            'input_photo_bike_name' => 'required',
            'input_photo_bike_description' => 'required',
            'input_photo_name' => 'required'
        ]);

        if ($validate_inputs) {
            
            $check_bike_existence = PhotoModel::where('photo_name', $request->input_photo_bike_name)->count();
            
            if ($check_bike_existence == 0) {

                $new_bike = new PhotoModel();

            } else {
                return ['exist' => true, 'message' => 'Bike Model Already Exist!'];
            }
        } else {
            return response()->json();
        }
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
}

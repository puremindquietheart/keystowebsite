<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// use App\Http\Resources\Photos;
// use App\Model\AdminModel\Photos as PhotoModel;
use App\Http\Resources\Bikes as BikeResource;
use App\Model\AdminModel\Bikes as BikeModel;

use Carbon\Carbon;

class BikeDashboardController extends Controller
{
    public function index()
    {
        $articles = BikeModel::orderBy('id', 'desc')->paginate(5);

        return BikeResource::collection($articles);
    }

    public function store(Request $request)
    {   
        $check_bike_existence = BikeModel::where('bike_name', $request->bike_name)->count();

        if ($check_bike_existence == 0) {

            $bike = new BikeModel;

            $bike->bike_name = $request->bike_name;
            $bike->bike_price = $request->bike_price;
            $bike->bike_quantity = $request->bike_qty;
            $bike->bike_discount = 0;
            $bike->bike_rating = 0;
            $bike->bike_available = 1;
            $bike->date_added = Carbon::now('Asia/Manila');

            if ($bike->save()) {
                $new_bike_resource = new BikeResource($bike);
                return ['success' => true, 'message' => 'New Bike was Added Successfully!', $new_bike_resource];
            }
        } else {
            return ['success' => false];
        } 
    }

    public function show($id)
    {
       $get_bike_details = BikeModel::findOrFail($id);

       return new BikeResource($get_bike_details);
    }

    public function update(Request $request, $id)
    {
        if ($request->bike_available === 1) {
            
            $update_bike_availability = BikeModel::findOrFail($id);

            if ($update_bike_availability->bike_available === 1) {

                $update_bike_availability->bike_available = 0;

                if ($update_bike_availability->save()) {
                    $bike_available_resource =  new BikeResource($update_bike_availability);
                    return ['unavailable' => true, 'message' => 'Bike was Unavailable!', $bike_available_resource];
                }
            } else {
                $update_bike_availability->bike_available = 1;

                if ($update_bike_availability->save()) {
                    
                    $bike_available_resource =  new BikeResource($update_bike_availability);
                    return ['unavailable' => false, 'message' => 'Bike was Available!', $bike_available_resource];
                }
            }

        } else if ($request->bike_details === 1) {
            echo "HAH!";
        }
    }
}

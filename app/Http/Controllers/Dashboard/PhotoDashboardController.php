<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\AdminModel\Photos as PhotoModel;
use App\Http\Resources\Photos as PhotoResource;

class PhotoDashboardController extends Controller
{

    public function index()
    {
        $photos = PhotoModel::orderBy('id', 'desc')->paginate(5);

        return PhotoResource::collection($photos);
    }

    public function store(Request $request)
    {
        // return $request->bike_upload_photo;
        // if ($request->hasFile('image')) {
        //     return 'true';
        // } else {
        //     return 'haha!';
        // }
        return $request->all();   
        // return $request->assigned_bike_id;
        // return $request->bike_description;
        // return $request->photos;
        // return $request->all();
        // echo $request->photos->first_photo;
        // foreach ($request->photos as $photo) {
        //     $photo->store('public');
        // }
        // return $photos;
    }

    public function show($id)
    {
        $check_bike_existence = PhotoModel::where('bike_id', $id)->count();

        if ($check_bike_existence > 0) {

            $get_bike_photos = PhotoModel::findOrFail($id);

            $bike_data_resource = new PhotoResource($get_bike_photos);

            return ['exist' => true, 'data' => $bike_data_resource];
        } else {
            return ['exist' => false];
        }
        
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

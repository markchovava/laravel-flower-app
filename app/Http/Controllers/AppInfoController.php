<?php

namespace App\Http\Controllers;

use App\Http\Resources\AppInfoResource;
use App\Models\AppInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppInfoController extends Controller
{
    public function index(){
        $data = AppInfo::with(['user'])->first();

        return response()->json([
            'message' => 'Our App Info',
            'data' => new AppInfoResource($data)
        ]);
    }

    public function search(Request $request){}

    public function store(Request $request){
        $data = new AppInfo();
        $data->user_id = $request->user_id;
        $data->name = $request->name;
        $data->address =  $request->address;
        $data->phone = $request->phone;
        $data->email = $request->email;
        $data->bank_details = $request->bank_details;
        $data->save(); 

        return response()->json([
            'message' => 'Saved Successfully.',
            'data' => new AppInfoResource($data)
        ]);
    }

    public function update(Request $request, $id){
        $data = AppInfo::find($id);
        $data->user_id = !empty($request->user_id) ? $request->user_id : $data->user_id;
        $data->name = !empty($request->name) ? $request->name : $data->name;
        $data->address = !empty($request->address) ? $request->address : $data->address;
        $data->phone = !empty($request->phone) ? $request->phone : $data->phone;
        $data->email = !empty($request->email) ? $request->email : $data->email;
        $data->bank_details = !empty($request->bank_details) ? $request->bank_details : $data->bank_details;
        $data->save();

        return response()->json([
            'message' => 'Saved Successfully.',
            'task' => new AppInfoResource($data)
        ]);
    }
    

}

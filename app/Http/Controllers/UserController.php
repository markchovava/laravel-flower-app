<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        $data = User::orderBy('updated_at','desc')->orderBy('name','asc')->paginate(20);
        
        return UserResource::collection($data);
    }

    public function search(Request $request){
        $search = $request->search;
        $data = User::where('name', $search)->paginate(20);
        
        return UserResource::collection($data);
    }

    public function show($id){
        $data = User::find($id);
       
        return new UserResource($data);
    }

    public function store(Request $request){
        $code = rand(100000000, 1000000000000);
        $data = new User();
        $data->code = $code;
        $data->password = Hash::make($code);
        $data->name = $request->name;
        $data->first_name = $request->first_name;
        $data->last_name = $request->last_name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->access_level = $request->access_level;
        $data->address =  $request->address;
        $data->city =  $request->city;
        $data->country =  $request->country;
        $data->delivery_phone =  $request->delivery_phone;
        $data->delivery_email =  $request->delivery_email;
        $data->delivery_address =  $request->delivery_address;
        $data->delivery_city =  $request->delivery_city;
        $data->delivery_country =  $request->delivery_country;
        $data->delivery_message =  $request->delivery_message;
        $data->created_at = now();
        $data->updated_at = now();
        $data->save();

        return response()->json([
            'message' => 'Saved Successfully.',
            'data' => new UserResource($data)
        ]);
    }


    public function update(Request $request, $id){
        $data = User::find($id);
        $data->name = !empty($request->name) ? $request->name : $data->name;
        $data->first_name = !empty($request->first_name) ? $request->first_name : $data->first_name;
        $data->last_name = !empty($request->last_name) ? $request->last_name : $data->last_name;
        $data->email = !empty($request->email) ? $request->email : $data->email;
        $data->phone = !empty($request->phone) ? $request->phone : $data->phone;
        $data->access_level = !empty($request->access_level) ? $request->access_level : $data->access_level;
        $data->address =  !empty($request->address) ? $request->address : $data->address;
        $data->city =  !empty($request->city) ? $request->city : $data->city;
        $data->country =  !empty($request->country) ? $request->country : $data->country;
        $data->delivery_phone =  !empty($request->delivery_phone) ? $request->delivery_phone : $data->delivery_phone;
        $data->delivery_email =  !empty($request->delivery_email) ? $request->delivery_email : $data->delivery_email;
        $data->delivery_address =  !empty($request->delivery_address) ? $request->delivery_address : $data->delivery_address;
        $data->delivery_city =  !empty($request->delivery_city) ? $request->delivery_city : $data->delivery_city;
        $data->delivery_country =  !empty($request->delivery_country) ? $request->delivery_country : $data->delivery_country;
        $data->delivery_message =  !empty($request->delivery_message) ? $request->delivery_message : $data->delivery_message;
        $data->updated_at = now();
        $data->save();

        return response()->json([
            'message' => 'Updated Successfully.',
            'data' => new UserResource($data)
        ]);
    }

    public function delete($id){
        $data = User::find($id);
        $data->delete();

        return response()->json([
            'message' => 'Deleted Sucessfully.'
        ]);
    }
}

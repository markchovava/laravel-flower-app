<?php

namespace App\Http\Controllers;

use App\Http\Resources\PermissionResource;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index(){
        $data = Permission::orderBy('updated_at','desc')->orderBy('name','asc')->paginate(20);
        
        return PermissionResource::collection($data);
    }

    public function search(Request $request){
        $search = $request->search;
        $data = Permission::where('name', $search)->paginate(20);
        
        return PermissionResource::collection($data);
    }

    public function show($id){
        $data = Permission::find($id);
       
        return new PermissionResource($data);
    }

    public function store(Request $request){
        $data = new Permission();
        $data->user_id = $request->user_id;
        $data->name = $request->name;
        $data->description =  $request->description;
        $data->created_at = now();
        $data->updated_at = now();
        $data->save();

        return response()->json([
            'message' => 'Saved Successfully.',
            'data' => new PermissionResource($data)
        ]);
    }

    public function update(Request $request, $id){
        $data = Permission::find($id);
        $data->user_id = !empty($request->user_id) ? $request->user_id : $data->user_id;
        $data->name = !empty($request->name) ? $request->name : $data->name;
        $data->description = !empty($request->description) ? $request->description : $data->description;
        $data->updated_at = now();
        $data->save();

        return response()->json([
            'message' => 'Updated Successfully.',
            'data' => new PermissionResource($data)
        ]);
    }

    public function delete($id){
        $data = Permission::find($id);
        $data->delete();

        return response()->json([
            'message' => 'Deleted Sucessfully.'
        ]);
    }
}

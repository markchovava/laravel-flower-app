<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $data = Category::with(['user'])->orderBy('updated_at','desc')->orderBy('name','asc')->paginate(20);
        
        return CategoryResource::collection($data);
    }

    public function search(Request $request){
        $search = $request->search;
        $data = Category::with(['user'])->where('name', $search)->paginate(20);
        
        return CategoryResource::collection($data);
    }

    public function show($id){
        $data = Category::find($id);
       
        return new CategoryResource($data);
    }

    public function store(Request $request){
        $data = new Category();
        $data->user_id = $request->user_id;
        $data->name = $request->name;
        $data->description =  $request->description;
        $data->created_at = now();
        $data->updated_at = now();
        $data->save();

        return response()->json([
            'message' => 'Saved Successfully.',
            'data' => new CategoryResource($data)
        ]);
    }

    public function update(Request $request, $id){
        $data = Category::find($id);
        $data->user_id = !empty($request->user_id) ? $request->user_id : $data->user_id;
        $data->name = !empty($request->name) ? $request->name : $data->name;
        $data->description = !empty($request->description) ? $request->description : $data->description;
        $data->updated_at = now();
        $data->save();

        return response()->json([
            'message' => 'Updated Successfully.',
            'data' => new CategoryResource($data)
        ]);
    }

    public function delete($id){
        $data = Category::find($id);
        $data->delete();

        return response()->json([
            'message' => 'Deleted Sucessfully.'
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(){
        $data = Product::with(['user', 'categories'])
                ->orderBy('name','asc')
                ->orderBy('updated_at','desc')
                ->paginate(20);
        return ProductResource::collection($data);
    }


    public function search(Request $request){
        $search = $request->search;
        $data = Product::with(['user'])
                ->where('name', $search)
                ->paginate(20);
        return ProductResource::collection($data);
    }


    public function show($id){
        $data = Product::with(['user', 'categories'])->find($id);
        return new ProductResource($data);
    }


    public function store(Request $request){
        $data = new Product();
        if( $request->file('image') ){
            $product_image = $request->file('product_image');
            $image_extension = strtolower($product_image->getClientOriginalExtension());
            $image_name = date('YmdHi'). '.' . $image_extension;
            $upload_location = 'storage/products/thumbnail/';
            if(!empty($data->image)){
                if(file_exists(public_path($upload_location . $data->image))){
                    unlink($upload_location . $data->image);
                }
                $product_image->move($upload_location, $image_name);
                $data->image = $upload_location . $data->image;                    
            }else{
                $product_image->move($upload_location, $image_name);
                $data->image = $upload_location . $data->image;
            }              
        }
        $data->name = $request->name;
        $data->user_id = $request->user_id;
        $data->description = $request->description;
        $data->price = (int)$request->price;
        $data->created_at = now();
        $data->updated_at = now();
        $data->save();

        if(!empty($request->category_id)){
            print_r($request->category_id);
            $category = $request->category_id;
            foreach($category as $cat_id){
                $category = new ProductCategory();
                $category->product_id = $data->id;
                $category->category_id = $cat_id;
                $category->save();
            }
        }

        return response()->json([
            'message' => 'Saved Successfully.',
            'data' => new ProductResource($data)
        ]);
    }



    public function update(Request $request, $id){
            $data = Product::find($id);
            if( $request->file('image') ){
                $product_image = $request->file('product_image');
                $image_extension = strtolower($product_image->getClientOriginalExtension());
                $image_name = date('YmdHi'). '.' . $image_extension;
                $upload_location = 'storage/products/';
                if(!empty($data->image)){
                    if(file_exists(public_path($upload_location . $data->image))){
                        unlink($upload_location . $data->image);
                    }
                    $product_image->move($upload_location, $image_name);
                    $data->image = $upload_location . $data->image;                    
                }else{
                    $product_image->move($upload_location, $image_name);
                    $data->image = $upload_location . $data->image;
                }              
            }
            $data->name = !empty($request->name) ? $request->name : $data->name;
            $data->user_id =  !empty($request->user_id) ? $request->user_id : $data->user_id;
            $data->description = !empty($request->description) ? $request->description : $data->description;
            $data->price = !empty($request->price) ? (int)$request->price : $data->price;
            $data->updated_at = now();
            $data->save();
    
            if(!empty($request->category_id)){
                ProductCategory::where('product_id', $data->id)->delete();
                $category = $request->category_id;
                foreach($category as $cat_id){
                    $category = new ProductCategory();
                    $category->product_id = $data->id;
                    $category->category_id = $cat_id;
                    $category->save();
                }
            }

        return response()->json([
            'message' => 'Updated Successfully.',
            'data' => new ProductResource($data)
        ]);
    }
    

    public function delete($id){
        ProductCategory::where('product_id', $id)->delete();
        $data = Product::find($id);
        $upload_location = 'storage/products/';
        if(!empty($data->image)){
            if(file_exists(public_path($upload_location . $data->image))){
                unlink($upload_location . $data->image);
            }
        }
        $data->delete();

        return response()->json([
            'message' => 'Deleted Sucessfully.'
        ]);       
    }
}

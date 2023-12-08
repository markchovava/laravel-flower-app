<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderItemResource;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    public function index(){
        $data = OrderItem::with(['user', 'order', 'product'])
                    ->order_by('created_at', 'desc')
                    ->paginate(20);

        return OrderItemResource::collection($data);
    }

    public function search(Request $request){
        $search = $request->search;
        $data = OrderItem::with(['user', 'order', 'product'])
                    ->where('created_at', $search)
                    ->orWhere('name', $search)
                    ->order_by('created_at', 'desc')
                    ->paginate(20);

        return OrderItemResource::collection($data);
    }

    public function show($id){
        $data = OrderItem::with(['user', 'order', 'product'])->find($id);

        return new OrderItemResource($data);
    }

    public function update(Request $request, $id){
        $data = OrderItem::find($id);
        //$data->order_id = $request->order_id;
        $data->user_id = $request->user_id;
        $data->product_id = $request->product_id;
        $data->product_name = $request->product_name;
        $data->product_image = $request->product_image;
        $data->product_quantity = $request->product_quantity;
        $data->product_price = $request->product_price;
        $data->product_total = $request->product_total;
        $data->option_name = $request->option_name;
        $data->option_price = $request->option_price;
        $data->option_quantity = $request->option_quantity;
        $data->option_total = $request->option_total;
        $data->updated_at = now();
        $data->save();

        return response()->json([
            'message' => 'Saved Successfully.',
            'data' => new OrderItemResource($data)
        ]);
    }
    
    public function delete($id){
        $data = OrderItem::find($id);
        $data->delete();

        return response()->json([
            'message' => 'Delete Successfully.',
        ]);
    }

}

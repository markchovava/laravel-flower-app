<?php

namespace App\Http\Controllers;

use App\Http\Resources\CartResource;
use App\Models\Cart\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(){
        $data = Cart::with(['user'])
                    ->order_by('created_at', 'desc')
                    ->paginate(20);

        return CartResource::collection($data);
    }

    public function search(Request $request){
        $search = $request->search;
        $data = Cart::with(['user'])
                ->where('created_at', $search)
                ->orWhere('shopping_session', $search)
                ->order_by('created_at', 'desc')
                ->paginate(20);
        
        return CartResource::collection($data);
    }

    public function show($id){
        $data = Cart::with(['user', 'cart_items'])->find($id);

        return new CartResource($data);
    }

    public function store(Request $request){
        $data = new Cart();
        $data->user_id = $request->user_id;
        $data->shopping_session = $request->shopping_session;
        $data->ip_address = $request->ip_address;
        $data->quantity = $request->quantity;
        $data->total = $request->total;
        $data->option_quantity = $request->option_quantity;
        $data->option_total = $request->option_total;
        $data->created_at = now();
        $data->updated_at = now();
        $data->save();

        if(!empty($request->cart_items)){
            $cart_items = $request->cart_items;
            foreach($cart_items as $item){
                $db_item = new CartItem();
                $db_item->cart_id = $data->id; // cart id
                $db_item->user_id = $item->user_id;
                $db_item->product_id = $item->product_id;
                $db_item->product_name = $item->product_name;
                $db_item->product_image = $item->product_image;
                $db_item->product_quantity = $item->product_quantity;
                $db_item->product_price = $item->product_price;
                $db_item->product_total = $item->product_total;
                $db_item->option_name = $item->option_name;
                $db_item->option_price = $item->option_price;
                $db_item->option_quantity = $item->option_quantity;
                $db_item->option_total = $item->option_total;
                $db_item->updated_at = now();
                $db_item->created_at = now();
                $db_item->save();

            }
        }

        return response()->json([
            'message' => 'Saved Successfully.',
            'data' => new CartResource($data)
        ]);
    }

    public function update(Request $request, $id){
        $data = Cart::find($id);
        $data->user_id = !empty($request->user_id) ? $request->user_id : $data->user_id;
        $data->shopping_session = !empty($request->shopping_session) ? $request->shopping_session : $data->shopping_session;
        $data->ip_address = !empty($request->ip_address) ? $request->ip_address : $data->ip_address;
        $data->quantity = !empty($request->quantity) ? $request->quantity : $data->quantity;
        $data->total = !empty($request->total) ? $request->total : $data->total;
        $data->option_quantity = !empty($request->option_quantity) ? $request->option_quantity : $data->option_quantity;
        $data->option_total = !empty($request->option_total) ? $request->option_total : $data->option_total;
        $data->updated_at = now();
        $data->save();

        if(!empty($request->cart_items)){
            CartItem::where('cart_id', $data->id)->delete();
            $cart_items = $request->cart_items;
            foreach($cart_items as $item){
                $db_item = new CartItem();
                $db_item->cart_id = $data->id; // cart id
                $db_item->user_id = $item->user_id;
                $db_item->product_id = $item->product_id;
                $db_item->product_name = $item->product_name;
                $db_item->product_image = $item->product_image;
                $db_item->product_quantity = $item->product_quantity;
                $db_item->product_price = $item->product_price;
                $db_item->product_total = $item->product_total;
                $db_item->option_name = $item->option_name;
                $db_item->option_price = $item->option_price;
                $db_item->option_quantity = $item->option_quantity;
                $db_item->option_total = $item->option_total;
                $db_item->updated_at = now();
                $db_item->created_at = now();
                $db_item->save();

            }
        }

        return response()->json([
            'message' => 'Saved Successfully.',
            'data' => new CartResource($data)
        ]);
    }
    
    public function delete($id){
        CartItem::where('cart_id', $id)->delete();
        $data = Cart::find($id);
        $data->delete();

        return response()->json([
            'message' => 'Deleted Sucessfully.'
        ]);
    }

}

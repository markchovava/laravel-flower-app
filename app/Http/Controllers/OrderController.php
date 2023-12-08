<?php

namespace App\Http\Controllers;

use App\Models\Order\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){}

    public function search(Request $request){}

    public function show(Order $order){}

    public function store(Request $request){}

    public function update(Request $request, Order $order){}
    
    public function delete(Order $order){}
}

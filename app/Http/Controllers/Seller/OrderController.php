<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $user_id = Auth::user()->id;
        $orders = Order::select('orders.id', 'orders.count', 'orders.package_id', 'orders.active_at', 'orders.expired_at', 'packages.name as package_name')
            ->join('packages', 'packages.id', '=', 'orders.package_id')
            ->where(['user_id' => $user_id, 'status' => 1])
            ->get();
        // return $orders;
        return view('seller.order', compact('orders'));
    }
    public function payment(String $uuid)
    {

        $order = Order::select('orders.price', 'orders.id', 'orders.count', 'packages.name as package_name')
            ->join('packages', 'packages.id', '=', 'orders.package_id')
            ->where(['orders.uuid' => $uuid])
            ->first();
        // return $order;


        // $order = Order::where('uuid', $uuid)->first();
        $banks = Bank::all();
        // return $order;
        return view('seller.payment', compact('order', 'banks'));
    }
}

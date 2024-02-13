<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Package;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    function index()
    {
        $orders = Order::orderBy('id', 'desc')->paginate(10);
        return view('admin.order.index', compact('orders'));
    }
    function show(int $order_id)
    {


        // $orders = Order::where('id', $order_id)->first();
        $order =  Order::select('orders.price', 'orders.package_id', 'orders.id', 'orders.count', 'orders.created_at', 'users.name as user_name', 'users.phone as user_phone', 'packages.name as package_name')
            ->join('packages', 'packages.id', '=', 'orders.package_id')
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->where(['orders.id' => $order_id])
            ->first();
        // return $days;
        return view('admin.order.detail', compact('order'));
    }
    function confirmation(Request $request, int $order_id)
    {
        $order = Order::where('id', $order_id)->first();
        $package = Package::where('id', $order->package_id)->first();


        $active_period = $package->active_period; //count active_period from table package
        $expired = date('Y-m-d H:i:s', strtotime("+$active_period days"));
        $active = date('Y-m-d H:i:s');
        $order = Order::findOrFail($order_id);

        $order->ads_period = $package->ads_period;
        $order->active_at = $active;
        $order->expired_at = $expired;
        $order->status = 1;
        $order->update();
        return redirect()->back()->with('message', 'Pembayaran Terkonfirmasi!');
    }
}

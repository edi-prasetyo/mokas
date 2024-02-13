<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::all();
        // return $packages;
        return view('seller.package', compact('packages'));
    }

    public function order(Request $request)
    {
        $uuid  = Str::uuid()->toString();
        $order = new Order();

        $order->uuid = $uuid;
        $order->user_id = Auth::user()->id;
        $order->package_id = $request['package_id'];
        $order->count = $request['count'];
        $order->price = $request['price'];
        $order->status = 0;

        $order->save();
        return redirect('seller/payment/' . $order->uuid)->with('message', 'Silahkan melakukan Pembayaran melalui nomor Rekening di bawah ini');
    }
    public function payment(String $uuid)
    {
        return $uuid;
    }
}

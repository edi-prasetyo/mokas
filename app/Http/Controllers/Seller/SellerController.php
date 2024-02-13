<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerController extends Controller
{
    public function index()
    {
        $user_id = Auth::user()->id;
        $mypackages = Order::select('orders.count', 'packages.name as package_name')
            ->join('packages', 'packages.id', '=', 'orders.package_id')
            ->where(['user_id' => $user_id, 'status' => 1])->get();

        $ads = Vehicle::select(

            'vehicles.slug',
            'vehicles.title',
            'vehicles.price',
            'vehicles.expired_at',
            'vehicles.views',

            'categories.slug as category_slug'
        )
            ->join('categories', 'categories.id', '=', 'vehicles.category_id')
            ->where(['vehicles.user_id' => $user_id, 'vehicles.status' => 1])->paginate(10);
        // return $mypackages;
        return view('seller.index', compact('ads', 'mypackages'));
    }
    public function ads()
    {
    }
    public function package()
    {
    }
}

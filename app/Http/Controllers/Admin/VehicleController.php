<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::select(
            'vehicles.id',
            'vehicles.title',
            'vehicles.uuid',
            'vehicles.image_cover',
            'vehicles.slug',
            'vehicles.transmision',
            'vehicles.fuel',
            'vehicles.engine_capacity',
            'vehicles.odometer',
            'vehicles.year',
            'vehicles.price',
            'vehicles.description',
            'vehicles.views',
            'categories.slug as category_slug',
            'categories.name as category_name',
            'users.name as user_name',
            'users.phone as user_phone',

        )
            ->join('categories', 'categories.id', '=', 'vehicles.category_id')
            ->join('users', 'users.id', '=', 'vehicles.user_id')
            ->paginate(10);

        return view('admin.vehicle.index', compact('vehicles'));
    }
}

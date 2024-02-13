<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Slider;
use App\Models\Category;
use App\Models\City;
use App\Models\Image;
use App\Models\Vehicle;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class FrontendController extends Controller
{
    public function index()
    {
        $cars = Vehicle::select(
            'vehicles.title',
            'vehicles.image_cover',
            'vehicles.slug',
            'vehicles.transmision',
            'vehicles.fuel',
            'vehicles.engine_capacity',
            'vehicles.odometer',
            'vehicles.year',
            'vehicles.price',
            'cities.name as city_name',
            'categories.slug as category_slug',
            'categories.name as category_name',
            // 'cities.name as city_name',
        )
            ->join('categories', 'categories.id', '=', 'vehicles.category_id')
            ->join('cities', 'cities.id', '=', 'vehicles.city_id')
            // ->join('cities', 'cities.id', '=', 'vehicles.city_id')
            ->where('category_id', 1)->take(4)->get();

        $sliders = Slider::where('status', '1')->get();
        $categories = Category::where('status', 1)->get();

        $motor_brand = Brand::where('category_id', 2)->get();
        $car_brand = Brand::where('category_id', 1)->get();
        $cities = City::all();
        // return $cars;
        return view('frontend.index', compact('sliders', 'categories', 'cars', 'motor_brand', 'car_brand', 'cities'));
    }
    public function vehicle()
    {
        $vehicles = Vehicle::select(
            'vehicles.title',
            'vehicles.image_cover',
            'vehicles.slug',
            'vehicles.transmision',
            'vehicles.fuel',
            'vehicles.engine_capacity',
            'vehicles.odometer',
            'vehicles.year',
            'vehicles.price',
            'categories.slug as category_slug',
            'categories.name as category_name',

        )
            ->join('categories', 'categories.id', '=', 'vehicles.category_id')
            // ->join('cities', 'cities.id', '=', 'vehicles.city_id')
            ->where('vehicles.status', 1)
            ->orderBy('vehicles.id', 'desc')
            ->paginate(10);

        // return $vehicles;

        return view('frontend.vehicle.index', compact('vehicles'));
    }
    public function categories($category)
    {
        $categorydetail = Category::where('slug', $category)->first();
        $vehicles = Vehicle::where('category_id',  $categorydetail->id)->paginate(6);
        $cities = City::all();

        return view('frontend.vehicle.category', compact('vehicles', 'categorydetail', 'cities'));
    }
    public function car()
    {
        $cars = Vehicle::where('category_id', 1)->orderBy('id', 'desc')->paginate(6);
        return view('frontend.car.index', compact('cars'));
    }
    public function show($category_slug, $vehicle_slug)
    {

        $vehicle = Vehicle::select(
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
            ->where('vehicles.slug', $vehicle_slug)->first();

        $images = Image::where('content_uuid', $vehicle->uuid)->get();
        // return $images;

        // return view('frontend.vehicle.show', compact('vehicle', 'images'));



        if (!Auth::check()) { //guest user identified by ip
            $cookie_name = (Str::replace('.', '', (request()->ip())) . '-' . $vehicle->id);
        } else {
            $cookie_name = (Auth::user()->id . '-' . $vehicle->id); //logged in user
        }
        if (Cookie::get($cookie_name) == '') { //check if cookie is set
            $cookie = cookie($cookie_name, '1', 60); //set the cookie
            $vehicle->incrementReadCount(); //count the view

            return response()
                ->view('frontend.vehicle.show', [
                    'vehicle' => $vehicle,
                    'images' => $images
                ])
                ->withCookie($cookie); //store the cookie
        } else {
            return view('frontend.vehicle.show', compact('vehicle', 'images'));
        }
    }
}

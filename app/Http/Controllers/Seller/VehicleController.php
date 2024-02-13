<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\VehicleFormRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Image;
use App\Models\Order;
use App\Models\Province;
use App\Models\Type;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;


use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class VehicleController extends Controller
{
    public function create()
    {
        // $period = 90;
        // $date_period = date('Y-m-d H:i:s', strtotime("+$period day"));
        // return $date_period;

        $provinces = Province::all();
        $user_id = Auth::user()->id;
        $count_ads = Order::select('orders.id', 'orders.uuid', 'orders.count', 'packages.name as package_name')
            ->join('packages', 'packages.id', '=', 'orders.package_id')
            ->where(['user_id' => $user_id, 'status' => 1])->get();

        if (empty(!$count_ads->isEmpty())) {
            return redirect('seller/dashboard')->with('error', 'Maaf Anda tidak memiliki paket iklan, Silahkan Order Paket Iklan');
        }


        $categories = Category::all();
        return view('seller.create', compact('categories', 'count_ads', 'provinces'));
    }
    public function store(VehicleFormRequest $request)
    {
        $validatedData = $request->validated();

        $slugRequest = Str::slug($validatedData['title']);
        $code = random_int(00, 99);
        $slug = $slugRequest . '-' . $code;

        $uuid  = Str::uuid()->toString();
        $vehicle = new Vehicle();

        if (Vehicle::where('slug', $slugRequest)->exists()) {
            $vehicle->slug = $slug;
        } else {
            $vehicle->slug = $slugRequest;
        }

        $vehicle->user_id = Auth::user()->id;
        $vehicle->uuid = $uuid;
        $vehicle->category_id = $validatedData['category_id'];
        $vehicle->brand_id = $validatedData['brand_id'];
        $vehicle->type_id = $validatedData['type_id'];
        $vehicle->condition = $validatedData['condition'];
        $vehicle->seat = $validatedData['seat'];
        $vehicle->transmision = $validatedData['transmision'];
        $vehicle->fuel = $validatedData['fuel'];
        $vehicle->plat_number = $validatedData['plat_number'];
        $vehicle->year = $validatedData['year'];
        $vehicle->engine_capacity = $validatedData['engine_capacity'];
        $vehicle->odometer = $validatedData['odometer'];
        $vehicle->color = $validatedData['color'];
        $vehicle->stnk = $validatedData['stnk'];
        $vehicle->bpkb = $validatedData['bpkb'];
        $vehicle->faktur = $validatedData['faktur'];
        $vehicle->grade_engine = $validatedData['grade_engine'];
        $vehicle->grade_exterior = $validatedData['grade_exterior'];
        $vehicle->grade_interior = $validatedData['grade_interior'];
        $vehicle->description = $validatedData['description'];
        $vehicle->price = $validatedData['price'];
        $vehicle->province_id = $validatedData['province_id'];
        $vehicle->city_id = $validatedData['city_id'];
        $vehicle->title = $validatedData['title'];
        $vehicle->meta_title = $validatedData['meta_title'];
        $vehicle->meta_description = $validatedData['meta_description'];
        $vehicle->meta_keywords = $validatedData['meta_keywords'];
        $vehicle->order_id = $validatedData['order_id'];
        $vehicle->status = 1;
        $vehicle->views = 0;

        // if ($request->hasFile('image_cover')) {

        //     $file = $request->file('image_cover');
        //     $ext = $file->getClientOriginalExtension();
        //     $filename = 'vehicle_cover' . time() . '.' . $ext;
        //     $file->move('uploads/images/', $filename);
        //     $vehicle->image_cover = URL::to('/uploads/images/' . $filename);
        // }

        if ($request->hasFile('image_cover')) {
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()) . '.' . $request->file('image_cover')->getClientOriginalExtension();
            $img = $manager->read($request->file('image_cover'));
            $img = $img->scale(height: 200);
            $img->toJpeg(80)->save(base_path('public/uploads/images/' . $name_gen));

            $vehicle->image_cover = URL::to('/uploads/images/' . $name_gen);
        }

        $vehicle->save();

        // Update Order
        $order_id = $vehicle->order_id;
        $user_id = Auth::user()->id;
        $order = Order::where(['user_id' => $user_id, 'id' => $order_id])->first();

        $count_decreash = $order->count - 1;
        $count_plus = $order->count_used + 1;

        $order->count = $count_decreash;
        $order->count_used = $count_plus;
        $order->update();

        // Update Status Order

        $order_id = $vehicle->order_id;
        $user_id = Auth::user()->id;
        $order = Order::where(['user_id' => $user_id, 'id' => $order_id])->first();
        if ($order->count == 0) {
            $order->status = 0;
        } else {
        }
        $order->update();

        // Update Expired Ads
        $vehicle_update  = Vehicle::where('id', $vehicle->id)->first();
        $date_period = date('Y-m-d H:i:s', strtotime("+$order->ads_period day"));
        $vehicle_update->expired_at = $date_period;
        $vehicle_update->update();


        $image = new Image;
        $image->content_uuid = $vehicle->uuid;
        $image->name = $vehicle->title;
        $image->from = 'vehicle';
        $image->url = $vehicle->image_cover;
        $image->save();

        // if ($request->hasFile('image')) {
        //     $uploadPath = 'uploads/images/';
        //     $i =  1;
        //     foreach ($request->file('image') as $imageFile) {
        //         $extention = $imageFile->getClientOriginalExtension();
        //         $filename = 'vehicle' . time() . $i++ . '.' . $extention;
        //         $imageFile->move($uploadPath, $filename);
        //         // $finalImanePathName = $uploadPath  . $filename;

        //         $vehicleimages = new Image();
        //         $vehicleimages->content_uuid = $vehicle->uuid;
        //         $vehicleimages->name = $vehicle->title;
        //         $vehicleimages->from = 'vehicle';
        //         $vehicleimages->url = URL::to('/uploads/images/' . $filename);

        //         $vehicleimages->save();
        //     }
        // }


        // if ($request->hasFile('image')) {
        //     $uploadPath = 'uploads/images/';
        //     $i =  1;
        //     foreach ($request->file('image') as $imageFile) {
        //         $extention = $imageFile->getClientOriginalExtension();
        //         $filename = 'vehicle' . time() . $i++ . '.' . $extention;
        //         $imageFile->move($uploadPath, $filename);
        //         // $finalImanePathName = $uploadPath  . $filename;

        //         $vehicleimages = new Image();
        //         $vehicleimages->content_uuid = $vehicle->uuid;
        //         $vehicleimages->name = $vehicle->title;
        //         $vehicleimages->from = 'vehicle';
        //         $vehicleimages->url = URL::to('/uploads/images/' . $filename);

        //         $vehicleimages->save();
        //     }
        // }

        if ($request->hasFile('image')) {
            $i = 1;
            foreach ($request->file('image') as $imageFile) {
                $manager = new ImageManager(new Driver());
                $name_gen = hexdec(uniqid()) . $i++ . '.' . $imageFile->getClientOriginalExtension();

                $imageFile = $manager->read($imageFile);
                $imageFile = $imageFile->scale(height: 200);

                $imageFile->toJpeg(80)->save(base_path('public/uploads/images/' . $name_gen));

                $vehicleimages = new Image();
                $vehicleimages->content_uuid = $vehicle->uuid;
                $vehicleimages->name = $vehicle->title;
                $vehicleimages->from = 'vehicle';
                $vehicleimages->url = URL::to('/uploads/images/' . $name_gen);

                $vehicleimages->save();
            }
        }


        return redirect('seller/dashboard');
    }

    public function fetchBrand(Request $request)
    {
        $data['brands'] = Brand::where("category_id", $request->category_id)
            ->get(["name", "id"]);

        return response()->json($data);
    }
    public function fetchType(Request $request)
    {
        $data['types'] = Type::where("brand_id", $request->brand_id)
            ->get(["name", "id"]);

        return response()->json($data);
    }
}

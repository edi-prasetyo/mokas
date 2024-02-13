<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyFormRequest;
use App\Http\Requests\UserDetailFormRequest;
use App\Models\City;
use Illuminate\Support\Facades\File;
use App\Models\Image;
use App\Models\Province;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\VerifyOtp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;
use App\Models\CountAd;
use App\Models\Order;
use App\Models\Vehicle;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        $provinces = Province::all();
        $user = User::where('email', auth()->user()->email)->first();
        $myads = Vehicle::where(['user_id' => $user->id, 'status' => 1])->get();
        $mypackage = Order::where('user_id', $user->id)->get();

        if ($user->status == 1) {
            return view('home', compact('user', 'provinces', 'myads', 'mypackage'));
        } else {
            return redirect('member/otp');
        }
    }
    public function seller()
    {
        $provinces = Province::all();

        $user = User::where('email', auth()->user()->email)->first();
        if ($user->status == 1) {
            return view('frontend.seller.add_seller', compact('user', 'provinces'));
        } else {
            return redirect('member/otp');
        }
    }
    public function add_seller(Request $request)
    {
        $user = User::where('email', auth()->user()->email)->first();
        if ($user->status == 1) {

            $seller = UserDetail::where('user_id', $user->id)->first();

            $seller->card_id = $request['card_id'];
            $seller->address = $request['address'];
            $seller->showroom_name = $request['showroom_name'];
            $seller->province_id = $request['province_id'];
            $seller->city_id = $request['city_id'];

            if ($request->hasFile('photo')) {

                $path = 'uploads/images/' . $seller->photo;
                if (File::exists($path)) {
                    File::delete($path);
                }

                $file = $request->file('photo');
                $ext = $file->getClientOriginalExtension();
                $filename = time() . '.' . $ext;
                $file->move('uploads/images/', $filename);
                $seller->photo = URL::to('/uploads/images/' . $filename);
            }

            $seller->update();


            $image = new Image;
            $image->content_uuid = $seller->uuid;
            $image->name = $seller->showroom_name;
            $image->from = 'seller';
            $image->url = $seller->photo;
            $image->save();

            $user_id = Auth::user()->id;
            $user = User::findOrFail($user_id);
            $user->role_as = 3;
            $user->update();

            return redirect('seller/dashboard')->with('message', 'Profile Upgrade successfully!');
        } else {
            return redirect('member/otp');
        }
    }
    public function verify_otp()
    {
        $user = User::where('email', auth()->user()->email)->first();
        if ($user->status == 0) {
            return view('auth.verify_otp');
        } else {
            return redirect('member/dashboard');
        }
    }
    public function send_otp(Request $request)
    {
        $input_otp = $request->otp;
        $get_otp = VerifyOtp::where('otp', $input_otp)->first();

        if ($get_otp) {

            // $get_otp->status == 1;
            // $get_otp->save();

            $user = User::where('email', $get_otp->email)->first();
            $user->status = 1;
            $user->save();

            VerifyOtp::where('email', $get_otp->email)->delete();
            // $getting_otp->delete();

            $user_detail = new UserDetail();
            $user_detail->uuid = $user->uuid;
            $user_detail->user_id = $user->id;
            $user_detail->save();

            return redirect('member/dashboard')->with('activated', 'Akun anda sudah di aktivasi');
        } else {
            return redirect('member/otp')->with('incorrect', 'OTP tidak valid');
        }
    }

    public function resend_otp(Request $request)
    {
        $user_id = $request->user_id;
        $user = User::where('id', $user_id)->first();

        $delete_otp = VerifyOtp::where('email', $user->email)->delete();
        if ($delete_otp == null) {

            $validOtp = rand(10, 100. . '2022');

            $get_otp = new VerifyOtp();
            $get_otp->otp = $validOtp;
            $get_otp->email = $user->email;
            $get_otp->phone = $user->phone;
            $get_otp->save();

            $get_user_email = $user->email;
            $get_user_name = $user->name;
            $get_user_phone = $user->phone;
            Mail::to($user->email)->send(new WelcomeMail($get_user_email, $validOtp, $get_user_name, $get_user_phone));

            $this->send_whatsapp($validOtp, $get_user_phone);

            return redirect('member/otp')->with('sending', "Kode OTP telah dikirim ke Nomor $user->phone");
        } else {


            $validOtp = rand(10, 100. . '2022');

            $get_otp = new VerifyOtp();
            $get_otp->otp = $validOtp;
            $get_otp->email = $user->email;
            $get_otp->phone = $user->phone;
            $get_otp->save();

            $get_user_email = $user->email;
            $get_user_name = $user->name;
            $get_user_phone = $user->phone;
            Mail::to($user->email)->send(new WelcomeMail($get_user_email, $validOtp, $get_user_name, $get_user_phone));

            $this->send_whatsapp($validOtp, $get_user_phone);

            return redirect('member/otp')->with('sending', "Kode OTP telah dikirim ke Nomor $user->phone");
        }
    }


    public function send_whatsapp($validOtp, $get_user_phone)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'target' => $get_user_phone,
                'message' => "Ini adalah Kode OTP Pendaftaran Anda *$validOtp* Pesan ini dikirim dari atransauto.com jangan bagikan kode otp ini kepada siapapun",
            ),
            CURLOPT_HTTPHEADER => array(
                'Authorization: KyJbdr0LxUSM#WXgzszp' //change TOKEN to your actual token
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }

    public function edit_password()
    {
        $userId = Auth::user()->id;
        $user = User::findOrFail($userId);
        return view('frontend.member.edit_password', compact('user'));
    }


    public function fetchCity(Request $request)
    {
        $data['cities'] = City::where("province_id", $request->province_id)
            ->get(["name", "id"]);

        return response()->json($data);
    }
}

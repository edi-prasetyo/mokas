<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::all();
        return view('admin.package.index', compact('packages'));
    }
    public function store(Request $request)
    {

        $uuid =  $uuid = Str::uuid()->toString();
        $package = new Package();
        $package->uuid = $uuid;
        $package->name = $request['name'];
        $package->description_period = $request['description_period'];
        $package->description_ads = $request['description_ads'];
        $package->count = $request['count'];
        $package->price = $request['price'];
        $package->active_period = $request['active_period'];
        $package->ads_period = $request['ads_period'];
        $package->icon = $request['icon'];
        $package->highlight = $request->status == true ? '1' : '0';

        $package->save();
        return redirect()->back()->with('message', 'Paket telah di tambahkan');
    }

    public function edit(Package $package)
    {
        return view('admin.package.edit', compact('package'));
    }
    public function update(Request $request, Package $package)
    {
        $package->id = $package->id;
        $package->name = $request['name'];
        $package->description_period = $request['description_period'];
        $package->description_ads = $request['description_ads'];
        $package->count = $request['count'];
        $package->price = $request['price'];
        $package->active_period = $request['active_period'];
        $package->ads_period = $request['ads_period'];

        $package->icon = $request['icon'];
        $package->highlight = $request->status == true ? '1' : '0';

        $package->update();
        return redirect('admin/packages')->with('message', 'Paket telah di ubah');
    }
    public function destroy(Package $package)
    {
        $package->delete();
        return redirect()->back()->with('message', 'Paket telah di Hapus');
    }
}

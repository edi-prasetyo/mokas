<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryFormRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Type;
use Illuminate\Support\Facades\URL;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class CategoryController extends Controller
{
    public $category_id;
    public function index()
    {
        $categories =  Category::orderBy('id', 'DESC')->paginate(10);
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function fetchBrand(Request $request)
    {
        $data['brands'] = Brand::where("category_id", $request->category_id)
            ->get(["name", "id"]);

        return response()->json($data);
    }

    public function create()
    {
        return view('admin.category.create');
    }
    public function store(CategoryFormRequest $request)
    {
        $validatedData = $request->validated();

        $uuid =  $uuid = Str::uuid()->toString();
        $slugRequest = Str::slug($validatedData['name']);
        $code = random_int(00, 99);
        $slug = $slugRequest . '-' . $code;

        $category = new Category;

        $category->uuid = $uuid;
        $category->name = $validatedData['name'];
        $category->icon = $validatedData['icon'];
        if (Category::where('slug', $slugRequest)->exists()) {
            $category->slug = $slug;
        } else {
            $category->slug = $slugRequest;
        }
        $category->description = $validatedData['description'];

        $uploadPath = 'uploads/category/';
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/category/', $filename);
            $category->image = $uploadPath . $filename;
        }
        $category->meta_title = $validatedData['meta_title'];
        $category->meta_description = $validatedData['meta_description'];
        $category->meta_keyword = $validatedData['meta_keyword'];
        $category->status = $request->status == true ? '1' : '0';

        $category->save();
        return redirect('admin/category')->with('message', 'Category Has Added');
    }
    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }
    public function update(CategoryFormRequest $request, $category)
    {
        $validatedData = $request->validated();
        $category = Category::findOrFail($category);

        $category->name = $validatedData['name'];
        $category->icon = $validatedData['icon'];
        $category->description = $validatedData['description'];

        $uploadPath = 'uploads/category/';
        if ($request->hasFile('image')) {

            $path = 'uploads/category/' . $category->image;
            if (File::exists($path)) {
                File::delete($path);
            }

            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/category/', $filename);
            $category->image = $uploadPath . $filename;
        }

        $category->meta_title = $validatedData['meta_title'];
        $category->meta_description = $validatedData['meta_description'];
        $category->meta_keyword = $validatedData['meta_keyword'];
        $category->status = $request->status == true ? '1' : '0';

        $category->update();
        return redirect('admin/category')->with('message', 'Category update Succesfully');
    }

    public function destroy(Category $category)
    {
        if ($category->count() > 0) {

            $destination = $category->image;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $category->delete();
            return redirect()->back()->with('message', 'Image Category Delete Succesfully!');
        }
        return redirect()->back()->with('message', 'Someting Went Wrong');
    }

    // BRAND FUNCTION
    public function brand(Category $category)
    {

        $brands = Brand::where(['category_id' => $category->id, 'status' => 1])->orderBy('id', 'asc')->paginate(10);
        $category_name = Category::where('id', $category->id)->first();
        // return $category_name->name;
        return view('admin.category.brand', compact('brands', 'category_name'));
    }
    public function store_brand(Request $request)
    {
        $uuid =  $uuid = Str::uuid()->toString();
        $slugRequest = Str::slug($request['name']);
        $code = random_int(00, 99);
        $slug = $slugRequest . '-' . $code;

        $brand = new Brand();
        $brand->uuid = $uuid;
        $brand->category_id = $request['category_id'];
        $brand->name = $request['name'];
        if (Brand::where('slug', $slugRequest)->exists()) {
            $brand->slug = $slug;
        } else {
            $brand->slug = $slugRequest;
        }
        if ($request->hasFile('image')) {

            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = 'brand' . time() . '.' . $ext;
            $file->move('uploads/brand/', $filename);
            $brand->image = $filename;
            $brand->image_url = URL::to('/uploads/brand/' . $filename);
        }
        $brand->status = $request->status == true ? '1' : '0';
        $brand->save();

        return redirect()->back()->with('message', 'Brand has ben Added');
    }
    public function edit_brand(Brand $brand)
    {
        return view('admin.category.edit_brand', compact('brand'));
    }
    public function update_brand(Request $request, int $brand_id)
    {

        $brand = Brand::where('id', $brand_id)->first();
        $category = Category::where('id', $brand->category_id)->first();

        $brand->name = $request['name'];
        // $brand->category_id = $category_id;

        // $uploadPath = 'uploads/brand/';
        if ($request->hasFile('image')) {

            $path = 'uploads/brand/' . $brand->image;
            if (File::exists($path)) {
                File::delete($path);
            }

            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = 'brand' . time() . '.' . $ext;
            $file->move('uploads/brand/', $filename);
            $brand->image = $filename;
            $brand->image_url = URL::to('/uploads/brand/' . $filename);
        }

        $brand->status = $request->status == true ? '1' : '0';

        $brand->update();

        return redirect('admin/category/brand/' . $category->id)->with('message', 'Brand update Succesfully');
    }
    public function destroy_brand(Brand $brand)
    {
        $destination = 'uploads/brand/' . $brand->image;
        if (File::exists($destination)) {
            File::delete($destination);
        }
        $brand->delete();
        return redirect()->back()->with('message', 'Brand car delete Succesfully!');
    }

    // TYPE FUNCTION
    public function type(Brand $brand)
    {
        $types = Type::where('brand_id', $brand->id)->orderBy('id', 'asc')->paginate(10);
        return view('admin.category.type', compact('brand', 'types'));
    }
    public function store_type(Request $request)
    {
        $uuid =  $uuid = Str::uuid()->toString();
        $slugRequest = Str::slug($request['name']);
        $code = random_int(00, 99);
        $slug = $slugRequest . '-' . $code;

        $type = new Type();
        $type->uuid = $uuid;
        $type->brand_id = $request['brand_id'];
        $type->name = $request['name'];

        if (Type::where('slug', $slugRequest)->exists()) {
            $type->slug = $slug;
        } else {
            $type->slug = $slugRequest;
        }
        $type->description = $request['description'];
        $type->save();
        return redirect()->back()->with('message', 'Type car Added Succesfully!');
    }
    public function destroy_type(Type $type)
    {
        $type->delete();
        return redirect()->back()->with('message', 'Type car delete Succesfully!');
    }
}

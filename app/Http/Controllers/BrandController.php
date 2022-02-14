<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function allBrand()
    {
        $brands = Brand::latest()->paginate(1);
        return view('admin.brand.index', compact('brands'));
    }

    public function addBrand(Request $request){
       
        $validated = $request->validate([
            'brand_name' => 'required|unique:brands|max:255',
            'brand_image' => 'required|mimes:jpg,jpeg,png',
        ]);

        $brand_image = $request->file('brand_image');
        $image_name = hexdec(uniqid());
        $image_extension = strtolower($brand_image->getClientOriginalExtension());
        $brand_image_name = $image_name.$image_extension;
        $image_upload_location = 'uploads/images/brand/';
        $brand_image->move($image_upload_location, $brand_image_name);
        $data = ([
            'brand_name' => $request->brand_name,
            'brand_image' => $brand_image_name,
            'created_at' => Carbon::now(),
        ]);
        $brand = Brand::insert($data);
        
       return back()->with('success', 'Category created successfully.');
    }
}

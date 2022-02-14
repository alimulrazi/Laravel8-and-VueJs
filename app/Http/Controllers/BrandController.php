<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function allBrand()
    {
        $brands = Brand::latest()->paginate(5);
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
        $brand_image_name = $image_name.".".$image_extension;
        $image_upload_location = 'uploads/images/brand/';
        $brand_image->move($image_upload_location, $brand_image_name);
        $data = ([
            'brand_name' => $request->brand_name,
            'brand_image' => $brand_image_name,
            'created_at' => Carbon::now(),
        ]);
        $brand = Brand::insert($data);
        
       return back()->with('success', 'Brand created successfully.');
    }

    public function editBrand($id)
    {
       $brand = Brand::find($id);
       return view('admin.brand.edit', compact('brand'));
    }

    public function updateBrand(Request $request, $id)
    {
        $validated = $request->validate([
            'brand_name' => 'required|max:255',
            //'brand_image' => 'required|mimes:jpg,jpeg,png',
        ]);
        $old_image = $request->old_image;
        $brand_image = $request->file('brand_image');
        if($brand_image){
            $image_name = hexdec(uniqid());
            $image_extension = strtolower($brand_image->getClientOriginalExtension());
            $brand_image_name = $image_name.".".$image_extension;
            $image_upload_location = 'uploads/images/brand/';
            $brand_image->move($image_upload_location, $brand_image_name);
            $data = ([
                'brand_name' => $request->brand_name,
                'brand_image' => $brand_image_name,
                'created_at' => Carbon::now(),
            ]);
            unlink($image_upload_location.$old_image);
        }
        else{
            $data = ([
                'brand_name' => $request->brand_name,
                'created_at' => Carbon::now(),
            ]);
        }
        $brand = Brand::find($id)->update($data);
        
       return back()->with('success', 'Brand updated successfully.');
    }

    public function deleteBrand($id)
    {
        $brand = Brand::find($id)->delete();
        return back()->with('success', 'Brand deleted successfully.');
    }
}

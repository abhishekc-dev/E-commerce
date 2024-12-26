<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    public function listBrand(Request $request, $id = '')
    {

        $single = [];

        if ($id) {
            $single = DB::table('brand')->where('BRAND_ID', $id)->get();
        }

        $brands = DB::table('brand')->get();

        $category = DB::table('category')->where('PARENT_ID', '-1')->get();

        $subcategory = DB::table('subcategory')->get();

        return view('Admin.Product.brand', compact('brands', 'category', 'subcategory', 'single'));
    }
    public function createBrand(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'dd_cat' => 'required',
            'dd_subcat' => 'required',
            'txt_brand' => 'required',
            'txt_file' => 'required|max:2048|mimes:jpg,png,jpeg',
        ], [
            'dd_cat.required' => 'Category is required',
            'dd_subcat.required' => 'Sub Category is required',
            'txt_brand.required' => 'Brand is required',
            'txt_file.required' => 'Image is required',
            'txt_file.max' => 'Max 2Mb',
        ]);
        if ($validator->fails()) {
            // dd($validator->errors());
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        $txt_img = '';
        if ($request->hasFile('txt_file')) {
            $file = time() . '.' . $request->file('txt_file')->getClientOriginalExtension();
            $path = $request->txt_file->move(public_path('/Images'), $file);
            if ($path) {
                $txt_img = $file;
            }
        }
        $arr = [
            'm01_category_id' => $request->dd_cat,
            'm01_subcat_id' => $request->dd_subcat,
            'm02_brand_name' => $request->txt_brand,
            'm02_brand_status' => 1,
            'm02_brand_image' => $txt_img,
        ];
        $brand = DB::table('m02_brand')->insert($arr);
        if ($brand) {
            Session::flash('message', 'Brand Added Successfully');
            Session::flash('type', 'success');
        }

        return redirect()->route('brand');

    }
    public function brandStatus(Request $request, $id)
    {
        $status = DB::update('UPDATE m02_brand SET m02_brand_status = case m02_brand_status when "ACTIVE" then "INACTIVE"
     when "INACTIVE" then "ACTIVE" end WHERE m02_brand_id = "' . $id . '"');
        if ($status) {
            Session::flash('message', 'Status Changed');
            Session::flash('type', 'success');
        }
        return redirect()->route('brand');
    }

    public function updateBrand(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'dd_cat' => 'required',
            'dd_subcat' => 'required',
            'txt_brand' => 'required',
            'txt_file' => 'max:2048|mimes:jpg,png,jpeg',
        ], [
            'dd_cat.required' => 'Category is required',
            'dd_subcat.required' => 'Sub Category is required',
            'txt_brand.required' => 'Brand is required',
            'txt_file.max' => 'Max 2Mb',
            'txt_file.mimes' => 'Invalid file type',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        $txt_img = '';
        if ($request->hasFile('txt_file')) {
            // dd('yes');
            $file = time() . '.' . $request->file('txt_file')->getClientOriginalExtension();
            $path = $request->txt_file->move(public_path('/Images'), $file);
            if ($path) {
                $txt_img = $file;
            }
        } else {
            $txt_img = $request->txt_old_image;
        }
        $arr = [
            'm01_category_id' => $request->dd_cat,
            'm01_subcat_id' => $request->dd_subcat,
            'm02_brand_name' => $request->txt_brand,
            'm02_brand_status' => 1,
            'm02_brand_image' => $txt_img,
        ];
        $brand = DB::table('m02_brand')->where('m02_brand_id', $id)->update($arr);
        if ($brand) {
            Session::flash('message', 'Brand Updated Successfully');
            Session::flash('type', 'success');
        }

        return redirect()->route('brand');

    }
}

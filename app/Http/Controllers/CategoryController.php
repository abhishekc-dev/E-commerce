<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Repositories\Category\CategoryRepository;

class CategoryController extends Controller
{

    public function __construct(public CategoryRepository $cat_repo)
    {

    }
    public function listCategory(Request $request, $id = '')
    {
        $single = [];
        if ($id) {
            $single = DB::table('category')->where('CATEGORY_ID', $id)->get();
        }
        $all_cat = DB::table('category')->where('PARENT_ID', '-1')->get();

        return view('Admin.Product.category', compact('all_cat', 'single'));
    }


    public function createCategory(Request $request)
    {

        $request->validate([
            'txt_cat' => 'required',
            'txt_file' => 'required|max:2048|mimes:jpg,png,jpeg',
        ], [
            'txt_cat.required' => 'Category name is required',
            'txt_file.required' => 'Image is required',
            'txt_file.max' => 'Max file size is 2Mb',
        ]);
        $txt_img = '';
        if ($request->hasFile('txt_file')) {
            $file = time() . '.' . $request->file('txt_file')->getClientOriginalExtension();
            $path = $request->txt_file->move(public_path('/Images'), $file);
            if ($path) {
                $txt_img = $file;
            }
        }
        $arr = [
            'm01_parent_id' => -1,
            'm01_category_name' => $request->txt_cat,
            'm01_category_image' => $txt_img,
            'm01_category_status' => 1,
        ];
        $category = DB::table('m01_category')->insert($arr);
        if ($category) {
            Session::flash('message', 'Category Created');
            Session::flash('type', 'success');
        }

        return redirect()->route('category');
    }


    public function categoryStatus(Request $request, $id)
    {
        $status = DB::update('UPDATE m01_category SET m01_category_status = case m01_category_status when "ACTIVE" then "INACTIVE"
     when "INACTIVE" then "ACTIVE" end WHERE m01_category_id = "' . $id . '"');
        if ($status) {
            Session::flash('message', 'Status Changed');
            Session::flash('type', 'success');
        }
        $single = DB::table('category')->where('CATEGORY_ID', $id)->get();
        if ($single[0]->PARENT_ID != '-1') {
            return redirect()->route('subcategory');
        }
        return redirect()->route('category');

    }


    public function updateCategory(Request $request, string $id)
    {
        //    dd($request->all());
        $request->validate([
            'txt_cat' => 'required',
            'txt_file' => 'max:2048|mimes:jpg,png,jpeg',
        ], [
            'txt_cat.required' => 'Category name is required',
            'txt_file.max' => 'Max file size is 2Mb',
            //     'dd_status.required' => 'Status is required',
        ]);

        $txt_img = '';
        if ($request->hasFile('txt_file')) {
            $file = time() . '.' . $request->file('txt_file')->getClientOriginalExtension();
            $path = $request->txt_file->move(public_path('/Images'), $file);
            if ($path) {
                $txt_img = $file;
            }
        } else {
            $txt_img = $request->txt_old_image;
        }

        $arr = [
            'm01_parent_id' => -1,
            'm01_category_name' => $request->txt_cat,
            'm01_category_image' => $txt_img,
        ];

        $category = DB::table('m01_category')->where('m01_category_id', $id)->update(values: $arr);

        if ($category) {
            Session::flash('message', 'Category Updated Successfully');
            Session::flash('type', 'success');
        }
        return redirect()->route('category');
    }

    public function listSubCategory($id = '')
    {
        $single = [];
        if ($id) {
            $single = DB::table('subcategory')->where('SUBCAT_ID', $id)->get();
        }
        $category = DB::table('category')->where('PARENT_ID', -1)->get();
        $subcat = DB::table('subcategory')->whereNot('PARENT_ID', '-1')->get();
        return view('Admin.Product.subcategory', compact('subcat', 'single', 'category'));
    }

    public function createSubcategory(Request $request)
    {

        $request->validate([
            'dd_cat' => 'required',
            'txt_subcategory' => 'required',
            'txt_file' => 'required|max:2048|mimes:jpg,png,jpeg',
        ], [
            'dd_cat.required' => 'Category is required',
            'txt_subcategory.required' => 'Sub Category is required',
            'txt_file.required' => 'Image is required',
            'txt_file.max' => 'Max 2Mb',
        ]);

        $file = time() . '.' . $request->file('txt_file')->getClientOriginalExtension();
        $path = $request->txt_file->move(public_path('/Images'), $file);

        $arr = [
            'parent_id' => $request->dd_cat,
            'category_name' => $request->txt_subcategory,
            'category_status' => 1,
            'category_image' => $file,
        ];
        $subCategory = DB::table('category')->insert($arr);
        if ($subCategory) {
            Session::flash('message', 'Sub Category Created');
            Session::flash('type', 'success');
        }
        return redirect()->route('subcategory');
    }


    public function updateSubcategory(Request $request, $id)
    {
        $request->validate([
            'dd_cat' => 'required',
            'txt_subcategory' => 'required',
            'txt_file' => 'max:2048|mimes:jpg,png,jpeg',
        ], [
            'dd_cat.required' => 'Category is required',
            'txt_subcategory.required' => 'Sub Category is required',
            'txt_file.max' => 'Max 2Mb',
        ]);
        $txt_img = '';
        if ($request->hasFile('txt_file')) {
            $file = time() . '.' . $request->file('txt_file')->getClientOriginalExtension();
            $path = $request->txt_file->move(public_path('/Images'), $file);
            $txt_img = $file;
        } else {
            $txt_img = $request->txt_old_image;
        }

        $arr = [
            'm01_parent_id' => $request->dd_cat,
            'm01_category_name' => $request->txt_subcategory,
            'm01_category_image' => $txt_img,
        ];

        $subCategory = DB::table('m01_category')->where('m01_category_id', $id)->update($arr);
        if ($subCategory) {
            Session::flash('message', 'Sub Category Updated');
            Session::flash('type', 'success');
        }
        return redirect()->route('subcategory');
    }

}

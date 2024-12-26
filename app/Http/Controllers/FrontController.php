<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontController extends Controller
{
    public function getsubcat(Request $request)
    {
        $cat_id = $request->cat_id;
        $sub_cat = DB::table('subcategory')->where('PARENT_ID', $cat_id)->get();
        return [
            'status' => 'success',
            'sub_cat' => $sub_cat,
        ];
    }
}

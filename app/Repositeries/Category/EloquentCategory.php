<?php
namespace App\Repositories\Category;
use DB;
class EloquentCategory implements CategoryRepository
{
    public function getAll()
    {
        return DB::SELECT("select * from category");
    }
    public function singleCategory($Id)
    {
        $single = DB::table('category')->where('category_id', $Id)->first();
        return $single;
    }
    public function create($arr)
    {
        return DB::table('category')->insert($arr);
    }
    public function update($arr, $Id)
    {
        return DB::table('category')->where('category_id', $Id)->update($arr);
    }
    public function changeStatus()
    {
        echo 'Hello';
    }
}
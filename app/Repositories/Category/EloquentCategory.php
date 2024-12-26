<?php
namespace App\Repositories\Category;
use DB;
class EloquentCategory implements CategoryRepository
{
    public function getAll()
    {
        return DB::SELECT("select * from category");
    }
    public function getById($id): array
    {
        return DB::SELECT("select * from category where id = $id");
    }
    public function create($arr)
    {
        return DB::table('category')->insert($arr);
    }
    public function update($arr, $id)
    {
        DB::table('category')->where('id', $id)->update($arr);
    }
    public function changeStatus()
    {
        echo 'Hello';
    }
}
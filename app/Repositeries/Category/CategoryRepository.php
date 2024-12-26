<?php

namespace App\Repositories\Category;

interface CategoryRepository
{
    public function getAll();
    public function singleCategory($Id);
    public function create($arr);
    public function update($arr, $Id);
    public function changeStatus();
}
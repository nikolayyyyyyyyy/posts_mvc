<?php
namespace App\Http\Services\Category;
use Illuminate\Http\Request;

interface CategoryServiceInterface
{
    public function createCategory(Request $request);
}
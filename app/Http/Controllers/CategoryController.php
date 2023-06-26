<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Category::where('active', 1)
            ->notMobile()
            ->orderBy('seq')
            ->get(['name', 'category', 'brandid', 'seq']);
    }

    public function categoriesGroups()
    {
        return Category::where('active', 1)
            ->notMobile()
            ->orderBy('seq')
            ->get(['name', 'category', 'brandid', 'seq'])
            ->groupBy('brandid');
    }
}

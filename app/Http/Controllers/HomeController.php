<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Service;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $featuredServices = Service::where('is_available', true)
            ->inRandomOrder()
            ->take(6)
            ->get();

        return view('home', compact('categories', 'featuredServices'));
    }
}

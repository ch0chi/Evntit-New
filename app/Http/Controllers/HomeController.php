<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Repo\Repositories\CategoryRepository as Category;

class HomeController extends Controller
{
    
    private $category;
    public function __construct(Category $category)
    {
        $this->category = $category;
        //$this->middleware('auth');
    }

    
    public function index()
    {
        $categories = $this->category->all();
        return view('welcome',compact('categories'));
    }
}

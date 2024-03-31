<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::get();
        return view('admin.categories.index', compact('categories'));
    }
    public function save(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|max:255'
        ]);
        Category::create([
            'title' => $data['title'],

        ]);
        return redirect('/admin/categories')
            ->with('success', 'Category created successfully!');
    }
}

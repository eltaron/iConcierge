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
            'title' => 'required|max:255',
            'image' => 'required'
        ]);
        $data = new Category();
        $data->title = $request->title;
        $file = $request->file('image');
        if (isset($file)) {
            $mainpath = date("Y-m-d") . '/';
            $fileNameWithExtension = $file->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $name = $this->generateCode();
            $imageName = $name . '_' . time() . '.' . $extension;
            $path = $file->move(public_path('storage/categories/' . $mainpath), $imageName);
            $data->image = url('') . '/storage/categories/' . $mainpath . $imageName;
        }
        $data->save();
        return back()->with('success', 'Category created successfully!');
    }
    public function update(Request $request)
    {
        try {
            $data = $request->validate([
                'title' => 'nullable',
                'image' => 'nullable',
                'id' => 'required',
            ]);
            $data = Category::find($request->id);
            if ($data) {
                if ($request->title) {
                    $data->title = $request->title;
                }
                $file = $request->file('image');
                if (isset($file)) {
                    $mainpath = date("Y-m-d") . '/';
                    $fileNameWithExtension = $file->getClientOriginalName();
                    $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
                    $extension = $file->getClientOriginalExtension();
                    $name = $this->generateCode();
                    $imageName = $name . '_' . time() . '.' . $extension;
                    $path = $file->move(public_path('storage/categories/' . $mainpath), $imageName);
                    $data->image = url('') . '/storage/categories/' . $mainpath . $imageName;
                }
                $data->save();
            }

            return back()->with('success', 'Category updated successfully!');
        } catch (\Exception $e) {
            return back()->with('faild', 'Category not found');
        }
    }
    function generateCode()
    {
        $code = mt_rand(100000, 999999);
        if ($this->codeExists($code)) {
            return $this->generateCode();
        }
        return $code;
    }

    function codeExists($code)
    {
        return Category::where('image', $code)->exists();
    }
    public function delete(Request $request)
    {
        try {
            $data = Category::find($request->id);
            if ($data) {
                $data->delete();
            }
            return back()->with('success', 'Category deleted successfully!');
        } catch (\Exception $e) {
            return back()->with('faild', 'Category not found');
        }
    }
}

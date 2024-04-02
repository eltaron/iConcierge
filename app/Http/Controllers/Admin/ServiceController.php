<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::latest()->get();
        $categories = Category::latest()->get();
        return view('admin.services.index', compact('services', 'categories'));
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|max:255',
            'images' => 'required'
        ]);
        $data = new Service();
        $data->user_id = Auth::user()->id;
        $data->title = $request->title;
        $data->category_id = $request->category;
        $data->description = $request->description;
        $data->map = $request->map;
        $data->price = $request->price;
        $data->save();
        $files = $request->file('images');
        if (isset($files)) {
            foreach ($files as $file) {
                $mainpath = date("Y-m-d") . '/';
                $fileNameWithExtension = $file->getClientOriginalName();
                $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $imageName = $fileName . '_' . time() . '.' . $extension;
                $path = $file->move(public_path('storage/categories/' . $mainpath), $imageName);
                $image = new Image();
                $image->service_id = $data->id;
                $image->filename = $imageName;
                $image->url = url('') . '/storage/categories/' . $mainpath . $imageName;
                $image->save();
            }
        }


        return back()->with('success', 'Category Service successfully!');
    }
    public function update(Request $request)
    {
        try {
            $data = $request->validate([
                'title' => 'nullable',
                'images' => 'nullable',
                'id' => 'required',
            ]);
            $data = Service::find($request->id);
            if ($data) {
                if ($request->title) {
                    $data->title = $request->title;
                }
                if ($request->title) {
                    $data->description = $request->description;
                }
                if ($request->price) {
                    $data->price = $request->price;
                }
                if ($request->map) {
                    $data->map = $request->map;
                }
                if ($request->category) {
                    $data->category_id = $request->category;
                }
                $data->save();
                $files = $request->file('images');
                if (isset($files)) {
                    foreach ($files as $file) {
                        $mainpath = date("Y-m-d") . '/';
                        $fileNameWithExtension = $file->getClientOriginalName();
                        $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
                        $extension = $file->getClientOriginalExtension();
                        $imageName = $fileName . '_' . time() . '.' . $extension;
                        $path = $file->move(public_path('storage/categories/' . $mainpath), $imageName);
                        $image = new Image();
                        $image->service_id = $data->id;
                        $image->filename = $imageName;
                        $image->url = url('') . '/storage/categories/' . $mainpath . $imageName;
                        $image->save();
                    }
                }
            }

            return back()->with('success', 'Service updated successfully!');
        } catch (\Exception $e) {
            return back()->with('faild', 'Service not found');
        }
    }
    public function delete(Request $request)
    {
        try {
            $data = Service::find($request->id);
            if ($data) {
                $data->delete();
            }
            return back()->with('success', 'Service deleted successfully!');
        } catch (\Exception $e) {
            return back()->with('faild', 'Service not found');
        }
    }
}

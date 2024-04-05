<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\ServiceDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::latest()->get();
        $categories = Category::latest()->get();
        return view('admin.services.index', compact('services', 'categories'));
    }
    public function show($id)
    {
        $service_details = Service::find($id);
        $service_id = $id;
        return view('admin.services.show', compact('service_id', 'service_details'));
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
                $name = str_replace(' ', '_', $fileName);
                $imageName = $name . '_' . time() . '.' . $extension;
                $path = $file->move(public_path('storage/services/' . $mainpath), $imageName);
                $image = new Image();
                $image->service_id = $data->id;
                $image->filename = $imageName;
                $image->url = url('') . '/storage/services/' . $mainpath . $imageName;
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
                        $path = $file->move(public_path('storage/services/' . $mainpath), $imageName);
                        $image = new Image();
                        $image->service_id = $data->id;
                        $image->filename = $imageName;
                        $image->url = url('') . '/storage/services/' . $mainpath . $imageName;
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
                $details = ServiceDetail::where('service_id', $request->id)->get();
                foreach ($details as $d) {
                    $d->delete();
                }
                $images = Image::where('service_id', $request->id)->get();
                foreach ($images as $i) {
                    if (Storage::disk('public')->exists($i->url)) {
                        Storage::disk('public')->delete($i->url);
                    }
                    $i->delete();
                }
                $data->delete();
            }
            return back()->with('success', 'Service deleted successfully!');
        } catch (\Exception $e) {
            return back()->with('faild', 'Service not found');
        }
    }
    public function detailsadd(Request $request)
    {
        $details = $request->validate([
            'key' => 'required',
            'value' => 'nullable',
            'service_id' => 'required',
        ]);
        $detail = new ServiceDetail();
        $detail->key = $request->key;
        $detail->service_id = $request->service_id;
        if (strtolower($detail->key) == 'map') {
            preg_match('/src="([^"]+)"/', $request->value, $match);
            $src = $match[1] ?? null;
            $detail->value = $src;
            $detail->type = 'map';
        } elseif (strtolower($detail->key) == 'logo') {
            $detail->type = 'logo';
        } elseif (strtolower($detail->key) == 'menu') {
            $detail->type = 'menu';
        } else {
            $detail->value = $request->value;
            $detail->type = isset($files) ? 'image' : '';
        }
        $detail->save();
        $files = $request->file('images');
        if (isset($files)) {
            foreach ($files as $file) {
                $mainpath = date("Y-m-d") . '/';
                $fileNameWithExtension = $file->getClientOriginalName();
                $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $name = str_replace(' ', '_', $fileName);;
                $imageName = $name . '_' . time() . '.' . $extension;
                $path = $file->move(public_path('storage/details/services/' . $mainpath), $imageName);
                $image = new Image();
                $image->service_detail = $detail->id;
                $image->filename = $imageName;
                $image->url = url('') . '/storage/details/services/' . $mainpath . $imageName;
                $image->save();
            }
        }
        $detail->save();
        return back()->with('success', 'key added successfully!');
    }
    public function detailsedit(Request $request)
    {
        $details = $request->validate([
            'key' => 'required',
            'value' => 'nullable',
            'service_id' => 'required',
        ]);
        $serviceDetail = ServiceDetail::findOrFail($request->service_id);

        if ($serviceDetail) {
            $serviceDetail->key = $details['key'];
            $serviceDetail->value = $details['value'];
            if (strtolower($details['key']) == 'logo') {
                $serviceDetail->type = 'logo';
            }
            $serviceDetail->save();
            $files = $request->file('images');
            if (isset($files)) {
                foreach ($files as $file) {
                    $mainpath = date("Y-m-d") . '/';
                    $fileNameWithExtension = $file->getClientOriginalName();
                    $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
                    $extension = $file->getClientOriginalExtension();
                    $name = str_replace(' ', '_', $fileName);
                    $imageName = $name . '_' . time() . '.' . $extension;
                    $path = $file->move(public_path('storage/details/services/' . $mainpath), $imageName);
                    $image = new Image();
                    $image->service_detail = $serviceDetail->id;
                    $image->filename = $imageName;
                    $image->url = url('') . '/storage/details/services/' . $mainpath . $imageName;
                    $image->save();
                }
            }
            return back()->with('success', 'key edited successfully!');
        }
    }
    public function detailsdestroy(Request $request)
    {
        $detail = ServiceDetail::findOrFail($request->id);
        if ($detail) {
            $images = Image::where('service_detail', $request->id)->get();
            foreach ($images as $i) {
                if (Storage::disk('public')->exists($i->url)) {
                    Storage::disk('public')->delete($i->url);
                }
                $i->delete();
            }
            $detail->delete();
            return back()->with('success', 'key deleted successfully!');
        }
        return back()->with('faild', 'key not found');
    }
    public function imageadd(Request $request)
    {
        $details = $request->validate([
            'images' => 'required',
            'service_id' => 'required',
        ]);
        $files = $request->file('images');
        if (isset($files)) {
            foreach ($files as $file) {
                $mainpath = date("Y-m-d") . '/';
                $fileNameWithExtension = $file->getClientOriginalName();
                $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $name = str_replace(' ', '_', $fileName);;
                $imageName = $name . '_' . time() . '.' . $extension;
                $path = $file->move(public_path('storage/services/' . $mainpath), $imageName);
                $image = new Image();
                $image->service_id = $request->service_id;
                $image->filename = $imageName;
                $image->url = url('') . '/storage/services/' . $mainpath . $imageName;
                $image->save();
            }
        }
        return back()->with('success', 'Images added successfully!');
    }
    public function imagedelete(Request $request)
    {
        $detail = Image::findOrFail($request->id);
        if ($detail) {
            $images = Image::where('service_id', $detail->service_id)->count();
            if ($images == 1) {
                return back()->with('faild', 'can\'t delete this image');
            } else {
                if (Storage::disk('public')->exists($detail->url)) {
                    Storage::disk('public')->delete($detail->url);
                }
                $detail->delete();
                return back()->with('success', 'key deleted successfully!');
            }
        }
        return back()->with('faild', 'key not found');
    }
}

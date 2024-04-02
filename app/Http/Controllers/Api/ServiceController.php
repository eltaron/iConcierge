<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Category;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        try {
            $data = Service::with(['category', 'images'])->latest()->paginate($request->perpage);
            return response()->json([
                'message' => 'success',
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'error',
                'data' => $e->getMessage()
            ]);
        }
    }
    public function categories(Request $request)
    {
        try {
            $data = Category::latest()->paginate($request->perpage);
            return response()->json([
                'message' => 'success',
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'error',
                'data' => $e->getMessage()
            ]);
        }
    }
    public function schedule()
    {
        try {
            $data = '';
            return response()->json([
                'message' => 'success',
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'error',
                'data' => $e->getMessage()
            ]);
        }
    }
    public function popular(Request $request)
    {
        try {
            $data = Service::where('popular', 1)->with(['category', 'images'])->latest()->paginate($request->perpage);
            return response()->json([
                'message' => 'success',
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'error',
                'data' => $e->getMessage()
            ]);
        }
    }
    public function recommended()
    {
        try {
            $data = '';
            return response()->json([
                'message' => 'success',
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'error',
                'data' => $e->getMessage()
            ]);
        }
    }
    public function show($id)
    {
        try {
            $data = Service::with(['category', 'images', 'details'])->find($id);
            return response()->json([
                'message' => 'success',
                'data' => $data,

            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'error',
                'data' => $e->getMessage()
            ]);
        }
    }
    public function bookmarked(Request $request)
    {
        try {
            $data = '';
            return response()->json([
                'message' => 'success',
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'error',
                'data' => $e->getMessage()
            ]);
        }
    }
    public function favorite(Request $request)
    {
        try {
            $data = '';
            return response()->json([
                'message' => 'success',
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'error',
                'data' => $e->getMessage()
            ]);
        }
    }
    public function search(Request $request)
    {
        try {
            $key = '%' . $request->key . '%';
            $data = Service::where('title', 'like', $key)
                ->orWhere('description', 'like', $key)
                ->with(['category', 'images'])->latest()->paginate($request->perpage);
            return response()->json([
                'message' => 'success',
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'error',
                'data' => $e->getMessage()
            ]);
        }
    }
    public function filter(Request $request)
    {
        try {
            if ($request->key) {
                $key = '%' . $request->key . '%';
                $data = Service::where(function ($query) use ($key) {
                    $query->where('title', 'like', '%' . $key . '%')
                        ->orWhere('description', 'like', '%' . $key . '%');
                })->with(['category', 'images'])->latest()->paginate($request->perpage);
            } else {
                if ($request->category_id == 'all') {
                    $data = Service::with(['category', 'images'])->latest()->paginate($request->perpage);
                } else {
                    $data = Service::where('category_id', $request->category_id)->with(['category', 'images'])->latest()->paginate($request->perpage);
                }
            }


            return response()->json([
                'message' => 'success',
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'error',
                'data' => $e->getMessage()
            ]);
        }
    }
    public function upcoming()
    {
        try {
            $data = '';
            return response()->json([
                'message' => 'success',
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'error',
                'data' => $e->getMessage()
            ]);
        }
    }
    public function book(Request $request)
    {
        try {
            $validation = $request->validate([
                'user_id'           => 'required',
                'service_id'        => 'required',
                'inqiry_id'         => 'required',
                'new_price'         => 'required',
            ]);
            $data = new Booking();
            $data->user_id = $request->user_id;
            $data->service_id = $request->service_id;
            $data->inqiry_id = $request->inqiry_id;
            $data->new_price = $request->new_price;
            $data->save();
            return response()->json([
                'message' => 'success',
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'error',
                'data' => $e->getMessage()
            ]);
        }
    }
}

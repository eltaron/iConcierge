<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Favourite;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    public function index(Request $request)
    {
        try {
            $data = Favourite::with('service.images')->where('user_id', auth()->guard('api')->id())->latest()->paginate($request->perpage);
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
    public function create(Request $request)
    {
        try {
            $validation = $request->validate([
                'service_id'       => 'required',
            ]);
            $data = new Favourite();
            $data->user_id = auth()->guard('api')->id();
            $data->service_id = $request->service_id;
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
    public function delete(Request $request)
    {
        try {
            $data = Favourite::find($request->id);
            if ($data) {
                $data->delete();
            }

            return response()->json([
                'message' => 'success',
                'data' => true
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'error',
                'data' => $e->getMessage()
            ]);
        }
    }
}

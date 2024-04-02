<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        try {
            $data = Notification::where('user_id', auth()->guard('api')->id())->latest()->paginate($request->perpage);
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
    public function show(Request $request)
    {
        try {
            $data = Notification::find($request->id);
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
            $data = Notification::find($request->id);
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
    public function read(Request $request)
    {
        try {
            $data = Notification::find($request->id);
            if ($data) {
                $data->read_at = now();
                $data->save();
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
    public function delete_all(Request $request)
    {
        try {
            $data = Notification::where('user_id', auth()->guard('api')->id())->latest()->get();
            foreach ($data as $d) {
                $d->delete();
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

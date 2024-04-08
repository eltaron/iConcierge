<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BookingController extends Controller
{

    public function all(Request $request)
    {
        try {
            $data = Booking::where('user_id', auth()->guard('api')->id())->with('inqiry')->latest()->get();
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
    public function past(Request $request)
    {
        try {
            $currentDate = Carbon::now();
            $data = Booking::where('user_id', auth()->guard('api')->id())->whereHas('inqiry', function ($query) use ($currentDate) {
                $query->where('date_to', '<', $currentDate);
            })->with('inqiry')->latest()->get();
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
    public function upcoming(Request $request)
    {
        try {
            $currentDate = Carbon::now();
            $data = Booking::where('user_id', auth()->guard('api')->id())->whereHas('inqiry', function ($query) use ($currentDate) {
                $query->where('date_from', '>', $currentDate);
            })->with('inqiry')->latest()->get();
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
    public function ongoing(Request $request)
    {
        try {
            $currentDate = $request->day;
            $data = Booking::where('user_id', auth()->guard('api')->id())->whereHas('inqiry', function ($query) use ($currentDate) {
                $query->where('date_from', '<=', $currentDate)->where('date_to', '>', $currentDate);
            })->with('inqiry')->latest()->get();
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

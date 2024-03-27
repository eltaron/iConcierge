<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        try {
<<<<<<< HEAD
            $data = Review::latest()->paginate($request->perpage);
=======
            $data = Review::get();
>>>>>>> 2de2f21a8cf3b84ab9d7f3861c8ac056ea510ec8
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

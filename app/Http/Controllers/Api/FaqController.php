<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;
use App\Models\Faq;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        try {
<<<<<<< HEAD
            $data = Faq::latest()->paginate($request->perpage);
=======
            $data = Faq::get();
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

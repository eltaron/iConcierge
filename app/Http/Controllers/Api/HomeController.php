<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\contact;

class HomeController extends Controller
{
    public function index()
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
    public function contact(Request $request){
        try {
            $validation = $request->validate([
                'first_name'    => 'nullable',
                'last_name'     => 'nullable',
                'email'         => 'nullable',
                'phone'         => 'nullable',
                'message'       => 'required',
            ]);
            $data = new contact();
            $data->first_name = $request->first_name;
            $data->last_name = $request->last_name;
            $data->email = $request->email;
            $data->phone = $request->phone;
            $data->message = $request->message;
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

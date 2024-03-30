<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inqiry;

class InquireController extends Controller
{
    public function index(Request $request){
        try {
            $data = Inqiry::with(['user', 'service'])->latest()->paginate($request->perpage);
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
    public function show(Request $request){
        try {
            $data = Inqiry::with(['user', 'service','messages'])->find($request->id);
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
    public function store(Request $request){
        try {
            $validation = $request->validate([
                'service_id'       => 'required',
                'date_from'        => 'required',
                'date_to'          => 'required',
                'status'           => 'required',
                'contact_method'   => 'required',
            ]);
            $data = new Inqiry();
            $data->user_id = auth()->guard('api')->id();
            $data->service_id = $request->service_id;
            $data->date_from = $request->date_from;
            $data->date_to = $request->date_to;
            $data->contact_method = $request->contact_method;
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
    public function store_message(Request $request){
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
    public function services(){
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
    public function requests(){
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
    public function done(){
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
    public function schedule(Request $request){
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
}

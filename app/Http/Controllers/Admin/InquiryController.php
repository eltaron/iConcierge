<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inqiry;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    public function  index()
    {
        $inquires = Inqiry::latest()->get();
        return view("admin.inquiries.index", ['inquires' => $inquires]);
    }
}

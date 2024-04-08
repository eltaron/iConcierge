<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;

class BookingController extends Controller
{
    public function index()
    {
        $books = Booking::get();
        return view('admin.bookings.index', compact("books"));
    }
    public function delete(Request $request)
    {

        $data = Booking::where('id', $request->id)->first();
        $data->delete();
        return back()->with('success', 'deleted successfully');
    }
    public function update(Request $request)
    {
        $data = Booking::where('id', $request->id)->first();
        $data->new_price = $request->price;
        $data->description = $request->description;
        $data->save();
        return back()->with('success', 'edited successfully');
    }
}

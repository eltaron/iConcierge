<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;

class NotificationController extends Controller
{
    public function index(){
        $notifications=Notification::all();
        return view ("admin.notifications.index",compact("notifications"));
    }
    public function delete(Request $request){
        $item = Notification::find($request->id);
        if($item){
            $item->delete();
            return back()->with("success","Notification deleted successfully");
        }
    }
}

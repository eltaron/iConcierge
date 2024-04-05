<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(){
        $notifications=Notification::all();
        return view ("admin.notifications.index",compact("notifications"));
    }
}

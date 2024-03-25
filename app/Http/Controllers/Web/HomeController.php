<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Consultation;
use App\Models\Message;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('web.home.index');
    }
}

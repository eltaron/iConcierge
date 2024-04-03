<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class ClientController extends Controller
{
    public function index()
    {
        $users = User::get();
        return view('admin.clients.index', compact('users'));
    }
    public function delete(Request $request)
    {
        $user = User::findOrFail($request->id);
        if ($user) {
            $user->delete();
            return back()->with('success', 'Member deleted successfully!');
        }
    }
    public function edit(Request $request){
        $user=User::findOrFail($request->id);
        if($user){
            $data=$request->validate([
                'email'=>'required',
                'phone'=>'required',
                'username'=>'required'
            ]);
            $user->username=$data['username'];
            $user->phone=$data['phone'];
            $user->email=$data['email'];
            $user->save();
            return back()->with('success','client has been edited successfully');
        }
    }
}

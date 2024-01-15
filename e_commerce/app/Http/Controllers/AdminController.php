<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index () {
        return view('admin.dashboard');
    }

    //logout
    public function AdminLogout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.sign_in');
    }

    //login
    public function SignIn () {
        return view('admin.sign_in');
    }
    //sign up
    public function SignUp () {
        return view('admin.sign_up');
    }

    //admin profile
    public function AdminProfile () {
        $id = Auth::user()->id;
        $data_user = User::find($id);
        return view('admin.profile', compact('data_user'));
    }

    //update profile
    public function AdminUpdateProfile (Request $request) {
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->phone = $request->phone;
        $data->email = $request->email;
        $data->address = $request->address;
        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink('uploads/admin/images/'.$data->photo);
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('uploads/admin/images'), $filename);
            $data->photo = $filename;
        }
        $data->save();
        $notification = [
            'message' => 'Admin update profile successfully',
            'alert-type' => 'success'
        ];
        return back()->with($notification);
    }
}

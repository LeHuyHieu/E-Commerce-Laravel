<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yoeunes\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index () {
        $title = 'Dashboard';
        return view('admin.dashboard', compact('title'));
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
        $title = 'Sign In';
        return view('admin.sign_in', compact('title'));
    }
    //sign up
    public function SignUp () {
        $title = 'Sign Up';
        return view('admin.sign_up', compact('title'));
    }

    //admin profile
    public function AdminProfile () {
        $id = Auth::user()->id;
        $data_user = User::find($id);
        $title = 'Profile';
        return view('admin.profile', compact('data_user', 'title'));
    }

    //update profile
    public function AdminUpdateProfile (Request $request)
    {
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
        Toastr::success('Update data profile successfully!', 'Update', ['closeButton' => true]);
        return back()->with($notification);
    }

    //change password
    public function AdminChangePassword ()
    {
        $title = 'Change Password';
        return view('admin.change_password', compact('title'));
    }

    public function AdminUpdatePassword (Request $request)
    {
        $request->validate([
            'old_password' => 'required|max:255',
            'new_password' => 'required|required_with:confirm_password|same:confirm_password|max:255|min:3',
            'confirm_password' => 'required|min:3',
        ]);
        if (!Hash::check($request->old_password, auth()->user()->password)) {
            Toastr::warning('Update password failed', 'Password', ['closeButton' => true]);
            return back();
        }
        User::whereId(auth()->user()->id)->update(['password' => Hash::make($request->new_password)]);
        Toastr::success('Update password successfully!', 'Password', ['closeButton' => true]);
        return back();
    }
}

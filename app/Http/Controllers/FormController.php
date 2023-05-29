<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class FormController extends Controller
{
    public function index()
    {
        $admins = Admin::all();
        return view('index', ['admins' => $admins]);
    }

    public function insert(Request $request)
    {

        $validate = Validator::make($request->all(), [
            'name' => 'required|min:4',
            'email' => 'required|unique:admins|email',
            'password' => 'required|confirmed|min:8|max:16',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors());
        }

        $admin = new Admin();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password = Hash::make($request->password);
        $admin->save();

        if ($admin) {
            return redirect()->back()->with('success', 'Admin added succesfully.');
        }
    }

    public function deleteAdmin($id)
    {
        $delete_admin = Admin::find($id);
        $delete_admin->delete();
        if ($delete_admin) {
            return redirect()->back()->with('delete', 'Admin deleted succesfully.');
        }
    }
    public function updateAdmin($id)
    {
        $update_admin = Admin::select('id', 'name')->where('id', $id)->first();
        if ($update_admin) {
            return view('index', ['update_admin' => $update_admin]);
        }
    }
    public function updateAdmindata(Request $request)
    {
        $update_admin_id = $request->id;
        $update_admin = Admin::find($update_admin_id);
        $update_admin->name = $request->name;
        $update_admin->update();
        if ($update_admin) {
            return redirect('/form')->with('success', 'Admin updated succesfully.');
        }
    }
}

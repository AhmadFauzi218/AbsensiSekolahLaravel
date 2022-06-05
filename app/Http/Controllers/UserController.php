<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function user()
    {
    	$data["data_users"] = User::where("role", 1)->get();

    	return view("content.page.admin.users.data_user", $data);
    }

    public function simpan_data_users(Request $request)
    {
        $message = [
            "required" => "Kolom :attribute tidak boleh kosong"
        ];

        $this->validate($request, [
            "name" => "required",
            "username" => "required",
            "password" => "required"
        ]);

    	User::create([
    		"name" => $request->name,
    		"username" => $request->username,
    		"password" => $request->password,
    		"role" => 1,
    		"active" => 1
    	]);

    	return redirect()->back()->with("sukses", "Data Berhasil di Inputkan");
    }

    public function put_users(Request $request)
    {

        if ($request->password != $request->konfirmasi_password) {
            return redirect()->back()->with("error", "Invalid Password");
        }

        $message = [
            "required" => "Kolom :attribute tidak boleh kosong"
        ];

        $this->validate($request, [
            "name" => "required",
            "username" => "required",
            "password" => "required"
        ]);

        User::where("id", $request->id)->update([
            "name" => $request->name,
            "username" => $request->username,
            "password" => bcrypt($request->password)
        ]);

        return redirect()->back()->with("sukses", "Data Berhasil di Simpan");
    }
}

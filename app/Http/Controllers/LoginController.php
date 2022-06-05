<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    public function login()
    {
    	return view("content.page.auth.login");
    }

    public function post_login(Request $request)
    {
        $message = [
            "required" => "Kolom :attribute tidak boleh kosong",
            "numeric" => "Kolom :attribute harus angka",
            "min" => "Kolom :attribute harus diisi minimal :min digit",
            "max" => "Kolom :attribute harus diisi maximal :max digit",
            "unique" => "Kolom :attribute sudah ada"
        ];

        $this->validate($request, [
            "username" => "required",
            "password" => "required"
        ], $message);

    	if (Auth::attempt(["username" => $request->username, "password" => $request->password])) {
    		return redirect("/page/dashboard")->with("sukses", "Anda Berhasil Login");
    	} else if(Auth::attempt(["username" => $request->username, "password" => $request->password, "role" => 3])) {
    		return redirect("/page/dashboard")->with("sukses", "Anda Berhasil Login");
    	} else {
            return redirect()->back()->with("error", "Anda Gagal Login");
        }
    }

    public function logout()
    {
    	Auth::logout();

    	return redirect()->back()->with("sukses", "Anda Berhasil Logout");
    }
}
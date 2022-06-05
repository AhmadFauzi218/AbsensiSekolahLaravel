<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Kelas;
use App\Model\Guru;
use App\User;

class KelasController extends Controller
{
    public function data_kelas()
    {
    	$data["data_kelas"] = Kelas::orderBy("nama_kelas", "ASC")->get();
    	$data["data_guru"] = Guru::orderBy("nip", "ASC")->get();

    	return view("content.page.admin.kelas.data_kelas", $data);
    }

    public function simpan_data_kelas(Request $request)
    {
        $message = [
            "required" => "Kolom :attribute tidak boleh kosong",
            "numeric" => "Kolom :attribute harus angka",
            "min" => "Kolom :attribute harus diisi minimal :min digit",
            "max" => "Kolom :attribute harus diisi maximal :max digit",
            "unique" => "Kolom :attribute sudah ada"
        ];

        $this->validate($request, [
            "nama_kelas" => "required|unique:kelas",
            "nip_wali_kelas" => "required"
        ], $message);

    	$kelas = new Kelas;
    	$kelas->nama_kelas = $request->nama_kelas;
    	$kelas->nip_wali_kelas = $request->nip_wali_kelas;
    	$kelas->save();

        $data_guru = Guru::where("nip", $request->nip_wali_kelas)->first();
        $nama = $data_guru->nama;

        $user = new User;
        $user->name = $nama;
        $user->username = $request->nip_wali_kelas;
        $user->password = bcrypt("wakel".$request->nip_wali_kelas);
        $user->role = 2;
        $user->active = 1;
        $user->id_kelas = $kelas->id;
        $user->save();

    	return redirect()->back()->with("sukses", "Data Berhasil di Inputkan");
    }

    public function hapus_data_kelas($id)
    {
    	Kelas::where("id", $id)->delete();

        User::where("id_kelas", $id)->delete();

    	return redirect()->back()->with("sukses", "Data Berhasil di Hapus");
    }

    public function edit_data_kelas(Request $request)
    {
    	$data["edit"] = Kelas::where("id", $request->id)->first();
    	$data["data_guru"] = Guru::orderBy("nama", "ASC")->get();

    	return view("content.page.admin.kelas.edit_data_kelas", $data);
    }

    public function update_data_kelas(Request $request)
    {
        $message = [
            "required" => "Kolom :attribute tidak boleh kosong",
            "numeric" => "Kolom :attribute harus angka",
            "min" => "Kolom :attribute harus diisi minimal :min digit",
            "max" => "Kolom :attribute harus diisi maximal :max digit",
            "unique" => "Kolom :attribute sudah ada"
        ];

        $this->validate($request, [
            "nama_kelas" => "required",
            "nip_wali_kelas" => "required"
        ], $message);

    	Kelas::where("id", $request->id)->update([
    		"nama_kelas" => $request->nama_kelas,
    		"nip_wali_kelas" => $request->nip_wali_kelas
    	]);

        $data_guru = Guru::where("nip", $request->nip_wali_kelas)->first();
        $nama = $data_guru->nama;

        User::where("id_kelas", $request->id)->update([
            "name" => $nama,
            "username" => $request->nip_wali_kelas,
            "password" => bcrypt("wakel".$request->nip_wali_kelas),
            "id_kelas" => $request->id
        ]);

    	return redirect()->back()->with("sukses", "Data Berhasil di Update");
    }
}

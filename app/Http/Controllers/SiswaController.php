<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Siswa;
use App\Model\Kelas;

class SiswaController extends Controller
{
    public function data_siswa()
    {
    	$data["data_siswa"] = Siswa::orderBy("id_kelas", "ASC")->orderBy("nama", "ASC")->get();
    	$data["data_kelas"] = Kelas::orderBy("nama_kelas", "ASC")->get();

    	return view("content.page.admin.siswa.data_siswa", $data);
    }

    public function simpan_data_siswa(Request $request)
    {
        $message = [
            "required" => "Kolom :attribute tidak boleh kosong",
            "numeric" => "Kolom :attribute harus angka",
            "min" => "Kolom :attribute harus diisi minimal :min digit",
            "max" => "Kolom :attribute harus diisi maximal :max digit",
            "unique" => "Kolom :attribute sudah ada"
        ];

        $this->validate($request, [
            "nis" => "required|min:1|unique:siswa",
            "nama" => "required",
            "id_kelas" => "required",
            "no_telp" => "required|min:1|max:15",
            "jenis_kelamin" => "required",
            "alamat" => "required"
        ], $message);

    	Siswa::create($request->all());

    	return redirect()->back()->with("sukses", "Data Berhasil di Inputkan");
    }

    public function hapus_data_siswa($nis)
    {
    	Siswa::where("nis", $nis)->delete();

    	return redirect()->back()->with("sukses", "Data Berhasil di Hapus");
    }

    public function edit_data_siswa(Request $request)
    {
    	$data["edit"] = Siswa::where("nis", $request->nis)->first();
    	$data["data_kelas"] = Kelas::orderBy("nama_kelas", "ASC")->get();

    	return view("content.page.admin.siswa.edit_data_siswa", $data);
    }

    public function update_data_siswa(Request $request)
    {
        $message = [
            "required" => "Kolom :attribute tidak boleh kosong",
            "numeric" => "Kolom :attribute harus angka",
            "min" => "Kolom :attribute harus diisi minimal :min digit",
            "max" => "Kolom :attribute harus diisi maximal :max digit",
            "unique" => "Kolom :attribute sudah ada"
        ];

        $this->validate($request, [
            "nis" => "required|min:1",
            "nama" => "required",
            "id_kelas" => "required",
            "no_telp" => "required|min:1|max:15",
            "jenis_kelamin" => "required",
            "alamat" => "required"
        ], $message);

    	Siswa::where("nis", $request->nis)->update([
    		"nama" => $request->nama,
    		"id_kelas" => $request->id_kelas,
    		"no_telp" => $request->no_telp,
    		"jenis_kelamin" => $request->jenis_kelamin,
    		"alamat" => $request->alamat
    	]);

    	return redirect()->back()->with("sukses", "Data Berhasil di Simpan");
    }
}

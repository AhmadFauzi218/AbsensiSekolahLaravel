<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Guru;

class GuruController extends Controller
{
    public function data_guru()
    {
    	$data["data_guru"] = Guru::orderBy("nama", "ASC")->get();

    	return view("content.page.admin.guru.data_guru", $data);
    }

    public function simpan_data_guru(Request $request)
    {
        $message = [
            "required" => "Kolom :attribute tidak boleh kosong",
            "numeric" => "Kolom :attribute harus angka",
            "min" => "Kolom :attribute harus diisi minimal :min digit",
            "max" => "Kolom :attribute harus diisi maximal :max digit",
            "unique" => "Kolom :attribute sudah ada"
        ];

        $this->validate($request, [
            "nip" => "required|numeric|min:1|unique:guru",
            "nama" => "required",
            "no_hp" => "required|numeric|min:1",
            "alamat" => "required"
        ], $message);

        $guru = new Guru;

        $cek_double = $guru->where(["nip" => $request->nip])->count();

        if ($cek_double > 0) {
            return redirect()->back()->with("error", "Data NIP ".$request->nip." Sudah Ada");
        }

    	Guru::create($request->all());

    	return redirect()->back()->with("sukses", "Data Berhasil di Inputkan");
    }

    public function hapus_data_guru($nip)
    {
    	Guru::where("nip", $nip)->delete();

    	return redirect()->back()->with("sukses", "Data Berhasil di Hapus");
    }

    public function edit_data_guru(Request $request)
    {
    	$data["edit"] = Guru::where("nip", $request->nip)->first();

    	return view("content.page.admin.guru.edit_data_guru", $data);
    }

    public function update_data_guru(Request $request)
    {
        $message = [
            "required" => "Kolom :attribute tidak boleh kosong",
            "numeric" => "Kolom :attribute harus angka",
            "min" => "Kolom :attribute harus diisi minimal :min digit",
            "max" => "Kolom :attribute harus diisi maximal :max digit",
            "unique" => "Kolom :attribute sudah ada"
        ];

        $this->validate($request, [
            "nip" => "required|numeric|min:1",
            "nama" => "required",
            "no_hp" => "required|numeric|min:1",
            "alamat" => "required"
        ], $message);

    	Guru::where("nip", $request->nip)->update([
    		"nama" => $request->nama,
    		"jenis_kelamin" => $request->jenis_kelamin,
    		"no_hp" => $request->no_hp,
    		"alamat" => $request->alamat
    	]);

    	return redirect()->back()->with("sukses", "Data Berhasil di Update");
    }
}

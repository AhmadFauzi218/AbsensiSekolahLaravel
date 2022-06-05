<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Guru;
use App\Model\GuruPiket;
use App\User;

class GuruPiketController extends Controller
{
    public function data_guru_piket()
    {
    	$data["data_guru"] = Guru::orderBy("nama", "ASC")->get();
    	$data["data_guru_piket"] = GuruPiket::orderBy("hari", "DESC")->get();

    	return view("content.page.admin.guru_piket.data_guru_piket", $data);
    }

    public function simpan_data_guru_piket(Request $request)
    {
        $message = [
            "required" => "Kolom :attribute tidak boleh kosong",
            "unique" => "Kolom :attribute sudah ada"
        ];

        $this->validate($request, [
            "nip_guru" => "required",
            "hari" => "required"
        ], $message);

        $guru_piket = new GuruPiket;

        $cek_double = $guru_piket->where(["nip_guru" => $request->nip_guru, "hari" => $request->hari])->count();

        if ($cek_double > 0) {
            return redirect()->back()->with("error", "Data Jadwal Piket ".$request->nip_guru." di hari ".$request->hari." Sudah");
        }

    	$guru_piket = new GuruPiket;
    	$guru_piket->nip_guru = $request->nip_guru;
    	$guru_piket->hari = $request->hari;
    	$guru_piket->status = 1;
    	$guru_piket->save();

    	$guru = Guru::where("nip", $request->nip_guru)->first();
    	$nama_guru = $guru->nama;

    	$user = new User;
    	$user->name = $nama_guru;
    	$user->username = $request->nip_guru;
    	$user->password = bcrypt("gurupiket".$request->nip_guru);
    	$user->role = 3;
    	$user->active = 1;
    	$user->save();

    	return redirect()->back()->with("sukses", "Data Berhasil di Inputkan");
    }

    public function hapus_data_guru_piket($nip)
    {
    	GuruPiket::where("nip_guru", $nip)->delete();

    	User::where("role", 3)->where("username", $nip)->delete();
    	
    	return redirect()->back()->with("sukses", "Data Berhasil di Hapus");
    }

    public function edit_guru_piket(Request $request)
    {
    	$data["edit"] = GuruPiket::where("id", $request->id)->first();
    	$data["data_guru"] = Guru::orderBy("nama", "ASC")->get();

    	return view("content.page.admin.guru_piket.edit_data_guru_piket", $data);
    }

    public function update_data_guru_piket(Request $request)
    {
    	GuruPiket::where("id", $request->id)->update([
    		"nip_guru" => $request->nip_guru,
    		"hari" => $request->hari
    	]);

    	$data_guru = Guru::where("nip", $request->nip_guru)->first();
    	$nama = $data_guru->nama;

    	$user = User::where("role", 3)->where("username", $request->nip_lama)->first();
    	$user->name = $nama;
    	$user->username = $request->nip_guru;
    	$user->password = bcrypt("gurupiket".$request->nip_guru);
    	$user->save();

    	return redirect()->back()->with("sukses", "Data Berhasil di Simpan");
    }
}

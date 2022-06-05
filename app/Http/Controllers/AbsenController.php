<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Absen;
use App\Model\Siswa;
use App\Model\Kelas;
use Auth;
class AbsenController extends Controller
{
    public function tambah_absen()
    {
    	$id_kelas = Auth::user()->id_kelas;
    	$data["data_siswa"] = Siswa::where("id_kelas", $id_kelas)->orderBy("nama", "ASC")->paginate(10);
        $data["total"] = Siswa::where("id_kelas", $id_kelas)->count();
        $data["kelas"] = Kelas::where("id", $id_kelas)->first();
    	return view("content.page.walikelas.absen.tambah_data_absen", $data);
    }

    public function simpan_data_absen(Request $request)
    {
        $message = [
            "required" => "Kolom :attribute tidak boleh kosong"
        ];

        $this->validate($request, [
            "absen_status" => "required",
            "absen_date" => "required"
        ], $message);

    	$absen = new Absen;
    	$absen->id_user = $request->id_user;
    	$absen->nis_siswa = $request->nis_siswa;
    	$absen->absen_date = $request->absen_date;
    	$absen->absen_time = date("H:i:s");
    	$absen->absen_status = $request->absen_status;
    	if ($absen->absen_status == 1) {
    		$absen->keterangan = "Hadir";
    	}else if($absen->absen_status == 4) {
            $absen->keterangan = "Tidak Ada Keterangan";
        }else {
            $this->validate($request, [
                "keterangan" => "required"
            ], $message);

    		$absen->keterangan = $request->keterangan;
    	}
    	$absen->save();

    	return redirect()->back()->with("sukses", "Data Berhasil di Inputkan");
    }

    public function data_absen()
    {
        $id = Auth::user()->id_kelas;
        $data["data_absen"] = Absen::orderBy("absen_date", "ASC")->orderBy("absen_time", "ASC")->paginate(10);
        $data["kelas"] = Kelas::where("id", $id)->first();
        $data["total"] = Siswa::where("id_kelas", $id)->count();

        return view("content.page.walikelas.absen.data_absen", $data);
    }

    public function update_data_absen(Request $request)
    {
        $message = [
            "required" => "Kolom :attribute tidak boleh kosong"
        ];

        $this->validate($request, [
            "absen_status" => "required"
        ], $message);

        $absen = Absen::where("id", $request->id)->first();
        $absen->absen_status = $request->absen_status;

        if ($absen->absen_status == 1) {
            $absen->keterangan = "Hadir";
        } else {
            $this->validate($request, [
                "keterangan" => "required"
            ], $message);

            $absen->keterangan = $request->keterangan;
        }

        $absen->save();

        return redirect()->back()->with("sukses", "Data Berhasil di Update");
    }

    public function data_siswa_terlambat()
    {
        $data["data_absen"] = Absen::where("absen_status", 5)->get();

        return view("content.page.gurupiket.data_siswa_terlambat", $data);
    }

    public function tambah_absen_terlambat()
    {
        $data["data_siswa"] = Siswa::orderBy("id_kelas", "DESC")->orderBy("nama", "ASC")->get();

        return view("content.page.gurupiket.tambah_absen_terlambat", $data);
    }

    public function simpan_data_absen_terlambat(Request $request)
    {
        $message = [
            "required" => "Kolom :attribute tidak boleh kosong"
        ];

        $this->validate($request, [
            "absen_status" => "required"
        ], $message);

        $absen = new Absen;
        $absen->id_user = Auth::user()->id;
        $absen->nis_siswa = $request->nis_siswa;
        $absen->absen_date = date("Y-m-d");
        $absen->absen_time = date("H:i:s");
        $absen->absen_status = $request->absen_status;
        if ($absen->absen_status == 5) {
            $this->validate($request, [
                "keterangan" => "required"
            ], $message);

            $absen->keterangan = $request->keterangan;
        }
        
        $absen->save();

        return redirect()->back()->with("sukses", "Data Berhasil di Inputkan");
    }

    public function update_data_siswa_terlambat(Request $request)
    {
        $message = [
            "required" => "Kolom :attribute tidak boleh kosong"
        ];

        $this->validate($request, [
            "keterangan" => "required"
        ]);

        Absen::where("id", $request->id)->update([
            "keterangan" => $request->keterangan
        ]);

        return redirect()->back()->with("sukses", "Data Berhasil di Simpan");
    }
}

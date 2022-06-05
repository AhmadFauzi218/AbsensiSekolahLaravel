<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Siswa;
use App\Model\Absen;
use App\Model\Kelas;
use App\Model\Guru;
use App\Model\GuruPiket;
use Auth;

class AppController extends Controller
{
    public function theme()
    {
    	return view("content.page.layouts.theme");
    }

    public function dashboard()
    {
        $data["total_guru"] = Guru::count();
        $data["total_kelas"] = Kelas::count();
        $data["total_siswa"] = Siswa::count();
        $data["total_guru_piket"] = GuruPiket::count();

        $id_kelas = Auth::user()->id_kelas;
        $data["data_siswa"] = Siswa::where("id_kelas", $id_kelas)->orderBy("nama", "ASC")->get();

    	return view("content.page.dashboard", $data);
    }

    public function data_laporan()
    {
        $id_kelas = Auth::user()->id_kelas;
        $data["data_siswa"] = Siswa::where("id_kelas", $id_kelas)->orderBy("nama", "ASC")->paginate(10);
        $data["kelas"] = Kelas::where("id", $id_kelas)->first();

        $data["data_absen_siswa"] = Siswa::orderBy("id_kelas", "ASC")->orderBy("nama", "ASC")->paginate(10);

        return view("content.page.report.data_laporan", $data);
    }

    public function laporan_perhari()
    {
        $id_kelas = Auth::user()->id_kelas;
        $data["data_siswa"] = Siswa::where("id_kelas", $id_kelas)->orderBy("nama", "ASC")->paginate(10);
        $data["kelas"] = Kelas::where("id", $id_kelas)->first();

        $data["data_absen_siswa"] = Siswa::orderBy("id_kelas", "ASC")->orderBy("nama", "ASC")->paginate(10);

        return view("content.page.report.laporan_perhari", $data);
    }

    public function lihat_data_laporan_keseluruhan()
    {
        $data["data_absen_siswa"] = Siswa::orderBy("id_kelas", "ASC")->orderBy("nama", "ASC")->get();

        return view("content.page.print.print_keseluruhan_data", $data);
    }

    public function lihat_data_laporan_perhari()
    {
        $data["data_absen_siswa"] = Siswa::orderBy("id_kelas", "ASC")->orderBy("nama", "ASC")->get();

        return view("content.page.print.print_perharian_data", $data);
    }

    public function lihat_keseluruhan_laporan_perkelas()
    {
        $id_kelas = Auth::user()->id_kelas;
        $data["data_siswa"] = Siswa::where("id_kelas", $id_kelas)->orderBy("nama", "ASC")->get();
        $data["kelas"] = Kelas::where("id", $id_kelas)->first();

        $data["data_absen_siswa"] = Siswa::orderBy("id_kelas", "ASC")->orderBy("nama", "ASC")->paginate(10);

        return view("content.page.print.print_keseluruhan_laporan_perkelas", $data);
    }

    public function lihat_data_laporan_perhari_perkelas()
    {
        $id_kelas = Auth::user()->id_kelas;
        $data["data_siswa"] = Siswa::where("id_kelas", $id_kelas)->orderBy("nama", "ASC")->get();
        $data["kelas"] = Kelas::where("id", $id_kelas)->first();

        $data["data_absen_siswa"] = Siswa::orderBy("id_kelas", "ASC")->orderBy("nama", "ASC")->paginate(10);
        
        return view("content.page.print.print_laporan_pertanggal_kelas", $data);   
    }
}

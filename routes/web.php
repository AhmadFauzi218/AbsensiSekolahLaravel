<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get("/", function () {
	return view("welcome");
});

Route::group(["middleware" => ["guest"]], function () {
	Route::get("/login", "LoginController@login");
	Route::post("/login", "LoginController@post_login");
});

Route::group(["middleware" => ["admin"]], function () {
	Route::get("/theme", "AppController@theme");
	Route::prefix("page")->group(function() {
		Route::get("/dashboard", "AppController@dashboard");

		// Data Guru
		Route::get("/guru", "GuruController@data_guru");
		Route::post("/simpan_data_guru", "GuruController@simpan_data_guru");
		Route::get("/hapus_data_guru/{nip}", "GuruController@hapus_data_guru");
		Route::get("/edit_data_guru", "GuruController@edit_data_guru");
		Route::put("/update_data_guru", "GuruController@update_data_guru");

		// Data Kelas
		Route::get("/kelas", "KelasController@data_kelas");
		Route::post("/simpan_data_kelas", "KelasController@simpan_data_kelas");
		Route::get("/hapus_data_kelas/{id}", "KelasController@hapus_data_kelas");
		Route::get("/edit_data_kelas", "KelasController@edit_data_kelas");
		Route::put("/update_data_kelas", "KelasController@update_data_kelas");

		// Data Siswa
		Route::get("/siswa", "SiswaController@data_siswa");
		Route::post("/simpan_data_siswa", "SiswaController@simpan_data_siswa");
		Route::get("/hapus_data_siswa/{nis}", "SiswaController@hapus_data_siswa");
		Route::get("/edit_data_siswa", "SiswaController@edit_data_siswa");
		Route::put("/update_data_siswa", "SiswaController@update_data_siswa");

		// Data Guru Piket
		Route::get("/guru_piket", "GuruPiketController@data_guru_piket");
		Route::post("/simpan_data_guru_piket", "GuruPiketController@simpan_data_guru_piket");
		Route::get("/hapus_data_guru_piket/{nip}", "GuruPiketController@hapus_data_guru_piket");
		Route::get("/edit_guru_piket", "GuruPiketController@edit_guru_piket");
		Route::put("/update_data_guru_piket", "GuruPiketController@update_data_guru_piket");

		// Data Absen
		Route::get("/tambah_absen", "AbsenController@tambah_absen");
		Route::post("/simpan_data_absen", "AbsenController@simpan_data_absen");
		Route::get("/data_absen", "AbsenController@data_absen");
		Route::put("/update_data_absen", "AbsenController@update_data_absen");

		// Data Absen Terlambat
		Route::get("/tambah_absen_terlambat", "AbsenController@tambah_absen_terlambat");
		Route::post("/simpan_data_absen_terlambat", "AbsenController@simpan_data_absen_terlambat");
		Route::get("/data_siswa_terlambat", "AbsenController@data_siswa_terlambat");
		Route::post("/update_data_siswa_terlambat", "AbsenController@update_data_siswa_terlambat");

		// Data Laporan
		Route::get("/laporan", "AppController@data_laporan");
		Route::get("/laporan_perhari", "AppController@laporan_perhari");

		// Data Print
		Route::get("/lihat_data_laporan_keseluruhan", "AppController@lihat_data_laporan_keseluruhan");
		Route::get("/lihat_data_laporan_perhari", "AppController@lihat_data_laporan_perhari");
		Route::get("/lihat_keseluruhan_laporan_perkelas", "AppController@lihat_keseluruhan_laporan_perkelas");
		Route::get("/lihat_data_laporan_perhari_perkelas", "AppController@lihat_data_laporan_perhari_perkelas");
		// Data Users
		Route::get("/users", "UserController@user");
		Route::post("/simpan_data_users", "UserController@simpan_data_users");
		Route::put("/users", "UserController@put_users");

		Route::get("/logout", "LoginController@logout");
	});
});
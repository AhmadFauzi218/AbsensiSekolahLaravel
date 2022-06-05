<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = "kelas";

    protected $guarded = [''];

    public $timestamps = false;

    public function guru()
    {
    	return $this->belongsTo("App\Model\Guru", "nip_wali_kelas", "nip");
    }

    public function siswa()
    {
    	return $this->hasMany("App\Model\Siswa", "id_kelas", "id");
    }
}

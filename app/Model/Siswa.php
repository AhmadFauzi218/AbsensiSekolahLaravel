<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = "siswa";

    protected $guarded = [''];

    public $timestamps = false;

    public function kelas()
    {
    	return $this->belongsTo("App\Model\Kelas", "id_kelas", "id");
    }
}

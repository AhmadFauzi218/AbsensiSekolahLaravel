<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    protected $table = "absen";

    protected $guarded = [''];

    public $timestamps = false;

    public function siswa()
    {
    	return $this->belongsTo("App\Model\Siswa", "nis_siswa", "nis");
    }
}

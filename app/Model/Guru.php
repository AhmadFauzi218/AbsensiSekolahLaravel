<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table = "guru";

    protected $guarded = [''];

    public $timestamps = false;

    public function kelas()
    {
    	return $this->hasOne("App\Model\Kelas", "nip_wali_kelas", "nip");
    }
}

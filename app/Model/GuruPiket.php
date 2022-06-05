<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class GuruPiket extends Model
{
    protected $table = "jadwal_piket";

    protected $guarded = [''];

    public $timestamps = false;

    public function guru()
    {
    	return $this->belongsTo("App\Model\Guru", "nip_guru", "nip");
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class Pekerjaan extends Model
{
    

    protected $table = 'pekerjaans';
    protected $fillable = [
        'id',
        'nama_pekerjaan',
    ];

    public function anggota()
    {
        return $this->hasMany(Anggota::class, 'pekerjaan_id');
    }
  

}

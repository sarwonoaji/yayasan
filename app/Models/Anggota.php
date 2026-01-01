<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Anggota extends Model
{
    use SoftDeletes;

    protected $table = 'anggotas';

    protected $fillable = [
        'nik',
        'no_kk',
        'status_kk',
        'nama_lengkap',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'golongan_darah',
        'status_perkawinan',
        'pekerjaan_id',
        'desa',
        'rt',
        'rw',
        'kelurahan',
        'kecamatan',
        'kabupaten',
        'provinsi',
        'tanggal_masuk',
        'no_telp',
        'foto',
        'maps',
        'latitude',
        'longitude',
        'is_deleted',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'tanggal_masuk' => 'date',
        'is_deleted' => 'boolean',
    ];

    /**
     * Get the full address attribute
     */
    public function getFullAddressAttribute()
    {
        return implode(', ', array_filter([
            $this->desa,
            'RT ' . $this->rt,
            'RW ' . $this->rw,
            $this->kelurahan,
            $this->kecamatan,
            $this->kabupaten,
            $this->provinsi,
        ]));
    }

    /**
     * Get umur based on tanggal_lahir
     */
    public function getUmurAttribute()
    {
        if ($this->tanggal_lahir) {
            return $this->tanggal_lahir->diffInYears(now());
        }
        return null;
    }
    public function pekerjaan()
    {
        return $this->belongsTo(Pekerjaan::class, 'pekerjaan_id');
    }
}

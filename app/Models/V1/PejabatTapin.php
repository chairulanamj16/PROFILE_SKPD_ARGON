<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PejabatTapin extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function anakPejabats()
    {
        return $this->hasMany(AnakPejabat::class);
    }

    public function riwayatPendidikanPejabats()
    {
        return $this->hasMany(RiwayatPendidikanPejabat::class);
    }

    public function riwayatOrganisasiPejabats()
    {
        return $this->hasMany(RiwayatOrganisasiPejabat::class);
    }

    public function riwayatPekerjaanPejabats()
    {
        return $this->hasMany(RiwayatPekerjaanPejabat::class);
    }

    public function riwayatPenghargaanPejabats()
    {
        return $this->hasMany(RiwayatPenghargaanPejabat::class);
    }

    // v3
    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('nama', 'like', '%' . $search . '%')
                ->orWhere('jabatan', 'like', '%' . $search . '%')
                ->orWhere('periode', 'like', '%' . $search . '%')
                ->orWhere('status', 'like', '%' . $search . '%');
        });
    }
}

<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\V1\PejabatTapin;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PejabatTapinController extends Controller
{
    function detail($jabatan): Response
    {
        $jabatan =   PejabatTapin::with(['anakPejabats', 'riwayatPendidikanPejabats', 'riwayatOrganisasiPejabats', 'riwayatPekerjaanPejabats', 'riwayatPenghargaanPejabats'])
            ->where('status', 'aktif')
            ->where('jabatan', $jabatan)
            ->first();

        return response([
            'code' => '200',
            'status' => 'Success',
            'data' => $jabatan,
        ]);
    }
}

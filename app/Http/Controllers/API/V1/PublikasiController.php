<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\V1\Office;
use App\Models\V1\Publication;

class PublikasiController extends Controller
{
    public function publikasi($subdomain)
    {
        $office = Office::where('subdomain', $subdomain)->first();

        $publikasi = Publication::where('office_id', $office->id)->get();

        return $publikasi;
    }
}

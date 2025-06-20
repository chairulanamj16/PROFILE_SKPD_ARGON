<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\V1\Office;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function index($account)
    {
        $data['office'] = Office::where('subdomain', $account)->first();
        return view('frontend.bootslander.beranda', $data);
    }
}

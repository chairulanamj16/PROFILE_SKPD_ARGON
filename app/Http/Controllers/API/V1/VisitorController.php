<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\V1\Visitor;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    public function visitor($date)
    {
        $day = Visitor::whereDay('created_at', $date)->count();
        $month = Visitor::whereMonth('created_at', date('m-Y', strtotime($date)))->count();
        $year = Visitor::whereYear('created_at', date('Y', strtotime($date)))->count();

        return response([
            'day' => $day,
            'month' => $month,
            'year' => $year,
        ]);
    }
}

<?php

namespace App\Http\Middleware;

use App\Models\V1\Visitor as ModelsVisitor;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Visitor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Dapatkan informasi tentang pengunjung
        $ipAddress = $request->ip();
        $userAgent = $request->header('User-Agent');
        $visitTime = Carbon::now();
        $pageVisited = $request->path(); // Mendapatkan URI halaman yang diakses
        $method = $request->method(); // Mendapatkan metode HTTP yang digunakan
        $isLoggedIn = Auth::check();


        // Periksa apakah pengunjung sudah ada dalam bulan ini
        $existingVisitor = ModelsVisitor::where('ip_address', $ipAddress)
            ->where('user_agent', $userAgent)
            // ->whereBetween('visit_time', [
            //     $visitTime->startOfMonth(),
            //     $visitTime->endOfMonth()
            // ])
            ->whereDate('visit_time', now())
            ->where('method', $method)
            ->where('page_visited', $pageVisited)
            ->first();

        // Jika pengunjung belum ada dalam bulan ini, simpan informasinya
        if (!$existingVisitor) {
            // Simpan informasi pengunjung ke database
            ModelsVisitor::create([
                'ip_address' => $ipAddress,
                'user_agent' => $userAgent,
                'visit_time' => now(),
                'page_visited' => $pageVisited,
                'method' => $method,
                'is_logged_in' => $isLoggedIn,
            ]);
        } else {
            ModelsVisitor::where('id', $existingVisitor->id)
                ->update(['page_visited' => $pageVisited]);
        }


        return $next($request);
    }
}

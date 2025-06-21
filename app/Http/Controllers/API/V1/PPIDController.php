<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\PPIDResource;
use App\Models\V1\Ppid;
use App\Models\V1\PpidCategory;
use App\Models\V1\Office;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class PPIDController extends Controller
{
    public function ppid(Request $request)
    {
        $paginate = $request->input('paginate') ? $request->input('paginate') : 12;
        $ppid = Ppid::orderBy('id', 'DESC')->where('status', 'publikasi')->paginate($paginate);
        return PPIDResource::collection($ppid);
    }

    public function byTopDownload(Request $request)
    {
        $paginate = $request->input('paginate') ? $request->input('paginate') : 12;
        $ppid = Ppid::orderBy('didownload', 'DESC')
            ->where('status', 'publikasi')
            ->paginate($paginate);
        return PPIDResource::collection($ppid);
    }

    public function byFilter(Request $request)
    {

        $title = $request->input('title');
        $category_id = $request->input('category_id');
        $office_id = $request->input('office_id');
        // Lakukan pencarian dengan kriteria yang diberikan
        $query = PPID::query();


        if ($title) {
            $query->where('title', 'LIKE', '%' . $title . '%');
        }

        if ($category_id) {
            $category = PpidCategory::where('id', $category_id)->first();
            if (!empty($category)) {
                $query->whereHas('ppid_category', function ($query) use ($category) {
                    $query->where('id', $category->id);
                });
            }
        }

        if ($office_id) {
            $office = Office::find($office_id);
            if (!empty($office)) {
                $query->where('office_id', $office->id);
            }
        }
        $paginate = $request->input('paginate') ? $request->input('paginate') : 12;

        $ppid = $query
            ->where('status', 'publikasi')
            ->paginate($paginate);

        return PPIDResource::collection($ppid);
    }

    public function detail(Request $request, PPID $ppid)
    {

        $ppid = PPID::where('id', $ppid->id)
            ->with(['office', 'ppid_category'])
            ->first();

        return $ppid;
    }

    public function download_file(Request $request, PPID $ppid)
    {

        $ppid->update([
            'didownload' => $ppid->didownload + 1
        ]);
        return 'Success';
        // return public_path('storage') . '/' . $ppid->file;
        // return Response::download($file);

    }

    public function count(Request $request)
    {
        $berkala = $request->input('berkala');
        $setiap_saat = $request->input('setiap_saat');
        $serta_merta = $request->input('serta_merta');
        $dikecualikan = $request->input('dikecualikan');
        if ($berkala) {
            $category_berkala = PPID::where('ppid_category_id', '1')->count();
        }
        if ($setiap_saat) {
            $category_setiap_saat = PPID::where('ppid_category_id', '2')->count();
        }
        if ($serta_merta) {
            $category_serta_merta = PPID::where('ppid_category_id', '3')->count();
        }
        if ($dikecualikan) {
            $category_dikecualikan = PPID::where('ppid_category_id', '4')->count();
        }
        $documents = PPID::where('status', 'publikasi')->count();
        $document_downloads = PPID::where('status', 'publikasi')->pluck('didownload')->sum();

        return response([
            'document_count' => $documents,
            'document_downloads' => $document_downloads,
            'berkala' => $berkala ? $category_berkala : null,
            'setiap_saat' => $setiap_saat ? $category_setiap_saat : null,
            'serta_merta' => $serta_merta ? $category_serta_merta : null,
            'dikecualikan' => $dikecualikan ? $category_dikecualikan : null,
        ], 200);
    }
}

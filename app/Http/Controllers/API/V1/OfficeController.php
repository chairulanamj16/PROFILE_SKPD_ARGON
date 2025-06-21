<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\OfficeResource;
use App\Http\Resources\V1\TopOfficeResource;
use App\Models\V1\Gallery;
use App\Models\V1\Office;
use App\Models\V1\VideoGallery;
use Illuminate\Http\Request;

class OfficeController extends Controller
{
    public function offices(Request $request)
    {
        $office = Office::orderBY('name', 'ASC')->get();
        return OfficeResource::collection($office);
    }

    public function office(Request $request, $subdomain)
    {
        $office = Office::with(['visimisi', 'tupoksi', 'sejarahpembentukan', 'organization'])
            ->where('subdomain', $subdomain)
            ->first();
        return new OfficeResource($office);
    }

    public function top_office(Request $request)
    {
        $limit =  $request->input('limit') ? $request->input('limit') : 6;
        $office = Office::orderBY('posts_count', 'desc')->withCount('posts')->limit($limit)->get();
        return TopOfficeResource::collection($office);
    }

    public function galleries(Request $request, $subdomain)
    {
        $office = Office::with(['galleries'])
            ->where('subdomain', $subdomain)
            ->first();
        return $office;
    }

    public function office_galleries(Request $request)
    {
        $paginate = $request->input('paginate') ? $request->input('paginate') : 10;
        if ($request->input('live') == 'aktif') {
            $gallery = VideoGallery::where('show_tapinkab', 1)->where('status_live', 1)->orderBy('id', 'DESC')->paginate($paginate);
        } else {
            $gallery = VideoGallery::where('show_tapinkab', 1)->orderBy('id', 'DESC')->paginate($paginate);
        }
        return $gallery;
    }

    public function office_galleries_foto(Request $request)
    {
        $paginate = $request->input('paginate') ? $request->input('paginate') : 10;
        $gallery = Gallery::where('show_tapinkab', 1)->orderBy('id', 'DESC')->paginate($paginate);
        return $gallery;
    }
}

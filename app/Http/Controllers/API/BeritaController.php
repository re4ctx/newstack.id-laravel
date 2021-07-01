<?php

namespace App\Http\Controllers\API;

use App\Models\Berita;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class BeritaController extends Controller
{

    public function categoryBerita($kategori){
        
        $beritas = DB::table('beritas')->where('kategori', $kategori)->orderBy('id', 'desc')->get();
        
        if (count($beritas) > 0) {
            return response()->json($beritas);
        } else {
            return response()->json(["status" => "failed", "success" => false, "message" => "Whoops! no berita found"]);
        }
    }

    public function relatedPost($kategori, $limit){
        $beritas = DB::table('beritas')->where('kategori', $kategori)->orderBy('id', 'desc')->limit($limit)->get();
        
        if (count($beritas) > 0) {
            return response()->json($beritas);
        } else {
            return response()->json(["status" => "failed", "success" => false, "message" => "Whoops! no berita found"]);
        }
    }

    public function beritasListing()
    {
        

        $beritas = DB::table('beritas')->orderBy('id', 'desc')->get();
        if (count($beritas) > 0) {
            return response()->json($beritas);
        } else {
            return response()->json(["status" => "failed", "success" => false, "message" => "Whoops! no berita found"]);
        }
    }

    public function beritaDetail($id)
    {
        $berita        =       Berita::find($id);
        if (!is_null($berita)) {
            return response()->json($berita);
        } else {
            return response()->json(["status" => "failed", "success" => false, "message" => "Whoops! no berita found"]);
        }
    }
}

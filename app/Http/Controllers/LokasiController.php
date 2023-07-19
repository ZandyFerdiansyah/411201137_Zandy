<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Lokasi;
use JWTAuth;

class LokasiController extends Controller
{
    public function getLokasi(){
        $lokasi = Lokasi::orderBy("id", "desc")->get();

        return Helper::toJson($lokasi);
    }

    public function tambahLokasi(Request $request)
    {

        $lokasi = new Lokasi();
        $lokasi->kode_lokasi = $request->kode_lokasi;
        $lokasi->nama_lokasi = $request->nama_lokasi;
        $lokasi->save();

        return Helper::toJson($lokasi, "Data lokasi sudah ditambah");
        
    }

    public function ubahLokasi(Request $request)
    {

        $lokasi = Lokasi::where("id", $request->id)->first();
        $lokasi->kode_lokasi = $request->kode_lokasi;
        $lokasi->nama_lokasi = $request->nama_lokasi;
        $lokasi->save();

        return Helper::toJson($lokasi, "Data lokasi sudah diubah");
        
    }

    public function hapusLokasi($id)
    {

        $lokasi = Lokasi::where('id', $id)->first();
        Lokasi::where('id', $id)->delete();

        return Helper::toJson("", "Data lokasi sudah dihapus");
        
    }
    
}

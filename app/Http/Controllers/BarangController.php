<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Pengiriman;
use App\Lokasi;
use App\Barang;
use App\User;
use App\ViewPengiriman;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Carbon\Carbon;
use JWTAuth;


class BarangController extends Controller
{
    public function getBarang(){
        $barang = Barang::orderBy("id", "desc")->get();
        return Helper::toJson($barang);
    }

    public function tambahBarang(Request $request)
    {

        $barang = new Barang();
        $barang->kode_barang = $request->kode_barang;
        $barang->nama_barang = $request->nama_barang;
        $barang->deskripsi = $request->deskripsi;
        $barang->stok_barang = $request->stok_barang;
        $barang->harga_barang = $request->harga_barang;
        $barang->save();

        return Helper::toJson($barang, "Data barang sudah ditambah");
        
    }

    public function ubahBarang(Request $request)
    {

        $barang = Barang::where("id", $request->id)->first();
        $barang->kode_barang = $request->kode_barang;
        $barang->nama_barang = $request->nama_barang;
        $barang->deskripsi = $request->deskripsi;
        $barang->stok_barang = $request->stok_barang;
        $barang->harga_barang = $request->harga_barang;
        $barang->save();

        return Helper::toJson($barang, "Data barang sudah diubah");
        
    }

    public function hapusBarang($id)
    {

        $barang = Barang::where('id', $id)->first();
        Barang::where('id', $id)->delete();

        return Helper::toJson("", "Data barang sudah dihapus");
        
    }
    
}

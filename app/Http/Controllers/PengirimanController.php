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

class PengirimanController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
            $listPengiriman = ViewPengiriman::all();
        
       
        return view('pengiriman.index', compact('listPengiriman'));
    }

    public function create()
    {
        $barangs = Barang::all();
        $lokasi = Lokasi::all();
        $users = User::all();
         return view('pengiriman.create', compact('barangs', 'lokasi','users'));

  
    }

    public function store(Request $request)
    {

        
        $today = Carbon::today();
        $dataPengiriman = ViewPengiriman::whereDate('created_at', $today)->where("id_lokasi", $request->input('lokasi_id'))->count();



        $messages = [
            'barang_id.required' => 'Mohon isi id barang terlebih dahulu',
            'barang_id.required' => 'Mohon isi id barang terlebih dahulu',
            'kurir_id.required' => 'Mohon isi id lokasi terlebih dahulu',
            'harga_barang.required' => 'Mohon isi harga barang terlebih dahulu',
            'jumlah_barang.required' => 'Mohon isi jumlah barang terlebih dahulu',
            'status.required' => 'Mohon isi status terlebih dahulu',
            'tanggal.required' => 'Mohon isi tanggal terlebih dahulu',
            'no_pengiriman.required' => 'Mohon isi nomor pengiriman terlebih dahulu',
            'no_pengiriman.unique' => 'Mohon nomor pengiriman tidak boleh sama',
            ];
            $validator = Validator::make($request->all(),[
                'barang_id' => 'required',
                'lokasi_id' => 'required',
                'kurir_id' => 'required',
                'harga_barang' => 'required',
                'jumlah_barang' => 'required',
                'status' => 'required',
                'tanggal' => 'required',
                'no_pengiriman' => 'required|unique:pengiriman',

            ], $messages);
            if($validator->fails()){
            $messages = $validator->messages();
            return Redirect::back()->withErrors($messages)->withInput($request->all());
            }
            
            if($dataPengiriman > 5){
                return \redirect('pengiriman')->with('error', 'Data pengiriman sudah lebih dari 5x hari ini');
            }

        $pengiriman = New Pengiriman();
        $pengiriman->no_pengiriman = $request->input('no_pengiriman');
        $pengiriman->kurir_id = $request->input('kurir_id');
        $pengiriman->tanggal = $request->input('tanggal');
        $pengiriman->barang_id = $request->input('barang_id');
        $pengiriman->lokasi_id = $request->input('lokasi_id');
        $pengiriman->jumlah_barang = $request->input('jumlah_barang');
        $pengiriman->harga_barang = $request->input('harga_barang');
        $pengiriman->jumlah_barang = $request->input('jumlah_barang');
        $pengiriman->status = $request->input('status');
        $pengiriman->save();

        return \redirect('pengiriman')->with('success', 'Tambah data berhasil');
    }


    public function destroy($id)
    {
        $pengiriman = Pengiriman::find($id);
        $pengiriman->delete();

        return \redirect('pengiriman')->with('success', 'Delete data pengiriman berhasil');
    }

    public function getPengiriman(){
        $pengiriman = Pengiriman::orderBy("id", "desc")->get();
        

        return Helper::toJson($pengiriman);
    }

    public function tambahPengiriman(Request $request)
    {
        $user = JWTAuth::user();
        $randomNumber = rand(0, 99999);

        $barang = Barang::where("id", $request->barang_id)->first();
        $lokasi = Lokasi::where("id", $request->lokasi_id)->first();


        if($barang == null || $lokasi == null){
            return Helper::toJson("", "Data Barang / Lokasi yang anda masukkan salah",false);

        } else {

                $pengiriman = new Pengiriman();
                $pengiriman->no_pengiriman = $randomNumber;
                $pengiriman->tanggal = $request->tanggal;
                $pengiriman->lokasi_id = $request->lokasi_id;
                $pengiriman->barang_id = $request->barang_id;
                $pengiriman->jumlah_barang = $request->jumlah_barang;
                $pengiriman->harga_barang = $request->harga_barang;
                $pengiriman->kurir_id = $user['id'];
                $pengiriman->status = 0;
                $pengiriman->save();

                return Helper::toJson($pengiriman, "Data Pengiriman sudah ditambah");
            
        }
    }

    public function ubahStatus(Request $request)
    {

        $pengiriman = Pengiriman::where("id", $request->id)->first();

        if($pengiriman == null){
            return Helper::toJson("", "Data Pengiriman yang anda masukkan salah",false);
        } else {
            $pengiriman->status = $request->status;
            $pengiriman->save();
            return Helper::toJson($pengiriman, "Data status sudah diubah");

        }

        // Detail Status
        // 0 = Menunggu Approve
        // 1 = Approve
        // 2 = Reject
        // 3 = Cancel

    }
}

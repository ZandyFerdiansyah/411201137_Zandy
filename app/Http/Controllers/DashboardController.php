<?php

namespace App\Http\Controllers;

use App\Barang;
use App\ViewPengiriman;
use App\Lokasi;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Helper;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Auth;


class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            //untuk pie chart
            $lastMonth = Carbon::now()->subMonth();
            $oneYearAgo = Carbon::now()->subYear();
            $threeMonth = Carbon::now()->subMonth(3);



            

            $listBarang = DB::table('view_pengiriman')->where('harga_barang', '>', 1000)->whereDate('tanggal', '>', $oneYearAgo)->
            select('nama_barang', DB::raw("count(id) as total"))->
            groupBy('id_barang')->get();

            $listLokasi = DB::table('view_pengiriman')->where('jumlah_barang', '>', 100)->whereDate('tanggal', '>', $lastMonth)->
            select('nama_lokasi', DB::raw("count(id) as total"))->
            groupBy('id_lokasi')->get();

            //get data visit/transaksi dan jumlah count
            $allVisit = ViewPengiriman::whereDate('tanggal', '>', $threeMonth);
            $countVisit = $allVisit->count();

            $trendLokasi = DB::table('view_pengiriman')->whereDate('tanggal', '>', $oneYearAgo)->
            select('nama_lokasi', DB::raw("count(id) as total"))->
            orderBy('total','desc')->
            groupBy('id_lokasi')->get();

            $trendBarang = DB::table('view_pengiriman')->whereDate('tanggal', '>', $oneYearAgo)->
            select('nama_barang', DB::raw("count(id) as total"))->
            orderBy('total','desc')->
            groupBy('id_barang')->get();

            //get data sales dan jumlah count
            $allSales = User::all();
            $countSales = $allSales->count();

            //get data outlet dan jumlah count
            $allOutlet = Lokasi::all();
            $countOutlet = $allOutlet->count();


            //get data barang dan jumlah count
            $allBarang = Barang::all();
            $countBarang = $allBarang->count();

            

            // if(Auth::user()->level == 1){
            //     return view('dashboard.index', compact('listBarang','listOutlet','countVisit','countOutlet','countSales','countBarang'));

            // } else {
            //     return redirect('transaksi');
            // }

            return view('dashboard.index', compact('listBarang','listLokasi','countVisit','trendLokasi','countSales','trendBarang'));

    }

    public function getData()
    {
        $lastMonth = Carbon::now()->subMonth();
        $oneYearAgo = Carbon::now()->subYear();

        $lokasi = DB::table('view_pengiriman')->where('jumlah_barang', '>', 100)->whereDate('created_at', '>', $lastMonth)->
            select('nama_lokasi', DB::raw("count(id) as total"))->
            groupBy('id_lokasi')->get();

            $listBarang = DB::table('view_pengiriman')->where('harga_barang', '>', 1000)->whereDate('created_at', '>', $oneYearAgo)->
            select('nama_barang', DB::raw("count(id) as total"))->
            groupBy('id_barang')->get();

            $trendLokasi = DB::table('view_pengiriman')->where('harga_barang', '>', 1000)->whereDate('created_at', '>', $oneYearAgo)->
            select('nama_lokasi', DB::raw("count(id) as total"))->
            orderBy('total','desc')->
            groupBy('id_lokasi')->get();
        

        return response()->json($trendLokasi);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('barang.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $messages = [
            'id_barang.required' => 'Mohon isi id barang terlebih dahulu',
            'id_barang.alpha_num' => 'Pastikan value yang diinput adalah alfabet dan numeric',
            'id_barang.unique' => 'Data id barang sudah ada di database',
            'kode_barang.required' => 'Mohon isi id barang terlebih dahulu',
            'kode_barang.alpha_num' => 'Pastikan value yang diinput adalah alfabet dan numeric',
            'kode_barang.unique' => 'Data id barang sudah ada di database',
            ];
            $validator = Validator::make($request->all(),[
                'id_barang' => 'required|alpha_num',
                'id_barang' => 'required|alpha_num',
                'id_barang' => 'required|unique:barang,id_barang',
                'kode_barang' => 'required|alpha_num',
                'kode_barang' => 'required|alpha_num',
                'kode_barang' => 'required|unique:barang,kode_barang',
            ], $messages);
            if($validator->fails()){
            $messages = $validator->messages();
            return Redirect::back()->withErrors($messages)->withInput($request->all());
            }

        $barang = New Barang();
        $barang->id_barang = $request->input('id_barang');
        $barang->kode_barang = $request->input('kode_barang');
        $barang->nama_barang = $request->input('nama_barang');
        $barang->stok_barang = $request->input('stok_barang');
        $barang->harga_barang = $request->input('harga_barang');
        // $barang->created_date_barang = $request->input('created_date_barang');
        // $barang->update_at_barang = $request->input('update_at_barang');
        $barang->save();

        return \redirect('barang')->with('success', 'Tambah data berhasil');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_barang)
    {
        $detail = Barang::find($id_barang);

        return view('barang.detail', compact('detail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_barang)
    {
        $detail = Barang::find($id_barang);

        return view('barang.edit', compact('detail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_barang)
    {
        $barang = Barang::find($id_barang);
        $barang->id_barang = $request->input('id_barang');
        $barang->kode_barang = $request->input('kode_barang');
        $barang->nama_barang = $request->input('nama_barang');
        $barang->stok_barang = $request->input('stok_barang');
        $barang->harga_barang = $request->input('harga_barang');
        $barang->save();

        return \redirect('barang')->with('success', 'Ubah data berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_barang)
    {
        $barang = Barang::find($id_barang);
        $barang->delete();

        return \redirect('barang')->with('success', 'Delete data berhasil');
    }

    public function getBarang(){
        $barang = Barang::orderBy("id", "desc")->get();
        return Helper::toJson($barang);
    }

    public function tambahBarang(Request $request)
    {

        $barang = new Barang();
        $barang->kode_barang = $request->kode_barang;
        $barang->nama_barang = $request->nama_barang;
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

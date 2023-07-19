@extends('layouts.layout')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    Ubah Data Transaksi
                    <div class="card-tools">
                        <a href="{{ url('transaksi') }}" class="btn btn-sm btn-primary">Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ url('transaksi/'.$detail->id) }}"> @csrf @method('PUT')

                        <div class="mb-3">
                            <label for="id_sales" class="form-label">Nama Sales</label>
                            <select name="id_sales" class="form-control" value="{{ $detail->id_sales }}">
                                @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ $user->id == $detail->id_sales ? 'selected' : '' }}>{{ $user->name }}</option>
                                @endforeach
                            </select>
                            <div class="mb-3">
                                <label for="id_barang" class="form-label">Nama Barang</label>
                                <select name="id_barang" class="form-control" value="{{ $detail->id_barang }}">
                                    @foreach ($barangs as $databarang)
                                    <option value="{{ $databarang->id }}" {{ $databarang->id == $detail->id_barang ? 'selected' : '' }}>{{ $databarang->nama_barang }}</option>
                                    @endforeach
                                </select>
                                <div class="mb-3">
                                    <label for="id_outlet" class="form-label">Nama Outlet</label>
                                    <select name="id_outlet" class="form-control" value="{{ $detail->id_outlet }}">
                                        @foreach ($outlets as $outlet)
                                        <option value="{{ $outlet->id }}" {{ $outlet->id == $detail->id_outlet ? 'selected' : '' }}>{{ $outlet->nama_outlet }}</option>
                                        </option>
                                        @endforeach
                                    </select>
                                    <div class="mb-3">
                                        <label for="jumlah_stok" class="form-label">Jumlah Stok</label>
                                        <input type="number" class="form-control" id="jumlah_stok" name="jumlah_stok"
                                            value="{{ $detail->jumlah_stok }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="jumlah_display" class="form-label">Jumlah Display</label>
                                        <input type="number" class="form-control" id="jumlah_display"
                                            name="jumlah_display" value="{{ $detail->jumlah_display }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="visit_datetime" class="form-label">Tanggal Visit</label>
                                        <input type="date" class="form-control" id="visit_datetime" name="visit_datetime" value="{{\Illuminate\Support\Carbon::parse($detail->visit_datetime)->format("Y-m-d")}}">
                                        
                                    </div>

                                    <div class="col-6">
                                        <button type="submit" class="btn btn-warning">
                                            Update
                                        </button>
                                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
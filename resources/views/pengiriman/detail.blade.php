@extends('layouts.layout')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-tools">
                        Detail Data Transaksi
                    </div>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="id" class="form-label">ID Transaksi : </label>
                        {{ $detail->id }}
                    </div>
                    <div class="mb-3">
                        <label for="id_sales" class="form-label">ID Sales : </label>
                        {{ $detail->id_sales }}
                    </div>
                    <div class="mb-3">
                        <label for="nama_sales" class="form-label">Nama Sales : </label>
                        {{ $detail->nama_sales }}
                    </div>
                    <div class="mb-3">
                        <label for="id_barang" class="form-label">Id Barang : </label>
                        {{ $detail->id_barang }}
                    </div>
                    <div class="mb-3">
                        <label for="nama_barang" class="form-label">Nama Barang : </label>
                        {{ $detail->nama_barang }}
                    </div>
                    <div class="mb-3">
                        <label for="id_outlet" class="form-label">Id Outlet :</label>
                        {{ $detail->id_outlet }}
                    </div>
                    <div class="mb-3">
                        <label for="nama_barang" class="form-label">Nama Outlet : </label>
                        {{ $detail->nama_outlet }}
                    </div>
                    <div class="mb-3">
                        <label for="jumlah_stok" class="form-label">Jumlah Stok:</label>
                        {{ $detail->jumlah_stok }}
                    </div>
                    <div class="mb-3">
                        <label for="jumlah_display" class="form-label">Jumlah Display:</label>
                        {{ $detail->jumlah_display }}
                    </div>
                    <div class="mb-3">
                        <label for="visit_datetime" class="form-label">Visit</label>
                        {{ $detail->visit_datetime }}
                    </div>
                    <div class="mb-3">
                        <label for="created_date_barang" class="form-label">Created at :</label>
                        {{ $detail->created_at}}
                    </div>
                    <div class="mb-3">
                        <label for="update_at_barang" class="form-label">Update At :</label>
                        {{ $detail->updated_at}}
                    </div>

                    <div class="col-12">
                        <a href="{{ url('transaksi') }}" class="btn btn-sm btn-primary">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
@extends('layouts.layout')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-tools">
                        Tambah Data Pengiriman
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ url('pengiriman') }}">
                        @csrf
                        <div class="mb-3{{$errors->has('no_pengiriman') ? ' alert alert-danger' : '' }}">
                            <label for="no_pengiriman" class="form-label">No Pengiriman</label>
                            <input type="text" class="form-control" id="no_pengiriman" name="no_pengiriman"
                                value="{{ old('no_pengiriman') }}">
                            @if($errors->has('no_pengiriman'))
                            <span class="help-block">
                            <strong>{{ $errors->first('no_pengiriman') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="mb-3{{$errors->has('kurir_id') ? ' alert alert-danger' : '' }}">
                            <label for="kurir_id" class="form-label">Nama Kurir</label>
                            <select name="kurir_id" class="form-control">
                                <option value="">- Pilih Nama Kurir -</option>
                                @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('kurir_id'))
                            <span class="help-block">
                            <strong>{{ $errors->first('kurir_id') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="mb-3{{$errors->has('barang_id') ? ' alert alert-danger' : '' }}">
                            <label for="barang_id" class="form-label">Nama Barang</label>
                            <select name="barang_id" class="form-control">
                                <option value="">- Pilih Nama Barang -</option>
                                @foreach ($barangs as $item)
                                <option value="{{ $item->id }}">{{ $item->nama_barang }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('barang_id'))
                            <span class="help-block">
                            <strong>{{ $errors->first('barang_id') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="mb-3{{$errors->has('lokasi_id') ? ' alert alert-danger' : '' }}">
                            <label for="lokasi_id" class="form-label">Nama Lokasi</label>
                            <select name="lokasi_id" class="form-control">
                                <option value="">- Pilih Nama Lokasi -</option>
                                @foreach ($lokasi as $lokasi)
                                <option value="{{ $lokasi->id }}">{{ $lokasi->nama_lokasi }}
                                </option>
                                @endforeach
                            </select>
                            @if($errors->has('lokasi_id'))
                            <span class="help-block">
                            <strong>{{ $errors->first('lokasi_id') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="mb-3{{$errors->has('harga_barang') ? ' alert alert-danger' : '' }}">
                            <label for="harga_barang" class="form-label">Harga Barang</label>
                            <input type="number" class="form-control" id="harga_barang" name="harga_barang"
                                value="{{ old('harga_barang') }}">
                            @if($errors->has('harga_barang'))
                            <span class="help-block">
                            <strong>{{ $errors->first('harga_barang') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="mb-3{{$errors->has('jumlah_barang') ? ' alert alert-danger' : '' }}">
                            <label for="jumlah_barang" class="form-label">Jumlah Stok</label>
                            <input type="number" class="form-control" id="jumlah_barang" name="jumlah_barang"
                                value="{{ old('jumlah_barang') }}">
                            @if($errors->has('jumlah_barang'))
                            <span class="help-block">
                            <strong>{{ $errors->first('jumlah_barang') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="mb-3{{$errors->has('tanggal') ? ' alert alert-danger' : '' }}">
                            <label for="tanggal" class="form-label">Tanggal Pengiriman</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal"
                                value="{{ old('tanggal') }}">
                            @if($errors->has('tanggal'))
                            <span class="help-block">
                            <strong>{{ $errors->first('tanggal') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="mb-3{{$errors->has('status') ? ' alert alert-danger' : '' }}">
                            <label for="status" class="form-label">Status Pengiriman</label>
                            <select name="status" class="form-control">
                                <option value="">- Pilih Status -</option>
                                <option value="0">Proses</option>
                                <option value="1">Pengiriman</option>
                                <option value="2">Selesai</option>
                            </select>
                            @if($errors->has('status'))
                            <span class="help-block">
                            <strong>{{ $errors->first('status') }}</strong>
                            </span>
                            @endif
                        </div>


                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.layout')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                    <a href="{{ url('pengiriman/create') }}" class="btn btn-md btn-primary" >Tambah Data</a>
                        <div class="card-tools">
                        </div>
                    </div>
                    <div class="card-body"> 
                        <table id="datatables1" class="table table-striped table-bordered" style="width:100%">
                            <thead class="table"> 
                                <tr> 
                                    <th scope="col">No Pengiriman</th> 
                                    <th scope="col">Nama Sales</th> 
                                    <th scope="col">Nama Barang</th> 
                                    <th scope="col">Nama Outlet</th> 
                                    <th scope="col">Harga Barang</th> 
                                    <th scope="col">Jumlah Barang</th> 
                                    <th scope="col">Tanggal Pengiriman</th> 
                                    <th scope="col">Created At</th> 
                                    <th scope="col">Update At</th> 
                                     <th scope="col">Action</th> 
                                </tr> 
                            </thead> 
                            <tbody> 
                                @foreach($listPengiriman as $key => $value) 
                                <tr> 
                                    <td>{{ $value->no_pengiriman }}</td> 
                                    <td>{{ $value->nama_pengirim }}</td>
                                    <td>{{ $value->nama_barang }}</td>
                                    <td>{{ $value->nama_lokasi }}</td>
                                    <td>{{ $value->harga_barang }}</td>
                                    <td>{{ $value->jumlah_barang }}</td>
                                    <td>{{ $value->tanggal }}</td> 
                                    <td>{{ $value->created_at }}</td> 
                                    <td>{{ $value->updated_at }}</td> 
                                    <td>
                                        <a href="{{ url('pengiriman/'.$value->id) }}" >
                                        <button class="btn btn-sm btn-success">
                                        View
                                        </button>  
                                        </a> 

                                        <a href="{{ url('pengiriman/'.$value->id.'/edit') }}" >
                                        <button class="btn btn-sm btn-warning">
                                        Edit
                                        </button>
                                        </a>
                                     <form method="POST" action="{{ url('pengiriman/'.$value->id) }}"> @csrf @method('DELETE') 
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin akan menghapus data ini?')">Delete</button> 
                                    </form> 
                                </td> 
                            </tr> 
                            @endforeach 
                            </tbody> 
                            </table> 
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection



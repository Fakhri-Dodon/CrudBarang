@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col">
            <div class="card mt-3">
                <div class="p-3">
                    <div class="row">
                        <div class="col-3">
                            <a href="{{ route('beli.create') }}" class="btn btn-primary">Beli</a>
                        </div>
                        <div class="col-9"></div>
                    </div>
                </div>
            </div>
            <div class="card p-3 mt-3">
                <table id="datatable" class="table table-striped table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Barang</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($beli as $data)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <th>{{ $data->kode }}</th>
                                <th>{{ $data->namaBarang }}</th>
                                <th>{{ $data->jumlah }} {{ $data->unit }}</th>
                                <th>{{ $data->harga }}</th>
                                <th>{{ $data->total }}</th>
                                <th>
                                    <a href="{{ route('barang.edit', encrypt($data->id)) }}" class="btn btn-primary">edit</a>
                                    <a href="{{ route('barang.show', encrypt($data->id)) }}" class="btn btn-warning">Detail</a>
                                    <button onclick="event.preventDefault(); document.getElementById('delete-form-{{ $data->id }}').submit();" class="btn btn-danger">Delete</button>
                                    <form action="{{ route('barang.destroy', encrypt($data->id)) }}" method="POST" style="display: none;" id="delete-form-{{ $data->id }}">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
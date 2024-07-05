@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card mt-3">
                    <div class="p-3">
                        <div class="row">
                            <div class="col-3">
                                <a href="{{ route('barang.index') }}" class="btn btn-primary">Kembali</a>
                            </div>
                            <div class="col-9"></div>
                        </div>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-body">
                        <form action="{{ route('barang.update', encrypt($id) )}}" method="POST" ecrtype="multipart/form-data">
                            <h3>Detail Barang</h3>
                            <div class="row mb-3">
                                <div class="col-12 mb-3">
                                    <div class="form-group">
                                        <label for="">Nama Barang: </label>
                                        <input name="name" type="text" class="form-control" value="{{ $data->name }}" readonly>
                                    </div>
                                </div>
                                <div class="col-12 mb-3">
                                    <div class="form-group">
                                        <label for="">Quantity: </label>
                                        <input name="qty" type="number" class="form-control" value="{{ $data->qty }}" readonly>
                                    </div>
                                </div>
                                <div class="col-12 mb-3">
                                    <div class="form-group">
                                        <label for="">Unit Barang: </label>
                                        <input name="unit" type="text" class="form-control" value="{{ $data->unit }}" readonly>
                                    </div>
                                </div>
                                <div class="col-12 mb-3">
                                    <div class="form-group">
                                        <label for="">Harga Barang: </label>
                                        <input name="harga" type="number" class="form-control" value="{{ $data->harga }}" readonly>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
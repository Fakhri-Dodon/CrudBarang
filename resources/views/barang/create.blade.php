@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card mt-3">
                    <div class="card-body">
                        <form action="{{ route('barang.store') }}" method="POST" ecrtype="multipart/form-data">
                            @csrf
                            <h3>Input Barang</h3>
                            <div class="row mb-3">
                                <div class="col-12 mb-3">
                                    <div class="form-group">
                                        <label for="">Nama Barang: </label>
                                        <input name="name" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-12 mb-3">
                                    <div class="form-group">
                                        <label for="">Quantity: </label>
                                        <input name="qty" type="number" class="form-control">
                                    </div>
                                </div>
                                <div class="col-12 mb-3">
                                    <div class="form-group">
                                        <label for="">Unit Barang: </label>
                                        <input name="unit" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-12 mb-3">
                                    <div class="form-group">
                                        <label for="">Harga Barang: </label>
                                        <input name="harga" type="number" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Input Barang</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

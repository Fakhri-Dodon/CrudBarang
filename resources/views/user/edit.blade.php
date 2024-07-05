@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col">
            <div class="card mt-3">
                <div class="card-body">
                    <form action="{{ route('user.update', encrypt($id) )}}" method="POST" ecrtype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <h3>Edit User</h3>
                        <div class="row mb-3">
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="">Nama: </label>
                                    <input name="name" type="text" class="form-control" value="{{ $data->name }}" required>
                                    @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="">Email: </label>
                                    <input name="email" type="text" class="form-control" value="{{ $data->email }}" required>
                                    @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="">Password: </label>
                                    <input name="password" type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Edit User</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
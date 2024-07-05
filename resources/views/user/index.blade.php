@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col">
            <div class="card mt-3">
                <div class="p-3">
                    <div class="row">
                        <div class="col-3">
                            <a href="{{ route('user.create') }}" class="btn btn-primary">Create</a>
                        </div>
                        <div class="col-9"></div>
                    </div>
                </div>
            </div>
            <div class="card p-3 mt-3">
                <table id="datatable" class="table table-striped table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Create</th>
                            <th>Update</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $user)
                            <tr>
                                <th>{{ $user->name }}</th>
                                <th>{{ $user->email }}</th>
                                <th>{{ date('j F, Y', strtotime($user->created_at)) }}</th>
                                <th>{{ $user->updated_at ? date('j F, Y', strtotime($user->updated_at)) : null; }}</th>
                                <th>
                                    <a href="{{ route('user.edit', encrypt($user->id)) }}" class="btn btn-primary">edit</a>
                                    <button onclick="event.preventDefault(); document.getElementById('delete-form-{{ $user->id }}').submit();" class="btn btn-danger">Delete</button>
                                    <form action="{{ route('user.destroy', encrypt($user->id)) }}" method="POST" style="display: none;" id="delete-form-{{ $user->id }}">
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
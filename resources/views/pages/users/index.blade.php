@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <h4 class="my-4 mt-2">Data User</h4>
                    <hr>
                    <a href="{{ route('user.create') }}" class="btn btn-sm btn-success mb-3"><i class='fa fa-plus-circle'></i> TAMBAH</a>
                    <div class="table-responsive">
                        <table id="myTable" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center" scope="col">NO.</th>
                                    <th class="text-center" scope="col">NAMA</th>
                                    <th class="text-center" scope="col">USER NAME</th>
                                    <th class="text-center" scope="col">EMAIL</th>
                                    <th class="text-center" scope="col">ROLE</th>
                                    <th class="text-center" scope="col" style="width: 20%">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}.</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->user_name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->role->name}}</td>
                                        <td class="text-center">
                                            <form action="{{ route('user.delete', $user->id) }}" method="POST">
                                                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm btn-primary" title="EDIT"><i class='fa fa-edit'></i></a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" id="delete" class="btn btn-sm btn-danger" title="DELETE"><i class='fa fa-trash'></i></button>
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
</div>

@endsection


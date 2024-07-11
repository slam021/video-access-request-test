@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <h4 class="my-4 mt-2">Data Role</h4>
                    <hr>
                    <a href="{{ route('role.create') }}" class="btn btn-sm btn-success mb-3"><i class='fa fa-plus-circle'></i> TAMBAH</a>
                    <div class="table-responsive">
                        <table id="myTable" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center" scope="col">NO.</th>
                                    <th class="text-center" scope="col">NAMA ROLE</th>
                                    <th class="text-center" scope="col" style="width: 20%">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}.</td>
                                        <td>{{ $role->name }}</td>
                                        <td class="text-center">
                                            <form action="{{ route('role.delete', $role->id) }}" method="POST">
                                                <a href="{{ route('role.edit', $role->id)}}" class="btn btn-sm btn-primary" title="EDIT"><i class='fa fa-edit'></i></a>
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


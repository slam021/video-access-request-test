@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <h4 class="my-4 mt-2">Tambah Role</h4>
                    <hr>
                    <form action="{{ route('role.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">NAMA ROLE</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name') }}" placeholder="Masukkan Nama Role..." autocomplete="off">
                            @error('name')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary me-3"><i class="fa fa-save"></i> SAVE</button>
                        <button type="reset" class="btn btn-sm btn-warning"><i class="fa fa-refresh"></i> RESET</button>
                        <a href="{{ route('role.index') }}" type="button" class="btn btn-sm btn-secondary float-end"><i class="fa fa-arrow-circle-left"></i> BACK</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

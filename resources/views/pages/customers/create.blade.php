@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <h4 class="my-4 mt-2">Tambah Customer</h4>
                    <hr>
                    <form action="{{ route('customer.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">NAMA LENGKAP</label>
                            <input type="text" class="form-control @error('full_name') is-invalid @enderror" name="full_name" id="full_name" value="{{ old('full_name') }}" placeholder="Masukkan Nama Lengkap..." autocomplete="off">
                            @error('full_name')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">NAMA PANGGILAN</label>
                            <input type="text" class="form-control @error('nick_name') is-invalid @enderror" name="nick_name" id="nick_name" value="{{ old('nick_name') }}" placeholder="Masukkan Nama Panggilan..." autocomplete="off">
                            @error('nick_name')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">TELP.</label>
                            <input type="text" class="form-control @error('telp') is-invalid @enderror" name="telp" id="telp" value="{{ old('telp') }}" placeholder="Masukkan Username..." autocomplete="off">
                            @error('telp')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">EMAIL</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}" placeholder="Masukkan Email..." autocomplete="off">
                            @error('email')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">JENIS KELAMIN</label>
                            <select class="form-control select2 @error('kelamin') is-invalid @enderror" name="kelamin" id="kelamin" data-placeholder="Pilih Kelamin..." autocomplete="off">
                                <option value=""></option>
                                <option value="1" {{ old('kelamin') == '1' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="2" {{ old('kelamin') == '2' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('kelamin')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">ALAMAT</label>
                            <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" rows="5" placeholder="Masukkan Alamat..." autocomplete="off">{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary me-3"><i class="fa fa-save"></i> SAVE</button>
                        <button type="reset" class="btn btn-sm btn-warning"><i class="fa fa-refresh"></i> RESET</button>
                        <a href="{{ route('customer.index') }}" type="button" class="btn btn-sm btn-secondary float-end"><i class="fa fa-arrow-circle-left"></i> BACK</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

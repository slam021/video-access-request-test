@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <h4 class="my-4 mt-2">Edit Permintaan Akses</h4>
                    <hr>
                    <form action="{{ route('video-access-request.update', $data_access->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">CUSTOMER</label>
                            <input type="text" class="form-control @error('customer_id') is-invalid @enderror" name="customer_id" id="customer_id" disabled value="{{ $data_access->customer->full_name }}">
                            @error('customer_id')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">TITLE VIDEO</label>
                            <input type="text" class="form-control @error('video_id') is-invalid @enderror" name="video_id" id="video_id" disabled value="{{ $data_access->video->title }}">
                            @error('video_id')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">WAKTU DISETUJUI</label>
                            @if ($data_access->granted_at)
                                <input type="text" class="form-control @error('telp') is-invalid @enderror" name="telp" id="telp" disabled value="{{ date('H:i:s', strtotime($data_access->granted_at))}}">
                            @else
                                <input type="text" class="form-control @error('telp') is-invalid @enderror" name="telp" id="telp" disabled value="-">
                            @endif
                            @error('telp')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">WAKTU BERAKHIR</label>
                            @if ($data_access->expired_at)
                                <input type="text" class="form-control @error('expired_at') is-invalid @enderror" name="expired_at" id="expired_at" disabled value="{{ date('H:i:s', strtotime($data_access->expired_at)) }}">
                            @else
                                <input type="text" class="form-control @error('expired_at') is-invalid @enderror" name="expired_at" id="expired_at" disabled value="-">
                            @endif
                            @error('expired_at')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">STATUS</label>
                            @if ($data_access->status == 1)
                                <select class="form-control select2 @error('status') is-invalid @enderror" name="status" id="status">
                                    <option value=""></option>
                                    <option value="" {{ $data_access->status == 1 ? 'selected' : '' }}>Tertunda</option>
                                    <option value="2" {{ $data_access->status == 2 ? 'selected' : '' }}>Disetujui</option>
                                </select>
                                @error('status')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            @else
                                <input type="text" class="form-control @error('status') is-invalid @enderror" name="status" id="status" disabled value="{{ $data_access->status }}">
                            @endif
                        </div>
                        @if ($data_access->status == 1)
                            <button type="submit" class="btn btn-sm btn-primary me-3"><i class="fa fa-save"></i> UPDATE</button>
                        @else
                            <button type="submit" class="btn btn-sm btn-primary me-3" disabled><i class="fa fa-save"></i> UPDATE</button>
                        @endif
                        <button type="reset" class="btn btn-sm btn-warning"><i class="fa fa-refresh"></i> RESET</button>
                        <a href="{{ route('video-access-request.index') }}" type="button" class="btn btn-sm btn-secondary float-end"><i class="fa fa-arrow-circle-left"></i> BACK</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

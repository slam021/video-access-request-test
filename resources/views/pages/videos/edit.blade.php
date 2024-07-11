@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <h4 class="my-4 mt-2">Edit Video</h4>
                    <hr>
                    <form action="{{ route('video.update', $video->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">TITLE</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" value="{{ $video->title }}" placeholder="Masukkan Nama Lengkap...">
                            @error('title')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">DESKRIPSI</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="5" placeholder="Masukkan description...">{{ $video->description }}</textarea>
                            @error('description')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">UPLOAD</label>
                            <input type="file" class="form-control @error('video_path') is-invalid @enderror" name="video_path" id="video_path" value="{{ $video->video_path }}" placeholder="Masukkan video_path..." autocomplete="off">
                            @error('video_path')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary me-3"><i class="fa fa-save"></i> UPDATE</button>
                        <button type="reset" class="btn btn-sm btn-warning"><i class="fa fa-refresh"></i> RESET</button>
                        <a href="{{ route('customer.index') }}" type="button" class="btn btn-sm btn-secondary float-end"><i class="fa fa-arrow-circle-left"></i> BACK</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

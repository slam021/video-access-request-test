@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><b>{{ $video->title }}</b></div>
                <div class="card-body">
                    <div class="mb-3">
                        @if ($data_access)
                            @if ($data_access->status == 1)
                                <b>Status : Tertunda</b>
                            @elseif ($data_access->status == 2)
                                <b>Status : Disetujui</b>
                                <br>
                                <b>Disetujui pada : {{ date('H:i:s', strtotime($data_access->granted_at)) }}</b>
                                <br>
                                <b>Berakhir pada : {{ date('H:i:s', strtotime($data_access->expired_at)) }}</b>
                            @elseif ($data_access->status == 3)
                                <b>Status : Selesai (Waktu Habis)</b>
                                <br>
                                <b>Disetujui pada : {{ date('H:i:s', strtotime($data_access->granted_at)) }}</b>
                                <br>
                                <b>Berakhir pada : {{ date('H:i:s', strtotime($data_access->expired_at)) }}</b>
                            @endif
                        @endif
                    </div>
                    <video width="100%" controls>
                        {{-- @if ($video->id != $data_access->video_id && $customer_id != $data_access->customer_id) --}}
                        @if ($data_access == null)
                            Your browser does not support the video tag.
                            <source src="" type="video/mp4">
                        @else
                            @if ($data_access->status != 2)
                                <source src="" type="video/mp4">
                            @else
                                <source src="{{ asset($video->video_path) }}" type="video/mp4">
                            @endif
                        @endif
                    </video>

                    {{-- <button type="submit" class="btn btn-sm btn-primary me-3"><i class="fa fa-save"></i> SAVE</button> --}}
                    <form action="{{ route('video-access-request.store') }}" method="POST" enctype="multipart/form-data" class="d-inline-block me-2">
                        @csrf
                        <input type="hidden" class="form-control" name="customer_id" id="customer_id" value="{{ $customer_id }}">
                        <input type="hidden" class="form-control" name="video_id" id="video_id" value="{{ $video->id }}">
                        @if ($data_access != null)
                            @if ($data_access->status == 3)
                                <button type="submit" class="btn btn-sm btn-warning mt-3" title="REQUEST ACCESS" ><i class='fa fa-pause-circle-o'></i> Minta Akses</button>
                            @else
                                <button type="submit" class="btn btn-sm btn-warning mt-3" title="REQUEST ACCESS" disabled><i class='fa fa-pause-circle-o'></i> Minta Akses</button>
                            @endif
                        @else
                            <button type="submit" class="btn btn-sm btn-warning mt-3" title="REQUEST ACCESS"><i class='fa fa-pause-circle-o'></i> Minta Akses</button>
                        @endif
                    </form>
                    <a href="{{ route('video.index') }}" type="button" class="btn btn-sm btn-secondary float-end mt-3"><i class="fa fa-arrow-circle-left"></i> BACK</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

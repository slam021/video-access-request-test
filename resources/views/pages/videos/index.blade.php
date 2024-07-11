@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <h4 class="my-4 mt-2">Data Video</h4>
                    <hr>
                    @if(auth()->check() && auth()->user()->role_id == 1)
                        <a href="{{ route('video.create') }}" class="btn btn-sm btn-success mb-3"><i class='fa fa-plus-circle'></i> TAMBAH</a>
                    @endif
                    <div class="table-responsive">
                        <table id="myTable" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center" scope="col">NO.</th>
                                    <th class="text-center" scope="col">TITLE</th>
                                    <th class="text-center" scope="col">DESKRIPSI</th>
                                    <th class="text-center" scope="col">VIDEO PATH</th>
                                    <th class="text-center" scope="col" style="width: 20%">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($videos as $video)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}.</td>
                                        <td>{{ $video->title }}</td>
                                        <td>{{ $video->description }}</td>
                                        <td>{{ $video->video_path }}</td>
                                        <td class="text-center d-flex align-items-center justify-content-center">
                                            @if(auth()->check() && auth()->user()->role_id == 2)
                                                <a href="{{ route('video.show', $video->id) }}" class="btn btn-sm btn-secondary me-2" title="PLAY"><i class='fa fa-play'></i></a>
                                            @endif
                                            @if(auth()->check() && auth()->user()->role_id == 1)
                                                <a href="{{ route('video.edit', $video->id) }}" class="btn btn-sm btn-primary me-2" title="EDIT"><i class='fa fa-edit'></i></a>
                                                <form action="{{ route('video.delete', $video->id) }}" method="POST" class="d-inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" id="delete" class="btn btn-sm btn-danger" title="DELETE"><i class='fa fa-trash'></i></button>
                                                </form>
                                            @endif
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


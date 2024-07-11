@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <h4 class="my-4 mt-2">Data Permintaan Akses Video</h4>
                    <hr>
                    {{-- <a href="{{ route('video-access-request.create') }}" class="btn btn-sm btn-success mb-3"><i class='fa fa-plus-circle'></i> TAMBAH</a> --}}
                    <div class="table-responsive">
                        <table id="myTable" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center" scope="col">NO.</th>
                                    <th class="text-center" scope="col">CUSTOMER</th>
                                    <th class="text-center" scope="col">TITLE VIDEO</th>
                                    <th class="text-center" scope="col">WAKTU DISETUJUI</th>
                                    <th class="text-center" scope="col">WAKTU BERAKHIR</th>
                                    <th class="text-center" scope="col">STATUS</th>
                                    @if(auth()->check() && auth()->user()->role_id == 1)
                                        <th class="text-center" scope="col" style="width: 20%">AKSI</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $val)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}.</td>
                                        <td>{{ $val->customer->full_name}}</td>
                                        <td>{{ $val->video->title }}</td>
                                        <td>
                                            @if ($val->granted_at)
                                                {{ \Carbon\Carbon::parse($val->granted_at)->format('H:i:s') }}</td>
                                            @else
                                                -
                                            @endif
                                        <td>
                                            @if ($val->expired_at)
                                                {{ \Carbon\Carbon::parse($val->expired_at)->format('H:i:s') }}</td>
                                            @else
                                                -
                                            @endif
                                        <td class="text-center">
                                            @if ( $val->status == 1 )
                                                <span class="badge rounded-pill bg-secondary">Tertunda</span>
                                            @elseif ( $val->status == 2 )
                                                <span class="badge rounded-pill bg-warning">Disetujui</span>
                                            @elseif ( $val->status == 3 )
                                                <span class="badge rounded-pill bg-success">Selesai</span>
                                            @endif
                                        </td>
                                        @if(auth()->check() && auth()->user()->role_id == 1)
                                            <td class="text-center">
                                                <form action="{{ route('video-access-request.delete', $val->id) }}" method="POST">
                                                    <a href="{{ route('video-access-request.edit', $val->id) }}" class="btn btn-sm btn-primary" title="EDIT"><i class='fa fa-check'></i></a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" id="delete" class="btn btn-sm btn-danger" title="DELETE"><i class='fa fa-trash'></i></button>
                                                </form>
                                            </td>
                                        @endif
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

<script>
    setTimeout(function() {
        location.reload();
    }, 10000);
</script>
@endsection


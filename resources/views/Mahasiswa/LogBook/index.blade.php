@extends('Template_Sekprod')
@section('title_admin', 'Data LogBook')
@section('content')

<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="main-content" style="padding-right: 60px;">
                <div class="container">
                    <a href="{{ route('Mahasiswa.LogBook.create') }}" class="btn btn-primary">
                        <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Buat LogBook
                    </a>
                    <div class="card mt-5">
                        <div class="card-body">
                            @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif

                            <table class="table table-striped table-bordered" style="float: left;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Minggu Pengisian LogBook</th>
                                        <th>Tanggal Mulai</th>
                                        <th>Tanggal Selesai</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($logbook as $key => $cus)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $cus->log_minggu }}</td>
                                        <td>{{ $cus->log_mulai }}</td>
                                        <td>{{ $cus->log_selesai }}</td>
                                        <td>{{ $cus->log_status }}</td>
                                        <td>
                                            @php
                                            $status = "Draft";
                                            $trimmedLogStatus = trim($cus->log_status);
                                            @endphp


                                            @if ($trimmedLogStatus === $status)
                                            <a href="{{ route('Mahasiswa.LogBook.edit', ['id' => $cus->log_id]) }}" class="fa fa-edit" title="Edit"></a>
                                            <a href="{{ route('Mahasiswa.LogBook.detail', ['id' => $cus->log_id]) }}" class="fa fa-list"></a>
                                            <a href="{{ route('logbook.kirimLogBook', ['id' => $cus->log_id]) }}" title="Kirim LogBook">
                                                <i class="fa fa-paper-plane" aria-hidden="true" style="color: #4285f4"></i>
                                            </a>
                                            @else
                                            <a href="{{ route('Mahasiswa.LogBook.detail', ['id' => $cus->log_id]) }}" class="fa fa-list"></a>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty

                                    <tr>
                                        <td colspan="4">Tidak ada data LogBook.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div><br>
                    <div>
                        {{ $logbook->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
    
@endsection

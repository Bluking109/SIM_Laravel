@extends('Template_Sekprod')
@section('title_admin', 'Data Pengelompokan')
@section('content')

<body>
    <div class="card-body">
        <a href="{{ route('Admin.Pengelompokkan.create') }}" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Tambah Baru</a>
        <br>
        <br>
        <form action="{{ route('Admin.Pengelompokkan.index') }}" method="GET">
            <div class="row">
                <div class="col-lg-12">
                    <div class="input-group">
                        <input type="text" class="form-control" id="cari" name="cari" value="{{ isset($cari) ? $cari : '' }}" placeholder="Pencarian" clientidmode="static">
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-secondary">Cari</button>
                        </span>
                    </div>
                </div>
            </div>
        </form>
        <div class="scrollstyle" style="overflow-x: auto;">
            <table class="table table-hover table-bordered table-condensed table-striped grid">
                <tr>
                    @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    <th style="text-align:center;">No</th>
                    <th style="text-align:center;">Kelompok Magang</th>
                    <th style="text-align:center;">Nama Pembimbing</th>
                    <th style="text-align:center;">Jumlah Mahasiswa</th>
                    <th style="text-align:center;">Departemen/Area Magang</th>
                    <th style="text-align:center;">Aksi</th>
                    <tbody>
                        @forelse ($pengelompokkan as $key => $cus)
                        <tr>
                            <td style="text-align:center;">{{ $key + 1 }}</td>
                            <td style="text-align:center;">{{ $cus->kel_nama }}</td>
                            <td>{{ $cus->pin_nama }}</td>
                            <td style="text-align: center;">{{ $cus->total_mhs }}</td>
                            <td style="text-align:center;">{{ $cus->kel_departemen }}</td>
                            <td style="text-align:center;">
                                <a href="{{ route('Admin.Pengelompokkan.edit', ['id' => $cus->kel_nama]) }}" class="fa fa-pencil-square-o"></a>
                                <a href="#" class="fa fa-trash" onclick="   
                                                    event.preventDefault();
                                                    if (confirm('Do you want to remove this?')) {
                                                        document.getElementById('delete-row-{{ $cus->kel_nama }}').submit();
                                                    }">

                                </a>
                                <a href="{{ route('Admin.Pengelompokkan.detail', ['id' => $cus->kel_nama]) }}" class="fa fa-list"></a>
                                <form id="delete-row-{{ $cus->kel_nama }}" action="{{ route('Admin.Pengelompokkan.destroy', ['id' => $cus->kel_nama]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                </form>

                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8">Tidak ada data industri.</td>
                        </tr>
                        @endforelse
                    </tbody>
            </table>
            <div>
            {{ $pengelompokkan->links('pagination::bootstrap-4') }}
            </div>

        </div>
    </div>


</body>
@endsection
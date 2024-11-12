@extends('Template_Sekprod')
@section('title_admin', 'Data Mahasiswa')
@section('content')

<body>
    <div class="card-body">

        <form action="{{ route('Admin.Mahasiswa.index') }}" method="GET">
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
        <br>
        <div class="scrollstyle" style="overflow-x: auto;">
            <table class="table table-hover table-bordered table-condensed table-striped grid">
                <thead>
                    <tr style="text-align:center">
                        <th>NO</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Prodi</th>
                        <th>Angkatan</th>
                        <th>Jenis Kelamin</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse ($mahasiswa as $key => $cus)
                    <tr>
                        <td style="text-align:center;">{{ $key + 1 }}</td>
                        <td style="text-align:center;">{{ $cus->mhs_id }}</td>
                        <td>{{ $cus->mhs_nama }}</td>
                        <td style="text-align:center;">{{ $cus->pro_singkatan }}</td>
                        <td style="text-align:center;">{{ $cus->mhs_angkatan }}</td>
                        <td style="text-align:center;">{{ $cus->mhs_jenis_kelamin }}</td>
                        <td style="text-align:center;"><a href="{{ route('Admin.Mahasiswa.detail', ['id' => $cus->mhs_id]) }}" class="fa fa-list"></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div>
                {{ $mahasiswa->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>

</body>
@endsection
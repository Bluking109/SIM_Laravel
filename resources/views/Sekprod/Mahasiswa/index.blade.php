@extends('Template_Sekprod')
@section('title_admin', 'Data Mahasiswa')
@section('content')

<body>
    <div class="card-body">

        <form action="{{ route('Admin.Industri.index') }}" method="GET">
            <div class="row">
                <div class="col-lg-12">
                    <div class="input-group">
                        <input type="text" class="form-control" id="cari" name="cari" value="{{ isset($cari) ? $cari : '' }}"
                            placeholder="Pencarian" clientidmode="static">
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-secondary">Cari</button>
                        </span>
                        <div class="input-group-btn">
                            <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="true" fdprocessedid="63p3so">
                                <i class="fa fa-filter"></i>&nbsp;Filter
                            </button>
                            <div class="dropdown-menu dropdown-menu-right"
                                style="padding: 20px; min-width: 300px !important;">
                                <div class="form-group">
                                    <label style="font-weight: bold;" for="ddUrut">Urut Berdasarkan</label>
                                    <select name="ddUrut" id="ddUrut" class="form-control dropdown"
                                        style="min-width: 260px !important;">
                                        <option selected="selected" value="dos_nama asc">Nama Dosen [↑]</option>
                                        <option value="dos_nama desc">Nama Dosen [↓]</option>
                                        <option value="mku_nama asc">Nama Mata Kuliah [↑]</option>
                                        <option value="mku_nama desc">Nama Mata Kuliah [↓]</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label style="font-weight: bold;" for="ddKonsentrasi">Program Studi</label>
                                    <select name="ddKonsentrasi" id="ddKonsentrasi" class="form-control dropdown"
                                        style="min-width: 260px !important;">
                                        <option value="">-- Semua --</option>
                                        <option selected="selected" value="3">D3 Manajemen Informatika (MI)</option>
                                        <option value="8">D3 Mekatronika (MK)</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label style="font-weight: bold;" for="ddTahunAjaran">Tahun Akademik</label>
                                    <select name="ddTahunAjaran" id="ddTahunAjaran" class="form-control dropdown"
                                        style="min-width: 260px !important;">
                                        <option value="">-- Semua --</option>
                                        <option selected="selected" value="2023/2024">2023/2024</option>
                                        <option value="2022/2023">2022/2023</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label style="font-weight: bold;" for="ddSemester">Semester</label>
                                    <select name="ddSemester" id="ddSemester" class="form-control dropdown"
                                        style="min-width: 260px !important;">
                                        <option value="">-- Semua --</option>
                                        <option selected="selected" value="Ganjil">Ganjil</option>
                                        <option value="Genap">Genap</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <br>
        <div class="scrollstyle" style="overflow-x: auto;">
            <table class="table table-hover table-bordered table-condensed table-striped grid">
                <thead>
                    <tr style="text-align:center">

                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Prodi</th>
                        <th>Angkatan</th>
                        <th>Jenis Kelamin</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse ($mahasiswa as $cus)
                    <tr>
                        <td>{{ $cus->mhs_id }}</td>
                        <td>{{ $cus->mhs_nama }}</td>
                        <td>{{ $cus->pro_singkatan }}</td>
                        <td>{{ $cus->mhs_angkatan }}</td>
                        <td>{{ $cus->mhs_jenis_kelamin }}</td>
                        <td><a href="{{ route('Admin.Mahasiswa.detail', ['id' => $cus->mhs_id]) }}"
                                class="fa fa-list"></a></td>
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
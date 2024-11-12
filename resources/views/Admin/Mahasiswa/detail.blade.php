@extends('Template_Sekprod')
@section('title_admin', 'Detail Mahasiswa')
@section('content')

<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="main-content" style="padding-right:150px;">
                <div class="container">
                    <div class="col-12 col-md-18" style="margin-top: 40px;"></div>

                    <!-- Profil -->
                    <div class="card">
                        <div class="card-header">
                            <label><b>Profil Mahasiswa</b></label>
                        </div>
                        <div class="card-block">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label style='font-weight: bold;' for="addNIM">Nomor Induk Mahasiswa<b
                                                style="color: red">*</b></label>
                                        <input class="form-control text-box single-line" data-val="true"
                                            data-val-required="The mhs_nama field is required." id="mhs_id"
                                            name="mhs_id" type="text"
                                            value="{{ old('mhs_id', $mahasiswa->mhs_id) }}" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label style='font-weight: bold;' for="addNama">Nama Mahasiswa<b
                                                style="color: red">*</b></label>
                                        <input class="form-control text-box single-line" data-val="true"
                                            data-val-required="The mhs_nama field is required." id="mhs_nama"
                                            name="mhs_nama" type="text"
                                            value="{{ old('mhs_nama', $mahasiswa->mhs_nama) }}" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label style='font-weight: bold;' for="addProdi">Program Studi<b
                                                style="color: red">*</b></label>
                                        <input class="form-control text-box single-line" data-val="true"
                                            data-val-required="The mhs_nama field is required." id="pro_nama"
                                            name="pro_nama" type="text"
                                            value="{{ old('pro_nama', $mahasiswa->pro_nama) }}"
                                            disabled>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label style='font-weight: bold;' for="addPembimbing">Pembimbing Industri<b
                                                style="color: red">*</b></label>
                                        <input class="form-control text-box single-line" data-val="true"
                                            data-val-required="The mhs_nama field is required." id="pin_nama"
                                            name="pin_nama" type="text"
                                            value="{{ old('pin_nama', $mahasiswa->pin_nama) }}" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label style='font-weight: bold;' for="addIndustri">Industri Magang<b
                                                style="color: red">*</b></label>
                                        <input class="form-control text-box single-line" data-val="true"
                                            data-val-required="The mhs_nama field is required." id="ipr_nama"
                                            name="ipr_nama" type="text"
                                            value="{{ old('ipr_nama', $mahasiswa->ipr_nama) }}" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label style='font-weight: bold;' for="addGrup">Grup Industri<b
                                                style="color: red">*</b></label>
                                        <input class="form-control text-box single-line" data-val="true"
                                            data-val-required="The mhs_nama field is required." id="ipr_grup"
                                            name="ipr_grup" type="text"
                                            value="{{ old('ipr_grup', $mahasiswa->ipr_grup) }}" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Logbook -->
                    <div class="card mt-5 ">
                        <div class="card-header">
                            <label><b>Logbook Mahasiswa</b></label>
                        </div>
                        <div class="card-body">
                            <div class="scrollstyle" style="overflow-x: auto;">
                                <table class="table table-striped table-bordered" id="mytable" name="mytable">
                                    <tr>

                                        <th>No</th>
                                        <th>Tanggal Pengajuan</th>
                                        <th>Status</th>
                                        @if(session('usr_role') === 'ADMIN')
                                        <th>Aksi</th>
                                        @endif
                                        <tbody>

                                            @forelse ($logbookData as $key => $cus)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $cus->create_at }}</td>
                                                <td>{{ $cus->log_status }}</td>
                                                @if( session('usr_role') === 'ADMIN')
                                                <td><a href="{{ route('Mahasiswa.LogBook.detail', ['id' => $cus->log_id]) }}"
                                                        class="fa fa-list"></a></td>
                                                        @endif
                                            </tr>
                                            @empty
                                            <tr style="text-align: center;">
                                                <td colspan="8">Tidak ada data Logbook.</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Penilaian -->
                    <div class="card mt-5 ">
                        <div class="card-header">
                            <label><b>Penilaian Kinerja</b></label>
                        </div>
                        <div class="card-body">
                            <div class="scrollstyle" style="overflow-x: auto;">
                                <table class="table table-striped table-bordered" id="mytable" name="mytable">
                                    <tr>

                                        <th style="text-align:center">No</th>
                                        <th style="text-align:center">Periode</th>
                                        @if(session('usr_role') != 'MAHASISWA')
                                        <th>Rata-rata</th>
                                            @if( session('usr_role') === 'SEKRETARIS PRODI' || session('usr_role') === 'PEMBIMBING INDUSTRI')
                                            <th>Aksi</th>
                                            @endif
                                        @endif
                                        <tbody>

                                            @forelse ($penilaianData as $key => $cus)
                                            <tr>
                                                <td style="text-align:center">{{ $key + 1 }}</td>
                                                <td style="text-align:center">{{ $cus->pnl_periode }}</td>
                                                @if(session('usr_role') != 'MAHASISWA')
                                                <td>{{ $cus->rata_nilai }}</td>

                                                    @if(session('usr_role') === 'SEKRETARIS PRODI'  || session('usr_role') === 'PEMBIMBING INDUSTRI'  )
                                                    <td><a href="{{ route('Admin.Penilaian.detail', ['id' => $cus->pnl_id]) }}"
                                                            class="fa fa-list"></a></td>
                                                    @endif
                                                @endif
                                            </tr>
                                            @empty
                                            <tr>
                                                <td style="text-align: center;" colspan="8">Tidak ada data Penilaian.</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                </table>
                                <div>
                                    <!-- Paging -->
                                </div>

                            </div>
                        </div>
                    </div>
                    <br><br>
                    @if(session('usr_role') != 'MAHASISWA')
                    <a href="{{ route('Admin.Mahasiswa.index') }}" style="width:150px"
                        class="btn btn-secondary">Kembali</a>
                    @endif
                    

                </div>
            </div>
        </div>
    </div>
</body>

@endsection
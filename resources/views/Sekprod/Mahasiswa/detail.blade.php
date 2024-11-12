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
                                            <label style='font-weight: bold;' for="addNIM">Nomor Induk Mahasiswa<b style="color: red">*</b></label>
                                            <input class="form-control text-box single-line" data-val="true" data-val-required="The mhs_nama field is required." 
                                            id="pin_id" name="pin_id" type="text"  value="{{ old('mhs_id', $logbookData->first()->mhs_id) }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label style='font-weight: bold;' for="addNama">Nama Mahasiswa<b style="color: red">*</b></label>
                                            <input class="form-control text-box single-line" data-val="true" data-val-required="The mhs_nama field is required." 
                                            id="pin_id" name="pin_id" type="text"  value="{{ old('mhs_nama', $logbookData->first()->mhs_nama) }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label style='font-weight: bold;' for="addProdi">Program Studi<b style="color: red">*</b></label>
                                            <input class="form-control text-box single-line" data-val="true" data-val-required="The mhs_nama field is required." 
                                            id="pin_id" name="pin_id" type="text"  value="{{ old('pro_singkatan', $penilaianData->first()->pro_singkatan) }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label style='font-weight: bold;' for="addPembimbing">Pembimbing Industri<b style="color: red">*</b></label>
                                            <input class="form-control text-box single-line" data-val="true" data-val-required="The mhs_nama field is required." 
                                            id="pin_id" name="pin_id" type="text"  value="{{ old('pin_nama', $penilaianData->first()->pin_nama) }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label style='font-weight: bold;' for="addIndustri">Industri Magang<b style="color: red">*</b></label>
                                            <input class="form-control text-box single-line" data-val="true" data-val-required="The mhs_nama field is required." 
                                            id="pin_id" name="pin_id" type="text"  value="{{ old('ipr_nama', $penilaianData->first()->ipr_nama) }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label style='font-weight: bold;' for="addGrup">Grup Industri<b style="color: red">*</b></label>
                                            <input class="form-control text-box single-line" data-val="true" data-val-required="The mhs_nama field is required." 
                                            id="pin_id" name="pin_id" type="text"  value="{{ old('ipr_grup', $penilaianData->first()->ipr_grup) }}" disabled>
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
                            <table class="table table-striped table-bordered" id="mytable" name="mytable">
                                <tr>

                                    <th>No</th>
                                    <th>Tanggal Pengajuan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                    <tbody>
                                        
                                        @forelse ($logbookData as $key => $cus)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $cus->create_date }}</td>
                                            <td>{{ $cus->log_status }}</td>
                                            <!-- <td><a href="{{ route('Admin.Penilaian.detail', ['id' => $cus->log_id]) }}" class="fa fa-list"></a></td> -->
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="8">Tidak ada data Logbook.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                            </table>

                        </div>
                    </div>

                    <!-- Penilaian -->
                    <div class="card mt-5 ">
                        <div class="card-header">
                            <label><b>Penilaian Kinerja</b></label>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered" id="mytable" name="mytable">
                                <tr>

                                    <th>No</th>
                                    <th>Periode</th>
                                    <th>Rata-rata</th>
                                    <th>Aksi</th>
                                    <tbody>
                                        
                                        @forelse ($penilaianData as $key => $cus)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $cus->pnl_periode }}</td>
                                            <td>{{ $cus->rata_nilai }}</td>
                                            <td><a href="{{ route('Admin.Penilaian.detail', ['id' => $cus->pnl_id]) }}" class="fa fa-list"></a></td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="8">Tidak ada data Penilaian.</td>
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
            </div>
        </div>
    </div>
</body>

@endsection

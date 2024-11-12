@extends('Template_Sekprod')
@section('title_admin', 'Detail LogBook')
@section('content')

<div class="card">
    <div class="card-header">
        <label><b>Detail LogBook</b></label>
    </div>
    <div class="card-block">
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label style='font-weight: bold;' for="addID">Nomor Induk Mahasiswa</label><br />
                    {{ $logbook->mhs_id }}
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label style='font-weight: bold;' for="addNama">Nama Mahasiswa</label><br />
                    {{ $logbook->mhs_nama }}
                    @if (session('SameMessage'))
                    <span class="text-danger">
                        {{ session('SameMessage') }}
                    </span>
                    @endif
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label style='font-weight: bold;' for="addNama">Program Studi</label><br />
                    {{ $logbook->pro_nama }}
                    @if (session('SameMessage'))
                    <span class="text-danger">
                        {{ session('SameMessage') }}
                    </span>
                    @endif
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label style='font-weight: bold;' for="addNama">Pembimbing Industri</label><br />
                    {{ $logbook->pin_nama }}
                    @if (session('SameMessage'))
                    <span class="text-danger">
                        {{ session('SameMessage') }}
                    </span>
                    @endif
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label style='font-weight: bold;' for="addNama">Industri Magang</label><br />
                    {{ $logbook->ipr_nama }}
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label style='font-weight: bold;' for="addNama">Grup Industri</label><br />
                    {{ $logbook->ipr_grup }}
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label style='font-weight: bold;' for="addNama">Kegiatan Hari Senin</label><br />
                    <textarea class="form-control" name="log_hari_1" id="log_hari_1" readonly>{{ $logbook->log_hari_1 }}</textarea>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label style='font-weight: bold;' for="addNama">Kegiatan Hari Selasa</label><br />
                    <textarea class="form-control" name="log_hari_2" id="log_hari_2" readonly>{{ $logbook->log_hari_2 }}</textarea>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="form-group">
                    <label style='font-weight: bold;' for="addNama">Kegiatan Hari Rabu</label><br />
                    <textarea class="form-control" name="log_hari_3" id="log_hari_3" readonly>{{ $logbook->log_hari_3 }}</textarea>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label style='font-weight: bold;' for="addNama">Kegiatan Hari Kamis</label><br />
                    <textarea class="form-control" name="log_hari_4" id="log_hari_4" readonly>{{ $logbook->log_hari_4 }}</textarea>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label style='font-weight: bold;' for="addNama">Kegiatan Hari Jumat</label><br />
                    <textarea class="form-control" name="log_hari_5" id="log_hari_5" readonly>{{ $logbook->log_hari_5 }}</textarea>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label style='font-weight: bold;' for="addNama">Kegiatan Hari Sabtu</label><br />
                    <textarea type="text" class="form-control" name="log_hari_6" id="pin_nama" readonly> {{ $logbook->log_hari_6 }}</textarea>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label style='font-weight: bold;' for="addNama">Kegiatan Hari Minggu</label><br />
                    <textarea type="text" class="form-control" name="log_hari_7" id="pin_nama" readonly>{{ $logbook->log_hari_7 }}</textarea>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label style='font-weight: bold;' for="addNama">Alasan Tolak</label><br />
                    <textarea type="text" class="form-control" name="log_ulasan" id="log_ulasan" readonly>{{ $logbook->log_ulasan }}</textarea>
                </div>
            </div>
            <br />
            <div class="container-login100-form-btn m-t-32">
                <a class="btn btn-secondary" onclick="goBack()">Kembali</a>
            </div>
        </div>
    </div>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
    @endsection
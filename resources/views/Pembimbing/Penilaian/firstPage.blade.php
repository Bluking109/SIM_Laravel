@extends('Template_Sekprod')
@section('title_admin', 'Kriteria Penilaian')
@section('content')

@if (session('SuccessMessage'))
    <div class="row">
        <div class="form-group col-md-12">
            <div class="alert alert-success alert-dismissible fade show" style="padding-right:20px; padding-left:20px;" role="alert">
                <strong>Sukses!</strong> {{ session('SuccessMessage') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
@endif

@if (session('WarningMessage'))
    <div class="row">
        <div class="form-group col-md-12">
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session('WarningMessage') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
@endif

<div class="col panelcontent panelcontentweb" style="font-size: 14px; height:650px">
    <div class="jumbotron" style="box-shadow: none; height:auto; padding: 15px 30px;">
        {{-- taruh content disini --}}
        <div class="card">
            <span style="font-size: large; padding-left:20px;padding-right:20px;padding-top:20px; padding-bottom:20px;">
                <p>
                    Pembimbing Industri memberikan penilaian kepada Mahasiswa peserta Praktik Kerja Industri (Magang) sesuai kriteria penilaian.
                </p><br />
                <p>
                    <strong>Petunjuk Penilaian</strong>
                </p>
                <p>
                    Pembimbing Industri memberikan penilaian untuk butir A sampai dengan H dengan skala 0 - 10, sesuai rubrik penilaian berikut ini (cukup pilih nomor saja).
                </p>
                <span>
                    Range Penilaian Mahasiswa Magang Industri :<br>
                    8 - 10    =  Sangat Baik <br />
                    7 - 7.9   =  Baik <br />
                    6 - 6.9   =  Cukup <br />
                    4 - 5.9   =  Kurang <br />
                    0  - 3.9  =  Sangat Kurang<br>
                </span>
                <br />
                <p>
                    Jika ada pertanyaan/masukan silakan kirim email ke Departemen Administrasi Akademik dan Admisi :
                    <a href="mailto:melin.said@polytechnic.astra.ac.id">melin.said@polytechnic.astra.ac.id</a>
                </p>
                <br /><br>
            </span>
            <a href="{{ route('Pembimbing.Penilaian.create') }}" style="margin-left:20px; margin-right:20px;" class="btn btn-primary">Berikutnya</a>
            <br /><br />
        </div>
    </div>

    <hr class="my-4" />
    <br /><br />
</div>

@endsection
@extends('Template_SekProd')
@section('title_admin', 'Detail laporan Penilaian')
@section('content')

<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="main-content" style="padding-right:400px;">
                <div class="container" style="margin-top:40px;">

                    <div class="text-left">
                        @if(session('usr_role') === 'ADMIN')
                        <a href="{{ route('Admin.Penilaian.export2', ['id' => $id]) }}" class="btn btn-success">
                            <i class="fa fa-download"></i> Download
                        </a>
                        @endif
                    </div>

                    <div class="card mt-5" style="width: 1500px; height: 300px;">
                        <div class="card-header">
                            <label><b>Kelompok Magang</b></label>
                        </div>
                        <div class="card-body">
                            <div class="scrollstyle" style="overflow-x: auto;">
                                <table class="table table-striped table-bordered">
                                    <tr>
                                        <th style="text-align:center;">No</th>
                                        <th style="text-align:center;">NIM</th>
                                        <th style="text-align:center;">Nama Mahasiswa</th>
                                        <th style="text-align:center;">Industri</th>
                                        <th style="text-align:center;">Periode Penilaian</th>
                                        <th style="text-align:center;">Pengetahuan Kerja</th>
                                        <th style="text-align:center;">Kualitas Kerja</th>
                                        <th style="text-align:center;">Kecepatan Kerja</th>
                                        <th style="text-align:center;">Sikap dan Perilaku</th>
                                        <th style="text-align:center;">Kreatifitas dan Kerjasama</th>
                                        <th style="text-align:center;">Softskill dan Leadership</th>
                                        <th style="text-align:center;">Softskill Kemampuan Menangani Masalah</th>
                                        <th style="text-align:center;">Softskill Kemampuan Beradaptasi</th>
                                        <th style="text-align:center;">Ulasan</th>
                                        <th style="text-align:center;">Rata-rata Nilai (Periode) </th>
                                        <th style="text-align:center;">Aksi</th>
                                        <tbody>
                                            @forelse ($penilaian as $key => $cus)
                                            <tr>
                                                <td style="text-align:center;">{{ $key + 1 }}</td>
                                                <td style="text-align:center;">{{ $cus->mhs_id }}</td>
                                                <td>{{ $cus->mhs_nama }}</td>
                                                <td>{{ $cus->ipr_nama }}</td>
                                                <td style="text-align: center;">{{ $cus->pnl_periode }}</td>
                                                <td style="text-align:center;">{{ $cus->pnl_pengetahuan_kerja }}</td>
                                                <td style="text-align: center;">{{ $cus->pnl_kualitas_kerja }}</td>
                                                <td style="text-align:center;">{{ $cus->pnl_kecepatan_kerja }}</td>
                                                <td style="text-align: center;">{{ $cus->pnl_sikap_perilaku }}</td>
                                                <td style="text-align: center;">{{ $cus->pnl_kreatifitas_kerja_sama }}</td>
                                                <td style="text-align:center;">{{ $cus->pnl_leadership }}</td>
                                                <td style="text-align: center;">{{ $cus->pnl_penanganan_masalah }}</td>
                                                <td style="text-align:center;">{{ $cus->pnl_beradaptasi }}</td>
                                                <td style="text-align:center;">{{ $cus->pnl_ulasan }}</td>
                                                <td style="text-align: center;">{{ $cus->rata_nilai }}</td>
                                                <td style="text-align:center;">
                                                    <a href="{{ route('Admin.Penilaian.detail', ['id' => $cus->pnl_id]) }}" class="fa fa-list"></a>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="8">Tidak ada data industri.</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                </table>
                            </div>
                        </div>
                        <br><br>
                        <div style="text-align: left;">
                            <a href="{{ url()->previous() }}" class="btn btn-secondary" style="width:150px">Kembali</a>&nbsp;
                        </div>
                        <div class="form-group">
                        </div>
                    </div>

                    <br><br><br>
                </div>
            </div>
        </div>
</body>


@endsection
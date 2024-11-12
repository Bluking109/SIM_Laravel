@extends('Template_Sekprod')
@section('title_admin', 'Data LaporanPenilaian')
@section('content')

<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="main-content" style="padding-right:400px;">
                <div class="container" style="margin-top:40px;">
                    
                    <div class="card mt-5" style="width: 1500px; height: 700px;">
                    <div class="scrollstyle" style="overflow-x: auto;">
                    <div class="card-header">
                        <label><b>Kelompok Magang</b></label>
                    </div>
                        <div class="card-body" >
                            <table class="table table-striped table-bordered">
                                <tr>
                                    <th style="text-align:center;">No</th>
                                    <th style="text-align:center;">NIM</th>
                                    <th style="text-align:center;">Nama Mahasiswa</th>
                                    <th style="text-align:center;">Pengetahuan Kerja</th>
                                    <th style="text-align:center;">Kualitas Kerja</th>
                                    <th style="text-align:center;">Kecepatan Kerja</th>
                                    <th style="text-align:center;">Sikap dan Perilaku</th>
                                    <th style="text-align:center;">Kreatifitas dan Kerjasama</th>
                                    <th style="text-align:center;">Softskill dan Leadership</th>
                                    <th style="text-align:center;">Softskill Kemampuan Menangani Masalah</th>
                                    <th style="text-align:center;">Softskill Kemampuan Beradaptasi</th>
                                    <th style="text-align:center;">Aksi</th>
                                    <tbody>
                                    @forelse ($laporan as $key => $cus)
                                    <tr>
                                        <td style="text-align:center;">{{ $key + 1 }}</td>
                                        <td style="text-align:center;">{{ $cus['mhs_id'] }}</td>
                                        <td>{{ $cus['mhs_nama'] }}</td>
                                        <td style="text-align: center;">{{ $cus['rata_pengetahuan'] }}</td>
                                        <td style="text-align:center;">{{ $cus['rata_kualitas'] }}</td>
                                        <td style="text-align: center;">{{ $cus['rata_kecepatan'] }}</td>
                                        <td style="text-align:center;">{{ $cus['rata_sikap'] }}</td>
                                        <td style="text-align: center;">{{ $cus['rata_kreatifitas'] }}</td>
                                        <td style="text-align:center;">{{ $cus['rata_leadership'] }}</td>
                                        <td style="text-align: center;">{{ $cus['rata_beradaptasi'] }}</td>
                                        <td style="text-align:center;">{{ $cus['rata_penanganan'] }}</td>
                                        <td style="text-align:center;"> 
                                                <a href="{{ route('Admin.Penilaian.detailLaporan', ['id' => $cus['mhs_id']]) }}" class="fa fa-list"></a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="14">Tidak ada data industri.</td>
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
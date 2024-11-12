@extends('Template_SekProd')
@section('title_admin', 'Data Penilaian')
@section('content')

<body>
    <div class="card-body">
        @if (session('successMessage'))
        <div class="alert alert-success">{{ session('successMessage') }}</div>
        @endif

        @if (session('warningMessage'))
        <div class="alert alert-warning">{{ session('warningMessage') }}</div>
        @endif

        <br>
        <br>

        <form action="{{ route('Admin.Penilaian.index') }}" method="GET">
            <div class="row">
                <div class="col-lg-12">
                    <div class="input-group">

                        <!-- Pindahkan elemen tabel ke luar dari div input-group -->
                        <input type="text" class="form-control" name="cari" id="cari" placeholder="Pencarian" clientidmode="static">
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-secondary">Cari</button>
                        </span>
                        @if(session('usr_role') === 'ADMIN')
                        <a class="btn btn-success" href="{{ route('Admin.Penilaian.export', ['cari' => request('cari'), 'ddProdi' => request('ddProdi')]) }}">
                            <i class="fa fa-download"></i> Download
                        </a>
                        

                        <div class="input-group-btn">
                            <button class="btn btn-primary dropdown-toggle" name="filter" id="filter" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" fdprocessedid="63p3so">
                                <i class="fa fa-filter"></i>&nbsp;Filter
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" style="padding: 20px; min-width: 300px !important;">

                                <div class="form-group">
                                    <label style="font-weight: bold;" for="ddProdi">Prodi</label>
                                    <select class="form-control" name="ddProdi" id="ddProdi" style="min-width: 260px !important;">
                                        <option value="" selected>Select Prodi</option>
                                        <!-- Add options dynamically based on your data -->
                                        @foreach($prodiOptions as $prodiOption)
                                        <option value="{{ $prodiOption->pro_id }}" {{ request('ddProdi') == $prodiOption->pro_id ? 'selected' : '' }}>
                                            {{ $prodiOption->pro_nama }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- <div class="form-group">
                                    <label style="font-weight: bold;" for="ddAngkatan">Angkatan</label>
                                    <select name="ddAngkatan" id="ddAngkatan" class="form-control dropdown" style="min-width: 260px !important;">
                                        <option value="">-- Semua --</option>
                                        <option {{ request('ddAngkatan') == 2023 ? 'selected' : '' }} value="2023">2023</option>
                                        <option {{ request('ddAngkatan') == 2022 ? 'selected' : '' }} value="2022">2022</option>
                                        <option {{ request('ddAngkatan') == 2021 ? 'selected' : '' }} value="2021">2021</option>
                                        <!-- Add more options as needed -->
                                    </select>
                                </div> -->
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </form>

        <br>
        <div class="scrollstyle" style="overflow-x: auto;">
            <table class="table table-hover table-bordered table-condensed table-striped grid" id="cari" name="cari">
                <thead>
                    <tr>
                        <th style="text-align:center;">No</th>
                        <th style="text-align:center;">NIM</th>
                        <th style="text-align:center;">Nama Mahasiswa</th>
                        <th style="text-align:center;">Program Studi</th>
                        <th style="text-align:center;">Industri</th>
                        <th style="text-align:center;">Departemen/Area magang</th>
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
                        <td>{{ $cus['pro_nama'] }}</td>
                        <td>{{ $cus['ipr_nama'] }}</td>
                        <td>{{ $cus['kel_departemen'] }}</td>
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
                        <td colspan="14">Tidak ada data Penilaian.</td>
                    </tr>
                    @endforelse

                </tbody>
            </table>
            <div>
            {{ $mahasiswa->appends(request()->query())->links('pagination::bootstrap-4') }}
            </div>

        </div>
    </div>
</body>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
<!-- Tambahkan jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- Tambahkan DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<!-- Tambahkan DataTables Buttons -->
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>

<script>
    $('#ddProdi').on('click', function(e) {
        e.stopPropagation();
    });

    $('#ddAngkatan').on('click', function(e) {
        e.stopPropagation();
    });
</script>
<!--  -->

@endsection
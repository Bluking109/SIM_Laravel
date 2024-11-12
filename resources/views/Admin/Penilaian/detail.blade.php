@extends('Template_SekProd')
@section('title_admin', 'Detail Penilaian')
@section('content')

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
                                    <input class="form-control text-box single-line" data-val="true" data-val-required="The mhs_nama field is required." id="pin_id" name="pin_id" type="text" value="{{ old('mhs_id', $penilaian->first()->mhs_id) }}" disabled>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label style='font-weight: bold;' for="addNama">Nama Mahasiswa<b style="color: red">*</b></label>
                                    <input class="form-control text-box single-line" data-val="true" data-val-required="The mhs_nama field is required." id="pin_id" name="pin_id" type="text" value="{{ old('mhs_nama', $penilaian->first()->mhs_nama) }}" disabled>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label style='font-weight: bold;' for="addProdi">Program Studi<b style="color: red">*</b></label>
                                    <input class="form-control text-box single-line" data-val="true" data-val-required="The mhs_nama field is required." id="pin_id" name="pin_id" type="text" value="{{ old('pro_singkatan', $penilaian->first()->pro_singkatan) }}" disabled>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label style='font-weight: bold;' for="addPembimbing">Pembimbing Industri<b style="color: red">*</b></label>
                                    <input class="form-control text-box single-line" data-val="true" data-val-required="The mhs_nama field is required." id="pin_id" name="pin_id" type="text" value="{{ old('pin_nama', $penilaian->first()->pin_nama) }}" disabled>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label style='font-weight: bold;' for="addIndustri">Industri Magang<b style="color: red">*</b></label>
                                    <input class="form-control text-box single-line" data-val="true" data-val-required="The mhs_nama field is required." id="pin_id" name="pin_id" type="text" value="{{ old('ipr_nama', $penilaian->first()->ipr_nama) }}" disabled>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label style='font-weight: bold;' for="addGrup">Grup Industri<b style="color: red">*</b></label>
                                    <input class="form-control text-box single-line" data-val="true" data-val-required="The mhs_nama field is required." id="pin_id" name="pin_id" type="text" value="{{ old('ipr_grup', $penilaian->first()->ipr_grup) }}" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Table -->
                <table class="table w-100 container-fluid" style="padding-left: 40px">
                    <!-- Table headers -->
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Penilaian</th>
                            <th scope="col">Kriteria Penilaian</th>
                            <th scope="col">Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="vertical-align:middle;">1</td>
                            <td style="vertical-align:middle;">Penilaian Diri</td>
                            <td style="vertical-align:middle;">
                                <ul>
                                    <li>KEMAMPUAN MENGANALISA TUGAS</li>
                                    <li>PENGETAHUAN SECARA UMUM SECARA BIDANG TERKAIT</li>
                                    <li>KECEPETAN MENERIMA BIMBINGAN</li>
                                    <li>DAYA TANGKAP TERHADAP HAL-HAL BARU</li>
                                </ul>
                            </td>
                            <td style="vertical-align:middle;">{{ $penilaian->first()->pnl_pengetahuan_kerja }}</td>

                        </tr>
                        <tr>
                            <td style="vertical-align:middle;">2</td>
                            <td style="vertical-align:middle;">Kualitas Kerja</td>
                            <td style="vertical-align:middle;">
                                <ul>
                                    <li>HASIL KERJA (PRODUK/JASA)</li>
                                    <li>KEMAMPUAN MELAKUKAN ANALISIS DAN PENYELESAIAN MASALAH</li>
                                    <li>KEMAMPUAN MENYELESAIKAN TUGAS</li>
                                </ul>
                            </td>
                            <td style="vertical-align:middle;">{{ $penilaian->first()->pnl_kualitas_kerja }}</td>
                        </tr>
                        <tr>
                            <td style="vertical-align:middle;">3</td>
                            <td style="vertical-align:middle;">Kecepatan Kerja</td>
                            <td style="vertical-align:middle;">
                                <ul>
                                    <li>KECEPATAN MENYELESAIKAN TUGAS</li>
                                    <li>KECEPATAN MAMAHAMI TUGAS DARI MENTOR</li>
                                    <li>KEMAMPUAN MELAKUKAN ANALISIS DAN PENYELESAIAN MASALAH</li>
                                </ul>
                            </td>
                            <td style="vertical-align:middle;">{{ $penilaian->first()->pnl_kecepatan_kerja }}</td>
                        </tr>
                        <tr>
                            <td style="vertical-align:middle;">4</td>
                            <td style="vertical-align:middle;">Sikap dan Perilaku</td>
                            <td style="vertical-align:middle;">
                                <ul>
                                    <li>TAAT PERATURAN PERUSAHAAN</li>
                                    <li>MENGGUNAKAN PERLENGKAPAN STANDAR KERJA DAN MEMPERHATIKAN SAFETY</li>
                                    <li>CUSTOMER SATISFACTION (KEPUASAN PELANGGAN)</li>
                                </ul>
                            </td>
                            <td style="vertical-align:middle;">{{ $penilaian->first()->pnl_sikap_perilaku }}</td>
                        </tr>
                        <tr>
                            <td style="vertical-align:middle;">5</td>
                            <td style="vertical-align:middle;">Kreativitas dan Kerja Sama</td>
                            <td style="vertical-align:middle;">
                                <ul>
                                    <li>MEMBERIKAN IDE/SARAN DALAM PROSES KERJA ATAU MELAKUKA IMPROVMENT</li>
                                    <li>KERJA SAMA TIM DALAM LINGKUNGAN KERJA</li>
                                </ul>
                            </td>
                            <td style="vertical-align:middle;">{{ $penilaian->first()->pnl_kreatifitas_kerja_sama }}</td>
                        </tr>
                        <tr>
                            <td rowspan="3" style="vertical-align:middle;">6</td>
                            <td rowspan="3" style="vertical-align:middle;">Soft Skill</td>
                            <td style="vertical-align:middle;">
                                Leadership
                            </td>
                            <td style="vertical-align:middle;">{{ $penilaian->first()->pnl_leadership }}</td>


                        </tr>
                        <tr>
                            <td style="vertical-align:middle;">
                                Kemampuan Menangani Masalah
                            </td>
                            <td style="vertical-align:middle;">{{ $penilaian->first()->pnl_penanganan_masalah }}</td>


                        </tr>
                        <tr>
                            <td style="vertical-align:middle;">
                                Kemampuan Beradapatasi
                            </td>
                            <td style="vertical-align:middle;">{{ $penilaian->first()->pnl_beradaptasi }}</td>
                        </tr>
                        <tr>
                            <td style="vertical-align:middle;"></td>
                            <td class="text-center" style="vertical-align:middle;"><b>Rata Rata</b></td>
                            <td></td>
                            <td>
                                {{ $penilaian->first()->rata_nilai }}
                            </td>
                        </tr>
                        <tr>

                        </tr>
                    </tbody>
                </table>

                <div class="form-group col-lg-12">
                    <label for="exampleFormControlTextarea1"><b>Catatan dari Pembimbing</b></label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" readonly>{{ $penilaian->first()->pnl_ulasan }}</textarea>
                </div>
            </div>
        </div>
        <br />
        <div class="form-group">
            <div style="text-align: left; margin-left : 40px">
                @if(session('usr_role') === 'SEKRETARIS PRODI')
                <a href="{{ url()->previous() }}" style="width:150px" class="btn btn-secondary">Kembali</a>
                @elseif (session('usr_role') === 'ADMIN')
                <a href="{{ route('Admin.Penilaian.detailLaporan', ['id' => $penilaian->first()->mhs_id]) }}" class="btn btn-secondary" style="width: 200px">Kembali</a>&nbsp;
                @elseif (session('usr_role') === 'PEMBIMBING INDUSTRI')
                <a href="{{ url()->previous() }}" class="btn btn-secondary" style="width: 200px">Kembali</a>&nbsp;
                @endif

            </div>
        </div>
        <br><br>
    </div>
</div>
</div>
</div>
</body>

@endsection
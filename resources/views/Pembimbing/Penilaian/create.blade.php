@extends('Template_Sekprod')
@section('title_penilaian', 'Data Penilaian')
@section('content')

<div class="card">
    <div class="card-header">
        <label><b>Tambah Penilaian</b></label>
    </div>
    <div class="card-body">
        <div class="card-block">
            <form name="myform" class="login100-form validate-form p-b-33 p-t-5" method="post" onsubmit="return validateForm(event)" action="{{ route('Pembimbing.Penilaian.store') }}">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <label style='font-weight: bold;' for="addNama">Pilih Mahasiswa<span style="color:red;">*</span></label>
                        <select name="mhs_id" class="form-control" id="mhsId">
                            <option value="">-- Pilih Mahasiswa --</option>
                            @foreach ($mahasiswa as $mhs)
                            <option value="{{ $mhs->mhs_id }}" @if(old('mhs_id')==$mhs->mhs_id) selected @endif>
                                {{ $mhs->mhs_nama }}
                            </option>
                            @endforeach
                        </select>
                        <span class="text-danger" id="mhsIdMessage"></span>
                    </div>

                    <div class="col-lg-6">
                        <label for="pnl_periode" style='font-weight: bold;'>Periode Penilaian<span style="color:red;">*</span></label>
                        <select class="form-control" id="periode" name="pnl_periode">
                            <option value="">--Pilih Periode--</option>
                            <option value="Januari">Januari</option>
                            <option value="Februari">Februari</option>
                            <option value="Maret">Maret</option>
                            <option value="April">April</option>
                            <option value="Mei">Mei</option>
                            <option value="Juni">Juni</option>
                            <option value="Juli">Juli</option>
                            <option value="Agustus">Agustus</option>
                            <option value="September">September</option>
                            <option value="Oktober">Oktober</option>
                            <option value="November">November</option>
                            <option value="Desember">Desember</option>
                        </select>
                        <span class="text-danger" id="periodeErrorMessage"></span>
                    </div>

                    <div class="col-6 form-group">
                        <label style='font-weight: bold;'>NIM</label>
                        <input type="text" class="form-control" name="mhs_id" id="NIM" placeholder="NIM" readonly>
                    </div>
                    <div class="col-6 form-group">
                        <label style='font-weight: bold;'>Prodi</label>
                        <input type="text" class="form-control" id="prodi" placeholder="Prodi" readonly>
                    </div>
                    <div class="col-6 form-group">
                        <label style='font-weight: bold;'>Departemen/Area Magang</label>
                        <input type="text" class="form-control" id="departemen" placeholder="Departemen/Area Magang" readonly>
                    </div>
                    <div class="col-6 form-group">
                        <label style='font-weight: bold;'>Kelompok</label>
                        <input type="text" class="form-control" id="kel" placeholder="Kelompok" readonly>
                    </div>
                </div>
        </div>
    </div>
</div>
<br><br>
<div class="card" style="padding-bottom: 5px;">
    <div class="card-header">
        <label><b>Penilaian Kerja</b></label>
    </div>
</div>
<div class="card-body">
    <div class="row">
        <br><br><br><br>
        <div class="col-6 form-group" style="padding-top: 10px">
            <div class="form-group">
                <table class="table table-bordered" style="width: 50px; margin-left:30px">
                    <thead>
                        <tr>
                            <th style="text-align:center">Jenis</th>
                            <th style="text-align:center">Kriteria</th>
                        </tr>
                    </thead>
                    <tbody>
                        <td rowspan="6" style="vertical-align:middle;">{{ $jenis[3] }}</td>
                        @foreach($karakteristik as $key => $nilai)
                        @if($key >= 0 && $key <=3) <tr>
                            <td>{{ $nilai }}</td>
                            </tr>
                            @endif
                            @endforeach
                    </tbody>
                </table>

                <div class="form-group mt-2" style="margin-left: 30px;">
                    <div class="form-check form-check-inline">
                        @for ($i = 1; $i <= 10; $i++) <label class="radio-label">
                            <input type="radio" name="pnl_pengetahuan_kerja" id="pnl_pengetahuan_kerja{{$i}}" value="{{$i}}" style="margin-right:10px;">
                            <div>{{$i}}</div>
                            </label>
                            @endfor
                    </div>
                </div>

                <span class="text-danger" id="pengetahuanErrorMessage"></span>
            </div>
        </div>

        <br><br><br><br>
        <div class="col-6 form-group" style="padding-top: 10px">
            <table class="table table-bordered" style="width: 50px; margin-left:30px">
                <thead>
                    <tr>
                        <th style="text-align:center">Jenis</th>
                        <th style="text-align:center">Kriteria</th>
                    </tr>
                </thead>
                <tbody>
                    <td rowspan="6" style="vertical-align:middle;">{{ $jenis[0] }}</td>
                    @foreach($karakteristik as $key => $nilai)
                    @if($key >= 7 && $key <= 9) <tr>
                        <td>{{ $nilai }}</td>
                        </tr>
                        @endif
                        @endforeach
                </tbody>
            </table>
            <br>

            <div class="form-group mt-2" style="margin-left: 30px;">
                <div class="form-check form-check-inline">
                    @for ($i = 1; $i <= 10; $i++) <label class="radio-label">
                        <input type="radio" name="pnl_kecepatan_kerja" id="pnl_kecepatan_kerja{{$i}}" value="{{$i}}" style="margin-right:10px;">
                        <div>{{$i}}</div>
                        </label>
                        @endfor
                </div>
            </div>
            <span class="text-danger" id="kecepatanErrorMessage"></span>
        </div>

        <br><br><br><br>
        <div class="col-6 form-group">
            <table class="table table-bordered" style="width: 50px; margin-left:30px">
                <thead>
                    <tr>
                        <th style="text-align:center">Jenis</th>
                        <th style="text-align:center">Kriteria</th>
                    </tr>
                </thead>
                <tbody>
                    <td rowspan="6" style="vertical-align:middle;">{{ $jenis[4] }}</td>
                    @foreach($karakteristik as $key => $nilai)
                    @if($key >= 10 && $key <= 12) <tr>
                        <td>{{ $nilai }}</td>
                        </tr>
                        @endif
                        @endforeach
                </tbody>
            </table>
            <div class="form-group mt-2" style="margin-left: 30px;">
                <div class="form-check form-check-inline">
                    @for ($i = 1; $i <= 10; $i++) <label class="radio-label">
                        <input type="radio" name="pnl_sikap_perilaku" id="pnl_sikap_perilaku{{$i}}" value="{{$i}}" style="margin-right:10px;">
                        <div>{{$i}}</div>
                        </label>
                        @endfor
                </div>
            </div>
            <span class="text-danger" id="sikapErrorMessage"></span>
        </div>

        <br><br><br><br>
        <div class="col-6 form-group">
            <table class="table table-bordered" style="width: 50px; margin-left:30px">
                <thead>
                    <tr>
                        <th style="text-align:center">Jenis</th>
                        <th style="text-align:center">Kriteria</th>
                    </tr>
                </thead>
                <tbody>
                    <td rowspan="6" style="vertical-align:middle;">{{ $jenis[2] }}</td>
                    @foreach($karakteristik as $key => $nilai)
                    @if($key >= 4 && $key <= 6) <tr>
                        <td>{{ $nilai }}</td>
                        </tr>
                        @endif
                        @endforeach
                </tbody>
            </table>
            <div class="form-group mt-2" style="margin-left: 30px;">
                <div class="form-check form-check-inline">
                    @for ($i = 1; $i <= 10; $i++) <label class="radio-label">
                        <input type="radio" name="pnl_kualitas_kerja" id="pnl_kualitas_kerja{{$i}}" value="{{$i}}" style="margin-right:10px;">
                        <div>{{$i}}</div>
                        </label>

                        @endfor
                </div>
            </div>
            <span class="text-danger" id="kualitasErrorMessage"></span>
        </div>

        <br><br><br><br>
        <div class="col-5 form-group">
            <table class="table table-bordered" style="width: 50px; margin-left:30px">
                <thead>
                    <tr>
                        <th style="text-align:center">Jenis</th>
                        <th style="text-align:center">Kriteria</th>
                    </tr>
                </thead>
                <tbody>
                    <td rowspan="6" style="vertical-align:middle;">{{ $jenis[1] }}</td>
                    @foreach($karakteristik as $key => $nilai)
                    @if($key >= 13 && $key <= 14) <tr>
                        <td>{{ $nilai }}</td>
                        </tr>
                        @endif
                        @endforeach
                </tbody>
            </table>
            <div class="form-group mt-2" style="margin-left: 30px;">
                <div class="form-check form-check-inline">
                    @for ($i = 1; $i <= 10; $i++) <label class="radio-label">
                        <input type="radio" name="pnl_kreatifitas_kerja_sama" id="pnl_kreatifitas_kerja_sama{{$i}}" value="{{$i}}" style="margin-right:10px;">
                        <div>{{$i}}</div>
                        </label>
                        @endfor
                </div>
            </div>
            <span class="text-danger" id="kreatifitasErrorMessage"></span>
        </div>
    </div>
    <br>
</div>
</div>
<br><br>
<div class="card" style="padding-bottom: 5px;">
    <div class="card-header">
        <label><b>{{ $jenis[5] }}</b></label>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-6 form-group" style="padding-top: 10px; padding-left:250px;">
                <label for="leadershipDropdown" style="padding-left: 30px;  font-weight: bold;"><b>Kemampuan
                        Leadership</b><span style="color:red;">*</span></label>
                <br><br>
                @for ($i = 1; $i <= 10; $i++) <label class="radio-label">
                    <input type="radio" name="pnl_leadership" id="pnl_leadership{{$i}}" value="{{$i}}" style="margin-right:10px;">
                    <div>{{$i}}</div>
                    </label>
                    @endfor
                    <span class="text-danger" id="leadershipErrorMessage"></span>
            </div>


            <div class="col-5 form-group" style="padding-top: 10px; ">
                <label for="kemampuanDropdown" style="padding-left: 30px;  font-weight: bold;"><b>Kemampuan
                        Menangani
                        Masalah</b><span style="color:red;">*</span></label>
                <br><br>
                @for ($i = 1; $i <= 10; $i++) <label class="radio-label">
                    <input type="radio" name="pnl_penanganan_masalah" id="pnl_penanganan_masalah{{$i}}" value="{{$i}}" style="margin-right:10px;">
                    <div>{{$i}}</div>
                    </label>
                    @endfor
                    <span class="text-danger" id="penangananMasalahErrorMessage"></span>
            </div>
            <div class="col-5 form-group" style="padding-top: 10px; padding-left:250px;">
                <label for="adaptasDropdown" style="padding-left: 30px;  font-weight: bold;"><b>Kemampuan
                        Beradaptasi</b><span style="color:red;">*</span></label>
                <br><br>
                @for ($i = 1; $i <= 10; $i++) <label class="radio-label">
                    <input type="radio" name="pnl_beradaptasi" id="pnl_beradaptasi{{$i}}" value="{{$i}}" style="margin-right:10px;">
                    <div>{{$i}}</div>
                    </label>
                    @endfor

                    <span class="text-danger" id="beradaptasiErrorMessage"></span>
            </div>
            <div class="col-12 form-group" style="padding-left:250px;">
                <label for=" group" font-weight: bold;"><b>Catatan untuk Mahasiswa</b><span style="color:red;">*</span></label>
                <textarea class="form-control" rows="5" id="ulasanTextarea" name="pnl_ulasan" placeholder="Masukkan catatan untuk mahasiswa"></textarea>
                <span class="text-danger" id="ulasanErrorMessage"></span>
            </div>
        </div>
        <br>
    </div>
    <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3 mr-3 float-right">Kembali</a>
    <button type="submit" title="Simpan" class="btn btn-primary mt-3 float-right">Simpan</button>
    </form>
</div>
</div>

<!-- Pastikan Anda telah menyertakan jQuery atau dapat menggantinya dengan versi lain -->
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script>
    document.getElementById('mhsId').addEventListener('change', function() {
        var selectedMhsId = this.value; // Mendapatkan nilai mhs_id yang dipilih dari dropdown
        var profilData = {
            !!json_encode($profile) !!
        }; // Mendapatkan data profil dari blade template

        // Mencari data mahasiswa yang sesuai dengan mhs_id yang dipilih
        var selectedMahasiswa = profilData.find(function(mahasiswa) {
            return mahasiswa.mhs_id == selectedMhsId;
        });

        // Memasukkan data ke dalam field input sesuai dengan yang dipilih
        if (selectedMahasiswa) {
            document.getElementById('NIM').value = selectedMahasiswa.mhs_id;
            document.getElementById('prodi').value = selectedMahasiswa.pro_nama;
            document.getElementById('departemen').value = selectedMahasiswa.kel_departemen;
            document.getElementById('kel').value = selectedMahasiswa.kel_nama;
        } else {
            // Jika tidak ada data yang sesuai, reset field input
            document.getElementById('NIM').value = '';
            document.getElementById('prodi').value = '';
            document.getElementById('departemen').value = '';
            document.getElementById('kel').value = '';
        }
    });
    // document.getElementById('mhsId').addEventListener('change', function () {
    //     var selectedMhsId = this.value; // Mendapatkan nilai mhs_id yang dipilih dari dropdown

    //     // Mencari data mahasiswa yang sesuai dengan mhs_id yang dipilih
    //     var selectedMahasiswa = profilData.find(function (mahasiswa) {
    //         return mahasiswa.mhs_id == selectedMhsId;
    //     });

    //     // Memasukkan data ke dalam field input sesuai dengan yang dipilih
    //     if (selectedMahasiswa) {
    //         document.getElementById('NIM').value = selectedMahasiswa.mhs_id;
    //         document.getElementById('prodi').value = selectedMahasiswa.pro_nama;
    //         document.getElementById('departemen').value = selectedMahasiswa.kel_departemen;
    //         document.getElementById('kel').value = selectedMahasiswa.kel_nama;
    //     } else {
    //         // Jika tidak ada data yang sesuai, reset field input
    //         document.getElementById('NIM').value = '';
    //         document.getElementById('prodi').value = '';
    //         document.getElementById('departemen').value = '';
    //         document.getElementById('kel').value = '';
    //     }
    // });

    function validateForm(event) {
        // Mendapatkan nilai mhs_id yang dipilih dari dropdown
        var selectedMhsId = document.getElementById('mhsId').value;
        // Mendapatkan nilai periode
        var periode = document.getElementById('periode').value;

        // Mendapatkan nilai dari setiap field input
        var pengetahuanKerja = document.getElementById('PengetahuanDropDown').value;
        var kecepatanKerja = document.getElementById('kecepatanDropdown').value;
        var sikapPerilaku = document.getElementById('sikapDropdown').value;
        var kualitasKerja = document.getElementById('Kualitasdropdown').value;
        var kreatifitasKerjaSama = document.getElementById('KreatifitasDropdown').value;
        var leadership = document.getElementById('leadershipDropdown').value;
        var penangananMasalah = document.getElementById('kemampuanDropdown').value;
        var beradaptasi = document.getElementById('adaptasDropdown').value;
        var ulasan = document.getElementById('ulasanTextarea').value;

        // Mendapatkan elemen untuk menampilkan pesan kesalahan
        var mhsIdError = document.getElementById('mhsIdMessage');
        var periodeError = document.getElementById('periodeErrorMessage');
        var pengetahuanError = document.getElementById('pengetahuanErrorMessage');
        var kecepatanError = document.getElementById('kecepatanErrorMessage');
        var sikapError = document.getElementById('sikapErrorMessage');
        var kualitasError = document.getElementById('kualitasErrorMessage');
        var kreatifitasError = document.getElementById('kreatifitasErrorMessage');
        var leadershipError = document.getElementById('leadershipErrorMessage');
        var penangananMasalahError = document.getElementById('penangananMasalahErrorMessage');
        var beradaptasiError = document.getElementById('beradaptasiErrorMessage');
        var ulasanError = document.getElementById('ulasanErrorMessage');

        // Validasi apakah nama mahasiswa telah dipilih
        if (selectedMhsId === "") {
            mhsIdError.innerHTML = "Nama mahasiswa harus dipilih";
            event.preventDefault();
        } else {
            mhsIdError.innerHTML = "";
        }

        // Validasi apakah periode telah diisi
        if (periode === "") {
            periodeError.innerHTML = "Periode harus diisi";
            event.preventDefault(); // Mencegah pengiriman formulir
        } else {
            periodeError.innerHTML = "";
        }

        // Validasi apakah setiap field input memiliki nilai yang valid
        if (pengetahuanKerja === "") {
            pengetahuanError.innerHTML = "Pengetahuan kerja harus dipilih";
            event.preventDefault();
        } else {
            pengetahuanError.innerHTML = "";
        }

        if (kecepatanKerja === "") {
            kecepatanError.innerHTML = "Kecepatan kerja harus dipilih";
            event.preventDefault();
        } else {
            kecepatanError.innerHTML = "";
        }

        if (sikapPerilaku === "") {
            sikapError.innerHTML = "Sikap dan perilaku harus dipilih";
            event.preventDefault();
        } else {
            sikapError.innerHTML = "";
        }

        if (kualitasKerja === "") {
            kualitasError.innerHTML = "Kualitas kerja harus dipilih";
            event.preventDefault();
        } else {
            kualitasError.innerHTML = "";
        }

        if (kreatifitasKerjaSama === "") {
            kreatifitasError.innerHTML = "Kreativitas dan kerjasama harus dipilih";
            event.preventDefault();
        } else {
            kreatifitasError.innerHTML = "";
        }

        if (leadership === "") {
            leadershipError.innerHTML = "Kemampuan leadership harus dipilih";
            event.preventDefault();
        } else {
            leadershipError.innerHTML = "";
        }

        if (penangananMasalah === "") {
            penangananMasalahError.innerHTML = "Kemampuan menangani masalah harus dipilih";
            event.preventDefault();
        } else {
            penangananMasalahError.innerHTML = "";
        }

        if (beradaptasi === "") {
            beradaptasiError.innerHTML = "Kemampuan beradaptasi harus dipilih";
            event.preventDefault();
        } else {
            beradaptasiError.innerHTML = "";
        }

        if (ulasan === "") {
            ulasanError.innerHTML = "Catatan untuk mahasiswa harus diisi";
            event.preventDefault();
        } else {
            ulasanError.innerHTML = "";
        }
    }
</script>

@endsection
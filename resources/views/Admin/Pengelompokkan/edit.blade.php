@extends('Template_Sekprod')
@section('title_admin', 'Edit Pengelompokan')
@section('content')

<body>
    <div class="card-body">
        <div class="col-12 col-md-18" style="margin-top: 40px;"></div>

        @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('Admin.Pengelompokkan.update', $kelompok1->first()['pin_id']) }}">
            @csrf
            @method('PUT')

            <div class="card mt-5 ">
                <div class="card-header">
                    <label><b>Edit Kelompok</b></label>
                </div>
                <div class="card-body" style="padding: 20px 20px 20px 20px;">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label style='font-weight: bold;' for="addKelompok">Kelompok Magang<b style="color: red">*</b></label>
                                <input class="form-control text-box single-line" data-val="true" value="{{ old('kel_nama', $kelompok1->kel_nama) }}" data-val-required="The pin_password field is required." id="kel_nama" name="kel_nama" type="text" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label style='font-weight: bold;' for="addAre">Departemen/Area Magang<b style="color: red">*</b></label>
                                <input class="form-control text-box single-line" data-val="true" value="{{ old('kel_departemen', $kelompok1->kel_departemen) }}" data-val-required="The pin_password field is required." id="kel_departemen" name="kel_departemen" type="text">
                                <span id="kelDepartemenError" style="color: red;"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label style='font-weight: bold;' for="addPembimbing">Pembimbing Industri</label>
                                <select name="pin_id" class="form-control" id="pin_id">
                                    <option value="">-- Pilih Pembimbing --</option>
                                    @foreach ($pembimbing as $pembimbingID => $pin_nama)
                                    <option value="{{ $pembimbingID }}" @selected(old('pin_id')==$pembimbingID || $kelompok1->pin_id == $pembimbingID)>
                                        {{ $pin_nama }}
                                    </option>
                                    @endforeach
                                </select>
                                <span id="pembimbingError" style="color: red;"></span>
                            </div>
                        </div>
                        <br><br>
                        <div class="col-lg-6">
                            <div class="form-group">
                            </div>
                        </div>
                    </div>
                </div>
                <br><br>
            </div>

            <div class="card mt-5">
                <div class="card-header">
                    <label><b>Pilih Mahasiswa</b></label>
                </div>
                <br>
                <div class="card-body" style="padding: 20px 20px 20px 20px;">
                    <div class="row" style="padding-right: 15px;">
                        <div class="input-group ml-auto" style="padding-left: 14px;">
                            <input type="text" class="form-control" id="cari" name="cari" value="{{ isset($cari) ? $cari : '' }}" placeholder="Pencarian" clientidmode="static">
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-primary">Cari</button>
                            </span>
                        </div>
                    </div>

                </div>
                <div class="scrollstyle" style="overflow-x: auto;">
                    <table class="table table-hover table-bordered table-condensed table-striped grid">
                        <thead>
                            <tr style="text-align:center">
                                <th>NIM</th>
                                <th>Nama</th>
                                <th>Prodi</th>
                                <th>Angkatan</th>
                                <th>Jenis Kelamin</th>
                                <th>Pilih</th>
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
                                <!-- Tambahkan checkbox dengan class 'mhs_id' dan data-id -->
                                <td>
                                    <input type="checkbox" class="mhs_id" name="mhs_ids[]" value="{{ $cus->mhs_id }}" {{
                                        in_array($cus->mhs_id, $pengelompokkan) ?
                                    'checked' : '' }}>
                                </td>

                            </tr>
                            @empty
                            <tr>
                                <td colspan="6">Tidak ada data Mahasiswa.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div>
                        {{ $mahasiswa->links('pagination::bootstrap-4') }}
                    </div>
                    <div class="container-login100-form-btn m-t-32">
                        <input type="submit" value="Simpan" class="btn btn-primary" name="simpan">
                        <a href="{{ route('Admin.Pengelompokkan.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
    </div>
    </div>
    </form>
    </div>

</body>

<script>
    // Simpan ukuran awal tabel saat halaman dimuat
    var originalTableWidth = "100%"; // Ganti dengan ukuran yang diinginkan
    var table = document.getElementById("mytable");
    table.style.width = originalTableWidth; // Atur ukuran awal tabel

    function searchTable() {
        var input, filter, tr, td, i, j, txtValue;
        input = document.getElementById("cari");
        filter = input.value.toUpperCase();
        tr = table.getElementsByTagName("tr");

        var hasMatchingRows = false;

        for (i = 0; i < tr.length; i++) {
            var display = false;
            for (j = 0; j < tr[i].cells.length; j++) {
                td = tr[i].cells[j];
                if (td) {
                    if (i === 0) {
                        // Jika baris header, selalu tampilkan
                        display = true;
                        break;
                    }

                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        display = true;
                        hasMatchingRows = true;
                        break;
                    }
                }
            }

            if (display) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }

        // Setel ukuran tabel kembali ke ukuran awal jika tidak ada hasil pencarian
        if (!hasMatchingRows) {
            table.style.width = originalTableWidth;
        } else {
            // Tidak ubah ukuran tabel jika ada hasil pencarian
        }
    }

    function validateForm(event) {
        var kelNama = document.getElementById("kel_nama").value;
        var kelDepartemen = document.getElementById("kel_departemen").value;
        var pin_id = document.getElementById("pin_id").value;
        var regex = /^Kelompok\s\d{1,2}$/;

        var kelNamaError = document.getElementById("kelNamaError");
        var kelDepartemenError = document.getElementById("kelDepartemenError");

        if (kelNama === "") {
            kelNamaError.innerHTML = "Kelompok Magang harus diisi";
            event.preventDefault();
        } else if (!regex.test(kelNama)) {
            document.getElementById("kelNamaError").innerText = "Format Nama Kelompok salah! Format yang benar: 'Kelompok X' atau 'Kelompok XX'";
            formIsValid = false;
        } else {
            kelNamaError.innerHTML = "";
        }

        if (kelDepartemen === "") {
            kelDepartemenError.innerHTML = "Departemen/Area Magang harus diisi";
            event.preventDefault();
        } else {
            kelDepartemenError.innerHTML = "";
        }

        if (pin_id === "") {
            pembimbingError.innerHTML = "Pembimbing harus diisi";
            event.preventDefault();
        } else {
            pembimbingError.innerHTML = "";
        }

        // Mendapatkan semua checkbox dengan class 'mhs_id'
        var checkboxes = document.querySelectorAll('.mhs_id:checked');
        
        // Hitung jumlah checkbox yang dipilih
        var checkedCount = checkboxes.length;
        
        // Jika jumlah checkbox yang dipilih kurang dari 2
        if (checkedCount < 1) {
            // Tampilkan pesan kesalahan
            alert("Pilih setidaknya 1 mahasiswa.");
            
            // Hentikan pengiriman form
            event.preventDefault();
        }
    }
</script>

@endsection
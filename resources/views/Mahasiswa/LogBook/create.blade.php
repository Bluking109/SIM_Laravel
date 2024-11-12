@extends('Template_Sekprod')
@section('title_admin', 'Tambah LogBook')


@section('content')
</hr>
<div id="app">
    <div class="main-wrapper">
        <div class="main-content">
            <div class="container">
                <form name="myform" class="login100-form validate-form p-b-33 p-t-5" onsubmit="return validateForm(event)" method="post" enctype="multipart/form-data" action="{{ route('Mahasiswa.LogBook.store') }}">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <label><b>Isi LogBook </b></label>
                        </div>

                        <div class="card-block">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label style='font-weight: bold;' for="log_minggu">Pekan LogBook<b style="color: red">*</b></label>
                                        <input class="form-control" id="log_minggu" name="log_minggu" type="text" readonly value="Minggu-{{ $latestLogMinggu }}">
                                        @error('log_minggu')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label style='font-weight: bold;' for="addNama">Pembimbing<b style="color: red">*</b></label>
                                        <!-- Input text readonly untuk menampilkan nilai pin_nama -->
                                        <input type="text" class="form-control" name="pin_nama" id="pin_nama" value="{{ $pembimbing->first()->pin_nama ?? '' }}" readonly>

                                        <!-- Hidden field untuk menyimpan nilai pin_id -->
                                        <input type="hidden" name="pin_id" value="{{ $pembimbing->first()->pin_id ?? '' }}">
                                        @error('pin_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>



                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label style='font-weight: bold;' for="addTanggal">Tanggal dan Waktu Pengisian<b style="color: red">*</b></label>
                                        <input type="datetime-local" id="addTanggal" name="create_at" class="form-control">
                                        <span class="text-danger" id="tanggalError"></span>
                                    </div>
                                </div>


                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label style='font-weight: bold;' for="log_hari_1">Kegiatan Hari Senin</label>
                                        <textarea class="form-control" id="log_hari_1" name="log_hari_1"></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label style='font-weight: bold;' for="log_hari_2">Kegiatan Hari Selasa</label>
                                        <textarea class="form-control" id="log_hari_2" name="log_hari_2"></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label style='font-weight: bold;' for="log_hari_3">Kegiatan Hari Rabu</label>
                                        <textarea class="form-control" id="log_hari_3" name="log_hari_3"></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label style='font-weight: bold;' for="log_hari_4">Kegiatan Hari Kamis</label>
                                        <textarea class="form-control" id="log_hari_4" name="log_hari_4"></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label style='font-weight: bold;' for="log_hari_5">Kegiatan Hari Jumat</label>
                                        <textarea class="form-control" id="log_hari_5" name="log_hari_5"></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label style='font-weight: bold;' for="log_hari_6">Kegiatan Hari Sabtu</label>
                                        <textarea class="form-control" id="log_hari_6" name="log_hari_6"></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label style='font-weight: bold;' for="log_hari_7">Kegiatan Hari Minggu</label>
                                        <textarea class="form-control" id="log_hari_7" name="log_hari_7"></textarea>
                                    </div>
                                </div>


                                <div class="container-login100-form-btn m-t-32">
                                    <a href="{{ route('Mahasiswa.LogBook.index') }}" style="width:150px" class="btn btn-secondary">Batal</a>
                                    <input type="submit" value="Simpan" class="btn btn-primary" name="simpan" style="margin-left: 30px; margin-top: 10px; width:150px">

                                </div>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    $(document).ready(function() {
        // Fungsi untuk mengonversi tanggal menjadi string dalam format yang sesuai dengan input tanggal
        function formatDate(date) {
            var year = date.getFullYear();
            var month = (date.getMonth() + 1).toString().padStart(2, '0');
            var day = date.getDate().toString().padStart(2, '0');
            return year + '-' + month + '-' + day;
        }

        // Mendapatkan tanggal saat ini
        var today = new Date();

        // Mendapatkan tahun saat ini
        var currentYear = today.getFullYear();

        // Mendefinisikan tanggal awal dan akhir tahun
        var startOfYear = new Date(currentYear, 0, 1);
        var endOfYear = new Date(currentYear, 11, 31);

        // Array untuk menyimpan semua hari Senin dalam tahun ini
        var allMondays = [];

        // Mengisi array dengan semua hari Senin dalam tahun ini
        var tempDate = new Date(startOfYear);
        while (tempDate.getDay() !== 1) {
            tempDate.setDate(tempDate.getDate() + 1); // Cari hari Senin pertama dalam tahun ini
        }
        while (tempDate <= endOfYear) {
            allMondays.push(new Date(tempDate)); // Tambahkan setiap hari Senin ke dalam array
            tempDate.setDate(tempDate.getDate() + 7); // Pindah ke hari Senin berikutnya
        }

        // Mengatur nilai minimal dan maksimal untuk input tanggal dengan id=addTanggal
        var minDate = formatDate(allMondays[0]); // Menggunakan hari Senin pertama dalam tahun ini
        var maxDate = formatDate(allMondays[allMondays.length - 1]); // Menggunakan hari Senin terakhir dalam tahun ini
        var addTanggalInput = document.getElementById('addTanggal');
        addTanggalInput.setAttribute("min", minDate);
        addTanggalInput.setAttribute("max", maxDate);

        // Menonaktifkan tanggal selain hari Senin pada input dengan id=addTanggal
        $('#addTanggal').on('input', function() {
            var selectedDate = new Date($(this).val());
            if (selectedDate.getDay() !== 1) {
                $(this).val(''); // Mengosongkan nilai input jika bukan hari Senin
            }
        });
    });
</script>





@endsection
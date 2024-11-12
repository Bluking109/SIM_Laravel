@extends('Template_Sekprod')
@section('title_admin', 'Edit LogBook')
@section('content')
</hr>
<div id="app">
    <div class="main-wrapper">
        <div class="main-content">
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <label><b>Edit LogBook</b></label>
                    </div>

                    <div class="card-block">
                        <div class="row">
                            <form action="{{ route('Mahasiswa.LogBook.update', $logbook->log_id) }}"
                                method="post">
                                @csrf
                                @method('PUT')
                                

                        <div class="card-block">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label style='font-weight: bold;' for="log_minggu">Pekan LogBook<b style="color: red">*</b></label>
                                        <input class="form-control" id="log_minggu" name="log_minggu" type="text" readonly value="{{ $logbook->log_minggu }}">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label style='font-weight: bold;' for="addNama">Pembimbing</label>
                                        <!-- Input text readonly untuk menampilkan nilai pin_nama -->
                                        <input type="text" class="form-control" name="pin_nama" id="pin_nama" value="{{ $pembimbing->first()->pin_nama ?? '' }}" readonly>

                                        <!-- Hidden field untuk menyimpan nilai pin_id -->
                                        <input type="hidden" name="pin_id" value="{{ $pembimbing->first()->pin_id ?? '' }}">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label style='font-weight: bold;' for="create_at">Tanggal dan Waktu Pengisian<b style="color: red">*</b></label>
                                        <input id="create_at" name="create_at" class="form-control" value="{{ ($logbook->create_at)}}" readonly>
                                        @error('create_at')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>


                                <!-- ... Formulir lainnya ... -->

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label style='font-weight: bold;' for="log_hari_1">Kegiatan Hari Senin<b style="color: red">*</b></label>
                                        <textarea class="form-control" id="log_hari_1" name="log_hari_1">{{ $logbook->log_hari_1 }}</textarea>
                                    </div>
                                </div>


                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label style='font-weight: bold;' for="log_hari_2">Kegiatan Hari Selasa<b style="color: red">*</b></label>
                                        <textarea class="form-control" id="log_hari_2" name="log_hari_2">{{ $logbook->log_hari_2 }}</textarea>
                                    </div>
                                </div>


                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label style='font-weight: bold;' for="log_hari_3">Kegiatan Hari Rabu<b style="color: red">*</b></label>
                                        <textarea class="form-control" id="log_hari_3" name="log_hari_3">{{ $logbook->log_hari_3 }}</textarea>
                                    </div>
                                </div>


                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label style='font-weight: bold;' for="log_hari_4">Kegiatan Hari Kamis<b style="color: red">*</b></label>
                                        <textarea class="form-control" id="log_hari_4" name="log_hari_4">{{ $logbook->log_hari_4 }}</textarea>
                                    </div>
                                </div>



                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label style='font-weight: bold;' for="log_hari_5">Kegiatan Hari Jumat<b style="color: red">*</b></label>
                                        <textarea class="form-control" id="log_hari_5" name="log_hari_5">{{ $logbook->log_hari_5 }}</textarea>
                                    </div>
                                </div>


                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label style='font-weight: bold;' for="log_hari_6">Kegiatan Hari Sabtu<b style="color: red">*</b></label>
                                        <textarea class="form-control" id="log_hari_6" name="log_hari_6">{{ $logbook->log_hari_6 }}</textarea>
                                    </div>
                                </div>


                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label style='font-weight: bold;' for="log_hari_7">Kegiatan Hari Minggu<b style="color: red">*</b></label>
                                        <textarea class="form-control" id="log_hari_7" name="log_hari_7">{{ $logbook->log_hari_7 }}</textarea>
                                    </div>
                                </div>

                                <!-- ... Formulir untuk kegiatan hari lainnya ... -->

                                <div class="container-login100-form-btn m-t-32">
                                <a href="{{ route('Mahasiswa.LogBook.index') }}" style="width:150px"
                        class="btn btn-secondary">Kembali</a>
                                    <input type="submit" value="Simpan" class="btn btn-primary" name="update" style="margin-left: 30px; margin-top: 10px; width:150px">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


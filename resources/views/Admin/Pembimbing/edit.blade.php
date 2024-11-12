@extends('Template_Sekprod')
@section('title_admin', 'Edit Pembimbing')
@section('content')
</hr>
<div id="app">
    <div class="main-wrapper">
        <div class="main-content">
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <label><b>Edit Pembimbing Industri</b></label>
                    </div>

                    <div class="card-block">
                        <div class="row">
                            <form onsubmit="return validateForm(event)" action="{{ route('Admin.Pembimbing.update', $pembimbing->first()->pin_id) }}"
                                method="post">
                                @method('PUT')
                                @csrf
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label style='font-weight: bold;' for="addNIM">ID Pembimbing<b
                                                style="color: red">*</b></label>
                                        <input class="form-control text-box single-line" data-val="true"
                                            data-val-required="The mhs_nama field is required." id="pin_id"
                                            name="pin_id" type="text"
                                            value="{{ old('pin_id', $pembimbing->first()->pin_id) }}" disabled>
                                    </div>
                                </div>

                                <!-- ... (sisa form fields) ... -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label style='font-weight: bold;' for="addNIM">Nama<b
                                                style="color: red">*</b></label>
                                        <input class="form-control text-box single-line" data-val="true"
                                            data-val-required="The pin_nama field is required." id="pin_nama"
                                            name="pin_nama" type="text"
                                            value="{{ old('pin_nama', $pembimbing->first()->pin_nama) }}">
                                            <label class="text-danger" id="pinNamaError"></label>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label style='font-weight: bold;' for="addNIM">Jabatan<b
                                                style="color: red">*</b></label>
                                        <input class="form-control text-box single-line" data-val="true"
                                            data-val-required="The pin_jabatan field is required." id="pin_jabatan"
                                            name="pin_jabatan" type="text"
                                            value="{{ old('pin_jabatan', $pembimbing->first()->pin_jabatan) }}">
                                            <label class="text-danger" id="pinJabatanError"></label>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label style='font-weight: bold;' type="email" for="addNIM">Email<b
                                                style="color: red">*</b></label>
                                        <input class="form-control text-box single-line" data-val="true"
                                            data-val-required="The pin_jabatan field is required." id="pin_email"
                                            name="pin_email" type="text"
                                            value="{{ old('pin_email', $pembimbing->first()->pin_email) }}">
                                            <label class="text-danger" id="pinEmailError"></label>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label style='font-weight: bold;' for="addNIM">Password<b
                                                style="color: red">*</b></label>
                                        <input class="form-control text-box single-line" data-val="true"
                                            data-val-required="The pin_password field is required." id="pin_password"
                                            name="pin_password" type="text"
                                            value="{{ old('pin_password', $pembimbing->first()->pin_password) }}">
                                            <label class="text-danger" id="pinPasswordError"></label>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label style='font-weight: bold;' for="addNama">Pilih Industri</label>
                                        <select name="ipr_id" class="form-control" id="ipr_id" name="ipr_id">
                                            <option value="">-- Pilih Industri --</option>
                                            @foreach ($industri as $industriID => $ipr_nama)
                                            <option value="{{ $industriID }}" @selected(old('ipr_id')==$industriID ||
                                                $pembimbing->first()->ipr_id == $industriID)>
                                                {{ $ipr_nama }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <label class="text-danger" id="iprIdError"></label>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>

                <div class="container-login100-form-btn m-t-32">
                    <input type="submit" value="Update">

                </div>

            </div>
        </div>
    </div>
</div>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    function validateForm(event) {
        // Mendapatkan nilai dari input dan dropdown
        var pinNama = document.getElementById("pin_nama").value;
        var pinJabatan = document.getElementById("pin_jabatan").value;
        var pinEmail = document.getElementById("pin_email").value;
        var pinPassword = document.getElementById("pin_password").value;
        var iprId = document.getElementById("ipr_id").value;

        // Mendapatkan label untuk menampilkan pesan error
        var pinNamaError = document.getElementById("pinNamaError");
        var pinJabatanError = document.getElementById("pinJabatanError");
        var pinEmailError = document.getElementById("pinEmailError");
        var pinPasswordError = document.getElementById("pinPasswordError");
        var iprIdError = document.getElementById("iprIdError");

        // Validasi setiap input dan dropdown
        if (pinNama === "") {
            pinNamaError.innerHTML = "Nama harus diisi";
            event.preventDefault();
        } else if (!/^[a-zA-Z\s]*$/.test(pinNama)) {
            pinNamaError.innerHTML = "Nama hanya boleh mengandung huruf";
            event.preventDefault();
        } else {
            pinNamaError.innerHTML = "";
        }


        if (pinJabatan === "") {
            pinJabatanError.innerHTML = "Jabatan harus diisi";
            event.preventDefault();
        } else {
            pinJabatanError.innerHTML = "";
        }

        if (pinEmail === "") {
            pinEmailError.innerHTML = "Email harus diisi";
            event.preventDefault();
        } else if (!/^\S+@\S+\.\S+$/.test(pinEmail)) {
            pinEmailError.innerHTML = "Email harus sesuai dengan format yang benar";
            event.preventDefault();
        } else {
            pinEmailError.innerHTML = "";
        }

        if (pinPassword === "") {
            pinPasswordError.innerHTML = "Password harus diisi";
            event.preventDefault();
        } else if (pinPassword.length < 3) {
            pinPasswordError.innerHTML = "Password harus minimal 3 karakter";
            event.preventDefault();
        } else {
            pinPasswordError.innerHTML = "";
        }


        if (iprId === "") {
            iprIdError.innerHTML = "Pilih industri";
            event.preventDefault();
        } else {
            iprIdError.innerHTML = "";
        }
    }
</script>
@endsection
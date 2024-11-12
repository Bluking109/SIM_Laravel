@extends('Template_Sekprod')
@section('title_admin', 'Data LogBook')
@section('content')


    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <br>
    <br>
    <form action="{{ route('Pembimbing.LogBook.daftar') }}" method="GET">
        <div class="row">
            <div class="col-lg-12">
                <div class="input-group">
                    <input type="text" class="form-control" name="cari" id="cari" placeholder="Pencarian" clientidmode="static">
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-secondary">Cari</button>
                    </span>
                    <div class="input-group-btn">
                        <button class="btn btn-primary dropdown-toggle" name="filter" id="filter" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" fdprocessedid="63p3so">
                            <i class="fa fa-filter"></i>&nbsp;Filter
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" style="padding: 20px; min-width: 300px !important;">
                            <div class="form-group">
                                <label style="font-weight: bold;" for="ddUrut">Urut Berdasarkan</label>
                                <label style="font-weight: bold;" for="ddStatus"></label>
                                <select class="form-control" name="ddStatus" id="ddStatus" style="min-width: 260px !important;">
                                    <option value="" selected>Select Status</option>
                                    <option value="disetujui" {{ $selectedStatus == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                                    <option value="ditolak" {{ $selectedStatus == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                    <option value="pending" {{ $selectedStatus == 'pending' ? 'selected' : '' }}>Pending</option>
                                </select>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
    </form>
    <br>
    <br>
    <table class="table container-fluid w-100 h-10 text-center" id="myTable">
        <thead>
            <tr>
                <th class="text-center">
                    No
                </th>
                <th class="text-center">
                    Nama Mahasiswa
                </th>
                <th class="text-center">
                    Departemen/Area Magang
                </th>
                <th class="text-center">
                    Pekan
                </th>
                <th class="text-center">
                    Waktu Mulai Logbook
                </th>
                <th class="text-center">
                    Waktu Selesai Logbook
                </th>
                <th class="text-center">
                    Status
                </th>
                <th class="text-center">
                    Aksi
                </th>
            </tr>
        </thead>
        <tbody>
            @if ($logbook->count() != 0)
            @php
            $i = 1;
            @endphp
            @foreach ($logbook as $log)
            <tr>
                <td>{{ $i }}</td>
                <td class="text-center">{{ $log->mhs_nama }}</td>
                <td class="text-center">{{ $log->kel_departemen }}</td>
                <td class="text-center">{{ $log->log_minggu }}</td>
                <td class="text-center">
                    {{ \Carbon\Carbon::parse($log->log_mulai)->format("l, d F Y, H:i") }}
                </td>
                <td class="text-center">
                    {{ \Carbon\Carbon::parse($log->log_selesai)->format("l, d F Y, H:i") }}
                </td>
                <td class="text-center">{{ $log->log_status }}</td>
                <td>
                    @php
                    $status = "Pending";
                    $trimmedLogStatus = trim($log->log_status);
                    @endphp

                    @if ($trimmedLogStatus === $status)
                    <a href="#" class="Konfirmasi" data-id="{{ $log->log_id }}">
                        <i class="fa fa-check" aria-hidden="true" style="color: #4285f4"></i>
                    </a>

                    <a href="#" class="Tolak" data-id="{{ $log->log_id }}">
                        <i class="fa fa-times" aria-hidden="true" style="color: #4285f4"></i>
                    </a>

                    <a href="{{ route('Mahasiswa.LogBook.detail', ['id' => $log->log_id]) }}" class="Detail">
                        <i class="fa fa-list" aria-hidden="true" style="color: #4285f4"></i>
                    </a>

                    @else

                    <a href="{{ route('Mahasiswa.LogBook.detail', ['id' => $log->log_id]) }}" class="Detail">
                        <i class="fa fa-list" aria-hidden="true" style="color: #4285f4"></i>
                    </a>
                    @endif
                </td>
            </tr>

            @php
            $i++;
            @endphp
            @endforeach
            @endif
        </tbody>

</div>
<script>
    $(document).ready(function() {
        // Event handler for Konfirmasi button
        $('.Konfirmasi').click(function() {
            var logId = $(this).data('id');

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success mx-3',
                    cancelButton: 'btn btn-danger mx-3'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Yakin?',
                text: "LogBook sudah sesuai dan akan Disetujui ? ",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Setujui!',
                cancelButtonText: 'Tidak!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Send the logId to Konfirmasi action in the controller with CSRF token
                    $.ajax({
                        type: 'POST',
                        url: '/LogBookController/konfirmasi/' + logId,
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(result) {
                            // Handle success if needed
                            console.log(result);

                            // Refresh the page after successful confirmation
                            location.reload();
                        },
                        error: function(error) {
                            // Handle error if needed
                            console.log(error);
                        }
                    });
                }
            });
        });

        $('.Tolak').click(function() {
            var logId = $(this).data('id');

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success mx-3',
                    cancelButton: 'btn btn-danger mx-3'
                },
                buttonsStyling: false,
                html: '<input id="alasan" class="swal2-input" placeholder="Alasan penolakan">'
            })

            swalWithBootstrapButtons.fire({
                title: 'Yakin?',
                text: "LogBook tidak sesuai dan akan Ditolak ? ",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Tolak!',
                cancelButtonText: 'Tidak!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    var alasan = $('#alasan').val();
                    // Send the logId and alasan to Tolak action in the controller with CSRF token
                    $.ajax({
                        type: 'POST',
                        url: '/LogBookController/tolak/' + logId,
                        data: {
                            _token: '{{ csrf_token() }}',
                            alasan: alasan
                        },
                        success: function(result) {
                            // Handle success if needed
                            console.log(result);

                            // Refresh the page after successful confirmation
                            location.reload();
                        },
                        error: function(error) {
                            // Handle error if needed
                            console.log(error);
                        }
                    });
                }

            });
        });
        $('#ddStatus').on('click', function(e) {
            e.stopPropagation();
        });
    });
</script>

@endsection
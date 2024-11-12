@extends('Template_Sekprod')
@section('title_admin', 'Data Pembimbing')
@section('content')

<body>
    <a href="{{ route('Admin.Pembimbing.create') }}" class="btn btn-primary">
        <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Tambah Pembimbing
    </a>

    <div class="card-body">
        @if (session('successMessage'))
        <div class="alert alert-success">{{ session('successMessage') }}</div>
        @endif

        @if (session('warningMessage'))
        <div class="alert alert-warning">{{ session('warningMessage') }}</div>
        @endif

        <br>
        <br>

        <form action="{{ route('Admin.Pembimbing.index') }}" method="GET">
            <div class="row">
                <div class="col-lg-12">
                    <div class="input-group">
                        <input type="text" class="form-control" id="cari" name="cari" value="{{ $cari }}" placeholder="Pencarian" clientidmode="static">
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-secondary">Cari</button>
                        </span>
                    </div>
                </div>
            </div>
        </form>
        <br>
        <div class="scrollstyle" style="overflow-x: auto;">
            <table class="table table-hover table-bordered table-condensed table-striped grid">
                <thead>
                    <tr style="text-align:center">
                        <th>No</th>
                        <th>ID Pembimbing</th>
                        <th>Nama Pembimbing</th>
                        <th>Jabatan</th>
                        <th>Industri</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Aksi</th>
                <tbody>
                    @forelse ($pembimbing as $key => $cus)
                    <tr>
                        <td style="text-align:center;">{{ $key + 1 }}</td>
                        <td style="text-align:center;">{{ $cus->pin_id }}</td>
                        <td>{{ $cus->pin_nama }}</td>
                        <td>{{ $cus->pin_jabatan }}</td>
                        <td>{{ $cus->ipr_nama }}</td>
                        <td>{{ $cus->pin_email }}</td>
                        <td>{{ $cus->pin_password }}</td>
                        <td class="text-center">
                            <a href="{{ route('Admin.Pembimbing.edit', ['id' => $cus->pin_id]) }}" class="fa fa-pencil-square-o"></a>
                            <a href="#" class="fa fa-trash" onclick="confirmDelete('{{ $cus->pin_id }}')"></a>
                            <form id="delete-row-{{ $cus->pin_id }}" action="{{ route('Admin.Pembimbing.destroy', ['id' => $cus->pin_id]) }}" method="POST">
                                @csrf
                                @method('PUT')
                            </form>


                            @if (session('status'))
                            <script>
                                Swal.fire({
                                    icon: '{{ session("status") == "success" ? "success" : "error" }}',
                                    title: '{{ session("status") == "success" ? "Berhasil" : "Gagal" }}',
                                    text: '{{ session("status") == "success" ? "Data berhasil dihapus" : "Gagal menghapus data" }}',
                                });
                            </script>
                            @endif
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div>
                {{ $pembimbing->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>

</body>

<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Hapus?',
            text: 'Apakah Kamu Akan Menghapus Data Ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-row-' + id).submit();
            }
        });
    }
</script>


@endsection
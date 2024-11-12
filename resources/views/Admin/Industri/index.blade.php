@extends('Template_Sekprod')
@section('title_admin', 'Data Industri')
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

            <form action="{{ route('Admin.Industri.index') }}" method="GET">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="input-group">
                            <input type="text" class="form-control" id="cari" name="cari" value="{{ $cari }}"
                                placeholder="Pencarian" clientidmode="static">
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
                            <th style="width:8%;">ID</th>
                            <th>Nama</th>
                            <th>Group</th>
                            <th>Alamat</th>
                            <th>Status</th>
                        
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($industri as $cus)
                        <tr>
                            <td>{{ $cus->ipr_id }}</td>
                            <td>{{ $cus->ipr_nama }}</td>
                            <td>{{ $cus->ipr_grup }}</td>
                            <td>{{ $cus->ipr_alamat }}</td>
                            <td>{{ $cus->ipr_status }}</td>
                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div>
                    {{ $industri->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    
</body>
@endsection
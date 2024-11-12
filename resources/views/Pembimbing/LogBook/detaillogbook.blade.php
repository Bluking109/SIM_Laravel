@extends('Template_Sekprod')
@section('title_admin', 'Detail LogBook')
@section('content')

<div class="card mt-5 ">
        <div class="card-header">
                            <label><b>Logbook Mahasiswa</b></label>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered" id="mytable" name="mytable">
                                <tr>

                                    <th>No</th>
                                    <th>Tanggal Pengajuan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                    <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    
                                    @forelse ($logbook as $cus)
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>{{ $cus->created_at ?? '' }}</td>
                                            <td>{{ is_object($cus) ? $cus->log_status : '' }}</td>
                                        </tr>
                                        @php
                                            $i++;
                                        @endphp
                                    @empty
                                        <tr>
                                            <td colspan="8">Tidak ada data Logbook.</td>
                                        </tr>
                                    @endforelse
                                </tbody>

                            </table>

                        </div>
                    </div>
                    @endsection
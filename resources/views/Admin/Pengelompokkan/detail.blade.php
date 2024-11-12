@extends('Template_Sekprod')
@section('title_admin', 'Detail Pengelompokan')
@section('content')

<body>
    <div class="card mt-5">
        <div class="card-header">
            <label><b>Detail Mahasiswa</b></label>
        </div>
        <div class="card-block">
            <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label style='font-weight: bold;'>Kelompok Magang<b style="color: red">*</b></label>
                    <input class="form-control text-box single-line" data-val="true" data-val-required="The mhs_nama field is required." 
                        id="pin_id" name="pin_id" type="text"  value="{{ old('kel_nama', $kelompok->first()->kel_nama) }}" disabled>
                </div>      
            </div>                  
            <div class="col-lg-6">
                <div class="form-group">
                    <label style='font-weight: bold;'>Industri Magang<b style="color: red">*</b></label>
                    <input class="form-control text-box single-line" data-val="true" data-val-required="The mhs_nama field is required." 
                        id="pin_id" name="pin_id" type="text"  value="{{ old('ipr_nama', $kelompok->first()->ipr_nama) }}" disabled>
                </div> 
            </div>                  
            <div class="col-lg-6"> 
                <div class="form-group">
                    <label style='font-weight: bold;'>Pembimbing Industri<b style="color: red">*</b></label>
                    <input class="form-control text-box single-line" data-val="true" data-val-required="The mhs_nama field is required." 
                        id="pin_id" name="pin_id" type="text"  value="{{ old('pin_nama', $kelompok->first()->pin_nama) }}" disabled>
                </div> 
            </div>                  
            <div class="col-lg-6"> 
                <div class="form-group">
                    <label style='font-weight: bold;'>Departemen/Area Magang<b style="color: red">*</b></label>
                    <input class="form-control text-box single-line" data-val="true" data-val-required="The mhs_nama field is required." 
                        id="pin_id" name="pin_id" type="text"  value="{{ old('kel_departemen', $kelompok->first()->kel_departemen) }}" disabled>
                </div>  
            </div>
        </div>                
    </div> 
    <div style="padding : 20px 20px 20px 20px;">
                <table id="datatable" class="table table-hover table-bordered table-condensed table-striped grid">
                    <thead>
                        <tr style="text-align:center">
                            <th style="width:8%;">
                                No
                            </th>
                            <th style="text-align: center;">
                                Nama Mahasiswa
                            </th>
                            <th style="text-align: center;">
                                Prodi
                            </th>
                        </tr>
                    </thead>
                    <br><br>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($kelompok as $item)
                            <tr>
                                <td style="text-align:center">
                                    {{ $i }}
                                </td>
                                <td style="text-align:left">
                                    {{ $item->mhs_nama }}
                                </td>
                                <td style="text-align:center">
                                    {{ $item->pro_nama }}
                                </td>
                            </tr>
                            @php
                                $i++;
                            @endphp
                        @endforeach
                    </tbody>
                </table>
                <a href="{{ route('Admin.Pengelompokkan.index') }}" style="width:150px" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
    <br />
   
</body>
@endsection

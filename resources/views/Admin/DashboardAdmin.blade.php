@extends('Template_SekProd')
@section('title_admin', 'Dashboard')
@section('content')
<div class="col panelcontent panelcontentweb" style="font-size: 14px; height:650px">
    <div class="jumbotron" style="box-shadow: none; height:auto; padding: 15px 30px; background-color: white">
        <div class="card-block">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card-container" style="padding-right:40px; border-radius: 15px;">
                        <div class="card-dashboard" style="background-color: white; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2); border-radius: 15px;">
                            <h5 style="text-align:left; display:inline-block; padding-top:30px; padding-left:30px; padding-bottom:20px; margin-bottom: 10px;">Pembimbing Industri <span style="color: #776">| Aktif</span></h5>
                            <div class="row" style="display: flex; align-items: center;">
                                <div style="flex: 1;">
                                    <i class="ri-presentation-fill text-primary" style="font-size: 60px; padding-left:50px;"></i>
                                </div>
                                <div style="flex: 2;">
                                    <h1 style="text-align:left; padding-top:20px; padding-left:60px; padding-bottom:30px; margin: 0; font-size: 40px;">{{ $pembimbing }}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card-container" style="padding-right:40px; border-radius: 15px;">
                        <div class="card-dashboard" style="background-color: white; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2); border-radius: 15px;">
                            <h5 style="text-align:left; display:inline-block; padding-top:30px; padding-left:30px; padding-bottom:20px; margin-bottom: 10px;">Kelompok Magang <span style="color: #776">| Aktif</span></h5>
                            <div class="row" style="display: flex; align-items: center;">
                                <div style="flex: 1;">
                                    <i class="ri-group-fill text-primary" style="font-size: 60px; padding-left:50px;"></i>
                                </div>
                                <div style="flex: 2;">
                                    <h1 style="text-align:left; padding-top:20px; padding-left:60px; padding-bottom:30px; margin: 0; font-size: 40px;">{{ $kelompok }}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card-container" style="padding-right:40px; border-radius: 15px;">
                        <div class="card-dashboard" style="background-color: white; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2); border-radius: 15px;">
                            <h5 style="text-align:left; display:inline-block; padding-top:30px; padding-left:30px; padding-bottom:20px; margin-bottom: 10px;">Mahasiswa Magang <span style="color: #776">| Aktif</span></h5>
                            <div class="row" style="display: flex; align-items: center;">
                                <div style="flex: 1;">
                                    <i class="ri-graduation-cap-fill text-primary" style="font-size: 60px; padding-left:50px;"></i>
                                </div>
                                <div style="flex: 2;">
                                    <h1 style="text-align:left; padding-top:20px; padding-left:60px; padding-bottom:30px; margin: 0; font-size: 40px;">{{ $mahasiswa }}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

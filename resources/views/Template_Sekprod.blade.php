<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width" />

    <link href="{{ asset('assets/Plugins/bootstrap-4.0.0-alpha.6-dist/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/Plugins/font-awesome-4.7.0/css/font-awesome.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/Content/jquery.fancybox.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/Content/bootstrap-select.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/Styles/Style.css') }}" rel="stylesheet" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.7.0/fonts/remixicon.css" rel="stylesheet">
    <script src="{{ asset('assets/Scripts/tether/tether.min.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <!-- jangan lupa menambahkan script js sweet alert di bawah ini  -->
    <script src="//cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.7/dist/sweetalert2.all.min.js"></script>
    <script src="{{ asset('assets/Scripts/jquery-ui-1.12.1.min.js') }}"></script>
    <script src="{{ asset('assets/Plugins/bootstrap-4.0.0-alpha.6-dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/Plugins/Highcharts-5.0.14/code/highcharts.js') }}"></script>
    <script src="{{ asset('assets/Plugins/Highcharts-5.0.14/code/highcharts-more.js') }}"></script>
    <script src="{{ asset('assets/Plugins/Highcharts-5.0.14/code/modules/solid-gauge.js') }}"></script>
    <script src="{{ asset('assets/Scripts/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('assets/Scripts/jquery.fancybox.pack.js') }}"></script>
    <script src="{{ asset('assets/Scripts/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('assets/Scripts/LetterAvatar.js') }}"></script>
    <script src="{{ asset('assets/Scripts/tableToExcel.js') }}"></script>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script type="text/javascript">
        $(function () {
            $("[data-toggle=tooltip").tooltip();
        })

        $(function () {
            $('[rel="tooltip"]').tooltip()
        })

        $(function () {
            $('[data-toggle="popover"]').popover()
        })

        function redirectNotifikasi() {
            // window.location.href = 'Page_Notifikasi.aspx';
        }

        function sentValidation(input) {
            // $(input).addClass('disabled');
            // $(input).text('Mohon tunggu..');
        }

        function pageLoad(sender, args) {
            // $('.selectpicker').selectpicker();
            // katweKibsAvatar.init({
            //     dataChars: 2
            // });
        }


    </script>

    <script src="{{ asset('assets/Scripts/jquery.floatThead.js')}}"></script>

    <style>
        .mce-branding-powered-by {
            display: none;
        }

        table {
            border-top: none;
            border-bottom: none;
            background-color: #FFF;
            white-space: nowrap;
            margin: 0;
            text-align: left;
        }

        .table-striped tbody tr:nth-of-type(2n+1) {
            background-color: #FFF;
        }

        .table-striped tbody tr:nth-of-type(2n),
        thead {
            background-color: #ECECEC;
        }

        .table-striped tbody tr.pagination-ys {
            background-color: #FFF;
        }

        .bottom-wrapper {
            margin-top: 1em;
        }
    </style>

    <script type="text/javascript" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap4.min.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/buttons/2.3.4/css/buttons.dataTables.min.css">

    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.4/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.print.min.js"></script>
</head>

<body class="scrollstyle2">
    <div>
        <div class="polman-nav-static-top">
            <div class="float-left">
                <img src="{{ asset('assets/Images/LOGO.jpeg')}}" style="height: 55px;" />
                </a>
            </div>

            <div class="polman-menu">
                <nav class="nav justify-content-end" style="padding-top: 15px;">
                    <b id="username1">{{session('usr_nama')}} ({{ session('usr_role')
                        }})</b>
                </nav>
            </div>
            <div class="polman-menu-bar">
                <div class="float-right">
                    <div class="fa fa-bars fa-2x" style="margin-top: 9px; cursor: pointer;" aria-hidden="true"
                        data-toggle="collapse" data-target="#menu" aria-expanded="false" aria-controls="menu"></div>
                </div>
            </div>
        </div>

        <div class="polman-nav-static-right collapse scrollstyle" id="menu">
            <div id="accordions" role="tablist" aria-multiselectable="true">
                <div class="list-group">
                    @if(strtolower(session('usr_role')) == 'sekretaris prodi')
                    <a href="{{ route('auth.login') }}" class="list-group-item list-group-item-action"
                        style="border-radius: 0px; border: none; padding-left: 22px; display: inherit;">
                        <i class="fa fa-sign-out fa-lg fa-pull-left"></i>Logout
                    </a>
                    <a href="{{ route('Sekprod.Dashboard.dashboard') }}" class="list-group-item list-group-item-action"
                        style="border-radius: 0px; border: none; padding-left: 22px; display: inherit;">
                        <i class="fa fa-home fa-lg fa-pull-left"></i>Dashboard
                    </a>
                    <a href="{{ route('Admin.Mahasiswa.index') }}" class="list-group-item list-group-item-action"
                        style="border-radius: 0px; border: none; padding-left: 22px; display: inherit;">
                        <i class=" fa fa-graduation-cap fa-lg fa-pull-left"></i>Mahasiswa
                    </a>
                    <a href="{{ route('Admin.LaporanPenilaian.indexSekProd') }}" class="list-group-item list-group-item-action"
                        style=" border-radius: 0px; border: none; padding-left: 22px; display: inherit;">
                        <i class="fa fa-pencil fa-lg fa-pull-left"></i>Laporan Penilaian
                    </a>
                    @elseif(strtolower(session('usr_role')) == 'admin')
                    <a href="{{ route('auth.login') }}" class="list-group-item list-group-item-action"
                        style="border-radius: 0px; border: none; padding-left: 22px; display: inherit;">
                        <i class='fa fa-sign-out fa-lg fa-pull-left'></i>Logout
                    </a>
                    <a href="{{ route('Admin.DashboardAdmin') }}" class="list-group-item list-group-item-action"
                        style="border-radius: 0px; border: none; padding-left: 22px; display: inherit;">
                        <i class="fa fa-home fa-lg fa-pull-left"></i>Dashboard
                    </a>
                    <a href="{{ route('Admin.Mahasiswa.index') }}" class="list-group-item list-group-item-action"
                        style="border-radius: 0px; border: none; padding-left: 22px; display: inherit;">
                        <i class=" fa fa-graduation-cap fa-lg fa-pull-left"></i>Mahasiswa
                    </a>
                    <a href="{{ route('Admin.Penilaian.index') }}" class="list-group-item list-group-item-action"
                        style=" border-radius: 0px; border: none; padding-left: 22px; display: inherit;">
                        <i class="fa fa-pencil fa-lg fa-pull-left"></i>Penilaian
                    </a>
                    <a href="{{ route('Admin.Industri.index') }}" class="list-group-item list-group-item-action"
                        style="border-radius: 0px; border: none; padding-left: 22px; display: inherit;">
                        <i class="fa fa-building fa-lg fa-pull-left"></i>Industri
                    </a>

                    <a href="{{ route('Admin.Pembimbing.index') }}" class="list-group-item list-group-item-action"
                        style="border-radius: 0px; border: none; padding-left: 22px; display: inherit;">
                        <i class="fa fa-user-circle fa-lg fa-pull-left"></i>Pembimbing Industri
                    </a>
                    <a href="{{ route('Admin.Pengelompokkan.index') }}" class="list-group-item list-group-item-action"
                        style="border-radius: 0px; border: none; padding-left: 22px; display: inherit;">
                        <i class="fa fa-users fa-lg fa-pull-left"></i>Pengelompokan Magang
                    </a>
                    @elseif(strtolower(session('usr_role')) == 'mahasiswa')
                    <a href="{{ route('auth.login') }}" class="list-group-item list-group-item-action"
                        style="border-radius: 0px; border: none; padding-left: 22px; display: inherit;">
                        <i class="fa fa-sign-out fa-lg fa-pull-left"></i>Logout
                    </a>
                    <a href="{{ route('Mahasiswa.DashboardMahasiswa') }}" class="list-group-item list-group-item-action"
                        style=" border-radius: 0px; border: none; padding-left: 22px; display: inherit;">
                        <i class='fa fa-home fa-lg fa-pull-left'></i>Dashboard
                    </a>
                    <a href="{{ route('Admin.Mahasiswa.detail', ['id' => 'mhs_id']) }}"
                        class="list-group-item list-group-item-action"
                        style=" border-radius: 0px; border: none; padding-left: 22px; display: inherit;">
                        <i class="fa fa-users fa-lg fa-pull-left"></i>Profil
                    </a>
                    <a href="{{ route('Mahasiswa.LogBook.index') }}" class="list-group-item list-group-item-action"
                        style="border-radius: 0px; border: none; padding-left: 22px; display: inherit;">
                        <i class="fa fa-users fa-lg fa-pull-left"></i>LogBook
                    </a>
                    @elseif(strtolower(session('usr_role')) == 'pembimbing industri')
                    <a href="{{ route('auth.login') }}" class="list-group-item list-group-item-action"
                        style="border-radius: 0px; border: none; padding-left: 22px; display: inherit;">
                        <i class='fa fa-sign-out fa-lg fa-pull-left' style="font-size: 20px;"></i>Logout
                    </a>
                    <a href="{{ route('Pembimbing.DashboardPembimbing') }}"
                        class="list-group-item list-group-item-action"
                        style="border-radius: 0px; border: none; padding-left: 22px; display: inherit;">
                        <i class='fa fa-home fa-lg fa-pull-left' style="font-size: 20px;"></i>Dashboard
                    </a>
                    <a href="{{ route('Admin.Mahasiswa.index') }}" class="list-group-item list-group-item-action"
                        style="border-radius: 0px; border: none; padding-left: 22px; display: inherit;">
                        <i class=" fa fa-graduation-cap fa-lg fa-pull-left"></i>Mahasiswa
                    </a>
                    <a href="{{ route('Pembimbing.Penilaian.firstPage') }}"
                        class="list-group-item list-group-item-action"
                        style="border-radius: 0px; border: none; padding-left: 22px; display: inherit;">
                        <i class="fa fa-users fa-lg fa-pull-left" style="font-size: 20px;"></i>Penilaian
                    </a>
                    <a href="{{ route('Pembimbing.LogBook.daftar')}}" class="list-group-item list-group-item-action"
                        style="border-radius: 0px; border: none; padding-left: 22px; display: inherit;">
                        <i class="fa fa-users fa-lg fa-pull-left" style="font-size: 20px;"></i>LogBook
                    </a>

                    @endif


                </div>
            </div>
        </div>

        <div id="allcontent" class="polman-adjust5">
            <ol class="breadcrumb polman-breadcrumb">
                <li class="breadcrumb-item"><a href='#' data-toggle="tooltip" data-placement="bottom"
                        title="Menuju Halaman SSO">Sistem informasi Magang</a></li>
                <li class="breadcrumb-item">@yield('title_admin')</li>
            </ol>
            <hr />
            @yield('content')
        </div>

    </div>
</body>

</html>
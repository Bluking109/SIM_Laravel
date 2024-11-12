<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Informasi Magang</title>
    <link rel="shortcut icon" href="{{ asset('assets/Images/LOGO.png') }}">

    <link href="{{ asset('assets/Plugins/bootstrap-4.0.0-alpha.6-dist/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/Plugins/font-awesome-4.7.0/css/font-awesome.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/Content/jquery.fancybox.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/Content/bootstrap-select.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/Styles/Style.css') }}" rel="stylesheet" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-TZl1bgnFFb8sbbV6BIq5S0Yw5JNwPrM2f8+ndbOEEq28qKEKhU5cEXPrM+OrnbWd" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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


    <style>
        .mce-branding-powered-by {
            display: none;
        }

        body {
            background-image: url('{{ asset('assets/Images/IMG_Background.jpg') }}');
            background-repeat: no-repeat;
            background-size: cover;
        }

        .form-container {
            max-width: 400px;
            margin: 0 auto;
            padding: 30px;
            padding-top: 70px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            margin-top: 50px;
        }

        .img-circle img {
            width: 100%;
            max-width: 340px;
            position: absolute;
            margin-top: 20px;
        }
    </style>

    @push('scripts')
    <script type="text/javascript">
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
            $('[rel="tooltip"]').tooltip();
            $('[data-toggle="popover"]').popover();
        });

        function sentValidation(input) {
            $(input).addClass('disabled');
            $(input).text('Mohon tunggu..');
        }

        function pageLoad(sender, args) {
            $('.selectpicker').selectpicker();
        }

        function showModalKey() {
            $('#changeModal').modal({ backdrop: 'static', keyboard: false });
        }
    </script>
    @endpush
</head>

<body class="scrollstyle2">
    <div class="polman-nav-static-top" style="display: flex; align-items: center;">
        <div class="float-left polman-adjust4">
            <img src="{{ asset('assets/Images/LOGO.jpeg') }}" style="height: 60px; margin-top: 5px;" />
        </div>
    </div>

    <form method="post" enctype="multipart/form-data" autocomplete="off">
        @csrf

        <div class="polman-form-login">
            <h4>Login</h4>
            <hr>
            <div class="alert alert-danger" id="divAlert" style="display: none;"></div>
            <div class="alert alert-success" id="divSuccess" style="display: none;"></div>

            <div class="form-group">
                <label for="txtUsername">Nama Akun <span style="color: red;">*</span></label>
                <span id="reqTxtUsername" style="color:Red;display:none;">Nama akun harus diisi</span>
                <input type="text" name="txtUsername" id="txtUsername" class="form-control text-center">
            </div>
            <div class="form-group">
                <label for="txtPassword">Kata Kunci <span style="color: red;">*</span></label>
                <span id="reqTxtPassword" style="color:Red;display:none;">Kata kunci harus diisi</span>
                <input type="password" name="txtPassword" id="txtPassword" class="form-control text-center">
            </div>

            <button type="button" class="btn btn-primary" onclick="btnLogin_Click()"
                style="width: 100%; margin-top: 10px; margin-bottom: 10px;">Masuk</button>
        </div>

        <div>
            <div class="polman-nav-static-bottom">
                Copyright © 2024 - MIS Politeknik Astra
            </div>
        </div>
    </form>


    @push('scripts')
    <script
        src="{{ asset('/sso/WebResource.axd?d=pynGkmcFUV13He1Qd6_TZIOYCJWzLiSg6Vt50C4hcArkFWENdd5y-V10UR14dRSKFffZpw2&amp;t=638259614771233176') }}"
        defer></script>
    <script
        src="{{ asset('/sso/ScriptResource.axd?d=nv7asgRUU0tRmHNR2D6t1JVp-ZMabRYPBqxA0qfWYtMhsnczqkll8VxJ8pW18t9N8t9Sa7GV5BEbGJkWLYe9gY02X8EFKn9239ABL9-tI1oJPplfT_wA_ZyhhIIYfKMZjQUaHQ2&amp;t=3fff4fa7') }}"
        defer></script>
    @endpush

</body>

</html>
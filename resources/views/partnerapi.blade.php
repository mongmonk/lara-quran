<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $title }}</title>
    <meta name="google-site-verification" content="{{ config('app.google_site_verification') }}" />
    <link rel="canonical" href="{{ url('/') }}" />
    <meta name="description" value="{{ config('app.description') }}">
    <meta property="og:locale" content="id_ID" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="{{ config('app.name') }}" />
    <meta property="og:description" content="{{ config('app.description') }}" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:site_name" content="{{ config('app.name') }}" />
    <meta property="og:image" content="{{ asset('inc/alquran.png') }}" />
    <meta property="og:image:width" content="800" />
    <meta property="og:image:height" content="500" />
    <meta property="og:image:type" content="image/png" />
    @include('css')
</head>
<body>
    <div class="wrapper">
        @include('sidenav')
            <div class="post">
                <h5 class="text-center mb-3">السلام عليكم ورحمة الله وبركاته</h5>
                <h2 class="text-center mb-3">{{ $title }}</h2>
                <p>Berikut adalah list API Partner yang digunakan {{ config('app.name') }} dalam pengembangannya. Teriring doa jazakumullahu ahsanal jaza` fiddini waddunya wal akhirah buat pengembang API berikut. Semoga Allah selalu menyertai setiap aktifitasmu. Amiin</p>
                <ol>
                    <li><a href="https://alquran.cloud/" target="_blank">Al Quran Cloud - A Full Featured Quran App</a></li>
                    <li><a href="https://github.com/gadingnst/hadith-api" target="_blank">Hadith-API</a></li>
                    <li><a href="https://api.myquran.com/" target="_blank">API myQuran - Islamic API</a></li>
                    <li><a href="https://doa-doa-api-ahmadramadhan.fly.dev/" target="_blank">API Doa Sehari-hari</a></li>
                    <li><a href="https://github.com/Kieza17/doa-tahlil" target="_blank">API Doa Tahlil</a></li>
                </ol> 
            </div>
            <div class="footer">
                <div class="text-center py-3">&copy;{{ date('Y') }} <a href="{{ url('/') }}">{{ config('app.name') }}</a>. Developed by <a href="mailto:akunpribadiku@gmail.com">akunpribadiku@gmail.com</a></div>
            </div>          
        </div>
    </div>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
                $(this).toggleClass('active');
            });
        });
    </script>
</body>

</html>
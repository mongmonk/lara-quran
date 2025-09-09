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
                <p>Segala puji bagi Allah, Tuhan semesta alam. Dengan rahmat dan ridlonya, {{ config('app.name') }} bisa menghadirkan Al-quran beserta terjemahan dalam Bahasa Indonesia dan Bahasa Inggris, serta audionya dengan harapan agar memudahkan kaum Muslimin dalam membaca dan juga mempelajari Al-quranul Karim.</p>
                <p>Project My QUR`AN ini di develope oleh <a href="https://t.me/cemonggaul">Cemonggaul</a> menggunakan framework <a href="https://codeigniter.com/" target="_blank">CodeIgniter3</a> dengan memanfaatkan API open source <a href="https://github.com/islamic-network/api.alquran.cloud" target="_blank">API Al-Quran</a> yang tersedia dalam berbagai macam bahasa. Namun disini My QUR`AN hanya mengambil yang Bahasa Indonesia, Bahasa Inggris dan juga Rasmul Usmani yang merupakan standar Al-quran Indonesia. Dan juga menggunakan data open source Hadits dari Project <a href="https://github.com/gadingnst/hadith-api" target="_blank">Hadith-API</a> dan juga beberapa API lain yang bisa dilihat <a href="{{ url('quran/partnerapi') }}">DISINI</a>. Mudah-mudahan Allah selalu melimpahkan hidayah, ridla, serta inayah-Nya kepada penyusun API Al-Quran dan HADITS API. Amin ya robbal alamin.</p>
                <p>Dengan adanya fitur Al-Quran per ayat, diharapkan akan membantu para calon hafidz dan hafidzoh dalam menghafal Alquran. Semua sudah dilengkapi dengan terjemahan dan juga audio bacaannya. Begitu pula dengan fitur audionya yang bisa dipilih reciter-nya sesuai keinginan diharapkan dapat mempermudah kaum Muslimin untuk belajar membaca Al-quran dengan baik dan enak didengar.</p>
                <p>Walaupun masih dalam tahap pengembangan, mudah-mudahan kehadiran Al-Quran yang disajikan oleh {{ config('app.name') }} bermanfaat bagi seluruh kaum Muslimin semuanya. Aamiin</p>
                <p>Untuk kritik, saran, masukan, atau donasi silahkan hubungi <a href="https://t.me/cemonggaul">Cemonggaul</a>. Terima kasih.</p>
                <p>Ingin mengembangkan aplikasi ini? Silahkan kunjungi <a href="https://github.com/mongmonk/lara-quran" target="_blank">Github Repository</a> nya.</p>
                <h5 class="text-center mt-3">والسلام عليكم ورحمة الله وبركاته</h5>
            </div>
            <div class="footer">
                <div class="text-center py-3">&copy;{{ date('Y') }} <a href="{{ url('/') }}">{{ config('app.name') }}</a>. Developed by <a href="https://t.me/cemonggaul">Cemonggaul</a></div>
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
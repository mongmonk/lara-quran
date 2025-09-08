
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $title }}</title>
    <meta name="google-site-verification" content="v41YLnzLxTtkqUVRPNP4qRvhFd4OLz5SHvhimMvEv7w" />
    <link rel="canonical" href="{{ url('/') }}" />
    <meta name="description" value="Jadikanlah Al-quranul Karim dan Sunnah Nabi sebagai tuntunan hidupmu agar kamu tidak sesat">
    <meta property="og:locale" content="id_ID" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="My QUR`AN" />
    <meta property="og:description" content="Jadikanlah Al-quranul Karim dan Sunnah Nabi sebagai tuntunan hidupmu agar kamu tidak sesat" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:site_name" content="My QUR`AN" />
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
                <h5 class="text-center mb-3">بِسْمِ ٱللَّهِ ٱلرَّحْمَٰنِ ٱلرَّحِيمِ</h5>
                <p>Silahkan isi from berikut untuk menghubungi My QUR`AN</p>
                {!! $pesan !!}
                <form method="post">
                    @csrf
                    <div class="row">
                        <label class="col-2 my-3">Nama <small class="text-danger">*</small></label>
                        <div class="col-10 my-2">
                            <input class="form-control" name="nama" placeholder="Ahmad Karim" required>
                        </div>
                        <label class="col-2 my-3">Email <small class="text-danger">*</small></label>
                        <div class="col-10 my-2">
                            <input type="email" class="form-control" name="email" placeholder="name@domain.com" required>
                        </div>
                        <label class="col-2 my-3">No.WA <small class="text-danger">*</small></label>
                        <div class="col-10 my-2">
                            <input type="number" class="form-control" name="wa" placeholder="081xxxxxxxxx" required>
                        </div>
                        <label class="col-2 my-3">Pesan <small class="text-danger">*</small></label>
                        <div class="col-10 my-2">
                            <textarea class="form-control" name="pesan" placeholder="Tuliskan pesan disini" required></textarea>
                        </div>
                        <div class="col-md-10"></div>
                        <div class="col-md-2 my2"><button class="btn btn-success form-control" type="submit">Kirim Pesan</button></div>
                    </div>
                </form>
            </div>
            <div class="footer">
                <div class="text-center py-3">&copy;{{ date('Y') }} <a href="{{ url('/') }}">My QUR`AN</a>. Developed by <a href="https://t.me/cemonggaul">Cemonggaul</a></div>
            </div>          
        </div>
    </div>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+9
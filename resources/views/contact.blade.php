
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
    <meta property="og:image" content="{{ asset('inc/images/alquran.png') }}" />
    <meta property="og:image:width" content="800" />
    <meta property="og:image:height" content="500" />
    <meta property="og:image:type" content="image/png" />
    @include('css')
</head>
<body>
    <div class="wrapper">
        @include('sidenav')
            <div class="post px-3">
                <h2 class="text-center mb-3 arab" style="color: #1e3d73;">بِسْمِ ٱللَّهِ ٱلرَّحْمَٰنِ ٱلرَّحِيمِ</h2>
                <p>Silahkan isi from berikut untuk menghubungi {{ config('app.name') }}</p>
                {!! $pesan !!}
                <form method="post">
                    @csrf
                    <div class="row">
                        <label class="col-2 my-3">Nama <small class="text-danger">*</small></label>
                        <div class="col-10 my-2">
                            <input class="form-control @error('nama') is-invalid @enderror" name="nama" placeholder="Ahmad Karim" value="{{ old('nama') }}" required>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <label class="col-2 my-3">Email <small class="text-danger">*</small></label>
                        <div class="col-10 my-2">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="name@domain.com" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <label class="col-2 my-3">No.WA <small class="text-danger">*</small></label>
                        <div class="col-10 my-2">
                            <input type="number" class="form-control @error('wa') is-invalid @enderror" name="wa" placeholder="081xxxxxxxxx" value="{{ old('wa') }}" required>
                            @error('wa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <label class="col-2 my-3">Pesan <small class="text-danger">*</small></label>
                        <div class="col-10 my-2">
                            <textarea class="form-control @error('pesan') is-invalid @enderror" name="pesan" placeholder="Tuliskan pesan disini" required>{{ old('pesan') }}</textarea>
                            @error('pesan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-10"></div>
                        <div class="col-md-2 my2"><button class="btn btn-success form-control" type="submit">Kirim Pesan</button></div>
                    </div>
                </form>
            </div>
            <div class="footer">
                <div class="text-center py-3">&copy;{{ date('Y') }} <a href="{{ url('/') }}">{{ config('app.name') }}</a>. Developed by <a href="mailto:akunpribadiku@gmail.com">Cemonggaul</a></div>
            </div>          
        </div>
    </div>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+9
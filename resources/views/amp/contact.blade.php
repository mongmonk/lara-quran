<!doctype html>
<html ⚡ lang="id-ID">
  <head>
    <meta charset="utf-8">
    <script async src="https://cdn.ampproject.org/v0.js"></script>
    <title>{{ $title }}</title>
    <meta name="google-site-verification" content="{{ config('app.google_site_verification') }}" />
    <link rel="canonical" href="{{ url()->current() }}" />
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
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
    <style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
    <script async custom-element="amp-sidebar" src="https://cdn.ampproject.org/v0/amp-sidebar-0.1.js"></script>
    <script async custom-element="amp-form" src="https://cdn.ampproject.org/v0/amp-form-0.1.js"></script>
    @include('amp.css')
  </head>
  <body>
    @include('amp.nav')
    <main id="content" role="main" class="pt4">
        <div class="post px3 py-3">
            <h2 class="text-center mb-3 arab" style="color: #1e3d73;">بِسْمِ ٱللَّهِ ٱلرَّحْمَٰنِ ٱلرَّحِيمِ</h2>
            <p>Silahkan isi from berikut untuk menghubungi {{ config('app.name') }}</p>
            
            @if($pesan)
            {!! $pesan !!}
            @endif

            <form method="post" action="{{ url('quran/contact') }}" target="_top">
                @csrf
                <fieldset class="border-none p0 m0">
                    <div class="ampstart-input my1">
                        <input name="nama" id="nama" value="{{ old('nama') }}" required class="block mb1" />
                        <label for="nama" class="ampstart-label">Nama *</label>
                    </div>
                    @error('nama')
                        <span class="ampstart-label">{{ $message }}</span>
                    @enderror

                    <div class="ampstart-input my1">
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required class="block mb1" />
                        <label for="email" class="ampstart-label">Email *</label>
                    </div>
                    @error('email')
                        <span class="ampstart-label">{{ $message }}</span>
                    @enderror

                    <div class="ampstart-input my1">
                        <input type="tel" name="wa" id="wa" value="{{ old('wa') }}" required class="block mb1" />
                        <label for="wa" class="ampstart-label">No. WA *</label>
                    </div>
                    @error('wa')
                        <span class="ampstart-label">{{ $message }}</span>
                    @enderror

                    <div class="ampstart-input my1">
                        <textarea name="pesan" id="pesan" required class="block mb1" rows="4">{{ old('pesan') }}</textarea>
                        <label for="pesan" class="ampstart-label">Pesan *</label>
                    </div>
                    @error('pesan')
                        <span class="ampstart-label">{{ $message }}</span>
                    @enderror

                    <input type="submit" value="Kirim Pesan" class="ampstart-btn">
                </fieldset>
            </form>
        </div>
    </main>
    <footer class="ampstart-footer flex flex-column items-center px3">
      <nav class="ampstart-footer-nav">
        <ul class="list-reset flex flex-wrap mb3">
          <li class="px1">
            <a class="text-decoration-none ampstart-label" href="/quran/about">ABOUT</a>
          </li>
          <li class="px1">
            <a class="text-decoration-none ampstart-label" href="/quran/contact">CONTACT</a>
          </li>
          <li class="px1">
            <a class="text-decoration-none ampstart-label" href="/quran/privacy">PRIVACY POLICY</a>
          </li>
        </ul>
      </nav>
      <p>&copy;{{ date('Y') }} <a href="{{ url('/') }}">{{ config('app.name') }}</a>. Developed by <a href="mailto:akunpribadiku@gmail.com">Cemonggaul</a></p>
    </footer>
  </body>
</html>
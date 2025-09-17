<!doctype html>
<html ⚡="" lang="id-ID">
  <head>
    <meta charset="utf-8">
    <script async src="https://cdn.ampproject.org/v0.js"></script>
    <title>{{ $title }}</title>
    <meta name="google-site-verification" content="{{ config('app.google_site_verification') }}" />
    <link rel="canonical" href="{{ url()->current() }}" />
    <meta name="description" content="Jadikanlah Al-quranul Karim dan Sunnah Nabi sebagai tuntunan hidupmu agar kamu tidak sesat">
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
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
    <style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
    <script
      custom-element="amp-carousel"
      src="https://cdn.ampproject.org/v0/amp-carousel-0.1.js"
      async=""
    ></script>
    <script
      custom-element="amp-sidebar"
      src="https://cdn.ampproject.org/v0/amp-sidebar-0.1.js"
      async=""
    ></script>
    <script
      custom-element="amp-accordion"
      src="https://cdn.ampproject.org/v0/amp-accordion-0.1.js"
      async=""
    ></script>
    <script async custom-element="amp-form" src="https://cdn.ampproject.org/v0/amp-form-0.1.js"></script>
    @include('amp.css')
  </head>
  <body>
    @include('amp.nav')
    <main id="content" role="main" class="pt4">
      <article class="recipe-article center border-bottom pt4">
        <header>
          <h1 class="h2 px3">{{ $title }}</h1>
          <span class="block px3 mb2">سْمِ ٱللّٰهِ الرَّحْمٰنِ الرَّحِيْمِ</span>
        </header>
      </article>
      <ul class="list-reset bold m2 p2 ampstart-label column-2">
        @foreach($data as $i => $surat)
          <li class="ampstart-nav-item ampstart-nav-dropdown relative mb2">
            <amp-accordion
              layout="container"
              disable-session-states=""
              class="ampstart-dropdown"
            >
              <section>
                <header>({{ $surat['name'] }}) {{ $surat['englishName'] }} {{ isset($surat['ayahs']) ? count($surat['ayahs']) : 0 }} ayat</header>
                <div class="grid-wrapper">
                  <ul class="ampstart-dropdown-items m0 p1 column-3 grid-column-3">
                    @foreach($surat['ayahs'] as $i => $ayat)
                      <li class="ampstart-dropdown-item mb1"><a href='/ayah/{{ $ayat['number'] }}'>Ayat {{ $ayat['numberInSurah'] }}</a></li>
                    @endforeach
                  </ul>
                </div>
              </section>
            </amp-accordion>
          </li>
        @endforeach
      </ul>
    </main>
    <footer class="ampstart-footer flex flex-column items-center px3">
      <nav class="ampstart-footer-nav">
        <ul class="list-reset flex flex-wrap mb3">
          <li class="px1">
            <a class="text-decoration-none ampstart-label" href="/quran/about">TENTANG {{ config('app.name') }}</a>
          </li>
          <li class="px1">
            <a class="text-decoration-none ampstart-label" href="/quran/contact">HUBUNGI {{ config('app.name') }}</a>
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
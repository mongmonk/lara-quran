<!doctype html>
<html ⚡="" lang="id-ID">
  <head>
    <meta charset="utf-8">
    <script async src="https://cdn.ampproject.org/v0.js"></script>
    <title>{{ $title }}</title>
    <meta name="google-site-verification" content="v41YLnzLxTtkqUVRPNP4qRvhFd4OLz5SHvhimMvEv7w" />
    <link rel="canonical" href="{{ url()->current() }}" />
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
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
    <style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
    <script
      custom-element="amp-carousel"
      src="https://cdn.ampproject.org/v0/amp-carousel-0.1.js"
      async="">
    </script>
    <script
      custom-element="amp-sidebar"
      src="https://cdn.ampproject.org/v0/amp-sidebar-0.1.js"
      async="">
    </script>
    <script
      custom-element="amp-accordion"
      src="https://cdn.ampproject.org/v0/amp-accordion-0.1.js"
      async="">
    </script>  
    <script async custom-element="amp-audio" src="https://cdn.ampproject.org/v0/amp-audio-0.1.js"></script>
    <script async custom-element="amp-addthis" src="https://cdn.ampproject.org/v0/amp-addthis-0.1.js"></script>
    @include('amp.css')
  </head>
  <body>
    @include('amp.nav')
    <main id="content" role="main" class="pt4">
      <article class="recipe-article center border-bottom pt4">
        <header>
          <span class="block arab">سْمِ ٱللّٰهِ الرَّحْمٰنِ الرَّحِيْمِ</span>
          <h1 class="h2"><a href="{{ url("surah/{$data['nomor']}") }}">{{ $title }}</a></h1>
          <p class="my2 justify">{!! $data['deskripsi'] !!}</p>
          <amp-audio class="my2" width="auto" height="50" src="{{ $data['audio'] }}" autoplay>
              <div fallback>Your browser doesn’t support HTML5 audio</div>
          </amp-audio>
          <div class="center" focus>
            <amp-addthis width="220" height="51"  data-pub-id="ra-58ee198592911521" data-widget-id="eebc" data-widget-type="inline"></amp-addthis>
          </div>
        </header>
        <form class="sample-form my3" method="GET" action="/quran/search/" target="_top">
          <input type="search" class="py1 px1" placeholder="Cari ayat tentang..." value="{{ request()->get('query') }}" name="query">
          <button type="submit" class="py1">Search</button>
        </form>
      </article>
      <ul class="list-reset">
        @foreach($data['tafsir'] as $i => $list)
            <li class="mb2 px3">
              <a href="{{ url("ayah/{$list['ayat']}") }}">[ {{ $list['ayat'] }} ]</a>. {!! $list['tafsir'] !!}
              <div class="dash"></div>
            </li>
        @endforeach
      </ul>
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
      <p>&copy;{{ date('Y') }} <a href="{{ url('/') }}">My QUR`AN</a>. Developed by <a href="https://t.me/cemonggaul">Cemonggaul</a></p>
    </footer>
  </body>
</html>
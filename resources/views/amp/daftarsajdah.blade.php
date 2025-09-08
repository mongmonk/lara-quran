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
        <form class="sample-form my3" method="GET" action="/quran/search/" target="_top">
          <input type="search" class="py1 px1" placeholder="Cari ayat tentang..." value="{{ request()->get('query') }}" name="query">
          <button type="submit" class="py1">Search</button>
        </form>
      </article>
      <ul class="list-reset">
        @if($data)
          @foreach($data as $i => $list)
            <li class="mb2 px3">
                <p class="arab text-right mb2">{!! $list['ar'] !!} ﴿{!! $list['surahAr'] !!} : {!! app('quran')->numConverter($list['surahNum']) !!}﴾</p>
                <p class="my1"><span class="btn">ID Translation</span> {!! request()->segment(2) !== 'search' ? $list['id'] : str_ireplace(request()->get('query'), "<b class='query'><em>" . request()->get('query') . "</em></b>", $list['id']) !!}</p>
                <p class="my1 pt1"><span class="btn">EN Translation</span> {!! $list['en'] !!}</p>
                <amp-audio class="mt2" width="auto" height="50" src="https://cdn.islamic.network/quran/audio/128/ar.alafasy/{!! $list['numList'] !!}.mp3">
                  <div fallback>Your browser doesn’t support HTML5 audio</div>
                </amp-audio>
                <div class="dash"></div>
            </li>
          @endforeach
        @else
          <p class='center btn'>Ayat Tentang `<b><em>{{ request()->get('query') }}</em></b>` Tidak Ada!</p>
        @endif
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
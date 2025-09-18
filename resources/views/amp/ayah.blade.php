<!doctype html>
<html ⚡="" lang="id-ID">
  <head>
    <meta charset="utf-8">
    <script async src="https://cdn.ampproject.org/v0.js"></script>
    <title>{{ $title }}</title>
    <meta name="google-site-verification" content="{{ config('app.google_site_verification') }}" />
    <link rel="canonical" href="{{ url()->current() }}" />
    <meta name="description" value="{{ $data['id'] }}">
    <meta property="og:locale" content="id_ID" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="{{ config('app.name') }}" />
    <meta property="og:description" content="{{ $data['id'] }}" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:site_name" content="{{ config('app.name') }}" />
    <meta property="og:image" content="https://cdn.islamic.network/quran/images/high-resolution/{{ $surah }}_{{ $ayah }}.png" />
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
      <div class="px3">
        <p class='text-right arab my2'>{!! $data['ar'] !!} ﴿{{ app('quran')->numConverter($data['ayat']) }}﴾</p>
        <p class="my1"><span class="btn">ID Translation</span> {!! $data['id'] !!}</p>
        <p class="my1 pt1"><span class="btn">EN Translation</span> {!! $data['en'] !!}</p>
        <p class="my1 pt1"><span class="btn">Tafsir</span> {!! $tafsir['tafsir'] !!}</p>
        <div class="row">
          <div class="col-6 px1">
            <amp-audio class="mt2" width="auto" height="50" src="https://cdn.islamic.network/quran/audio/64/{{ request()->get('audio') ? request()->get('audio') : 'ar.alafasy' }}/{{ $data['numList'] }}.mp3" autoplay>
              <div fallback>Your browser doesn’t support HTML5 audio</div>
            </amp-audio>
          </div>
          <div class="col-6 px1 pt2">
            @include('amp.reciter')         
          </div>
          <div class="col-6 text-right px1 py3">{!! $prev !!}</div>
          <div class="col-6 px1 py3">{!! $next !!}</div>
        </div>
        <div class="center my3">
          @if(config('app.addthis_pub_id'))
          <amp-addthis width="220" height="51"  data-pub-id="{{ config('app.addthis_pub_id') }}" data-widget-id="eebc" data-widget-type="inline"></amp-addthis>
          @endif
        </div>
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
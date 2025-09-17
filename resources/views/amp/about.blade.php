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
    @include('amp.css')
  </head>
  <body>
    @include('amp.nav')
    <main id="content" role="main" class="pt4">
      <div class="post">
          <h2 class="text-center mb-3 arab" style="color: #1e3d73;">السلام عليكم ورحمة الله وبركاته</h2>
          <p>Segala puji bagi Allah, Tuhan semesta alam. Dengan rahmat dan ridlonya, {{ config('app.name') }} bisa menghadirkan Al-quran beserta terjemahan dalam Bahasa Indonesia dan Bahasa Inggris, serta audionya dengan harapan agar memudahkan kaum Muslimin dalam membaca dan juga mempelajari Al-quranul Karim.</p>
          <p>Project My QUR`AN ini di develope oleh <a href="mailto:akunpribadiku@gmail.com">Cemonggaul</a> menggunakan framework <a href="https://laravel.com/" target="_blank">Laravel</a> dengan memanfaatkan API open source <a href="https://github.com/islamic-network/api.alquran.cloud" target="_blank">API Al-Quran</a> yang tersedia dalam berbagai macam bahasa. Namun disini My QUR`AN hanya mengambil yang Bahasa Indonesia, Bahasa Inggris dan juga Rasmul Usmani yang merupakan standar Al-quran Indonesia. Dan juga menggunakan data open source Hadits dari Project <a href="https://github.com/gadingnst/hadith-api" target="_blank">Hadith-API</a> dan juga beberapa API lain yang bisa dilihat <a href="{{ url('quran/partnerapi') }}">DISINI</a>. Mudah-mudahan Allah selalu melimpahkan hidayah, ridla, serta inayah-Nya kepada penyusun API Al-Quran dan HADITS API. Amin ya robbal alamin.</p>
          <p>Dengan adanya fitur Al-Quran per ayat, diharapkan akan membantu para calon hafidz dan hafidzoh dalam menghafal Alquran. Semua sudah dilengkapi dengan terjemahan dan juga audio bacaannya. Begitu pula dengan fitur audionya yang bisa dipilih reciter-nya sesuai keinginan diharapkan dapat mempermudah kaum Muslimin untuk belajar membaca Al-quran dengan baik dan enak didengar.</p>
          <p>Walaupun masih dalam tahap pengembangan, mudah-mudahan kehadiran Al-Quran yang disajikan oleh {{ config('app.name') }} bermanfaat bagi seluruh kaum Muslimin semuanya. Aamiin</p>
          <p>Untuk kritik, saran, masukan, atau donasi silahkan hubungi <a href="mailto:akunpribadiku@gmail.com">Cemonggaul</a>. Terima kasih.</p>
          <p>Ingin mengembangkan aplikasi ini? Silahkan kunjungi <a href="https://github.com/mongmonk/lara-quran" target="_blank">Github Repository</a> nya.</p>
          <h2 class="text-center mt-3 arab" style="color: #1e3d73;">والسلام عليكم ورحمة الله وبركاته</h2>
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
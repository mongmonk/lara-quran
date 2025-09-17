<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    <script src="https://telegram.org/js/telegram-web-app.js"></script>
    @include('css')
    <style type="text/css">
      .halaman{margin-bottom: 60px}
      .form-control {
        display: block;
        width: auto;
        padding: 0.375rem 0.15rem;
        font-size: 1rem;
        line-height: 1.5;
        background-color: transparent; 
        border: none;
      }
      .h-38{height: 38px}
    </style>
  </head>
  <body>
    <div class="container-fluid halaman" id="tampilan"> 
      <p class='text-center arab my-4 mx-2'>بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحِيْمِ  <br/><small class='btn btn-sm btn-rounded btn-outline-success'>﴿{!! $data[0]['surahEn'] !!}﴾ {!! $data[0]['surahAr'] !!} *﴿ الجزء : {!! $data[0]['juz'] !!}﴾</small></p><div class='line'></div>
      <p class='text-right arab my-2'>{!! $data[0]['ar'] !!} {!! app('quran')->numConverter($data[0]['ayat']) !!}</p>
      <p class="my-1 pt-1">
        <audio class="w-100" src="https://cdn.islamic.network/quran/audio/64/{{ request()->get('audio') ? request()->get('audio') : 'ar.alafasy' }}/{{ $data[0]['numList'] }}.mp3" controls autoplay>
        </audio>
      </p>
      <p class="my-1 pt-1"><span class="btn btn-sm btn-outline-secondary">EN</span> {!! $data[0]['en'] !!}</p>
      <p class="my-1"><span class="btn btn-sm btn-outline-secondary">ID</span> {!! $data[0]['id'] !!}</p>
      <p class="my-1 pt-1"><span class="btn btn-sm btn-outline-secondary">Tafsir</span> {!! $tafsir['tafsir'] !!}</p>
    </div>
    <div class="row justify-content-between fixed-bottom py-2 bg-light px-2 border-top">
      <div class="col-6 text-right">
        {!! $prev !!}
      </div>
      <div class="col-6">
        {!! $next !!}
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="{{ asset('/inc/bootstrap-multiselect.js') }}"></script>
    <script src="{{ asset('/inc/jquery.mediaplayer.js') }}"></script>
    <script src="{{ asset('/inc/jquery.surah.js') }}"></script>
    <script type="text/javascript">
      Telegram.WebApp.ready();

     	const initData = Telegram.WebApp.initData || '';
     	const initDataUnsafe = Telegram.WebApp.initDataUnsafe || {};

      function requestLocation() {
          if (navigator.geolocation) {
              navigator.geolocation.getCurrentPosition(function (position) {
                  document.querySelector('#locationData').innerHTML = '(' + position.coords.latitude + ', ' + position.coords.longitude + ')';
              });
          } else {
              document.querySelector('#locationData').innerHTML = '(Geolocation is not supported in this browser)';
          }

          return false;
      }

      var id = Telegram.WebApp.initDataUnsafe.user.id;
      $.ajax({
        url: "{{ url("bot/tafsir") }}",
        data: {id:id},
        success:function(e){}
      })
  </script>
  </body>
</html>
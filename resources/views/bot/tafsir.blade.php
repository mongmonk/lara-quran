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
    </style>
  </head>
  <body>
    <div class="container-fluid halaman" id="tampilan">
      <div class="post">
        <p class="text-center arab my-4 mx-2">سْمِ ٱللّٰهِ الرَّحْمٰنِ الرَّحِيْمِ</p>
        <h1 class="h2 text-center">{{ $title }}</h1>
        <p class="my-2">{!! $data['deskripsi'] !!}</p>
        <div class="center" focus>
          <!-- Tafsir content -->
          @foreach($data['tafsir'] as $i => $list)
              <div class="mb-3">
                <p><a href="{{ url("bot/ayah?number={$list['ayat']}") }}">[ {{ $list['ayat'] }} ]</a></p>
                <p>{!! $list['tafsir'] !!}</p>
                <div class="line"></div>
              </div>
          @endforeach
        </div>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
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
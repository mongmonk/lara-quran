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
      <p class="arab text-justify" style="line-height: 2.5em;">      
          @foreach ($data as $k => $ayat)
              @php
                  $number = app('quran')->numConverter($ayat['ayat']);
                  $urutan = $ayat['numList'];
              @endphp
              @if ($ayat['ayat'] == 1)
                  @if ($ayat['surahNum'] == 1)
                      @if($ayat['ayat'] < 2)
                          @continue
                      @endif
                  @endif
                @if ($k == 0)
                  </p><p class='text-center arab my-4 mx-2'>بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحِيْمِ  <br/><small class='btn btn-sm btn-rounded btn-outline-success'>{!! $ayat['surahAr'] !!} * الجزء : {!! $ayat['juz'] !!}</small></p><div class='line'></div><p class='arab text-justify' style='line-height: 2.5em;'>
                @else
                  </p><div class='line'></div><p class='text-center arab my-4 mx-2'>بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحِيْمِ  <br/><small class='btn btn-sm btn-rounded btn-outline-success'>{!! $ayat['surahAr'] !!} * الجزء : {!! $ayat['juz'] !!}</small></p><div class='line'></div><p class='arab text-justify' style='line-height: 2.5em;'>
                @endif
              @else
                @if ($ayat['surahNum'] == 1 && $ayat['ayat'] == 2 && $k !== 0)
                  </p><p class='text-center arab my-4 mx-2'>بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحِيْمِ  <br/><small class='btn btn-sm btn-rounded btn-outline-success'>{!! $ayat['surahAr'] !!} * الجزء : {!! $ayat['juz'] !!}</small></p><div class='line'></div><p class='arab text-justify' style='line-height: 2.5em;'>
                @endif
              @endif
              {!! $ayat['ar'] !!} {!! $number !!}
          @endforeach
      </p>
    </div>
    <div class="row justify-content-between fixed-bottom py-2 bg-light px-2 border-top">
      <div class="col-4">
        <form action="/bot">
          <select class="form-control" name="page" onchange="this.form.submit()">
            @foreach (app('quran')->getMeta()['data']['surahs']['references'] as $surah)
              @php
                $surat = $surah['number'];
                $page = request()->get('page');
                $ayatJuz = app('quran')->getSuratAyah($surat);
                $next = $surat+1;
                $ayatJuzNext = $surat < 30 ? app('quran')->getSuratAyah($next):604;
              @endphp
              <option value="{{ $ayatJuz }}" {{ $page >= $ayatJuz && $page < $ayatJuzNext ? 'selected':false }} >{!! $surah['name'] !!}</option>
            @endforeach
          </select>
        </form>        
      </div>
      <div class="col-4">
          @php     
              $halaman = request()->get('page') ? request()->get('page'): 1;                    
          @endphp
          @if ($halaman && $halaman != 1 && $halaman != 604)
              @php
                $prev = $halaman-1;
                $next = $halaman+1;
              @endphp
              <form action='/bot'>
                <div class='input-group'>
                  <a href='/bot?page={{ $next }}' class='btn btn-success input-group-prepend'>&laquo;</a>
                  <input onchange='this.form.submit()' class='form-control text-center' name='page' value='{{ app('quran')->numConverter($halaman) }}'/>
                  <a href='/bot?page={{ $prev }}' class='btn btn-success input-group-append'>&raquo</a>
                </div>
              </form>
          @elseif (!$halaman || $halaman == 1)
              <form action='/bot'>
                <div class='input-group'>
                  <a href='/bot?page=2' class='btn btn-success input-group-prepend'>&laquo</a>
                  <input onchange='this.form.submit()' class='form-control text-center' name='page' value='{{ app('quran')->numConverter($halaman) }}'/>
                </div>
              </form>
          @else
              <form action='/bot'>
                <div class='input-group'>
                  <input onchange='this.form.submit()' class='form-control text-center' name='page' value='{{ app('quran')->numConverter($halaman) }}'/>
                  <a href='/bot?page=603' class='btn btn-success input-group-append'>&raquo;</a>
                </div>
              </form>
          @endif
      </div>
      <div class="col-4">
        <form action="/bot">
          <select class="form-control" name="page" onchange="this.form.submit()">
            @foreach (range(1, 30) as $juz)
              @php
                $page = request()->get('page');
                $ayatJuz = app('quran')->getJuzAyah($juz);
                $next = $juz+1;
                $ayatJuzNext = $juz < 30 ? app('quran')->getJuzAyah($next):604;
              @endphp
              <option value="{{ $ayatJuz }}" {{ $page >= $ayatJuz && $page < $ayatJuzNext ? 'selected':false }} >الجزء {{ app('quran')->numConverter($juz) }}</option>
            @endforeach
          </select>
        </form>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script type="application/javascript">

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
        url: "{{ url("bot/updatecounter") }}",
        data: {id:id},
        success:function(e){}
      })
  </script>
  </body>
</html>
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
      <div class="post">
          @foreach ($data as $k => $juz)
              @php
                  $number = app('quran')->numConverter($juz['ayat']);
                  $urutan = $juz['numList'];
              @endphp
              @if ($juz['ayat'] == 1 || $k == 0 && $juz['ayat'] != 1)
                <p class='text-center arab my-4 mx-2'>بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحِيْمِ  <br/><small class='btn btn-sm btn-rounded btn-outline-success'>{!! $juz['surahAr'] !!} * الجزء : {!! $juz['juz'] !!}</small></p><div class='line'></div>
              @endif
              <div class='ayahAudio{{ $urutan }}'>
                <p class='text-right arab'>{!! $juz['ar'] !!} {!! $number !!}</p>
                <p>{!! $juz['id'] !!}</p>
                <div class="line"></div>
              </div>
          @endforeach
      </div>
    </div>
    <div class="row justify-content-between fixed-bottom py-2 bg-light border-top">
      <div class="col-4">
        <form action="/bot/juz">
          <select class="form-control" name="juz" onchange="this.form.submit()">
              @foreach (range(1, 30) as $key => $value)
                  @if ($value == request()->get('juz'))
                      <option value='{{ $value }}' selected>Juz {{ $value }}</option>
                  @else
                      <option value='{{ $value }}'>Juz {{ $value }}</option>
                  @endif                                
              @endforeach
          </select>
        </form>        
      </div>
      <div class="col-4">
        <audio id="juzPlayer" controls class="w-100 h-38">
            <source id="activeAyah" src="https://cdn.islamic.network/quran/audio/64/{{ request()->get('audio') ? request()->get('audio') : 'ar.alafasy' }}/1.mp3" title="1" type="audio/mp3">
        </audio>
      </div>
      <div class="col-4">
        <form class="sample-form" action="{{ url()->current() }}" target="_top">
          <input type="hidden" name="juz" value="{{ $currentJuz }}">
            <select name="audio" onchange="this.form.submit()" class="form-control">
                <option value="ar.alafasy" {{ request()->get('audio') == 'ar.alafasy' ? 'selected' : false }}>Alafasy</option>
                <option value="ar.abdulbasitmurattal" {{ request()->get('audio') == 'ar.abdulbasitmurattal' ? 'selected' : false }}>Abdulbasitmurattal</option>
                <option value="ar.abdullahbasfar" {{ request()->get('audio') == 'ar.abdullahbasfar' ? 'selected' : false }}>Abdullahbasfar</option>
                <option value="ar.abdulsamad" {{ request()->get('audio') == 'ar.abdulsamad' ? 'selected' : false }}>Abdulsamad</option>
                <option value="ar.abdurrahmaansudais" {{ request()->get('audio') == 'ar.abdurrahmaansudais' ? 'selected' : false }}>Abdurrahmaansudais</option>
                <option value="ar.ahmedajamy" {{ request()->get('audio') == 'ar.ahmedajamy' ? 'selected' : false }}>Ahmedajamy</option>                        
                <option value="ar.aymanswoaid" {{ request()->get('audio') == 'ar.aymanswoaid' ? 'selected' : false }}>Aymanswoaid</option>
                <option value="ar.hanirifai" {{ request()->get('audio') == 'ar.hanirifai' ? 'selected' : false }}>Hanirifai</option>
                <option value="ar.hudhaify" {{ request()->get('audio') == 'ar.hudhaify' ? 'selected' : false }}>Hudhaify</option>
                <option value="ar.husary" {{ request()->get('audio') == 'ar.husary' ? 'selected' : false }}>Husary</option>
                <option value="ar.husarymujawwad" {{ request()->get('audio') == 'ar.husarymujawwad' ? 'selected' : false }}>Husarymujawwad</option>
                <option value="ar.mahermuaiqly" {{ request()->get('audio') == 'ar.mahermuaiqly' ? 'selected' : false }}>Mahermuaiqly</option>
                <option value="ar.minshawimujawwad" {{ request()->get('audio') == 'ar.minshawimujawwad' ? 'selected' : false }}>Minshawimujawwad</option>
                <option value="ar.saoodshuraym" {{ request()->get('audio') == 'ar.saoodshuraym' ? 'selected' : false }}>Saoodshuraym</option>
                <option value="ar.shaatree" {{ request()->get('audio') == 'ar.shaatree' ? 'selected' : false }}>Shaatree</option>
            </select>
        </form>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="{{ asset('/inc/bootstrap-multiselect.js') }}"></script>
    <script src="{{ asset('/inc/jquery.mediaplayer.js') }}"></script>
    <script src="{{ asset('/inc/jquery.surah.js') }}"></script>
    <script type="text/javascript">
        $(function() {
            $('#editionSelector').multiselect({ enableFiltering: true, enableCaseInsensitiveFiltering: true, maxHeight: 400, dropUp: true});
            $.alQuranSurah.editions('#editionSelector', '{{ end($data)['juz'] }}');
            $.alQuranSurah.surahs('#juzSelector');
            $.alQuranMediaPlayer.init($("#juzPlayer")[0], 'surah', {{ $data[0]['numList'] }}, {{ end($data)['numList'] }}, {{ $data[0]['surahNum'] }}, 0, '{{ request()->get('audio') ? request()->get('audio') : 'ar.alafasy' }}');
            $.alQuranMediaPlayer.defaultPlayer();
            $.alQuranMediaPlayer.zoomIntoThisAyah();
        });
        $(function () {
            $('#juzSelector').change( function() {
                location.href = $(this).val();
            });
        });

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
        url: "{{ url("bot/perjuz") }}",
        data: {id:id},
        success:function(e){}
      })
  </script>
  </body>
</html>
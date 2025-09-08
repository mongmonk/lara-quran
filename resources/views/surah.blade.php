<!DOCTYPE html>
<html lang="id-ID">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $title }}</title>
    <link rel="canonical" href="{{ url()->current() }}" />
    <meta name="description" value="Al-quran {{ $title }}">
    <meta property="og:locale" content="id_ID" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="{{ $title }}" />
    <meta property="og:description" content="Al-quran {{ $title }}" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:site_name" content="My QUR`AN" />
    <meta property="og:image" content="{{ asset('inc/alquran.png') }}" />
    <meta property="og:image:type" content="image/png" />
    @include('css')
</head>
<body>
    <div class="wrapper mb-3 pb-5">
        @include('sidenav')
            <div class="post">
                <h1 class='text-center arab text-dark'><a href="{{ url("quran/tafsir/" . request()->segment(2)) }}">{{ $data[0]['surahAr'] }}</a></h1>
                <div class="line"></div>
                @foreach ($data as $surah)
                    @php
                        $number = app('quran')->numConverter($surah['ayat']);
                        $urutan = $surah['numList'];
                    @endphp
                    <div class='ayahAudio{{ $urutan }}'>
                        <p class='text-right arab'>{!! $surah['ar'] !!} {!! $number !!}</p>
                        <p><span class='btn btn-sm btn-secondary'>ID Translation</span> {!! $surah['id'] !!}</p>
                        <p><span class='btn btn-sm btn-secondary'>EN Translation</span> {!! $surah['en'] !!}</p>
                        <div class="line"></div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="bg-light fixed-bottom py-2 footer">
        <div class="container">
            <div class="d-flex justify-content-center mb-2">
                <button type="button" class="mx-1 btn btn-primary" target="popup" onclick="window.open('https://web.facebook.com/sharer.php?t={{ urlencode($title) }}&u={{ url()->current() }}','popup','width=700,height=500'); return false;">
                    <svg width="1.5em" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="facebook" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-facebook fa-w-16"><path fill="currentColor" d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-11 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z" class=""></path></svg>
                </button>
                <button type="button" class="mx-1 btn btn-info" target="popup" onclick="window.open('https://twitter.com/intent/tweet?text={{ urlencode($title) }}','popup','width=700,height=500'); return false;">
                    <svg width="1.5em" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="twitter" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-twitter fa-w-16"><path fill="currentColor" d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z" class=""></path></svg>
                </button>
                <button type="button" class="mx-1 btn btn-danger" target="popup" onclick="window.open('https://www.pinterest.com/pin/create/button/?description={{ url()->current() }}&media={{ asset('inc/alquran.png') }}','popup','width=700,height=500'); return false;">
                    <svg width="1.5em" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="pinterest" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" class="svg-inline--fa fa-pinterest fa-w-16"><path fill="currentColor" d="M496 256c0 137-111 248-248 248-25.6 0-50.2-3.9-73.4-11.1 10.1-16.5 25.2-43.5 30.8-65 3-11.6 15.4-59 15.4-59 8.1 15.4 31.7 28.5 56.8 28.5 74.8 0 128.7-68.8 128.7-154.3 0-81.9-66.9-143.2-152.9-143.2-107 0-163.9 71.8-163.9 150.1 0 36.4 19.4 81.7 50.3 96.1 4.7 2.2 7.2 1.2 8.3-3.3.8-3.4 5-20.3 6.9-28.1.6-2.5.3-4.7-1.7-7.1-10.1-12.5-18.3-35.3-18.3-56.6 0-54.7 41.4-107.6 112-107.6 60.9 0 103.6 41.5 103.6 100.9 0 67.1-33.9 113.6-78 113.6-24.3 0-42.6-20.1-36.7-44.8 7-29.5 20.5-61.3 20.5-82.6 0-19-10.2-34.9-31.4-34.9-24.9 0-44.9 25.7-44.9 60.2 0 22 7.4 36.8 7.4 36.8s-24.5 103.8-29 123.2c-5 21.4-3 51.6-.9 71.2C65.4 450.9 0 361.1 0 256 0 119 111 8 248 8s248 111 248 248z" class=""></path></svg>
                </button>
                <button type="button" class="mx-1 btn btn-info" target="popup" onclick="window.open('https://t.me/share/url?url={{ urlencode($title) }}&to=','popup','width=700,height=500'); return false;">
                    <svg width="1.5em" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="telegram" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" class="svg-inline--fa fa-telegram fa-w-16"><path fill="currentColor" d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm121.8 169.9l-40.7 191.8c-3 13.6-11.1 16.9-22.4 10.5l-62-45.7-29.9 28.8c-3.3 3.3-6.1 6.1-12.5 6.1l4.4-63.1 114.9-103.8c5-4.4-1.1-6.9-7.7-2.5l-142 89.4-61.2-19.1c-13.3-4.2-13.6-13.3 2.8-19.7l239.1-92.2c11.1-4 20.8 2.7 17.2 19.5z" class=""></path></svg>
                </button>
                <button type="button" class="mx-1 btn btn-success" target="popup" onclick="window.open('https://api.whatsapp.com/send?text={{ urlencode($title) }}','popup','width=700,height=500'); return false;">
                    <svg width="1.5em" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="whatsapp" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-whatsapp fa-w-14"><path fill="currentColor" d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z" class=""></path></svg>
                </button>
            </div>
            <div class="row justify-content-center" id="surahConfigurator">
              <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 mb-2">
                <select id="surahSelector" class="form-control" style="height: 54px !important;" onchange="if (this.value) window.location.href=this.value">
                    @foreach (app('quran')->surahListStatis() as $key => $value)
                        @if ($value['surahNum'] == request()->segment(2))
                            <option value='/surah/{{ $value['surahNum'] }}' selected>{{ $value['surahNum'] }}. {{ $value['surahEn'] }} ﴾ {{ $value['surahAr'] }} ﴿</option>
                        @else
                            <option value='/surah/{{ $value['surahNum'] }}'>{{ $value['surahNum'] }}. {{ $value['surahEn'] }} ﴾ {{ $value['surahAr'] }} ﴿</option>
                        @endif                                
                    @endforeach
                </select>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center mb-2">
                <audio id="surahPlayer" controls autoplay class="form-control">
                    <source id="activeAyah" src="https://cdn.islamic.network/quran/audio/64/{{ request()->get('audio') ? request()->get('audio') : 'ar.alafasy' }}/{{ $data[0]['numList'] }}.mp3" title="{{ $data[0]['numList'] }}" type="audio/mp3">
                </audio>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center mb-2">
                    @include('reciter')
              </div>
            </div>
            <div class="text-center text-secondary">&copy;{{ date('Y') }} <a href="{{ url('/') }}">My QUR`AN</a>. Developed by <a href="https://t.me/cemonggaul">Cemonggaul</a></div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <script src="{{ asset('/inc/bootstrap-multiselect.js') }}"></script>
    <script src="{{ asset('/inc/jquery.mediaplayer.js') }}"></script>
    <script src="{{ asset('/inc/jquery.surah.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
                $(this).toggleClass('active');
            });
        });
        $(function() {
            $('#editionSelector').multiselect({ enableFiltering: true, enableCaseInsensitiveFiltering: true, maxHeight: 400, dropUp: true});
            $.alQuranSurah.editions('#editionSelector', '{{ end($data)['surahNum'] }}');
            $.alQuranSurah.surahs('#surahSelector');
            $.alQuranMediaPlayer.init($("#surahPlayer")[0], 'surah', {{ $data[0]['numList'] }}, {{ end($data)['numList'] }}, {{ $data[0]['surahNum'] }}, 0, '{{ request()->get('audio') ? request()->get('audio') : 'ar.alafasy' }}');
            $.alQuranMediaPlayer.defaultPlayer();
            $.alQuranMediaPlayer.zoomIntoThisAyah();
        });
        $(function () {
            $('#surahSelector').change( function() {
                location.href = $(this).val();
            });
        });
    </script>
</body>
</html>
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
    <meta property="og:site_name" content="{{ config('app.name') }}" />
    <meta property="og:image" content="{{ asset('inc/images/alquran.png') }}" />
    <meta property="og:image:type" content="image/png" />
    @include('css')
</head>
<body>
    <div class="wrapper mb-3 pb-5">
        <!-- Sidebar Holder -->
        <nav id="sidebar" class="active">            
            <ul class="list-unstyled components">
                <li>
                    <a href="/quran/page">AL-QUR`AN PER HALAMAN</a>
                </li>
                <li>
                    <a href="/quran/daftarjuz">DAFTAR JUZ</a>
                </li>
                <li>
                    <a href="/quran/daftarsurah">DAFTAR SURAH</a>
                </li>
                <li>
                    <a href="/quran/daftarruku">RUKU`</a>
                </li>
                <li>
                    <a href="/quran/daftarsajdah">AYAT-AYAT SAJDAH</a>
                </li>
                <li>
                    <a href="/quran/daftarayat">TAHFIDZUL QUR`AN</a>
                </li>
                <li><a href="{{ url("quran/daftartafsir") }}">TAFSIR PER SURAH</a></li>
                <li>
                    <a href="/hadits/bukhari">HR.BUKHARI</a>
                </li>
                <li>
                    <a href="/hadits/muslim">HR.MUSLIM</a>
                </li>
                <li>
                    <a href="/hadits/abudaud">HR.ABU DAUD</a>
                </li>
                <li>
                    <a href="/hadits/ahmad">HR.AHMAD</a>
                </li>
                <li>
                    <a href="/hadits/darimi">HR.DARIMI</a>
                </li>
                <li>
                    <a href="/hadits/ibnumajah">HR.IBNU MAJAH</a>
                </li>
                <li>
                    <a href="/hadits/malik">HR.MALIK</a>
                </li>
                <li>
                    <a href="/hadits/nasai">HR.NASA`I</a>
                </li>
                <li>
                    <a href="/hadits/tirmidzi">HR.TIRMIDZI</a>
                </li>
                <li>
                    <a href="/quran/doa">DOA-DOA HARIAN</a>
                </li>
                <li>
                    <a href="/quran/tahlil">DOA TAHLIL</a>
                </li>
                <li>
                    <a href="/quran/jadwalsholat">JADWAL SHOLAT BULANAN</a>
                </li>
                <li>
                    <a href="/quran/jadwalsholatharian">JADWAL SHOLAT UNTUK MASJID</a>
                </li>
                <li>
                    <a href="/quran/about">TENTANG {{ config('app.name') }}</a>
                </li>
                <li>
                    <a href="/quran/contact">HUBUNGI {{ config('app.name') }}</a>
                </li>
                <li>
                    <a href="/quran/privacy">PRIVACY POLICY</a>
                </li>
                <li>
                    <a href="/quran/partnerapi">PARTNER API</a>
                </li>
            </ul>
        </nav>
        <!-- Page Content Holder -->
        <div id="content">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="navbar-btn">☰</button>
                    <a class="navbar-brand text-success font-weight-bold" href="{{ url('/') }}" title="{{ config('app.name') }}">
                        <img src="{{ asset('inc/images/logo.png') }}" width='200' height='45' alt="{{ config('app.name') }}"/>
                    </a>
                </div>
            </nav>
            <div class="halaman container">                
                <p class="arab text-justify" style="line-height: 2.5em;">
                    @foreach ($data as $k => $pages)
                        @php
                            $number = app('quran')->numConverter($pages['ayat']);
                            $urutan = $pages['numList'];
                        @endphp
                        @if ($pages['ayat'] == 1)
                            @if ($pages['surahNum'] == 1)
                              @if($pages['ayat'] < 2)
                                @continue
                              @endif
                            @endif
                            @if ($k == 0)
                              </p><p class='text-center arab my-4 mx-2'>بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحِيْمِ  <br/><small class='btn btn-sm btn-rounded btn-outline-success'>{!! $pages['surahAr'] !!} * الجزء : {{ $pages['juz'] }}</small></p><div class='line'></div><p class='arab text-justify' style='line-height: 2.5em;'>
                            @else
                              </p><div class='line'></div><p class='text-center arab my-4 mx-2'>بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحِيْمِ  <br/><small class='btn btn-sm btn-rounded btn-outline-success'>{!! $pages['surahAr'] !!} * الجزء : {{ $pages['juz'] }}</small></p><div class='line'></div><p class='arab text-justify' style='line-height: 2.5em;'>
                            @endif
                          @else
                            @if ($pages['surahNum'] == 1 && $pages['ayat'] == 2 && $k !== 0)
                              </p><p class='text-center arab my-4 mx-2'>بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحِيْمِ  <br/><small class='btn btn-sm btn-rounded btn-outline-success'>{!! $pages['surahAr'] !!} * الجزء : {{ $pages['juz'] }}</small></p><div class='line'></div><p class='arab text-justify' style='line-height: 2.5em;'>
                            @endif
                        @endif
                        <span class='ayahAudio{!! $urutan !!}'>{!! $pages['ar'] !!} {!! $number !!}</span>
                    @endforeach
                </p>
                <div class="line"></div>
                <div class="text-center">
                    @php     
                        $halaman = request()->segment(3) ? request()->segment(3): 1;                    
                    @endphp
                    @if ($halaman && $halaman != 1 && $halaman != 604)
                        @php
                            $prev = $halaman-1;
                            $next = $halaman+1;
                        @endphp
                        <a href='/quran/page/{{ $prev }}' class='btn btn-sm btn-outline-success'>⊲</a>
                        <span class='btn btn-sm btn-outline-success mx-1'>{!! app('quran')->numConverter($halaman) !!}</span>
                        <a href='/quran/page/{{ $next }}' class='btn btn-sm btn-outline-success'>⊳</a>
                    @elseif (!$halaman || $halaman == 1)
                        <span class='btn btn-sm btn-outline-success mx-1'>{!! app('quran')->numConverter($halaman) !!}</span>
                        <a href='/quran/page/2' class='btn btn-sm btn-outline-success mx-1'>⊳</a>
                    @else
                        <a href='/quran/page/603' class='btn btn-sm btn-outline-success'>⊲</a>
                        <span class='btn btn-sm btn-outline-success mx-1'>{!! app('quran')->numConverter($halaman) !!}</span>
                    @endif
                </div>
            </div>          
        <div class="text-center text-secondary fixed-bottom">&copy;{{ date('Y') }} <a href="{{ url('/') }}">{{ config('app.name') }}</a>. Developed by <a href="mailto:akunpribadiku@gmail.com">Cemonggaul</a></div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
                $(this).toggleClass('active');
            });
        });
    </script>
</body>

</html>
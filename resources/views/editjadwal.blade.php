<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $title }}</title>
    @include('css')
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar Holder -->
        <nav id="sidebar" class="active">            
            <ul class="list-unstyled components">
                <li>
                    <a href="#juzmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">JUZ</a>
                    <ul class="collapse list-unstyled" id="juzmenu">
                        @foreach (range(1, 30) as $key => $value)
                            <li><a href='/juz/{{ $value }}'>Juz {{ $value }}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li>
                    <a href="#surahmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">SURAH</a>
                    <ul class="collapse list-unstyled" id="surahmenu">
                        @foreach (app(App\Models\QuranModel::class)->surahListStatis() as $key => $value)
                            <li><a href='/surah/{{ $value['surahNum'] }}'>{{ $value['surahNum'] }}. {{ $value['surahEn'] }} ﴾ {{ $value['surahAr'] }} ﴿</a></li>
                        @endforeach
                    </ul>
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
                    <a href="/quran/about">TENTANG My QUR`AN</a>
                </li>
                <li>
                    <a href="/quran/contact">HUBUNGI My QUR`AN</a>
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
                    <a class="navbar-brand text-success font-weight-bold" href="{{ url('/') }}" title="My QUR`AN">
                        <img src="{{ asset('inc/logo.png') }}" width='200' height='45' alt="My QUR`AN"/>
                    </a>
                </div>
            </nav>
            <div class="post container">
                <h5 class="text-center mb-3 arab">السلام عليكم ورحمة الله وبركاته</h5>
                <h1 class="text-center mb-3">{{ $title }}</h1>
                <div class="line"></div>
                <form method="post" action="{{ url('quran/editjadwal/'.$masjid) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group my-2"><label class="text-danger">Nama Masjid (max:36 karakter)*</label><input type="text" class="form-control" placeholder="Masjid Shodiqul Akbar" name="nama" maxlength="36" value="{{ old('nama', $nama ?? '') }}" required></div>
                    <div class="form-group my-2"><label class="text-danger">Alamat Masjid (max:75 karakter)*</label><input type="text" class="form-control" placeholder="Dsn. Bakulan Ds. Bendosewu Kec. Talun Kab. Blitar" value="{{ old('alamat', $alamat ?? '') }}" name="alamat" maxlength="75" required></div>
                    <div class="form-group my-2"><label class="text-danger">Foto Masjid*</label>
                        <input type="file" class="form-control" name="img">
                        @if(isset($img))
                            <img src='{{ str_replace('https://', 'https://i1.wp.com/', url("storage/{$img}")) }}' height='150'>
                        @endif
                    </div>
                    <div class="form-group my-2"><label class="text-danger">Pilih Audio Masuk Waktu Sholat*</label>
                        <div class="row">
                            <div class="col-6">
                                <select class="form-control" style="height: 53px" id="mp3" name="mp3">
                                    <option value="/inc/adzan/adzan1.mp3" {{ (old('mp3', $adzan ?? '') == '/inc/adzan/adzan1.mp3') ? 'selected': false }}>Adzan 1</option>
                                    <option value="/inc/adzan/adzan2.mp3" {{ (old('mp3', $adzan ?? '') == '/inc/adzan/adzan2.mp3') ? 'selected': false }}>Adzan 2</option>
                                    <option value="/inc/adzan/adzan3.mp3" {{ (old('mp3', $adzan ?? '') == '/inc/adzan/adzan3.mp3') ? 'selected': false }}>Adzan 3</option>
                                    <option value="/inc/adzan/beep.mp3" {{ (old('mp3', $adzan ?? '') == '/inc/adzan/beep.mp3') ? 'selected': false }}>Beep</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <div id="play"><audio controls class='form-control'><source id='playing' src='{{ old('mp3', $adzan ?? '/inc/adzan/adzan1.mp3') }}' title='1' type='audio/mp3'></audio></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group my-2"><label class="text-danger">Pesan 1 (max:150 karakter)*</label><input type="text" class="form-control" value="{{ old('pesan1', $pesan1 ?? '') }}" placeholder="Informasi infaq bulan Oktober 2022 sebesar Rp 1.855.000,- Semoga kita senantiasa dilancarkan dalam segala urusan sehari-hari. Aamiin" name="pesan1" maxlength="150" required></div>
                    <div class="form-group my-2"><label class="text-danger">Pesan 2 (max:150 karakter)*</label><input type="text" class="form-control" value="{{ old('pesan2', $pesan2 ?? '') }}" placeholder="Waktu khutbah selain Khatib DILARANG BICARA! Luruskan shaf dan rapatkan barisan!" name="pesan2" maxlength="150" required></div>
                    <div class="form-group my-2"><label class="text-danger">Cari Kota Masjid*</label><input list="kota" class="form-control" name="id" value="{{ old('id', $id ?? '') }}" placeholder="Ketikkan nama kota lalu pilih dari list. Bukan hanya ketik kota saja" required>
                        <datalist id="kota">
                          @foreach ($kota as $key => $value)
                            <option value='{{ $value['id'] }}. {{ $value['lokasi'] }}'/>
                          @endforeach
                        </datalist></div>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
                <div class="line"></div>
                <h3 class="my-3">Daftar Masjid Yang Menggunakan Jadwal Sholat My QUR`AN</h3>
                <ul class="list-group">
                    @foreach ($masjid as $key => $value)
                        @if (Auth::id() == $value->chat_id)
                            <li class='list-group-item list-group-item-success'>{{ $value->nama_masjid }} <a href='/quran/editjadwal/{{ $value->url }}'>[edit]</a> <a href='/jadwal/{{ $value->url }}' target='_blank'>[lihat]</a></li>
                        @else
                             <li class='list-group-item list-group-item-info'><a href='/jadwal/{{ $value->url }}'>{{ $value->nama_masjid }}</a></li>
                        @endif
                    @endforeach
                </ul>
            </div>
            <div class="footer">
                <div class="text-center py-3">&copy;{{ date('Y') }} <a href="{{ url('/') }}">My QUR`AN</a>. Developed by <a href="https://t.me/cemonggaul">Cemonggaul</a></div>
            </div>          
        </div>
    </div>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
                $(this).toggleClass('active');
            });

            $('#mp3').on('change', function (){
                var mp3Url = $('#mp3').val();
                var newAudio = $('<audio>', {
                    controls: true,
                    class: 'form-control'
                });
                var newSource = $('<source>', {
                    id: 'playing',
                    src: mp3Url,
                    type: 'audio/mp3'
                });
                newAudio.append(newSource);
                $('#play').html(newAudio);
            })
        });
    </script>
</body>

</html>
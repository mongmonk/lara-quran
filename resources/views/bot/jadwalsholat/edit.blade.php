<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <script src="https://telegram.org/js/telegram-web-app.js"></script>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center mb-4">{{ $title }}</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="post" action="{{ isset($jadwal) ? route('bot.jadwalsholat.update', ['masjid' => $jadwal->url]) : route('bot.jadwalsholat.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group my-2">
                <label class="text-danger">Nama Masjid (max:36 karakter)*</label>
                <input type="text" class="form-control" placeholder="Masjid Shodiqul Akbar" name="nama" maxlength="36" value="{{ old('nama', $jadwal->nama_masjid ?? '') }}" required>
            </div>
            <div class="form-group my-2">
                <label class="text-danger">Alamat Masjid (max:75 karakter)*</label>
                <input type="text" class="form-control" placeholder="Dsn. Bakulan Ds. Bendosewu Kec. Talun Kab. Blitar" value="{{ old('alamat', $jadwal->alamat ?? '') }}" name="alamat" maxlength="75" required>
            </div>
            <div class="form-group my-2">
                <label class="text-danger">Foto Masjid*</label>
                <input type="file" class="form-control" name="img" {{ isset($jadwal) ? '' : 'required' }}>
                @if(isset($jadwal->img))
                    <img src='{{ str_replace('https://', 'https://i1.wp.com/', url("storage/{$jadwal->img}")) }}' height='150' class="mt-2">
                @endif
            </div>
            <div class="form-group my-2">
                <label class="text-danger">Pilih Audio Masuk Waktu Sholat*</label>
                <div class="row">
                    <div class="col-6">
                        <select class="form-control" style="height: 53px" id="mp3" name="mp3">
                            <option value="/inc/audio/adzan1.mp3" {{ (old('mp3', $jadwal->adzan ?? '') == '/inc/audio/adzan1.mp3') ? 'selected': false }}>Adzan 1</option>
                            <option value="/inc/audio/adzan2.mp3" {{ (old('mp3', $jadwal->adzan ?? '') == '/inc/audio/adzan2.mp3') ? 'selected': false }}>Adzan 2</option>
                            <option value="/inc/audio/adzan3.mp3" {{ (old('mp3', $jadwal->adzan ?? '') == '/inc/audio/adzan3.mp3') ? 'selected': false }}>Adzan 3</option>
                            <option value="/inc/audio/beep.mp3" {{ (old('mp3', $jadwal->adzan ?? '') == '/inc/audio/beep.mp3') ? 'selected': false }}>Beep</option>
                        </select>
                    </div>
                    <div class="col-6">
                        <div id="play"><audio controls class='form-control'><source id='playing' src='{{ old('mp3', $jadwal->adzan ?? '/inc/audio/adzan1.mp3') }}' title='1' type='audio/mp3'></audio></div>
                    </div>
                </div>
            </div>
            <div class="form-group my-2">
                <label class="text-danger">Pesan 1 (max:150 karakter)*</label>
                <input type="text" class="form-control" value="{{ old('pesan1', $jadwal->pesan1 ?? '') }}" placeholder="Informasi infaq..." name="pesan1" maxlength="150" required>
            </div>
            <div class="form-group my-2">
                <label class="text-danger">Pesan 2 (max:150 karakter)*</label>
                <input type="text" class="form-control" value="{{ old('pesan2', $jadwal->pesan2 ?? '') }}" placeholder="Waktu khutbah selain Khatib DILARANG BICARA!" name="pesan2" maxlength="150" required>
            </div>
            <div class="form-group my-2">
                <label class="text-danger">Cari Kota Masjid*</label>
                <input list="kota" class="form-control" name="id" value="{{ old('id', $id ?? '') }}" placeholder="Ketikkan nama kota lalu pilih dari list" required>
                <datalist id="kota">
                  @foreach ($kota as $key => $value)
                    <option value='{{ $value['id'] }}. {{ $value['lokasi'] }}'/>
                  @endforeach
                </datalist>
            </div>
            <button type="submit" class="btn btn-success btn-block">Submit</button>
            <a href="{{ route('bot.jadwalsholat.index') }}" class="btn btn-secondary btn-block mt-2">Kembali</a>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function () {
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
        Telegram.WebApp.ready();
    </script>
</body>
</html>
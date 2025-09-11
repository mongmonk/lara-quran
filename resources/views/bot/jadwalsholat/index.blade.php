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

        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('bot.jadwalsholat.create') }}" class="btn btn-primary">Buat Jadwal Baru</a>
        </div>

        <h3 class="my-3">Daftar Masjid Anda</h3>
        <ul class="list-group">
            @forelse ($masjids as $masjid)
                <li class='list-group-item d-flex justify-content-between align-items-center'>
                    {{ $masjid->nama_masjid }}
                    <span>
                        <a href="{{ route('bot.jadwalsholat.edit', $masjid->url) }}" class="btn btn-sm btn-info">[edit]</a>
                        <a href='/jadwal/{{ $masjid->url }}' target='_blank' class="btn btn-sm btn-success">[lihat]</a>
                    </span>
                </li>
            @empty
                <li class="list-group-item text-center">Anda belum memiliki jadwal masjid.</li>
            @endforelse
        </ul>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <script>
        Telegram.WebApp.ready();
    </script>
</body>
</html>
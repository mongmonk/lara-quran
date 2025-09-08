<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $title }}</title>
    <meta name="google-site-verification" content="v41YLnzLxTtkqUVRPNP4qRvhFd4OLz5SHvhimMvEv7w" />
    <link rel="canonical" href="{{ url('/') }}" />
    <meta name="description" value="Jadikanlah Al-quranul Karim dan Sunnah Nabi sebagai tuntunan hidupmu agar kamu tidak sesat">
    <meta property="og:locale" content="id_ID" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="My QUR`AN" />
    <meta property="og:description" content="Jadikanlah Al-quranul Karim dan Sunnah Nabi sebagai tuntunan hidupmu agar kamu tidak sesat" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:site_name" content="My QUR`AN" />
    <meta property="og:image" content="{{ asset('inc/alquran.png') }}" />
    <meta property="og:image:width" content="800" />
    <meta property="og:image:height" content="500" />
    <meta property="og:image:type" content="image/png" />
    @include('css')
</head>
<body>
    <div class="wrapper">
        @include('sidenav')
            <div class="post container">
                <h3 class="my-3 arab text-center d-print-none">سْمِ ٱللّٰهِ الرَّحْمٰنِ الرَّحِيْمِ</h5>
                <h1 class="text-center">Jadwal Sholat Untuk {{ strtolower($data['data']['lokasi']) }}</h1>
                <h2 class="text-center mb-4">{{ $bulan }}</h2>
                <form name=pilih>
                    <div class="form-row d-print-none">
                        <div class="col-4 text-right">
                            <a href="?bulan={{ $bulanprev }}&tahun={{ $tahunprev }}" class="btn btn-primary" title="sebelum">&laquo; sebelum</a>
                        </div>
                        <div class="col-4">
                            <select name=kota onChange="change_page()" class="form-control">
                                <option disabled selected>PILIH KOTA</option>
                                @foreach ($kota as $key => $value)
                                    @if ($value['id'] == $data['data']['id'])
                                        <option value='{{ $value['id'] }}' selected>{{ $value['lokasi'] }}</option>
                                    @else
                                        <option value='{{ $value['id'] }}'>{{ $value['lokasi'] }}</option>
                                    @endif                                    
                                @endforeach
                            </select>
                        </div>
                        <div class="col-4">
                            <a href="?bulan={{ $bulannext }}&tahun={{ $tahunnext }}" class="btn btn-primary" title="sesudah">sesudah &raquo;</a>
                        </div>
                        <div class="col-12 text-center my-2 vertical-align-middle">
                            <canvas id="canvas" width="200" height="200" class="d-print-none bg-info"></canvas><br>
                            <input type="button" class="btn btn-outline-secondary d-print-none" name="btnExport" value="PRINT" onClick="window.print()" />
                        </div>
                    </div>                    
                </form>
                <table class="table text-center mt-4">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Imsyak</th>
                            <th>Shubuh</th>
                            <th>Terbit</th>
                            <th>Dhuha</th>
                            <th>Dzuhur</th>
                            <th>Ashar</th>
                            <th>Maghrib</th>
                            <th>Isya`</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['data']['jadwal'] as $key => $jadwal)
                            @php
                                $tanggal = date("d", strtotime($jadwal['date']));
                            @endphp
                            @if ($tanggal == date('d'))
                                <tr class='bg-warning'><td>{{ $tanggal }}</td><td>{{ $jadwal['imsak'] }}</td><td>{{ $jadwal['subuh'] }}</td><td>{{ $jadwal['terbit'] }}</td><td>{{ $jadwal['dhuha'] }}</td><td>{{ $jadwal['dzuhur'] }}</td><td>{{ $jadwal['ashar'] }}</td><td>{{ $jadwal['maghrib'] }}</td><td>{{ $jadwal['isya'] }}</td></tr>
                            @else
                                <tr><td>{{ $tanggal }}</td><td>{{ $jadwal['imsak'] }}</td><td>{{ $jadwal['subuh'] }}</td><td>{{ $jadwal['terbit'] }}</td><td>{{ $jadwal['dhuha'] }}</td><td>{{ $jadwal['dzuhur'] }}</td><td>{{ $jadwal['ashar'] }}</td><td>{{ $jadwal['maghrib'] }}</td><td>{{ $jadwal['isya'] }}</td></tr>
                            @endif
                        @endforeach                        
                    </tbody>
                </table>
            </div>
            <div class="footer d-print-none">
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
        });
    </script>
    <script language="javascript">
        function change_page(){
        window.location="?id="+document.pilih.kota.value;
    }

    var canvas = document.getElementById("canvas");
    var ctx = canvas.getContext("2d");
    var radius = canvas.height / 2;
    ctx.translate(radius, radius);
    radius = radius * 0.90
    setInterval(drawClock, 1000);

    function drawClock() {
      drawFace(ctx, radius);
      drawNumbers(ctx, radius);
      drawTime(ctx, radius);
    }

    function drawFace(ctx, radius) {
      var grad;
      ctx.beginPath();
      ctx.arc(0, 0, radius, 0, 2*Math.PI);
      ctx.fillStyle = 'white';
      ctx.fill();
      grad = ctx.createRadialGradient(0,0,radius*0.95, 0,0,radius*1.05);
      grad.addColorStop(0, '#333');
      grad.addColorStop(0.5, 'white');
      grad.addColorStop(1, '#333');
      ctx.strokeStyle = grad;
      ctx.lineWidth = radius*0.1;
      ctx.stroke();
      ctx.beginPath();
      ctx.arc(0, 0, radius*0.1, 0, 2*Math.PI);
      ctx.fillStyle = '#333';
      ctx.fill();
    }

    function drawNumbers(ctx, radius) {
      var ang;
      var num;
      ctx.font = radius*0.15 + "px arial";
      ctx.textBaseline="middle";
      ctx.textAlign="center";
      for(num = 1; num < 13; num++){
        ang = num * Math.PI / 6;
        ctx.rotate(ang);
        ctx.translate(0, -radius*0.85);
        ctx.rotate(-ang);
        ctx.fillText(num.toString(), 0, 0);
        ctx.rotate(ang);
        ctx.translate(0, radius*0.85);
        ctx.rotate(-ang);
      }
    }

    function drawTime(ctx, radius){
        var now = new Date();
        var hour = now.getHours();
        var minute = now.getMinutes();
        var second = now.getSeconds();
        //hour
        hour=hour%12;
        hour=(hour*Math.PI/6)+
        (minute*Math.PI/(6*60))+
        (second*Math.PI/(360*60));
        drawHand(ctx, hour, radius*0.5, radius*0.07);
        //minute
        minute=(minute*Math.PI/30)+(second*Math.PI/(30*60));
        drawHand(ctx, minute, radius*0.8, radius*0.07);
        // second
        second=(second*Math.PI/30);
        drawHand(ctx, second, radius*0.9, radius*0.02);
    }

    function drawHand(ctx, pos, length, width) {
        ctx.beginPath();
        ctx.lineWidth = width;
        ctx.lineCap = "round";
        ctx.moveTo(0,0);
        ctx.rotate(pos);
        ctx.lineTo(0, -length);
        ctx.stroke();
        ctx.rotate(-pos);
    }
    </script>
</body>

</html>
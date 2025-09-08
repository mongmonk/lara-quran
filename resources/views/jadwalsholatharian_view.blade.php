<!doctype html>
<html lang="id-ID">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    <link rel="canonical" href="{{ url()->current() }}" />
    <meta name="description" value="{{ $title }}">
    <meta property="og:locale" content="id_ID" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="{{ $title }}" />
    <meta property="og:description" content="{{ $title }}" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:site_name" content="My QUR`AN" />
    <meta property="og:image" content="{{ asset('inc/jadwal.jpg') }}" />
    <meta property="og:image:type" content="image/png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <style type="text/css">
      @import url('https://fonts.googleapis.com/css2?family=Acme&family=Noto+Naskh+Arabic:wght@600;700&family=Poppins:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,500;1,600;1,700;1,800&family=Quicksand:wght@400;500;600;700&display=swap');
      body {
        font-family: 'Quicksand', sans-serif;
        margin: 0;
      }
      p{
        margin-bottom: 0;
      }
      .view {
        display: block;
        width: 100%;
        height: 100%;
        position: fixed;
        background-image: url("{{ url("storage/{$img}") }}");
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
        background-position: center center;
      }
      .header {
        padding: .5vw 1vw;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: rgba(0, 0, 0, 0.6);
      }
      .kolom-kiri {
        width: 75vw;
      }
      p.nama {
        font-family: 'Acme', sans-serif;
        color: lime;
        font-size: 4.3vw;
        font-weight: bolder;
        background: -webkit-linear-gradient(lime, lightgoldenrodyellow);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        text-transform: capitalize;
      }
      p.alamat {
        font-family: 'Quicksand', sans-serif;
        font-size: 1.7vw;
        color: cyan;
        /*-webkit-text-stroke: .7px #999;*/
      }
      .kolom-kanan {
        width: 25vw;
        text-align: center;
      }
      p.tanggal {
        color: antiquewhite;
        font-size: 1.3vw;
      }
      #tanggal-hijri {
        font-size: 2vw;
      }
      p.jam {
        font-family: 'Quicksand', sans-serif;
        font-size: 3vw;
        background: -webkit-linear-gradient(yellow, red);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-weight: bold;
      }
      .b-bottom {
        border-bottom: 1px solid whitesmoke;
      }
      .tengah {
        position: absolute;
        margin: 0;
        top: 50%;
        -ms-transform: translateY(-50%);
        transform: translateY(-50%);
        width: 100vw;
      }
      .container-fluit {
        padding: 1vw 0;
        border-radius: 1vw;
        background-color: rgba(0, 0, 0, .4);
        margin: 2vw;
      }
      .content {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
      }
      .data {
        font-family: 'Quicksand', sans-serif;
        margin: 0.5vh 1vw 0.5vh 1vw;
        width: 100%;
        font-weight: 600;
        text-align: center;
        border-radius: 1vw;
        background-color: rgba(56, 56, 56, .8);
        flex: 20%;
      }
      .active {
        color: lime !important;
      }
      p.info {
        font-size: 2vw;
        color: gold;
        margin: 0.2vh;
      }
      p.info-jam {
        font-size: 2.5vw;
        color: white;
        margin: 0.2vh;
      }
      #adzan, .reminder {
        width: 50vw;
        margin: 2vw auto 0;
        text-align: center;
        border-radius: 1vw;
        background-color: #111;
        background-image: radial-gradient(#333, #111);
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
      }
      p.text-reminder {
        font-family: 'Poppins', sans-serif;
        font-size: 2vw;
        font-weight: 600;
        color: yellow;
        text-shadow: 1px 2px 3px #666;
        text-transform: capitalize;
      }
      .sholattime {
        color: red;
      }
      .footer {
        position: absolute;
        width: 100vw;
        bottom: 1vw;
        height: 3.3vw;
        text-align: center;
        background-color: rgba(0, 0, 0, .8);
      }
      .marquee {
        overflow: hidden;
      }
      .marquee p {
        font-family: 'Quicksand', sans-serif;
        width: 100%;
        height: 100%;
        font-size: 1.4vw;
        text-align: center;
        color: lightgoldenrodyellow;
        transform:translateX(100%);
        -moz-transform:translateX(100%);
        -webkit-transform:translateX(100%);
      }
      .mrq1{
        margin-top: .5em;
      }
      .mrq2 {
        margin-top: -1.7em;
      }
      .marquee p:nth-child(1) {
        animation: left-one 20s ease infinite;
        -moz-animation: left-one 20s ease infinite;
        -webkit-animation: left-one 20s ease infinite;
      }
      .marquee p:nth-child(2) {
        animation: left-two 20s ease infinite;
        -moz-animation: left-two 20s ease infinite;
        -webkit-animation: left-two 20s ease infinite;
      }
      .adzan {
        font-family: 'Quicksand', sans-serif;
        width: 100%;
        margin: auto;
        color: white;
        padding: 1vw;
        font-size: 4vw;
        font-weight: bold;
        height: 18vh;
        text-transform: uppercase;
        background-color: #111;
        background-image: radial-gradient(#333, #000);
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
        border-radius: 1vw;
      }
      .adzan span {
        display: block;
        font-size: .4em;
        opacity: .8;
        -webkit-text-stroke: .6px #fefefe;
      }
      .adzan div {
        position: fixed;
        margin: 2vh 0;
        opacity: 0;
        left: 10vw;
        width: 80vw;
        animation: switch 32s linear infinite;
      }
      .adzan div:nth-child(2) { animation-delay: 4s}
      .adzan div:nth-child(3) { animation-delay: 8s}
      .adzan div:nth-child(4) { animation-delay: 12s}
      .adzan div:nth-child(5) { animation-delay: 16s}
      .adzan div:nth-child(6) { animation-delay: 20s}
      .adzan div:nth-child(7) { animation-delay: 24s}
      .adzan div:nth-child(8) { animation-delay: 28s}
      @keyframes switch {
          0% { opacity: 0;filter: blur(20px); transform:scale(12)}
          3% { opacity: 1;filter: blur(0); transform:scale(1)}
          10% { opacity: 1;filter: blur(0); transform:scale(.9)}
          13% { opacity: 0;filter: blur(10px); transform:scale(.1)}
          80% { opacity: 0}
          100% { opacity: 0}
      }
      .edit{
        display: inline-flex;
        position: absolute;
        right: 0;
        bottom: 5vw;
        width: 30px;
        background-color: rgba(150, 150, 150, .6);
        padding: 3px;
        border-top-left-radius: 10px;
        border-bottom-left-radius: 10px;
        opacity: .6;
        color: #ddd;
        text-decoration: none;
        font-size: 1.1vw;
      }
      .edit:hover{
        opacity: .9;
        width: 40px;
        background-color: rgba(100, 100, 100, .8);
      }
      .edit a img{
        float: left;
        margin-right: 2px;
      }
      #btn {
        opacity: .7;
        float: right;
        border: none;
      }
      @-moz-keyframes left-one {
        0%  {
          -moz-transform:translateX(100%);
        }
        10% {
          -moz-transform:translateX(0);
        }
        40% {
          -moz-transform:translateX(0);
        }
        50% {
          -moz-transform:translateX(-100%);
        }
        100%{
          -moz-transform:translateX(-100%);
        }
      }
      @-moz-keyframes left-two {
        0% {
          -moz-transform:translateX(100%);
        }
        50% {
          -moz-transform:translateX(100%);
        }
        60% {
          -moz-transform:translateX(0);
        }
        90% {
          -moz-transform:translateX(0);
        }
        100%{
          -moz-transform:translateX(-100%);
        }
      }
      @-webkit-keyframes left-one {
        0% {
          -webkit-transform:translateX(100%);
        }
        10% {
          -webkit-transform:translateX(0);
        }
        40% {
          -webkit-transform:translateX(0);
        }
        50% {
          -webkit-transform:translateX(-100%);
        }
        100%{
          -webkit-transform:translateX(-100%);
        }
      }
      @-webkit-keyframes left-two {
        0% {
          -webkit-transform:translateX(100%);
        }
        50% {
          -webkit-transform:translateX(100%);
        }
        60% {
          -webkit-transform:translateX(0);
        }
        90% {
          -webkit-transform:translateX(0);
        }
        100%{
          -webkit-transform:translateX(-100%);
        }
      }
      @media (min-width: 800px) {
        .data {
          flex: 10%;
        }
      }
      @media (max-width: 768px) {
        .header {
          flex-direction: column;
          text-align: center;
        }
        .kolom-kiri, .kolom-kanan {
          width: 100%;
        }
        p.nama {
          font-size: 8vw;
        }
        p.alamat {
          font-size: 4vw;
        }
        p.jam {
          font-size: 6vw;
        }
        p.tanggal {
          font-size: 3vw;
        }
        #tanggal-hijri {
          font-size: 4vw;
        }
        .data {
          flex: 40%;
          margin: 1vw;
        }
        p.info {
          font-size: 4vw;
        }
        p.info-jam {
          font-size: 5vw;
        }
        #adzan, .reminder {
          width: 90vw;
        }
        p.text-reminder {
          font-size: 4vw;
        }
        .footer {
          height: auto;
          padding: 1vw;
        }
        .marquee p {
          font-size: 3vw;
        }
      }
    </style>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-76383447-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-76383447-1');
    </script>
  </head>
  <body>
    <div class="view">
      <div class="header">
        <div class="kolom-kiri">
          <p class="nama" id="masjid">{{ $nama }}</p>
          <p class="alamat">{{ $alamat }}</p>
        </div>
        <div class="kolom-kanan">
          <p class="jam" id="waktu"><span id="jam-menit">{{ date("H:i") }}</span>:<span id="detik">{{ date("s") }}</span></p>
          <p class="tanggal b-bottom" id="tanggal">{{ date("l, d F Y") }}</p>
          <p class="tanggal" id="tanggal-hijri"></p>
        </div>
      </div>
      <button id="btn">⛶</button>
      <div class="tengah">
        <div class="container-fluit">
          <div class="content" id="content">
            <div class="data">
              <p class="info">Imsak</p>
              <div class="b-bottom my-2"></div>
              <p class="info-jam Imsak" id="imsak">--:--</p>
            </div>
            <div class="data">
              <p class="info">Subuh</p>
              <div class="b-bottom my-2"></div>
              <p class="info-jam Subuh" id="subuh">--:--</p>
            </div>
            <div class="data">
              <p class="info">Terbit</p>
              <div class="b-bottom my-2"></div>
              <p class="info-jam Terbit" id="terbit">--:--</p>
            </div>
            <div class="data">
              <p class="info">Dhuha</p>
              <div class="b-bottom my-2"></div>
              <p class="info-jam Dhuha" id="dhuha">--:--</p>
            </div>
            <div class="data">
              <p class="info">Dzuhur</p>
              <div class="b-bottom my-2"></div>
              <p class="info-jam Dzuhur" id="dzuhur">--:--</p>
            </div>
            <div class="data">
              <p class="info">Ashar</p>
              <div class="b-bottom my-2"></div>
              <p class="info-jam Ashar" id="ashar">--:--</p>
            </div>
            <div class="data">
              <p class="info">Maghrib</p>
              <div class="b-bottom my-2"></div>
              <p class="info-jam Maghrib" id="maghrib">--:--</p>
            </div>
            <div class="data">
              <p class="info">Isya</p>
              <div class="b-bottom my-2"></div>
              <p class="info-jam Isya" id="isya">--:--</p>
            </div>
          </div>
          <div id="adzan">
            <div class="reminder" id="reminder">
              <p class="text-reminder" id="waktu-reminder"></p>
            </div>
          </div>
        </div>
      </div>
      <div class="footer">
        <div class="marquee" id="informasi">
          <p class="mrq1">{{ $pesan1 }}</p>
          <p class="mrq2">{{ $pesan2 }}</p>
        </div>
      </div>
      <div class="edit">
        @if ($chat_id == $owner_chat_id)
          <a href="{{ url("quran/editjadwal/{$url}") }}">
            <img src="https://i0.wp.com/ps.w.org/under-construction-page/assets/icon-256x256.gif?resize=30,30" width="30" height="30">
          </a>
        @else
          <a href="{{ url("quran/jadwalsholatharian") }}">
            <img src="https://i0.wp.com/ps.w.org/under-construction-page/assets/icon-256x256.gif?resize=30,30" width="30" height="30">
          </a>
        @endif
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf-8">
      var list_nama = ["Subuh","Dzuhur","Ashar","Maghrib","Isya"];
      var list_jadwal = [];
      var cur_date;
      function update(){
        $.ajax({
          url: "{{ url("/quran/masjid/{$id}") }}",
          type: 'GET',
          success: function(res){
            var data = res;
            $('#imsak').html(data.imsak);
            $('#subuh').html(data.subuh);
            $('#terbit').html(data.terbit);
            $('#dhuha').html(data.dhuha);
            $('#dzuhur').html(data.dzuhur);
            $('#ashar').html(data.ashar);
            $('#maghrib').html(data.maghrib);
            $('#isya').html(data.isya);
            $('#date').html(data.date);
            $('#tanggal').html(data.tanggal);
            $('#tanggal-hijri').html(data.hijriyah);
            var kota = data.lokasi;
            var prov = data.daerah;
            /* Mulai hitung tanggal */
            var date = new Date();
            var jam = concatZero(date.getHours());
            var menit = concatZero(date.getMinutes());
            var detik = concatZero(date.getSeconds());
            var tahun = date.getFullYear();
            var bulan = date.getMonth();
            var tanggal = date.getDate();
            var hari = date.getDay();
            var jamSekarang = jam + ':' + menit+ ':' + detik;
            var jamMenit = jam + ':' + menit;
            bulan++;
            list_jadwal = [];
            list_jadwal.push(data.subuh);
            list_jadwal.push(data.dzuhur);
            list_jadwal.push(data.ashar);
            list_jadwal.push(data.maghrib);
            list_jadwal.push(data.isya);
            cur_date = tanggal;

            if (list_jadwal.length == 5) {
              var x = -1;
              for (var i = 0; i < list_jadwal.length; i++) {
                if (parseInt(list_jadwal[i].split(":")[0]) > parseInt(jam) || parseInt(list_jadwal[i].split(":")[0]) == parseInt(jam) && parseInt(list_jadwal[i].split(":")[1]) > parseInt(menit)) {
                  x = i;
                  break;
                }
              }

              if (x != -1) {
                var jamSholat = parseInt(list_jadwal[x].split(":")[0]);
                var menitSholat = parseInt(list_jadwal[x].split(":")[1]);
                var jamSholatBaru = concatZero(jamSholat) + ':' + concatZero(menitSholat-1) + ':59';
                var jamMin = jamSholat - parseInt(jam);
                var menitMin = menitSholat - parseInt(menit);

                if (menitMin < 0) {
                  menitMin = 60 - parseInt(menit) + menitSholat;
                  jamMin = jamMin - 1;
                }
                menitMin = menitMin - 1;
                if (jamMin < 10) {
                  jamMin = concatZero(jamMin);
                }
                if (menitMin < 10) {
                  menitMin = concatZero(menitMin);
                }
                var re_detik = 60 - parseInt(detik);
                if (re_detik < 10) {
                  re_detik = concatZero(re_detik);
                }
                if (re_detik == 60 || re_detik == 0-1) {
                  re_detik = concatZero(0);
                }

                var sholatPrev = list_nama[x-1];
                var sholatNext = list_nama[x];
                var reminder = "<div id='waktu-kurang'>waktu " + sholatNext + " <span class='sholattime'>-" + jamMin + ":" + menitMin + ":" + re_detik + "</span><br>Untuk " + kota + " dan sekitarnya</div>";
                $("#waktu-reminder").html(reminder);

                $('.' + sholatNext).addClass("active");

                if(jamSholatBaru == jamSekarang){
                  $('.' + sholatNext).removeClass("active");
                  $('.' + sholatNext).addClass("text-danger");
                  $("#adzan").html("<div class='adzan'><div class='text-danger'><span>Waktunya Sholat " + sholatNext + "</span><span>Untuk " + kota + " dan sekitarnya</span></div><div><span>Matikan HP</span><span>Segera ambil wudhu</span></div><div class='text-warning'><span>Waktunya Sholat " + sholatNext + "</span><span>Untuk " + kota + " dan sekitarnya</span></div><div><span>Rapatkan dan luruskan shaf</span><span>untuk kesempurnaan sholat jamaah</span></div><div class='text-primary'><span>Waktunya Sholat " + sholatNext + "</span><span>Untuk " + kota + " dan sekitarnya</span></div><div><span>Sholat berjamaah lebih utama 27 derajat</span><span>dibanding sholat sendirian</span></div><div class='text-info'><span>Waktunya Sholat " + sholatNext + "</span><span>Untuk " + kota + " dan sekitarnya</span></div><div><span>jadwal sholat ini</span><span>disediakan oleh {{ url('/') }}</span></div><audio controls autoplay class='d-none audio'><source src='{{ $adzan }}' title='1' type='audio/mp3'></audio></div>");
                }

                $('.audio').on('ended', function(){
                  $('.' + sholatPrev).removeClass("text-danger");
                  $('.' + sholatPrev).removeClass("active");
                  $('.adzan').remove();
                  $('#adzan').html('<div class="reminder" id="reminder"><p class="text-reminder" id="waktu-reminder"></p></div>');
                });

                if (jamSekarang === '00:00:01') {
                  location.reload();
                }

              }
            }


          }
        });
      }
      setInterval(update, 1000);

      function concatZero(timeFrame) {
        return timeFrame < 10 ? '0'.concat(timeFrame) : timeFrame
      }

      var a;
      var time;
      setInterval(() => {
        a = new Date();
        time = '<span id="jam-menit">' + concatZero(a.getHours()) + ':' + concatZero(a.getMinutes()) + '</span>:<span id="detik">' + concatZero(a.getSeconds()) + '</span>';
        document.getElementById('waktu').innerHTML = time;
      }, 1000);

      let myDocument = document.documentElement;
      let btn = document.getElementById("btn");

      btn.addEventListener("click", ()=>{
          if(btn.textContent == "⛶"){
              if(myDocument.requestFullscreen){
                  myDocument.requestFullscreen();
              }
              else if(myDocument.msRequestFullscreen){
                  myDocument.msRequestFullscreen();
              }
              else if(myDocument.mozRequestFullscreen){
                  myDocument.mozRequestFullscreen();
              }
              else if(myDocument.webkitRequestFullscreen){
                  myDocument.webkitRequestFullscreen();
              }

              btn.textContent = "⇲";
          }
          else{
              if(document.exitFullscreen){
                  document.exitFullscreen();
              }
              else if(document.msexitFullscreen){
                  document.msexitFullscreen();
              }
              else if(document.mozexitFullscreen){
                  document.mozexitFullscreen();
              }
              else if(document.webkitexitFullscreen){
                  document.webkitexitFullscreen();
              }

              btn.textContent = "⛶";
          }
      });
    </script>
  </body>
</html>
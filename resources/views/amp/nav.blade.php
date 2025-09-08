<amp-analytics type="googleanalytics">
<script type="application/json">
{
  "vars": {
    "account": "UA-76383447-1"
  },
  "triggers": {
    "default pageview": {
      "on": "visible",
      "request": "pageview",
      "vars": {
        "title": "{{ $title }}"
      }
    }
  }
}
</script>
</amp-analytics>
<header class="ampstart-headerbar fixed flex justify-start items-center top-0 left-0 right-0 pl2 pr4">
  <div
    role="button"
    aria-label="open sidebar"
    on="tap:header-sidebar.toggle"
    tabindex="0"
    class="ampstart-navbar-trigger pr2"
  >
    ☰
  </div>
  <a class="my2 mx-auto" href="{{ url('/') }}" title="My QUR`AN">
    <amp-img
      src="{{ asset('inc/logo.png') }}"
      width="200"
      height="45"
      layout="fixed"
      alt="My QUR`AN"
    ></amp-img>
  </a>
</header>

<!-- Start Sidebar -->
<amp-sidebar
  id="header-sidebar"
  class="ampstart-sidebar px3"
  layout="nodisplay"
>
  <div class="flex justify-start items-center ampstart-sidebar-header">
    <div
      role="button"
      aria-label="close sidebar"
      on="tap:header-sidebar.toggle"
      tabindex="0"
      class="ampstart-navbar-trigger items-start"
    >
      ✕
    </div>
  </div>
  <nav class="ampstart-sidebar-nav ampstart-nav">
    <ul class="list-reset m0 p0 ampstart-label">
      <li class="ampstart-nav-item">
        <a class="ampstart-nav-link" href="/quran/page">AL-QUR`AN PER HALAMAN</a>
      </li>
      <li class="ampstart-nav-item">
        <a class="ampstart-nav-link" href="/quran/daftarjuz">AL-QUR`AN PER JUZ</a>
      </li>
      <li class="ampstart-nav-item">
        <a class="ampstart-nav-link" href="/quran/daftarsurah">AL-QUR`AN PER SURAH</a>
      </li>
      <li class="ampstart-nav-item">
        <a class="ampstart-nav-link" href="/quran/daftarruku">QUR`AN PER RUKU`</a>
      </li>
      <li class="ampstart-nav-item">
        <a class="ampstart-nav-link" href="/quran/daftarsajdah">AYAT-AYAT SAJDAH</a>
      </li>
      <li class="ampstart-nav-item">
        <a class="ampstart-nav-link" href="/quran/daftarayat">TAHFIDZUL QUR`AN</a>
      </li>
      <li class="ampstart-nav-item">
        <a class="ampstart-nav-link" href="/hadits/bukhari">HADITS RIWAYAT BUKHARI</a>
      </li>
      <li class="ampstart-nav-item">
        <a class="ampstart-nav-link" href="/hadits/muslim">HADITS RIWAYAT MUSLIM</a>
      </li>
      <li class="ampstart-nav-item">
        <a class="ampstart-nav-link" href="/hadits/abudaud">HADITS RIWAYAT ABU DAUD</a>
      </li>
      <li class="ampstart-nav-item">
        <a class="ampstart-nav-link" href="/hadits/ahmad">HADITS RIWAYAT AHMAD</a>
      </li>
      <li class="ampstart-nav-item">
        <a class="ampstart-nav-link" href="/hadits/darimi">HADITS RIWAYAT DARIMI</a>
      </li>
      <li class="ampstart-nav-item">
        <a class="ampstart-nav-link" href="/hadits/ibnumajah">HADITS RIWAYAT IBNU MAJAH</a>
      </li>
      <li class="ampstart-nav-item">
        <a class="ampstart-nav-link" href="/hadits/malik">HADITS RIWAYAT MALIK</a>
      </li>
      <li class="ampstart-nav-item">
        <a class="ampstart-nav-link" href="/hadits/nasai">HADITS RIWAYAT NASA`I</a>
      </li>
      <li class="ampstart-nav-item">
        <a class="ampstart-nav-link" href="/hadits/tirmidzi">HADITS RIWAYAT TIRMIDZI</a>
      </li>
      <li class="ampstart-nav-item">
        <a class="ampstart-nav-link" href="/quran/doa">DOA HARIAN</a>
      </li>
      <li class="ampstart-nav-item">
        <a class="ampstart-nav-link" href="/quran/tahlil">DOA TAHLIL</a>
      </li>
      <li class="ampstart-nav-item">
        <a class="ampstart-nav-link" href="/quran/jadwalsholat">JADWAL SHOLAT BULANAN</a>
      </li>
      <li class="ampstart-nav-item">
        <a class="ampstart-nav-link" href="/quran/jadwalsholatharian">JADWAL SHOLAT UNTUK MASJID</a>
      </li>
      <li class="ampstart-nav-item">
        <a class="ampstart-nav-link" href="/quran/partnerapi">PARTNER API</a>
      </li>
    </ul>
  </nav>
</amp-sidebar>
<!-- End Sidebar -->
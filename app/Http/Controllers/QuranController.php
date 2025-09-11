<?php

namespace App\Http\Controllers;

use App\Models\QuranModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class QuranController extends Controller
{
    protected $quran;

    public function __construct()
    {
        $this->quran = new QuranModel;
    }

    public function index()
    {
        $data['title'] = 'My QUR`AN';

        return view('amp.index', $data);
    }

    public function daftarjuz()
    {
        $data['title'] = 'Daftar Juz ~ My QUR`AN';

        return view('amp.daftarjuz', $data);
    }

    public function daftarsurah()
    {
        $get = $this->quran->surahListStatis();
        $data['data'] = $get;
        $data['title'] = 'Daftar Surah ~ My QUR`AN';

        return view('amp.daftarsurah', $data);
    }

    public function daftartafsir()
    {
        $get = $this->quran->surahListStatis();
        $data['data'] = $get;
        $data['title'] = 'Daftar Tafsir ~ My QUR`AN';

        return view('amp.daftartafsir', $data);
    }

    public function daftarruku()
    {
        $get = $this->quran->getAllRukuStatis();
        $data['data'] = $get;
        $data['title'] = 'Daftar Ruku` ~ My QUR`AN';

        return view('amp.daftarruku', $data);
    }

    public function daftarayat()
    {
        $get = $this->quran->getQuran();
        $data['data'] = $get['data']['surahs'];
        $data['title'] = 'Daftar Ayat` ~ My QUR`AN';

        return view('amp.daftarayat', $data);
    }

    public function daftarsajdah()
    {
        $get = $this->quran->getSajdah();
        $data['data'] = $get;
        $data['title'] = 'Daftar Ayat Sajdah ~ My QUR`AN';

        return view('amp.daftarsajdah', $data);
    }

    public function juz($juz)
    {
        $get = $this->quran->getJuzStatis((int) $juz);
        $data['data'] = $get;
        $data['title'] = 'Juz '.$juz.' ~ My QUR`AN';

        return view('juz', $data);
    }

    public function surah($surah)
    {
        $get = $this->quran->getSurah((int) $surah);
        $data['data'] = $get;
        $data['title'] = 'Surah '.$get['surahEn'].' ~ My QUR`AN';

        return view('surah', $data);
    }

    public function ruku($ruku)
    {
        $get = $this->quran->getRuku((int) $ruku);
        $data['data'] = $get;
        $data['meta'] = $this->quran->getAllRukuStatis();
        $data['title'] = "Ruku` ke {$ruku} Surah {$get['surahEn']} ~ My QUR`AN";

        return view('ruku', $data);
    }

    public function page($page = 1)
    {
        $get = $this->quran->getPage((int) $page);
        $data['data'] = $get;
        $data['meta'] = $this->quran->getAllRukuStatis();
        $data['title'] = "Hal {$page} ~ My QUR`AN";

        return view('page', $data);
    }

    public function ayah($number)
    {
        $get = $this->quran->getAyah((int) $number);
        $surah = $get['surahNum'];
        $ayah = $get['ayat'];
        $data['data'] = $get;
        $namasurah = $get['surahEn'];
        $data['title'] = "Surat {$namasurah} Ayat {$ayah} ~ My QUR`AN";
        $data['surah'] = $surah;
        $data['ayah'] = $ayah;
        $data['tafsir'] = $this->quran->tafsirSurah($surah)['tafsir'][$ayah - 1];

        $prev = $number - 1;
        $next = $number + 1;

        if (request()->get('audio')) {
            $getAudio = request()->get('audio');
            $data['prev'] = $number != 1 ? '<a href="/ayah/'.$prev.'?audio='.$getAudio.'" class="btn">◄ PREV</a>' : false;
            $data['next'] = $number != 6236 ? '<a href="/ayah/'.$next.'?audio='.$getAudio.'" class="btn">NEXT ►</a>' : false;
        } else {
            $data['prev'] = $number != 1 ? '<a href="/ayah/'.$prev.'" class="btn">◄ PREV</a>' : false;
            $data['next'] = $number != 6236 ? '<a href="/ayah/'.$next.'" class="btn"gt;NEXT ►</a>' : false;
        }

        return view('amp.ayah', $data);
    }

    public function tafsir($surah)
    {
        $get = $this->quran->tafsirSurah($surah);
        $data['data'] = $get;
        $data['title'] = 'Tafsir Surah '.$get['nama_latin'].' ~ My QUR`AN';

        return view('amp.tafsir', $data);
    }

    public function jadwalsholat()
    {
        $kota = request()->get('id') ? request()->get('id') : 1603;
        $data['data'] = $this->quran->getJadwal($kota);
        $data['kota'] = $this->quran->getKota();
        $data['title'] = 'Jadwal Sholat ~ My QUR`AN';

        $tgl = $data['data']['data']['jadwal'][0]['date'];
        $data['bulanprev'] = date('m', strtotime('-1 month', strtotime($tgl)));
        $data['tahunprev'] = date('Y', strtotime('-1 month', strtotime($tgl)));
        $data['bulannext'] = date('m', strtotime('+1 month', strtotime($tgl)));
        $data['tahunnext'] = date('Y', strtotime('+1 month', strtotime($tgl)));

        $asli = ['january', 'february', 'march', 'may', 'june', 'July', 'august', 'october', 'december'];
        $ganti = ['Januari', 'Februari', 'Maret', 'Mei', 'Juni', 'Juli', 'Agustus', 'Oktober', 'Desember'];
        $data['bulan'] = str_ireplace($asli, $ganti, date('F Y', strtotime($tgl)));

        return view('jadwalsholat', $data);
    }

    public function tahlil()
    {
        $data['title'] = 'Do`a Tahlil ~ My QUR`AN';
        $data['data'] = $this->quran->getTahlil();

        return view('amp.tahlil', $data);
    }

    public function about()
    {
        $data['title'] = 'Tentang My QUR`AN';

        return view('amp.about', $data);
    }

    public function privacy()
    {
        $data['title'] = 'Tentang My QUR`AN';

        return view('amp.privacy', $data);
    }

    public function partnerapi()
    {
        $data['title'] = 'API Partner My QUR`AN';

        return view('partnerapi', $data);
    }

    public function contact()
    {
        $data['title'] = 'Hubungi My QUR`AN';
        $data['pesan'] = false;

        if (request()->isMethod('post')) {
            $validated = request()->validate([
                'nama' => 'required|string|min:3|max:30',
                'email' => 'required|email',
                'wa' => 'required|string|min:9|max:13',
                'pesan' => 'required|string|min:5',
            ]);

            $site = 'My QUR`AN';

            $text = "<b>PESAN BARU DARI {$site}</b>\n\nNAMA: {$validated['nama']}\nEMAIL: {$validated['email']}\nNO.WA: {$validated['wa']}\nPESAN: {$validated['pesan']}";

            $this->quran->kirimTelegram($text);

            $data['pesan'] = "<div class='alert alert-success'>Terimakasih sudah menghubungi kami.<br>Pesan berhasil terkirim ke admin {$site}. Insyaallah secepatnya akan kami kabari lewat WhatsApp</div>";
        }

        return view('amp.contact', $data);
    }


    public function doa()
    {
        $data['data'] = $this->quran->getDoa();
        $data['title'] = 'Do`a Harian ~ My QUR`AN';

        return view('amp.doa', $data);
    }

    public function masjid($masjidid = false)
    {
        $id = $masjidid ? $masjidid : 1603;
        $hari = date('d');
        $jadwal = $this->quran->getJadwal($id, $hari);

        return response()->json($jadwal);
    }

    public function meta()
    {
        $get = $this->quran->getMeta();

        return response()->json($get);
    }
}

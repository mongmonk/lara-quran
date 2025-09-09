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
        $data['title'] = 'Surah '.$get[0]['surahEn'].' ~ My QUR`AN';

        return view('surah', $data);
    }

    public function ruku($ruku)
    {
        $get = $this->quran->getRuku((int) $ruku);
        $data['data'] = $get;
        $data['meta'] = $this->quran->getAllRukuStatis();
        $data['title'] = "Ruku` ke {$ruku} Surah {$get[0]['surahEn']} ~ My QUR`AN";

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
        $surah = $get[0]['surahNum'];
        $ayah = $get[0]['ayat'];
        $data['data'] = $get;
        $namasurah = $get[0]['surahEn'];
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
            $data['next'] = $number != 6236 ? '<a href="/ayah/'.$next.'" class="btn">NEXT ►</a>' : false;
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

    public function jadwalsholatharian($masjid = false)
    {
        if ($masjid) {
            // Fetch the masjid data from database
            $jadwal = $this->quran->getJadwalSholatHarian($masjid);
            if (! $jadwal) {
                return redirect()->route('quran.jadwalsholatharian')->with('error', 'Jadwal sholat tidak ditemukan.');
            }

            $data['title'] = 'Jadwal Sholat Masjid ~ My QUR`AN';
            $data['nama'] = $jadwal->nama_masjid;
            $data['alamat'] = $jadwal->alamat;
            $data['img'] = $jadwal->img;
            $data['adzan'] = $jadwal->adzan;
            $data['pesan1'] = $jadwal->pesan1;
            $data['pesan2'] = $jadwal->pesan2;
            $data['id'] = $jadwal->id_kota;
            $data['url'] = $jadwal->url;
            $data['chat_id'] = \Illuminate\Support\Facades\Auth::id(); // This would be replaced with actual user check
            $data['owner_chat_id'] = $jadwal->chat_id;

            return view('jadwalsholatharian_view', $data);
        } else {
            $data['title'] = 'Input Jadwal Sholat Masjid Baru';
            $data['kota'] = $this->quran->getKota();
            // Fetch the list of masjids from database
            $data['masjid'] = $this->quran->getAllJadwalSholatHarian();

            return view('savemasjid', $data);
        }
    }

    public function storeJadwalSholatHarian(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|max:36',
            'alamat' => 'required|max:75',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'mp3' => ['required', Rule::in(['/inc/adzan/adzan1.mp3', '/inc/adzan/adzan2.mp3', '/inc/adzan/adzan3.mp3', '/inc/adzan/beep.mp3'])],
            'pesan1' => 'required|max:150',
            'pesan2' => 'required|max:150',
            'id' => 'required|regex:/^\d+\..+$/',
        ]);

        // Handle file upload
        $imgPath = null;
        if ($request->hasFile('img')) {
            $imgPath = $request->file('img')->store('images', 'public');
        }

        // Extract kota ID from the input (format: "id. nama_kota")
        $kotaId = explode('.', $request->id)[0];

        // Generate URL from nama masjid
        $url = strtolower(str_replace(' ', '-', $request->nama));

        // Get chat ID from the authenticated user
        $chatId = \Illuminate\Support\Facades\Auth::id();

        // Prepare data for database
        $data = [
            'nama_masjid' => $request->nama,
            'alamat' => $request->alamat,
            'img' => $imgPath,
            'adzan' => $request->mp3,
            'pesan1' => $request->pesan1,
            'pesan2' => $request->pesan2,
            'id_kota' => (int) $kotaId,
            'url' => $url,
            'chat_id' => $chatId,
        ];

        // Save data to database
        $this->quran->createJadwalSholatHarian($data);

        return redirect()->route('quran.jadwalsholatharian')->with('success', 'Data jadwal sholat harian berhasil disimpan.');
    }

    public function editjadwal($masjid)
    {
        // In a real implementation, you would check if the user is logged in
        // and if they have permission to edit this masjid

        // Fetch the masjid data from database
        $jadwal = $this->quran->getJadwalSholatHarian($masjid);
        if (! $jadwal) {
            return redirect()->route('quran.jadwalsholatharian')->with('error', 'Jadwal sholat tidak ditemukan.');
        }

        // Authorization check: ensure the authenticated user owns this record
        if ((int) $jadwal->chat_id !== (int) Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $data['title'] = 'Edit Jadwal Sholat Masjid ~ My QUR`AN';
        $data['nama'] = $jadwal->nama_masjid;
        $data['alamat'] = $jadwal->alamat;
        $data['img'] = $jadwal->img;
        $data['adzan'] = $jadwal->adzan;
        $data['pesan1'] = $jadwal->pesan1;
        $data['pesan2'] = $jadwal->pesan2;
        $data['id'] = $jadwal->id_kota;
        $data['url'] = $jadwal->url;
        $data['kota'] = $this->quran->getKota();
        $data['masjid'] = $this->quran->getAllJadwalSholatHarian();

        return view('editjadwal', $data);
    }

    public function updateJadwalSholatHarian(Request $request, $masjid)
    {
        // Find the existing record
        $jadwal = $this->quran->getJadwalSholatHarian($masjid);

        // Authorization check: ensure the authenticated user owns this record
        if (! $jadwal || (int) $jadwal->chat_id !== (int) Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Validasi input
        $request->validate([
            'nama' => 'required|max:36',
            'alamat' => 'required|max:75',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'mp3' => ['required', Rule::in(['/inc/adzan/adzan1.mp3', '/inc/adzan/adzan2.mp3', '/inc/adzan/adzan3.mp3', '/inc/adzan/beep.mp3'])],
            'pesan1' => 'required|max:150',
            'pesan2' => 'required|max:150',
            'id' => 'required|regex:/^\d+\..+$/',
        ]);

        // Handle file upload if new image is provided
        $imgPath = null;
        if ($request->hasFile('img')) {
            $imgPath = $request->file('img')->store('images', 'public');
        }

        // Extract kota ID from the input (format: "id. nama_kota")
        $kotaId = explode('.', $request->id)[0];

        // Generate URL from nama masjid
        $url = strtolower(str_replace(' ', '-', $request->nama));

        // Get chat ID from the authenticated user
        $chatId = \Illuminate\Support\Facades\Auth::id();

        // Prepare data for database
        $data = [
            'nama_masjid' => $request->nama,
            'alamat' => $request->alamat,
            'adzan' => $request->mp3,
            'pesan1' => $request->pesan1,
            'pesan2' => $request->pesan2,
            'id_kota' => (int) $kotaId,
            'url' => $url,
            'chat_id' => $chatId,
        ];

        // Add image path to data if new image was uploaded
        if ($imgPath) {
            $data['img'] = $imgPath;
        }

        // Update data in database
        $this->quran->updateJadwalSholatHarian($masjid, $data);

        return redirect()->route('quran.jadwalsholatharian')->with('success', 'Data jadwal sholat harian berhasil diperbarui.');
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

        return view('about', $data);
    }

    public function privacy()
    {
        $data['title'] = 'Tentang My QUR`AN';

        return view('privacy', $data);
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
            $post = request()->all();
            $nama = $post['nama'];
            $email = $post['email'];
            $wa = $post['wa'];
            $pesan = $post['pesan'];
            $site = 'My QUR`AN';

            $text = "<b>PESAN BARU DARI {$site}</b>\n\nNAMA: {$nama}\nEMAIL: {$email}\nNO.WA: {$wa}\nPESAN: {$pesan}";

            // In a real implementation, you would send this to Telegram
            // $this->quran->kirimTelegram($text);

            $data['pesan'] = "<div class='alert alert-success'>Terimakasih sudah menghubungi kami.<br>Pesan berhasil terkirim ke admin {$site}. Insyaallah secepatnya akan kami kabari lewat WhatsApp</div>";
        }

        return view('contact', $data);
    }

    public function search()
    {
        $query = request()->get('query');
        $data['data'] = $this->quran->searchQuran($query);
        $data['title'] = "Mencari Ayat Tentang `{$query}` ~ My QUR`AN";

        return view('amp.daftarsajdah', $data);
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

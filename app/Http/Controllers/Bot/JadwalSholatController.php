<?php

namespace App\Http\Controllers\Bot;

use App\Http\Controllers\Controller;
use App\Models\JadwalSholatHarian;
use App\Models\QuranModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class JadwalSholatController extends Controller
{
    protected $quran;

    public function __construct()
    {
        $this->quran = new QuranModel();
    }

    /**
     * Display a listing of the resource.
     */
    public function index($chat_id)
    {
        $data['title'] = 'Pengaturan Jadwal Sholat Masjid';
        $data['masjids'] = JadwalSholatHarian::where('chat_id', Auth::id())->get();
        return view('bot.jadwalsholat.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['title'] = 'Buat Jadwal Sholat Masjid Baru';
        $data['kota'] = $this->quran->getKota();
        return view('bot.jadwalsholat.edit', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:36',
            'alamat' => 'required|max:75',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'mp3' => ['required', Rule::in(['/inc/audio/adzan1.mp3', '/inc/audio/adzan2.mp3', '/inc/audio/adzan3.mp3', '/inc/audio/beep.mp3'])],
            'pesan1' => 'required|max:150',
            'pesan2' => 'required|max:150',
            'id' => 'required|string',
        ]);

        $imgPath = $request->file('img')->store('images', 'public');
        $kotaId = $request->id;
        if (str_contains($kotaId, '.')) {
            $kotaId = explode('.', $kotaId);
        }

        $url = strtolower(str_replace(' ', '-', $request->nama));

        JadwalSholatHarian::create([
            'nama_masjid' => $request->nama,
            'alamat' => $request->alamat,
            'img' => $imgPath,
            'adzan' => $request->mp3,
            'pesan1' => $request->pesan1,
            'pesan2' => $request->pesan2,
            'id_kota' => (int) $kotaId,
            'url' => $url,
            'chat_id' => Auth::id(),
        ]);

        return redirect()->route('bot.jadwalsholat.index')->with('success', 'Data jadwal sholat harian berhasil disimpan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($masjid)
    {
        $jadwal = JadwalSholatHarian::where('url', $masjid)->first();

        if (!$jadwal || (int) $jadwal->chat_id !== (int) Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $data['title'] = 'Edit Jadwal Sholat Masjid';
        $data['jadwal'] = $jadwal;
        $data['kota'] = $this->quran->getKota();

        $selectedKota = '';
        foreach ($data['kota'] as $k) {
            if ($k['id'] == $jadwal->id_kota) {
                $selectedKota = $k['id'] . '. ' . $k['lokasi'];
                break;
            }
        }
        $data['id'] = old('id', $selectedKota);

        return view('bot.jadwalsholat.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $masjid)
    {
        $jadwal = JadwalSholatHarian::where('url', $masjid)->first();

        if (!$jadwal || (int) $jadwal->chat_id !== (int) Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'nama' => 'required|max:36',
            'alamat' => 'required|max:75',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'mp3' => ['required', Rule::in(['/inc/audio/adzan1.mp3', '/inc/audio/adzan2.mp3', '/inc/audio/adzan3.mp3', '/inc/audio/beep.mp3'])],
            'pesan1' => 'required|max:150',
            'pesan2' => 'required|max:150',
            'id' => 'required|string',
        ]);

        $data = $request->only(['nama', 'alamat', 'pesan1', 'pesan2']);
        $data['adzan'] = $request->mp3;

        if ($request->hasFile('img')) {
            $data['img'] = $request->file('img')->store('images', 'public');
        }

        $kotaId = $request->id;
        if (str_contains($kotaId, '.')) {
            $kotaId = explode('.', $kotaId);
        }
        $data['id_kota'] = (int) $kotaId;
        $data['url'] = strtolower(str_replace(' ', '-', $request->nama));
        $data['nama_masjid'] = $request->nama;


        $jadwal->update($data);

        return redirect()->route('bot.jadwalsholat.edit', $jadwal->url)->with('success', 'Data jadwal sholat harian berhasil diperbarui.');
    }
}

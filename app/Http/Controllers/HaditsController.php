<?php

namespace App\Http\Controllers;

use App\Models\QuranModel;

class HaditsController extends Controller
{
    protected $quran;

    public function __construct(QuranModel $quran)
    {
        $this->quran = $quran;
    }

    public function bukhari($page = 1)
    {
        $page = max(1, (int) $page);
        $data['title'] = 'Hadits Riwayat Bukhari ~ My QUR`AN';
        // Dapatkan data untuk halaman tertentu
        $data['data'] = $this->quran->getHadits('bukhari', $page - 1);
        $data['perowi'] = 'Bukhari';
        // Menambahkan pagination
        $total = $this->quran->getHadits('bukhari');
        // Jika halaman yang diminta melebihi jumlah halaman yang tersedia, redirect ke halaman terakhir
        $totalPages = ceil($total / 25);
        if ($page > $totalPages && $totalPages > 0) {
            return redirect('/hadits/bukhari/'.$totalPages);
        }
        $data['pagination'] = $this->generatePagination($total, $page, 25, '/hadits/bukhari');

        return view('amp.hadits', $data);
    }

    public function muslim($page = 1)
    {
        $page = max(1, (int) $page);
        $data['title'] = 'Hadits Riwayat Muslim ~ My QUR`AN';
        // Dapatkan data untuk halaman tertentu
        $data['data'] = $this->quran->getHadits('muslim', $page - 1);
        $data['perowi'] = 'Muslim';
        // Menambahkan pagination
        $total = $this->quran->getHadits('muslim');
        // Jika halaman yang diminta melebihi jumlah halaman yang tersedia, redirect ke halaman terakhir
        $totalPages = ceil($total / 25);
        if ($page > $totalPages && $totalPages > 0) {
            return redirect('/hadits/muslim/'.$totalPages);
        }
        $data['pagination'] = $this->generatePagination($total, $page, 25, '/hadits/muslim');

        return view('amp.hadits', $data);
    }

    public function abudaud($page = 1)
    {
        $page = max(1, (int) $page);
        $data['title'] = 'Hadits Riwayat Abu Daud ~ My QUR`AN';
        // Dapatkan data untuk halaman tertentu
        $data['data'] = $this->quran->getHadits('abu-daud', $page - 1);
        $data['perowi'] = 'Abu Daud';
        // Menambahkan pagination
        $total = $this->quran->getHadits('abu-daud');
        // Jika halaman yang diminta melebihi jumlah halaman yang tersedia, redirect ke halaman terakhir
        $totalPages = ceil($total / 25);
        if ($page > $totalPages && $totalPages > 0) {
            return redirect('/hadits/abudaud/'.$totalPages);
        }
        $data['pagination'] = $this->generatePagination($total, $page, 25, '/hadits/abudaud');

        return view('amp.hadits', $data);
    }

    public function ahmad($page = 1)
    {
        $page = max(1, (int) $page);
        $data['title'] = 'Hadits Riwayat Ahmad ~ My QUR`AN';
        // Dapatkan data untuk halaman tertentu
        $data['data'] = $this->quran->getHadits('ahmad', $page - 1);
        $data['perowi'] = 'Ahmad';
        // Menambahkan pagination
        $total = $this->quran->getHadits('ahmad');
        // Jika halaman yang diminta melebihi jumlah halaman yang tersedia, redirect ke halaman terakhir
        $totalPages = ceil($total / 25);
        if ($page > $totalPages && $totalPages > 0) {
            return redirect('/hadits/ahmad/'.$totalPages);
        }
        $data['pagination'] = $this->generatePagination($total, $page, 25, '/hadits/ahmad');

        return view('amp.hadits', $data);
    }

    public function darimi($page = 1)
    {
        $page = max(1, (int) $page);
        $data['title'] = 'Hadits Riwayat Darimi ~ My QUR`AN';
        // Dapatkan data untuk halaman tertentu
        $data['data'] = $this->quran->getHadits('darimi', $page - 1);
        $data['perowi'] = 'Darimi';
        // Menambahkan pagination
        $total = $this->quran->getHadits('darimi');
        // Jika halaman yang diminta melebihi jumlah halaman yang tersedia, redirect ke halaman terakhir
        $totalPages = ceil($total / 25);
        if ($page > $totalPages && $totalPages > 0) {
            return redirect('/hadits/darimi/'.$totalPages);
        }
        $data['pagination'] = $this->generatePagination($total, $page, 25, '/hadits/darimi');

        return view('amp.hadits', $data);
    }

    public function ibnumajah($page = 1)
    {
        $page = max(1, (int) $page);
        $data['title'] = 'Hadits Riwayat Ibnu Majah ~ My QUR`AN';
        // Dapatkan data untuk halaman tertentu
        $data['data'] = $this->quran->getHadits('ibnu-majah', $page - 1);
        $data['perowi'] = 'Ibnu Majah';
        // Menambahkan pagination
        $total = $this->quran->getHadits('ibnu-majah');
        // Jika halaman yang diminta melebihi jumlah halaman yang tersedia, redirect ke halaman terakhir
        $totalPages = ceil($total / 25);
        if ($page > $totalPages && $totalPages > 0) {
            return redirect('/hadits/ibnumajah/'.$totalPages);
        }
        $data['pagination'] = $this->generatePagination($total, $page, 25, '/hadits/ibnumajah');

        return view('amp.hadits', $data);
    }

    public function malik($page = 1)
    {
        $page = max(1, (int) $page);
        $data['title'] = 'Hadits Riwayat Malik ~ My QUR`AN';
        // Dapatkan data untuk halaman tertentu
        $data['data'] = $this->quran->getHadits('malik', $page - 1);
        $data['perowi'] = 'Malik';
        // Menambahkan pagination
        $total = $this->quran->getHadits('malik');
        // Jika halaman yang diminta melebihi jumlah halaman yang tersedia, redirect ke halaman terakhir
        $totalPages = ceil($total / 25);
        if ($page > $totalPages && $totalPages > 0) {
            return redirect('/hadits/malik/'.$totalPages);
        }
        $data['pagination'] = $this->generatePagination($total, $page, 25, '/hadits/malik');

        return view('amp.hadits', $data);
    }

    public function nasai($page = 1)
    {
        $page = max(1, (int) $page);
        $data['title'] = 'Hadits Riwayat Nasa`i ~ My QUR`AN';
        // Dapatkan data untuk halaman tertentu
        $data['data'] = $this->quran->getHadits('nasai', $page - 1);
        $data['perowi'] = 'Nasa`i';
        // Menambahkan pagination
        $total = $this->quran->getHadits('nasai');
        // Jika halaman yang diminta melebihi jumlah halaman yang tersedia, redirect ke halaman terakhir
        $totalPages = ceil($total / 25);
        if ($page > $totalPages && $totalPages > 0) {
            return redirect('/hadits/nasai/'.$totalPages);
        }
        $data['pagination'] = $this->generatePagination($total, $page, 25, '/hadits/nasai');

        return view('amp.hadits', $data);
    }

    public function tirmidzi($page = 1)
    {
        $page = max(1, (int) $page);
        $data['title'] = 'Hadits Riwayat Tirmidzi ~ My QUR`AN';
        // Dapatkan data untuk halaman tertentu
        $data['data'] = $this->quran->getHadits('tirmidzi', $page - 1);
        $data['perowi'] = 'Tirmidzi';
        // Menambahkan pagination
        $total = $this->quran->getHadits('tirmidzi');
        // Jika halaman yang diminta melebihi jumlah halaman yang tersedia, redirect ke halaman terakhir
        $totalPages = ceil($total / 25);
        if ($page > $totalPages && $totalPages > 0) {
            return redirect('/hadits/tirmidzi/'.$totalPages);
        }
        $data['pagination'] = $this->generatePagination($total, $page, 25, '/hadits/tirmidzi');

        return view('amp.hadits', $data);
    }

    public function search($book)
    {
        $query = request()->get('query');
        $page = max(0, (int) request()->get('page', 0));
        $allData = $this->quran->searchHadits($book, $query);
        $data['title'] = "Mencari Hadits Tentang `{$query}` ~ My QUR`AN";
        // Menentukan nama perowi berdasarkan buku
        $perowiMap = [
            'bukhari' => 'Bukhari',
            'muslim' => 'Muslim',
            'abu-daud' => 'Abu Daud',
            'ahmad' => 'Ahmad',
            'darimi' => 'Darimi',
            'ibnu-majah' => 'Ibnu Majah',
            'malik' => 'Malik',
            'nasai' => 'Nasa`i',
            'tirmidzi' => 'Tirmidzi',
        ];
        $data['perowi'] = $perowiMap[$book] ?? ucfirst($book);

        // Menambahkan pagination untuk hasil pencarian
        $perPage = 25;
        $totalItems = count($allData);
        $totalPages = ceil($totalItems / $perPage);

        // Jika halaman yang diminta melebihi jumlah halaman yang tersedia, redirect ke halaman terakhir
        if ($page >= $totalPages && $totalPages > 0) {
            return redirect("/hadits/search/{$book}?query=".urlencode($query).'&page='.($totalPages - 1));
        }

        // Potong data berdasarkan halaman saat ini
        $data['data'] = array_slice($allData, $page * $perPage, $perPage);

        // Generate pagination
        $baseUrl = "/hadits/search/{$book}?query=".urlencode($query);
        $data['pagination'] = $this->generatePagination($totalItems, $page, $perPage, $baseUrl);

        return view('amp.hadits', $data);
    }

    /**
     * Generate simple pagination HTML like Quran page
     *
     * @param  int  $total
     * @param  int  $current
     * @param  int  $perPage
     * @param  string  $baseUrl
     * @return string
     */
    private function generatePagination($total, $current, $perPage, $baseUrl)
    {
        // Hitung jumlah halaman berdasarkan jumlah item dan item per halaman
        $totalPages = ceil($total / $perPage);
        // Jika hanya ada 1 halaman atau kurang, tidak perlu menampilkan pagination
        if ($totalPages <= 1) {
            return '';
        }

        $html = '<div class="text-center">';

        // Tombol Sebelumnya
        if ($current > 1) {
            $prevPage = $current - 1;
            $html .= "<a href=\"{$baseUrl}/{$prevPage}\" class='btn btn-sm btn-outline-success'>⊲</a>";
        } else {
            $html .= "<span class='btn btn-sm btn-outline-success'>⊲</span>";
        }

        // Nomor halaman saat ini
        $html .= "<span class='btn btn-sm btn-outline-success mx-1'>".$current.'</span>';

        // Tombol Berikutnya
        if ($current < $totalPages) {
            $nextPage = $current + 1;
            $html .= "<a href=\"{$baseUrl}/{$nextPage}\" class='btn btn-sm btn-outline-success'>⊳</a>";
        } else {
            $html .= "<span class='btn btn-sm btn-outline-success'>⊳</span>";
        }

        $html .= '</div>';

        return $html;
    }
}

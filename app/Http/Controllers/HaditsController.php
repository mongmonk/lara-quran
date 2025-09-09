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

    public function search($book, $page = 1)
    {
        $page = max(1, (int) $page);
        $perPage = 25;

        // Menentukan nama perowi berdasarkan buku dan validasi parameter {book}
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

        // Validasi untuk mencegah Path Traversal dengan memastikan $book ada di dalam whitelist
        if (!isset($perowiMap[$book])) {
            abort(404, 'Kitab hadits tidak ditemukan.');
        }
        $data['perowi'] = $perowiMap[$book];

        // Membersihkan input pencarian untuk hanya mengizinkan alfanumerik dan spasi
        $query = preg_replace('/[^a-zA-Z0-9\s]/', '', request()->get('query', ''));

        if ($query) {
            // Logika untuk pencarian
            $allData = $this->quran->searchHadits($book, $query);
            $totalItems = count($allData);
            $data['title'] = "Mencari Hadits Tentang `{$query}` ~ My QUR`AN";
            $data['data'] = array_slice($allData, ($page - 1) * $perPage, $perPage);
            $baseUrl = "/hadits/{$book}?query=".urlencode($query);
        } else {
            // Logika untuk browsing
            $totalItems = $this->quran->getHadits($book);
            $data['title'] = "Hadits Riwayat {$data['perowi']} ~ My QUR`AN";
            $data['data'] = $this->quran->getHadits($book, $page - 1);
            $baseUrl = "/hadits/{$book}";
        }

        $totalPages = ceil($totalItems / $perPage);

        if ($page > $totalPages && $totalPages > 0) {
            if ($query) {
                return redirect()->to("{$baseUrl}&page={$totalPages}");
            }

            return redirect()->to("{$baseUrl}/{$totalPages}");
        }

        $data['pagination'] = $this->generatePagination($totalItems, $page, $perPage, $baseUrl, ! is_null($query));

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
    private function generatePagination($total, $current, $perPage, $baseUrl, $isSearch = false)
    {
        $totalPages = ceil($total / $perPage);
        if ($totalPages <= 1) {
            return '';
        }

        $html = '<div class="text-center">';

        // Tombol Sebelumnya
        if ($current > 1) {
            $prevPage = $current - 1;
            $url = $isSearch ? "{$baseUrl}&page={$prevPage}" : "{$baseUrl}/{$prevPage}";
            $html .= "<a href=\"{$url}\" class='btn btn-sm btn-outline-success'>⊲</a>";
        } else {
            $html .= "<span class='btn btn-sm btn-outline-success'>⊲</span>";
        }

        // Nomor halaman saat ini
        $html .= "<span class='btn btn-sm btn-outline-success mx-1'>".$current.'</span>';

        // Tombol Berikutnya
        if ($current < $totalPages) {
            $nextPage = $current + 1;
            $url = $isSearch ? "{$baseUrl}&page={$nextPage}" : "{$baseUrl}/{$nextPage}";
            $html .= "<a href=\"{$url}\" class='btn btn-sm btn-outline-success'>⊳</a>";
        } else {
            $html .= "<span class='btn btn-sm btn-outline-success'>⊳</span>";
        }

        $html .= '</div>';

        return $html;
    }
}

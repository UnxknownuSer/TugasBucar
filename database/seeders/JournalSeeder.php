<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Journal;

class JournalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                'title' => 'Studi Kasus AI pada Pendidikan Tinggi',
                'authors' => 'A. Santoso, B. Wijaya',
                'year' => 2024,
                'keywords' => 'AI, Pendidikan, Pembelajaran',
                'status' => 'published',
                'pdf_path' => null,
            ],
            [
                'title' => 'Analisis Data Genom untuk Prediksi Penyakit',
                'authors' => 'C. Hartono',
                'year' => 2023,
                'keywords' => 'Genom, Bioinformatika',
                'status' => 'published',
                'pdf_path' => null,
            ],
            [
                'title' => 'Metodologi Penelitian Kualitatif dalam Sosial',
                'authors' => 'D. Rahma',
                'year' => 2022,
                'keywords' => 'Metodologi, Kualitatif',
                'status' => 'draft',
                'pdf_path' => null,
            ],
            [
                'title' => 'Optimasi Jaringan pada IoT Skala Besar',
                'authors' => 'E. Kurniawan, F. Putri',
                'year' => 2025,
                'keywords' => 'IoT, Jaringan',
                'status' => 'published',
                'pdf_path' => null,
            ],
            [
                'title' => 'Kajian Sistem Energi Terbarukan untuk Perkotaan',
                'authors' => 'G. Pratama',
                'year' => 2021,
                'keywords' => 'Energi, Terbarukan',
                'status' => 'published',
                'pdf_path' => null,
            ],
        ];

        foreach ($items as $data) {
            Journal::create($data);
        }
    }
}

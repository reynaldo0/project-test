<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tickets')->insert([
            [
                'title' => 'Masalah login',
                'message' => 'Saya tidak bisa login ke akun saya. Mohon bantuannya.',
                'labels' => json_encode(['bug', 'penting']),
                'categories' => json_encode(['autentikasi', 'keamanan']),
                'priority' => 'high',
                'attachment' => 'uploads/files/login_issue_screenshot.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Pembayaran gagal',
                'message' => 'Pembayaran saya ditolak meskipun saldo kartu saya mencukupi.',
                'labels' => json_encode(['pembayaran', 'proses']),
                'categories' => json_encode(['penagihan', 'keuangan']),
                'priority' => 'medium',
                'attachment' => 'uploads/files/payment_error.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Permintaan fitur: Mode gelap',
                'message' => 'Akan sangat bagus jika aplikasi memiliki opsi mode gelap.',
                'labels' => json_encode(['permintaan-fitur']),
                'categories' => json_encode(['antarmuka-pengguna', 'desain']),
                'priority' => 'low',
                'attachment' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

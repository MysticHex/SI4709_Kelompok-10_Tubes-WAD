<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\ApprovalStatus;
use App\Models\TAKSubmission;
use App\Models\Notification;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        // Status dasar
        ApprovalStatus::insert([
            ['status' => 'pending', 'description' => null],
            ['status' => 'approved', 'description' => null],
            ['status' => 'rejected', 'description' => 'Ditolak karena tidak valid'],
        ]);

        // Buat 10 user dengan 2 TAK masing-masing
        User::factory(10)->create()->each(function ($user) {
            TAKSubmission::factory(2)->create(['user_id' => $user->id]);
            Notification::factory(2)->create(['user_id' => $user->id]);
        });

        // Tambah 1 admin
        User::factory()->create([
            'nama' => 'Admin BK',
        'user_id' => '0000000000',
            'email' => 'admin@telkomuniversity.ac.id',
            'role' => 'admin',
            'password' => bcrypt('admin123'),
        ]);
    }
}

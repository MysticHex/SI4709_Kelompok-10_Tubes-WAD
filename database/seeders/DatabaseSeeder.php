<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\ApprovalStatus;
use App\Models\TAKSubmission;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        ApprovalStatus::insert([
            ['status' => 'pending', 'description' => null],
            ['status' => 'approved', 'description' => null],
            ['status' => 'rejected', 'description' => 'Ditolak karena tidak valid'],
        ]);

        User::factory()->create([
            'nama' => 'Fakultas Teknik Elektro',
            'user_id' => '0000000001',
            'email' => 'elektro@telkomuniversity.ac.id',
            'role' => 'penyelenggara',
            'password' => bcrypt('elektro123'),
        ]);

        User::factory()->create([
            'nama' => 'Admin BK',
            'user_id' => '0000000000',
            'email' => 'admin@telkomuniversity.ac.id',
            'role' => 'admin',
            'password' => bcrypt('admin123'),
        ]);
        User::factory(10)->create()->each(function ($user) {
            TAKSubmission::factory(2)->create(['user_id' => $user->id]);
        });
    }
}

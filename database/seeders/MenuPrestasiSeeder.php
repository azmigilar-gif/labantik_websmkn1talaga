<?php

namespace Database\Seeders;

use App\Models\S_Menu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MenuPrestasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if menu already exists
        $exists = S_Menu::where('name', 'Prestasi')
            ->orWhere('slug', 'prestasi-sekolah')
            ->first();

        if (! $exists) {
            S_Menu::create([
                'id' => (string) Str::uuid(),
                'name' => 'Prestasi',
                'slug' => 'prestasi-sekolah',
            ]);
            $this->command->info('Menu Prestasi berhasil dibuat.');
        } else {
            $this->command->info('Menu Prestasi sudah ada.');
        }
    }
}

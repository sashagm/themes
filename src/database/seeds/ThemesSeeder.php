<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ThemesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('themes')->insert([
            'title' => 'bootstrap',
            'description' => 'Default template website',
            'author' => 'Bootstrap',
            'version' => '4.6.x',
            'active'    => 1,
        ]);
    }
}

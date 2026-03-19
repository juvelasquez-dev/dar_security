<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvincesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $provinces = [
            'Regional Office',
            'Albay',
            'Catanduanes',
            'Camarines Sur 1',
            'Camarines Sur 2',
            'Masbate',
            'Sorsogon',
            'Camarines Norte',
        ];

        foreach ($provinces as $name) {
            DB::table('provinces')->updateOrInsert(['name' => $name], ['name' => $name]);
        }
    }
}

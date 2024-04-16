<?php

namespace Database\Seeders\settings;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InstitutionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $date = date('Y-m-d H:i:s');
        DB::table('institutions')->insert([
            'id' => 1,
            'name' => 'Web School',
            'logo' => 'images/institutions/logo.webp',
            'direction' => 'Street #1 Avenue',
            'phone' => '4444444',
            'cellphone' => '77777777',
            'email' => 'info@school.web',
            'created_at' => $date,
            'updated_at' => $date
        ]);
    }
}

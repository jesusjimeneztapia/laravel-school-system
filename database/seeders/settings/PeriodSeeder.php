<?php

namespace Database\Seeders\settings;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeriodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $date = date('Y-m-d H:i:s');
        $year = date('Y');
        DB::table('periods')->insert([
            'id' => 1,
            'period' => "I/$year",
            'created_at' => $date,
            'updated_at' => $date
        ]);
    }
}

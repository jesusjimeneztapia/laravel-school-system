<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $date = date('Y-m-d H:i:s');
        DB::table('levels')->insert([
            'id' => 1,
            'period_id' => 1,
            'name' => 'INICIAL',
            'shift' => 'MAÑANA',
            'created_at' => $date,
            'updated_at' => $date
        ]);
    }
}

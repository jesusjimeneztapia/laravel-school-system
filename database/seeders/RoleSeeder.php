<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $date = date('Y-m-d H:i:s');
        DB::table('roles')->insert([
            'id' => 1,
            'name' => 'ADMINISTRADOR',
            'created_at' => $date,
            'updated_at' => $date
        ]);
    }
}

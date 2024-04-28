<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\settings\InstitutionSeeder;
use Database\Seeders\settings\PeriodSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(InstitutionSeeder::class);
        $this->call(PeriodSeeder::class);
        $this->call(LevelSeeder::class);
    }
}

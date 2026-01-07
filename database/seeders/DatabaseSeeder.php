<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Seed Users first (Admin, Staff, Guest)
        $this->call([RoleSeeder::class]);
        
        // Seed Program Bansos
        $this->call([ProgramBansosSeeder::class]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // // User::factory(10)->create();
        // $this->call(TeknikInformatikaSeeder::class);
        // $this->call(ArtificialIntelligenceSeeder::class);
        // $this->call(GameDeveloperSeeder::class);
        // $this->call(CyberSecuritySeeder::class);
        // $this->call(FullStackDeveloperSeeder::class);
        $this->call(MajorSeeder::class);
        $this->call(QuestionSeeder::class);
        $this->call(AdminSeeder::class);
    }
}

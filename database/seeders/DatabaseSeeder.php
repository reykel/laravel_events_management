<?php

namespace Database\Seeders;

use App\Models\Executive;
use App\Models\Transportation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //Artisan::call('db:wipe');
       // Artisan::call('migrate');
        $this->call(RolesSeeder::class);
        $this->call(UserSeeder::class);


      //   $this->call(TransportationSeeder::class);
      //   $this->call(ExecutiveSeeder::class);
        // $this->call(ActivitySeeder::class);
    }
}

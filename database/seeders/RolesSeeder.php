<?php
namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!Role::where('name', 'Admin')->first()) {
            $role = new Role();
            $role ->name = 'Admin';
            $role ->save();
        }

        if (!Role::where('name', 'Driver')->first()) {
            $role = new Role();
            $role ->name = 'Driver';
            $role ->save();
        }
    }
}

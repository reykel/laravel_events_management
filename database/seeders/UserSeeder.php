<?php
namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rolAdmin = Role::where('name','Admin')->first();
        $rolDriver = Role::where('name','Driver')->first();
        if (!User::where('email', 'admin@iberdrola.com')->first()) {
            $user = new User();
            $user-> name = 'admin';
            $user->active = true;
            $user->email = 'admin@iberdrola.com';
            $user->password = bcrypt('admin');
            $user->role()->associate($rolAdmin);
            $user->save();

        }

        if (!User::where('email', 'protocolo_ib@iberdrola.es')->first()) {
            $user = new User();
            $user-> name = 'Protocolo';
            $user->active = true;
            $user->email = 'protocolo_ib@iberdrola.es';
            $user->password = bcrypt('EventoCEO1234$!');
            $user->role()->associate($rolAdmin);
            $user->save();

        }

         if (!User::where('email', 'ymayordomo@iberdrola.es')->first()) {
             $user = new User();
             $user-> name = 'YMayordomo';
             $user->active = true;
             $user->email = 'ymayordomo@iberdrola.es';
             $user->password = bcrypt('EventoCEO1234$!');
             $user->role()->associate($rolAdmin);
             $user->save();

         }

         if (!User::where('email', 'jsanchezb@iberdrola.es')->first()) {
             $user = new User();
             $user-> name = 'JSanchez';
             $user->active = true;
             $user->email = 'jsanchezb@iberdrola.es';
             $user->password = bcrypt('EventoCEO1234$!');
             $user->role()->associate($rolAdmin);
             $user->save();

         }

        if (!User::where('email', 'reinaldo.alcala@gmail.com')->first()) {
            $user = new User();
            $user-> name = 'Reinaldo';
            $user->active = true;
            $user->email = 'reinaldo.alcala@gmail.com';
            $user->password = bcrypt('EventoCEO1234$!');
            $user->role()->associate($rolAdmin);
            $user->save();

        }
        if (!User::where('email', 'luis.gonzalez@informagestudios.com')->first()) {
            $user = new User();
            $user-> name = 'Luis';
            $user->active = true;
            $user->email = 'luis.gonzalez@informagestudios.com';
            $user->password = bcrypt('EventoCEO1234');
            $user->role()->associate($rolAdmin);
            $user->save();

        }

        if (!User::where('email', 'driver@iberdrola.com')->first()) {
            $user = new User();
            $user-> name = 'driver';
            $user->email = 'driver@iberdrola.com';
            $user->password = bcrypt('driver');
            $user->role()->associate($rolDriver);
            $user->save();

        }
    }
}

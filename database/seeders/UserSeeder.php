<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use DB;
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
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Role::truncate();
        User::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $admin = Role::create([
            'name' => 'admin',
            'display_name' => 'Administrator',
            'description' => ''
        ]);

        $hero = Role::create([
            'name' => 'hero',
            'display_name' => 'Hero',
            'description' => ''
        ]);

        $optima = Role::create([
            'name' => 'optima',
            'display_name' => 'Optima',
            'description' => ''
        ]);

        $sdi = Role::create([
            'name' => 'sdi',
            'display_name' => 'SDI',
            'description' => ''
        ]);

        $mitra = Role::create([
            'name' => 'mitra',
            'display_name' => 'Mitra',
            'description' => ''
        ]);

        $user = User::create([
            'name'      => 'Admin',
            'email'     => 'admin@myoptima',
            'password'  => bcrypt('admin'),
        ]);

        $user->attachRole($admin);

        $user = User::create([
            'name'      => 'Hero',
            'email'     => 'hero@myoptima',
            'password'  => bcrypt('hero'),
        ]);

        $user->attachRole($hero);

        $user = User::create([
            'name'      => 'Optima',
            'email'     => 'optima@myoptima',
            'password'  => bcrypt('optima'),
        ]);

        $user->attachRole($optima);

        $user = User::create([
            'name'      => 'SDI',
            'email'     => 'sdi@myoptima',
            'password'  => bcrypt('sdi'),
        ]);

        $user->attachRole($sdi);

        $user = User::create([
            'name'      => 'Mitra',
            'email'     => 'mitra@myoptima',
            'password'  => bcrypt('mitra'),
        ]);

        $user->attachRole($mitra);
    }
}

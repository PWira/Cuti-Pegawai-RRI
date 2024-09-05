<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(){
        $this->call(KeymasterUserSeeder::class);
    }
}

class KeymasterUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Keymaster',
            'email' => 'k@m.null',
            'password' => Hash::make('adminkey135'),
            'role' => 'admin',
            'jabatan'=> ' ',
            'asal'=> ' ',
        ]);
    }
}

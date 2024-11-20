<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Pegawai;
use App\Models\UnitKerja;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(){
        $this->call(UnitKerjaSeeder::class);
        $this->call(KeymasterUserSeeder::class);
        // $this->call(PegawaiSeeder::class);
    }
}

class UnitKerjaSeeder extends Seeder
{
    public function run(){

        $daerah=['jakarta','bandung','surabaya','medan','makassar','semarang','yogyakarta','denpasar','palembang','pontianak','manado','ambon','jayapura','banjarmasin','mataram',];

        foreach ($daerah as $namaDaerah) {
            UnitKerja::create([
                'unit_kerja' => $namaDaerah,
            ]);
        }
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
            'user_nip'=>'101',
            'user_unit_id'=>'1',
            'user_jabatan'=>'',
            'email' => 'k@m.null',
            'password' => Hash::make('adminkey135'),
            'roles'=> 'admin',
            'hak' => 'admin',
        ]);

        // $nama = [
        //     'Andi',
        //     'Dewi',
        //     'Budi',
        //     'Siti',
        //     'Rudi',
        //     'Lina',
        //     'Toni',
        //     'Rina',
        //     'Agus',
        //     'Sri'
        // ];        
        // $peringkat =['kepala_rri','direktur','sdm'];
        // $role =['user','super_user'];
        // $kota =['jakarta', 'palembang', 'medan', 'yogyakarta'];

        // foreach ($role as $akses) {
        //     for ($i = 1; $i <= 10; $i++) {
        //         $name = $nama[array_rand($nama)];
        //         $email = $nama[array_rand($nama)].  rand(0,999).'@email.com';
        //         // $password = $nama[array_rand($nama)].rand(0,999);
        //         $password = "12345678";
        //         $jabatan = $peringkat[array_rand(array_keys($peringkat))];
        //         $asal = $kota[array_rand(array_keys($kota))];
        //         if ($jabatan == 'direktur' || $jabatan == 'kepala_rri'){
        //             $hak = $role[0];
        //         }elseif ($jabatan == 'sdm') {
        //             $hak = $role[1];
        //         }else{
        //             break;
        //         }

        //         User::create([
        //             'name' => $name,
        //             'email' => $email,
        //             'password' => Hash::make($password),
        //             'role' => $hak,
        //             'jabatan'=> $jabatan,
        //             'asal'=> $asal,
        //         ]);
        //     }
        // }

    }
}

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){

        $maleNames = ['John', 'David', 'Michael', 'Daniel', 'Robert', 'William', 'Joseph', 'Matthew', 'Anthony', 'Mark'];
        $femaleNames = ['Emma', 'Olivia', 'Ava', 'Isabella', 'Sophia', 'Mia', 'Charlotte', 'Amelia', 'Harper', 'Evelyn'];
        $lastNames = ['Smith', 'Johnson', 'Williams', 'Brown', 'Jones', 'Miller', 'Davis', 'Garcia', 'Rodriguez', 'Wilson'];

        $cities = ['Jakarta', 'Palembang', 'Medan', 'Yogyakarta'];
        $jobs = ['pranata_siaran_ahli_madya','pranata_siaran_ahli_muda','teknisi_siaran_ahli_madya','teknisi_siaran_ahli_muda',];
        $genders = ['laki_laki', 'perempuan'];

        foreach ($cities as $city) {
            for ($i = 1; $i <= 10; $i++) {
                $gender = $genders[array_rand($genders)];
                $firstName = $gender == 'laki_laki' ? $maleNames[array_rand($maleNames)] : $femaleNames[array_rand($femaleNames)];
                $lastName = $lastNames[array_rand($lastNames)];
                $nip = str_pad(rand(0, 999999999999), 12, '0', STR_PAD_LEFT);
                $unit_kerja = $cities[array_rand(array_keys($cities))];

                Pegawai::create([
                    'nama' => $firstName . ' ' . $lastName,
                    'by_id' => 1,
                    'jk' => $gender,
                    'umur' => rand(20, 60),
                    'nip' => $nip,
                    'jabatan' => $jobs[array_rand($jobs)],
                    'unit_kerja' => $unit_kerja,
                    'masa_kerja' => rand(1, 50),
                ]);
            }
        }

    }
}
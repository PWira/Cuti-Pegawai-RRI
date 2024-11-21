<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Pegawai;
use App\Models\UnitKerja;

use Carbon\Carbon;

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
        $this->call(PegawaiSeeder::class);
        $this->call(PengajuanSeeder::class);
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
        // Membuat user admin
        User::create([
            'name' => 'Keymaster',
            'user_nip' => '101',
            'user_unit_id' => '1',
            'user_jabatan' => '',
            'email' => 'k@m.null',
            'password' => Hash::make('adminkey135'),
            'roles' => 'admin',
            'hak' => 'admin',
        ]);

        $nama = [
            'Andi',
            'Dewi',
            'Budi',
            'Siti',
            'Rudi',
            'Lina',
            'Toni',
            'Rina',
            'Agus',
            'Sri'
        ];

        $unitKerjaIds = DB::table('unit_kerja')->pluck('unit_id')->toArray();
        $jakartaUnitId = 1; // Unit ID untuk Jakarta
        $usedEmails = [];
        $usedNips = [];

        // Membuat direktur yang berlokasi di Jakarta
        $email = $this->generateUniqueEmail($nama, $usedEmails);
        $nip = $this->generateUniqueNip($usedNips);

        User::create([
            'name' => $nama[array_rand($nama)],
            'user_nip' => $nip,
            'user_unit_id' => $jakartaUnitId,
            'user_jabatan' => 'Direktur LPP RRI',
            'email' => $email,
            'password' => Hash::make('12345678'),
            'roles' => 'direktur',
            'hak' => 'user',
        ]);

        foreach ($unitKerjaIds as $unitKerjaId) {
            // Membuat kepala_rri untuk setiap unit_kerja
            $email = $this->generateUniqueEmail($nama, $usedEmails);
            $nip = $this->generateUniqueNip($usedNips);
            User::create([
                'name' => $nama[array_rand($nama)],
                'user_nip' => $nip,
                'user_unit_id' => $unitKerjaId,
                'user_jabatan' => 'Kepala LPP RRI',
                'email' => $email,
                'password' => Hash::make('12345678'),
                'roles' => 'kepala_rri',
                'hak' => 'user',
            ]);

            // Membuat sdm untuk setiap unit_kerja
            $email = $this->generateUniqueEmail($nama, $usedEmails);
            $nip = $this->generateUniqueNip($usedNips);
            User::create([
                'name' => $nama[array_rand($nama)],
                'user_nip' => $nip,
                'user_unit_id' => $unitKerjaId,
                'user_jabatan' => 'Pengelola Data Kepegawaian',
                'email' => $email,
                'password' => Hash::make('12345678'),
                'roles' => 'sdm',
                'hak' => 'super_user',
            ]);
        }
    }

    private function generateUniqueNip(&$usedNips)
    {
        do {
            $nip = str_pad(rand(0, 999999999999), 12, '0', STR_PAD_LEFT);
        } while (in_array($nip, $usedNips));

        $usedNips[] = $nip;
        return $nip;
    }

    /**
     * Generate a unique email address.
     *
     * @param array $nama
     * @param array $usedEmails
     * @return string
     */
    private function generateUniqueEmail($nama, &$usedEmails)
    {
        do {
            $email = $nama[array_rand($nama)] . rand(0, 999) . '@email.com';
        } while (in_array($email, $usedEmails));

        $usedEmails[] = $email;
        return $email;
    }
}

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $maleNames = ['John', 'David', 'Michael', 'Daniel', 'Robert', 'William', 'Joseph', 'Matthew', 'Anthony', 'Mark', 'James', 'Paul', 'Andrew', 'Joshua', 'Brian'];
        $femaleNames = ['Emma', 'Olivia', 'Ava', 'Isabella', 'Sophia', 'Mia', 'Charlotte', 'Amelia', 'Harper', 'Evelyn', 'Abigail', 'Emily', 'Elizabeth', 'Madison', 'Avery'];
        $lastNames = ['Smith', 'Johnson', 'Williams', 'Brown', 'Jones', 'Miller', 'Davis', 'Garcia', 'Rodriguez', 'Wilson', 'Martinez', 'Anderson', 'Taylor', 'Thomas', 'Hernandez'];

        $jobs = ['pranata_siaran_ahli_madya', 'pranata_siaran_ahli_muda', 'teknisi_siaran_ahli_madya', 'teknisi_siaran_ahli_muda'];
        $genders = ['laki_laki', 'perempuan'];

        $unitKerjaIds = DB::table('unit_kerja')->pluck('unit_id')->toArray();
        $usedNips = [];

        foreach ($unitKerjaIds as $unitKerjaId) {
            for ($i = 1; $i <= 15; $i++) {
                $gender = $genders[array_rand($genders)];
                $firstName = $gender == 'laki_laki' ? $maleNames[array_rand($maleNames)] : $femaleNames[array_rand($femaleNames)];
                $lastName = $lastNames[array_rand($lastNames)];
                $nip = $this->generateUniqueNip($usedNips);

                Pegawai::create([
                    'nama' => $firstName . ' ' . $lastName,
                    'nip' => $nip,
                    'jk' => $gender,
                    'umur' => rand(20, 60),
                    'jabatan' => $jobs[array_rand($jobs)],
                    'pegawai_unit_id' => $unitKerjaId,
                    'masa_kerja' => rand(1, 300),
                    'by_id' => 1, // Asumsi by_id adalah 1
                ]);
            }
        }
    }

    /**
     * Generate a unique NIP with 12 digits.
     *
     * @param array $usedNips
     * @return string
     */
    private function generateUniqueNip(&$usedNips)
    {
        do {
            $nip = str_pad(rand(0, 999999999999), 12, '0', STR_PAD_LEFT);
        } while (in_array($nip, $usedNips));

        $usedNips[] = $nip;
        return $nip;
    }
}

class PengajuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $unitKerjaIds = DB::table('unit_kerja')->pluck('unit_id')->toArray();
        $jenisKonfirmasi = ['ditangguhkan', 'sakit', 'diterima', 'ditolak'];
        $jenisCuti = ['cuti_tahunan', 'cuti_sakit'];

        foreach ($unitKerjaIds as $unitKerjaId) {
            $pegawaiIds = DB::table('pegawai')->where('pegawai_unit_id', $unitKerjaId)->pluck('pid')->toArray();
            $userIds = DB::table('users')->pluck('id')->toArray();

            foreach ($jenisKonfirmasi as $konfirmasi) {
                foreach ($jenisCuti as $cuti) {
                    // Skip if cuti_tahunan and konfirmasi is sakit
                    if ($cuti == 'cuti_tahunan' && $konfirmasi == 'sakit') {
                        continue;
                    }

                    for ($i = 0; $i < 5; $i++) {
                        foreach ($pegawaiIds as $pegawaiId) {
                            $startDate = $this->generateRandomDate();
                            $endDate = $startDate->copy()->addDays(10);

                            $blankoDitangguhkan = 'blanko_ditangguhkan/1729576163_test-pengajuan-normalpdf.pdf';
                            $sakitDitangguhkan = 'sakit_ditangguhkan/1732086069_TEST PENGAJUAN kepala terima.pdf';
                            $blankoDiterima = 'blanko_diterima/1729576621_TEST PENGAJUAN normal diterima.pdf';
                            $blankoDitolak = 'blanko_ditolak/1729576593_TEST PENGAJUAN normal.pdf';

                            switch ($konfirmasi) {
                                case 'ditangguhkan':
                                    $blankoDiterima = null;
                                    $blankoDitolak = null;
                                    $sakitDitangguhkan = null;
                                    break;
                                case 'sakit':
                                    $blankoDiterima = null;
                                    $blankoDitolak = null;
                                    break;
                                case 'ditolak':
                                    if ($cuti == 'cuti_tahunan') {
                                        $blankoDitangguhkan = $blankoDitolak;
                                        $sakitDitangguhkan = null;
                                    } elseif ($cuti == 'cuti_sakit') {
                                        $blankoDiterima = null;
                                    }
                                    break;
                                case 'diterima':
                                    if ($cuti == 'cuti_tahunan') {
                                        $blankoDitangguhkan = $blankoDiterima;
                                        $sakitDitangguhkan = null;
                                        $blankoDitolak = null;
                                    } elseif ($cuti == 'cuti_sakit') {
                                        $blankoDitangguhkan = $blankoDiterima;
                                        $blankoDitolak = null;
                                    }
                                    break;
                            }

                            // Ensure user_id exists in the users table
                            $userId = $userIds[array_rand($userIds)];

                            DB::table('pengajuan')->insert([
                                'user_id' => $userId,
                                'pegawai_id' => $pegawaiId,
                                'jenis_cuti' => $cuti,
                                'mulai_cuti' => $startDate,
                                'selesai_cuti' => $endDate,
                                'tujuan_cuti' => $cuti == 'cuti_sakit' ? DB::table('unit_kerja')->where('unit_id', $unitKerjaId)->value('unit_kerja') : $this->getRandomUnitKerja(),
                                'alasan' => $cuti == 'cuti_tahunan' ? 'Liburan Tahunan' : 'Sakit',
                                'blanko_ditangguhkan' => $blankoDitangguhkan,
                                'sakit_ditangguhkan' => $sakitDitangguhkan,
                                'blanko_diterima' => $blankoDiterima,
                                'blanko_ditolak' => $blankoDitolak,
                                'konfirmasi' => $konfirmasi,
                                'keterangan' => 'Keterangan tambahan',
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        }
                    }
                }
            }
        }
    }

    /**
     * Generate a random date between 2020 and 2025.
     *
     * @return Carbon
     */
    private function generateRandomDate()
    {
        $startYear = 2020;
        $endYear = 2025;
        $randomYear = rand($startYear, $endYear);
        $randomMonth = rand(1, 12);
        $randomDay = rand(1, 28); // Using 28 to avoid issues with February

        return Carbon::create($randomYear, $randomMonth, $randomDay);
    }

    /**
     * Get a random unit kerja name from the unit_kerja table.
     *
     * @return string
     */
    private function getRandomUnitKerja()
    {
        $unitKerjaNames = DB::table('unit_kerja')->pluck('unit_kerja')->toArray();
        return $unitKerjaNames[array_rand($unitKerjaNames)];
    }
}
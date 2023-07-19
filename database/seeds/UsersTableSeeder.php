<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Zandy Ferdiansyah',
            'email' => '411201137@undira.ac.id',
            'password' => Hash::make('ferdi123'),
        ]);

        // Tambahkan data pengguna lainnya di sini jika diperlukan

    }
}

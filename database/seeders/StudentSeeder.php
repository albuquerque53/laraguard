<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('students')->insert([
            'name' => 'Gabriel Albuquerque',
            'email' => 'gabrielalbuquerque-ads@hotmail.com',
            'password' => Hash::make('secretpass')
        ]);
    }
}

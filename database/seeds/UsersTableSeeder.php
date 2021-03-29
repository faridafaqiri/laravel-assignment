<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
               'name'=>'مهدی احمدی',
               'email'=>'mehdiahmadise@gmail.com',
               'is_superuser'=>1,
               'is_staff'=>1,
               'email_verified_at'=> now(),
               'password'=>bcrypt('12345678'),
               'created_at'=>now(),
               'updated_at'=>now(),
        ]);
    }
}

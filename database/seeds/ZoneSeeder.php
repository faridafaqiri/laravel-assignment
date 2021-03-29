<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('zones')->insert([

            [
                'name'=>'زون شماره 1',
            ],
            [
                'name'=>'زون شماره 2',
            ],
            [
                'name'=>'زون شماره 3',
            ],
            [
                'name'=>'زون شماره 4',
            ],
            [
                'name'=>'زون شماره 5',
            ],
            [
                'name'=>'زون شماره 6',
            ],
        ]);
    }
}

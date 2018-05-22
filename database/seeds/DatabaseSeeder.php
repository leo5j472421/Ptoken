<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon as Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('transaction')->insert([
    		'user_id' => 1,
    		'state' => 'done',
    		'address' => '0xced68a2ecc46ae4a6d546b646f488e787a9',
    		'token' => 1043.25,
    		'pcoin' => 6666,
    		'created_at' => Carbon::now()
    	]);
    }
}

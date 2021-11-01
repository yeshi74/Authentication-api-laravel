<?php

use Illuminate\Database\Seeder;

class ProfileImageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('oauth_clients')->insert([
            'user_id' => 1,
            'image' => 'abcd.png',
        ], [
            'user_id' => 2,
            'image' => 'abscd.png',
        ], [
            'user_id' => 3,
            'image' => 'abacd.png',
        ], [
            'user_id' => 4,
            'image' => 'abcwd.png',
        ]);
    }
}

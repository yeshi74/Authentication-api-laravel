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
            'user_id' => Str::random(10),
            'image' => Str::random(10),
        ], [
            'user_id' => Str::random(10),
            'image' => Str::random(10),
        ], [
            'user_id' => Str::random(10),
            'image' => Str::random(10),
        ], [
            'user_id' => Str::random(10),
            'image' => Str::random(10),
        ]);
    }
}

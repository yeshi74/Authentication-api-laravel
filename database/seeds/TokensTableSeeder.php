<?php

use Illuminate\Database\Seeder;

class TokensTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('oauth_clients')->insert([
            'name' => Str::random(10),
            'docid' => Str::random(10),
            'token' => Str::random(10),
        ], [
            'name' => Str::random(10),
            'docid' => Str::random(10),
            'token' => Str::random(10),
        ], [
            'name' => Str::random(10),
            'docid' => Str::random(10),
            'token' => Str::random(10),
        ], [
            'name' => Str::random(10),
            'docid' => Str::random(10),
            'token' => Str::random(10),
        ]);
    }
}

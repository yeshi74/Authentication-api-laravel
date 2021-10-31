<?php

use Illuminate\Database\Seeder;

class OauthClientsTableSeeder extends Seeder
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
            'name' => Str::random(10),
            'secret' => Str::random(10),
            'personal_access_client' => Str::random(10),
            'password_client' => false,
            'redirect' => false,
        ], [
            'user_id' => Str::random(10),
            'name' => Str::random(10),
            'secret' => Str::random(10),
            'personal_access_client' => Str::random(10),
            'password_client' => false,
            'redirect' => false,
        ], [
            'user_id' => Str::random(10),
            'name' => Str::random(10),
            'secret' => Str::random(10),
            'personal_access_client' => Str::random(10),
            'password_client' => false,
            'redirect' => false,
        ], [
            'user_id' => Str::random(10),
            'name' => Str::random(10),
            'secret' => Str::random(10),
            'personal_access_client' => Str::random(10),
            'password_client' => false,
            'redirect' => false,
        ]);
    }
}

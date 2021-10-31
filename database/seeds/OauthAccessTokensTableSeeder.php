<?php

use Illuminate\Database\Seeder;

class OauthAccessTokensTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('oauth_access_tokens')->insert([
            'user_id' => Str::random(10),
            'id' => Str::random(10),
            'client_id' => Str::random(10),
            'revoked' => false,
        ], [
            'user_id' => Str::random(10),
            'id' => Str::random(10),
            'client_id' => Str::random(10),
            'revoked' => false,
        ], [
            'user_id' => Str::random(10),
            'id' => Str::random(10),
            'client_id' => Str::random(10),
            'revoked' => false,
        ], [
            'user_id' => Str::random(10),
            'id' => Str::random(10),
            'client_id' => Str::random(10),
            'revoked' => false,
        ]);
    }
}

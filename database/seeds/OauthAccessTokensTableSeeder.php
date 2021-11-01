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
            'user_id' => 1,
            'id' => 1,
            'client_id' => 1654656455,
            'revoked' => false,
        ], [
            'user_id' => 2,
            'id' => 2,
            'client_id' => 23434343222,
            'revoked' => false,
        ], [
            'user_id' => 3,
            'id' => 3,
            'client_id' => 3343534343,
            'revoked' => false,
        ], [
            'user_id' => 4,
            'id' => 4,
            'client_id' => 42156561615156,
            'revoked' => false,
        ]);
    }
}

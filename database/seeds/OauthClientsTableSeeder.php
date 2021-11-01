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
            'user_id' => 1,
            'name' => 'asdfasd',
            'secret' => 'asdflkjlsdfsd',
            'personal_access_client' => 'asdfiulkjljljlk',
            'password_client' => false,
            'redirect' => false,
        ], [
            'user_id' => 2,
            'name' => 'asdfsdasd',
            'secret' => 'asdfdslkjlsdfsd',
            'personal_access_client' => 'asdfiulsdkjljljlk',
            'password_client' => false,
            'redirect' => false,
        ], [
            'user_id' => 3,
            'name' => 'asdfasdwwwsd',
            'secret' => 'asdflsdsskjlsdfsd',
            'personal_access_client' => 'asdfiuldswwkjljljlk',
            'password_client' => false,
            'redirect' => false,
        ], [
            'user_id' => 4,
            'name' => 'asdfvvccasd',
            'secret' => 'asdvbbflkjlsdfsd',
            'personal_access_client' => 'asdfiuccfflkjljljlk',
            'password_client' => false,
            'redirect' => false,
        ]);
    }
}

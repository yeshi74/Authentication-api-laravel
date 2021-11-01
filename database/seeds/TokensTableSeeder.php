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
            'name' => 'asdflkjlfjljlnbkln',
            'docid' => 'asdfsiweuoiuo',
            'token' => 1234,
        ], [
            'name' => 'asdflkjlwjljlnbkln',
            'docid' => 'asdfsiwuoiuo',
            'token' => 1235,
        ], [
            'name' => 'asdflkjlsjljlnbkln',
            'docid' => 'asdfsisuoiuo',
            'token' => 1236,
        ], [
            'name' => 'asdflzkjljljlnbkln',
            'docid' => 'asdafsiuoiuo',
            'token' => 1237,
        ]);
    }
}

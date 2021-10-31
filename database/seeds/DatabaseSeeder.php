<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            GalleryTableSeeder::class,
            OauthAccessTokensTableSeeder::class,
            OauthClientsTableSeeder::class,
            OauthPersonalAccessClientsTableSeeder::class,
            ProfileImageTableSeeder::class,
            TokensTableSeeder::class,
    ]);
    }
}

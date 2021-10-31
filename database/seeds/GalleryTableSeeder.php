<?php

use Illuminate\Database\Seeder;

class GalleryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('gallery')->insert([
            'user_id' => Str::random(10),
            'title' => Str::random(10),
            'image' => Str::random(10),
        ], [
            'user_id' => Str::random(10),
            'title' => Str::random(10),
            'image' => Str::random(10),
        ], [
            'user_id' => Str::random(10),
            'title' => Str::random(10),
            'image' => Str::random(10),
        ], [
            'user_id' => Str::random(10),
            'title' => Str::random(10),
            'image' => Str::random(10),
        ]);
    }
}

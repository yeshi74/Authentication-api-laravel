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
            'user_id' => 1,
            'title' => 'some title',
            'image' => 'akbc.jpg',
        ], [
            'user_id' => 2,
            'title' => 'some title',
            'image' => 'aobc.jpg',
        ], [
            'user_id' => 3,
            'title' => 'some title',
            'image' => 'ahbc.jpg',
        ], [
            'user_id' => 4,
            'title' => 'some title',
            'image' => 'aybc.jpg',
        ]);
    }
}

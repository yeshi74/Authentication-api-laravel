<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Yeshi',
            'mobile' => '9980463638',
            'location' => 'Bangalore',
            'description' => 'Some text description',
            'email' => 'thebluediamond96@gmail.com',
            'password' => '$2a$12$1B6jlNNw0JFWbdqBQhzIie2NXDEr1oiqLL6PqnCCSRH9hZHI/j36a', //encrypted password is 123456
        ], [
            'name' => 'Rahul',
            'mobile' => '9980463631',
            'location' => 'Delhi',
            'description' => 'Some text description',
            'email' => 'rahul@gmail.com',
            'password' => '$2a$12$1B6jlNNw0JFWbdqBQhzIie2NXDEr1oiqLL6PqnCCSRH9hZHI/j36a', //encrypted password is 123456
        ], [
            'name' => 'Poonam',
            'mobile' => '9980463632',
            'location' => 'Kolkata',
            'description' => 'Some text description',
            'email' => 'poonam@gmail.com',
            'password' => '$2a$12$1B6jlNNw0JFWbdqBQhzIie2NXDEr1oiqLL6PqnCCSRH9hZHI/j36a', //encrypted password is 123456
        ], [
            'name' => 'Rakesh',
            'mobile' => '9980463636',
            'location' => 'Dehradun',
            'description' => 'Some text description',
            'email' => 'rakesh@gmail.com',
            'password' => '$2a$12$1B6jlNNw0JFWbdqBQhzIie2NXDEr1oiqLL6PqnCCSRH9hZHI/j36a', //encrypted password is 123456
        ]);
    }
}

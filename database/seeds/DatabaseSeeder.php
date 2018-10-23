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
        // $this->call(UsersTableSeeder::class);

        // 今回は不要の為、コメントアウトした
        //$this->call(StudentsTableSeeder::class);

        $this->call(GoodsTableSeeder::class);
    }
}


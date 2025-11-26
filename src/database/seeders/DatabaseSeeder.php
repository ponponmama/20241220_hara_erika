<?php

namespace Database\Seeders;

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
        // 依存するテーブルのシーダーを先に実行
        $this->call(SeasonsTableSeeder::class);
        // その後、製品のシーダーを実行
        $this->call(ProductsTableSeeder::class);
    }
}

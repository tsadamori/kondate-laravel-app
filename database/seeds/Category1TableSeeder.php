<?php

use Illuminate\Database\Seeder;

class Category1TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category1')->insert([
            [
                'category1' => '肉',
            ],
            [
                'category1' => '卵',
            ],
            [
                'category1' => '豆',
            ],
            [
                'category1' => '魚',
            ],
            [
                'category1' => 'その他',
            ],
        ]);
    }
}

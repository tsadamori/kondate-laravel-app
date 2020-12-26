<?php

use Illuminate\Database\Seeder;

class Category2TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category2')->insert([
            [
                'category2' => '緑',
            ],
            [
                'category2' => '豆',
            ],
            [
                'category2' => '海藻',
            ],
            [
                'category2' => 'きのこ',
            ],
            [
                'category2' => 'その他',
            ],
        ]);
    }
}

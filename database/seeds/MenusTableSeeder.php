<?php

use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i <= 100; $i++) {
            DB::table('menus')->insert([
                'name' => 'test name' . $i,
                'category' => 'test category' . $i,
            ]);
        }
    }
}

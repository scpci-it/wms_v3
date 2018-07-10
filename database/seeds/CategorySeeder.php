<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    
    public function run()
    {
        DB::table('categories')->insert([
            'name' => "Finished Goods",
            'updated_at' => NOW(),
            'created_at' => NOW(),
        ]);

        DB::table('categories')->insert([
            'name' => "Packaging Materials",
            'updated_at' => NOW(),
            'created_at' => NOW(),
        ]);

        DB::table('categories')->insert([
            'name' => "Raw Materials",
            'updated_at' => NOW(),
            'created_at' => NOW(),
        ]);

        DB::table('categories')->insert([
            'name' => "Spare Parts",
            'updated_at' => NOW(),
            'created_at' => NOW(),
        ]);
    }
}

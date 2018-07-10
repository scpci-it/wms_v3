<?php

use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    public function run()
    {
        DB::table('locations')->insert([
            'name' => "Virtual Gain or Loss",
            'wh_id' => 1,
            'type' => "Virtual",
            'updated_at' => NOW(),
            'created_at' => NOW(),
        ]);

        DB::table('locations')->insert([
            'name' => "Supplier",
            'wh_id' => 1,
            'type' => "Virtual",
            'updated_at' => NOW(),
            'created_at' => NOW(),
        ]);

        DB::table('locations')->insert([
            'name' => "Customer",
            'wh_id' => 1,
            'type' => "Virtual",
            'updated_at' => NOW(),
            'created_at' => NOW(),
        ]);

        DB::table('locations')->insert([
            'name' => "Production",
            'wh_id' => 1,
            'type' => "Virtual",
            'updated_at' => NOW(),
            'created_at' => NOW(),
        ]);

        DB::table('locations')->insert([
            'name' => "Scrapping",
            'wh_id' => 1,
            'type' => "Virtual",
            'updated_at' => NOW(),
            'created_at' => NOW(),
        ]);

        DB::table('locations')->insert([
            'name' => "QA Hold",
            'wh_id' => 1,
            'type' => "Virtual",
            'updated_at' => NOW(),
            'created_at' => NOW(),
        ]);

    }
}

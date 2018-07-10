<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WarehouseSeeder extends Seeder
{
    
    public function run()
    {
        DB::table('warehouses')->insert([
            'name' => "Virtual Warehouse",
            'code' => "V",
            'updated_at' => NOW(),
            'created_at' => NOW(),
        ]);

        DB::table('warehouses')->insert([
            'name' => "Finished Product Warehouse",
            'code' => "FPWH",
            'updated_at' => NOW(),
            'created_at' => NOW(),
        ]);

        DB::table('warehouses')->insert([
            'name' => "Chemical Stock Room",
            'code' => "CMSR",
            'updated_at' => NOW(),
            'created_at' => NOW(),
        ]);

	    DB::table('warehouses')->insert([
            'name' => "Tetra Pak Stock Room",
            'code' => "TPSR",
            'updated_at' => NOW(),
            'created_at' => NOW(),
        ]);

        DB::table('warehouses')->insert([
            'name' => "Fabrication Stock Room",
            'code' => "FSR",
            'updated_at' => NOW(),
            'created_at' => NOW(),
        ]);
    }
}

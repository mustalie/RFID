<?php

namespace Database\Seeders;

use App\Models\InventoryGroup;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class InventoryGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Schema::disableForeignKeyConstraints();
        //Tag::truncate();
        //TagMap::truncate();
        InventoryGroup::query()->delete();

        InventoryGroup::insert([
            ['name' => 'Group 1', 'required_permission' => 1],
            ['name' => 'Group 2', 'required_permission' => 1],
            ['name' => 'Group 3', 'required_permission' => 1],
            ['name' => 'Group 4', 'required_permission' => 0]
        ]);
    }
}

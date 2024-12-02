<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\TagMap;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class TagSeeder extends Seeder
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
        //Tag::query()->forceDelete();
        //TagMap::query()->forceDelete();

        Tag::insert([
            ['tag' => 'E200001D321002311270D047'],
            ['tag' => 'E200001D3210017911809FAD'],
            ['tag' => 'E200001D32100171110096D9'],
            ['tag' => 'E200001D3210017811809C79'],
            ['tag' => 'E200001D32100144106070E8'],
            ['tag' => 'E200001D32100119128059FB'],
            ['tag' => 'E200001D3210015612208226'],
            ['tag' => 'E200001D321001901280A4EB'],
            ['tag' => 'E200001D32100114106056D1'],
            ['tag' => 'E200001D321001941230AD71'],
        ]);

        $latest_id = Tag::latest('id')->value('id');

        TagMap::insert([
            ['tag_id' => $latest_id - 9, 'item_id' => '9034519001', 'item_type' => TagMap::TYPE_STUDENT],
            ['tag_id' => $latest_id - 8, 'item_id' => '9034519002', 'item_type' => TagMap::TYPE_STUDENT],
            ['tag_id' => $latest_id - 7, 'item_id' => '9034519003', 'item_type' => TagMap::TYPE_STUDENT],
            ['tag_id' => $latest_id - 6, 'item_id' => '9034519004', 'item_type' => TagMap::TYPE_STUDENT],
            ['tag_id' => $latest_id - 5, 'item_id' => '9034519005', 'item_type' => TagMap::TYPE_STUDENT],
            ['tag_id' => $latest_id - 4, 'item_id' => 'SSR0001', 'item_type' => TagMap::TYPE_DOSEN],
            ['tag_id' => $latest_id - 3, 'item_id' => 'B-586748', 'item_type' => TagMap::TYPE_INVENTORY],
            ['tag_id' => $latest_id - 2, 'item_id' => 'KFHVS00175', 'item_type' => TagMap::TYPE_INVENTORY],
            ['tag_id' => $latest_id - 1, 'item_id' => 'MK-LG17001', 'item_type' => TagMap::TYPE_INVENTORY],
            ['tag_id' => $latest_id, 'item_id' => 'TM-I8', 'item_type' => TagMap::TYPE_INVENTORY]
        ]);

        //Schema::enableForeignKeyConstraints();
    }
}

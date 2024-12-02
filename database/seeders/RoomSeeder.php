<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Room::query()->delete();

        for($i = 1; $i <=5; $i++) 
        {
            DB::table('rooms')->insert([
                'name' => "Ruang {$i}",
                'category' => 'Kelas'
            ]);
        }

        for($i = 6; $i <=10; $i++) 
        {
            DB::table('rooms')->insert([
                'name' => "Ruang {$i}",
                'category' => 'Inventory A',
                'need_request_movement' => 1
            ]);
        }

        for($i = 11; $i <=15; $i++) 
        {
            DB::table('rooms')->insert([
                'name' => "Ruang {$i}",
                'category' => 'Inventory B'
            ]);
        }
    }
}

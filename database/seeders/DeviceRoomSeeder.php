<?php

namespace Database\Seeders;

use App\Models\DeviceRoom;
use App\Models\Room;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeviceRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DeviceRoom::query()->forceDelete();
        $rooms = Room::where('category', 'Inventory A')->take(4)->get();

        for($i = 0; $i < 4; $i++) 
        {
            DB::table('device_rooms')->insert([
                'device_id' => 'a',
                'antenna' => $i + 1,
                'room_id' => $rooms[$i]->id
            ]);
        }
    }
}

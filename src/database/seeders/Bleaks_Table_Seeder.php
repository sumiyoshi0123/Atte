<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bleak;

class Bleaks_Table_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'work_id' => 1,
            'start_time' => date("H:i:s"),
            'end_time' => date("H:i:s"),
        ];

        Bleak::create($param);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Work;
use DateTime;
use Illuminate\Support\Facades\Date;

class WorksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'user_id' => 1,
            'date' => date("Y-m-d"),
            'start_time' => date("H:i:s"),
            'end_time' => date("H:i:s"),
        ];

        Work::create($param);
    }
}

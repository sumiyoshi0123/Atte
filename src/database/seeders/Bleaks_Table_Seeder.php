<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
            'start_time' => date('12:00:00'),
            'end_time' => date('13:00:00'),
        ];
        DB::table('bleaks')->insert($param);
        $param = [
            'work_id' => 1,
            'start_time' => date('15:00:00'),
            'end_time' => date('15:30:00'),
        ];
        DB::table('bleaks')->insert($param);
        $param = [
            'work_id' => 2,
            'start_time' => date('12:00:00'),
            'end_time' => date('13:00:00'),
        ];
        DB::table('bleaks')->insert($param);
        $param = [
            'work_id' => 3,
            'start_time' => date('12:00:00'),
            'end_time' => date('13:00:00'),
        ];
        DB::table('bleaks')->insert($param);
        $param = [
            'work_id' => 4,
            'start_time' => date('12:00:00'),
            'end_time' => date('13:00:00'),
        ];
        DB::table('bleaks')->insert($param);
        $param = [
            'work_id' => 5,
            'start_time' => date('12:00:00'),
            'end_time' => date('13:00:00'),
        ];
        DB::table('bleaks')->insert($param);
        $param = [
            'work_id' => 6,
            'start_time' => date('12:00:00'),
            'end_time' => date('13:00:00'),
        ];
        DB::table('bleaks')->insert($param);
        $param = [
            'work_id' => 7,
            'start_time' => date('12:00:00'),
            'end_time' => date('13:00:00'),
        ];
        DB::table('bleaks')->insert($param);
    }
}

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
            'date' => date('2023-11-28'),
            'start_time' => date('10:00:00'),
            'end_time' => date('20:00:00'),
        ];
        DB::table('works')->insert($param);
        $param = [
            'user_id' => 2,
            'date' => date('2023-11-28'),
            'start_time' => date('10:00:00'),
            'end_time' => date('20:00:00'),
        ];
        DB::table('works')->insert($param);
        $param = [
            'user_id' => 3,
            'date' => date('2023-11-28'),
            'start_time' => date('10:00:00'),
            'end_time' => date('20:00:00'),
        ];
        DB::table('works')->insert($param);
        $param = [
            'user_id' => 4,
            'date' => date('2023-11-28'),
            'start_time' => date('10:00:00'),
            'end_time' => date('20:00:00'),
        ];
        DB::table('works')->insert($param);
        $param = [
            'user_id' => 5,
            'date' => date('2023-11-28'),
            'start_time' => date('10:00:00'),
            'end_time' => date('20:00:00'),
        ];
        DB::table('works')->insert($param);
        $param = [
            'user_id' => 6,
            'date' => date('2023-11-28'),
            'start_time' => date('10:00:00'),
            'end_time' => date('20:00:00'),
        ];
        DB::table('works')->insert($param);
        $param = [
            'user_id' => 7,
            'date' => date('2023-11-28'),
            'start_time' => date('10:00:00'),
            'end_time' => date('20:00:00'),
        ];
        DB::table('works')->insert($param);
    }
}

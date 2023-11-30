<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => 'テスト一郎',
            'email' => 'test01@gmail.com',
            'password' => Hash::make('12345678')
        ];
        DB::table('users')->insert($param);
        $param = [
            'name' => 'テスト二郎',
            'email' => 'test02@gmail.com',
            'password' => Hash::make('12345678')
        ];
        DB::table('users')->insert($param);
        $param = [
            'name' => 'テスト三郎',
            'email' => 'test03@gmail.com',
            'password' => Hash::make('12345678')
        ];
        DB::table('users')->insert($param);
        $param = [
            'name' => 'テスト四郎',
            'email' => 'test04@gmail.com',
            'password' => Hash::make('12345678')
        ];
        DB::table('users')->insert($param);
        $param = [
            'name' => 'テスト五郎',
            'email' => 'test05@gmail.com',
            'password' => Hash::make('12345678')
        ];
        DB::table('users')->insert($param);
    }
}

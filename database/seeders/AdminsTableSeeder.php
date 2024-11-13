<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;


class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password = Hash::make('123456');

        $adminRecords = [
            [
                'name'=>'Admin4',
                'type'=>'admin',
                'mobile'=>'000000000',
                'email'=>'admin4@admin.mx',
                'password'=>$password,
                'image'=>'',
                'status'=>1
            ],
        ];
        Admin::insert($adminRecords);
    }
}

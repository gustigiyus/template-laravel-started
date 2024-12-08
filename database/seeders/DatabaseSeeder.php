<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\SettingApp;
use App\Models\User;
use Carbon\Carbon;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $startTime = Carbon::now();

        //? ROLES
        $adminSystemRole = Role::where('role_name', 'Admin System')->first();

        if (!$adminSystemRole) {
            DB::table('roles')->insert([
                'id' => 1,
                'role_name' => 'Admin System',
                'role_desc' => 'Can access all features',
                'created_at' => $startTime,
                'updated_at' => $startTime,
            ]);

            DB::table('roles')->insert([
                'id' => 2,
                'role_name' => 'Admin Master',
                'role_desc' => 'Can do specific features',
                'created_at' => $startTime->copy()->addSeconds(1),
                'updated_at' => $startTime->copy()->addSeconds(1),
            ]);

            DB::table('roles')->insert([
                'id' => 3,
                'role_name' => 'Admin',
                'role_desc' => 'Can do basic stuff',
                'created_at' => $startTime->copy()->addSeconds(2),
                'updated_at' => $startTime->copy()->addSeconds(2),
            ]);
        }


        //? MENUS
        DB::table('menus')->insert([
            'id' => 1,
            'menu_name' => 'Followup',
            'menu_desc' => 'User can acces crud menu followup',
            'created_at' => $startTime,
            'updated_at' => $startTime,
        ]);

        DB::table('menus')->insert([
            'id' => 2,
            'menu_name' => 'Cutting',
            'menu_desc' => 'User can acces crud menu cutting',
            'created_at' => $startTime->copy()->addSeconds(1),
            'updated_at' => $startTime->copy()->addSeconds(1),
        ]);

        DB::table('menus')->insert([
            'id' => 3,
            'menu_name' => 'Embro',
            'menu_desc' => 'User can acces crud menu embro',
            'created_at' => $startTime->copy()->addSeconds(2),
            'updated_at' => $startTime->copy()->addSeconds(2),
        ]);

        DB::table('menus')->insert([
            'id' => 4,
            'menu_name' => 'Sewing',
            'menu_desc' => 'User can access crud menu sewing',
            'created_at' => $startTime->copy()->addSeconds(3),
            'updated_at' => $startTime->copy()->addSeconds(3),
        ]);

        DB::table('menus')->insert([
            'id' => 5,
            'menu_name' => 'Delivery',
            'menu_desc' => 'User can access crud menu delivery',
            'created_at' => $startTime->copy()->addSeconds(4),
            'updated_at' => $startTime->copy()->addSeconds(4),
        ]);

        DB::table('menus')->insert([
            'id' => 6,
            'menu_name' => 'Payment',
            'menu_desc' => 'User can acces crud menu payment',
            'created_at' => $startTime->copy()->addSeconds(5),
            'updated_at' => $startTime->copy()->addSeconds(5),
        ]);


        //? USERS
        $user1 = User::factory()->create([
            'username' => 'gustigiyus',
            'role_id' => 1,
            'password' => Hash::make(123456),
            'email' => 'gustigiyus@gmail.com',
            'created_at' => $startTime,
            'updated_at' => $startTime,
        ]);

        $user2 = User::factory()->create([
            'username' => 'yuni',
            'role_id' => 2,
            'password' => Hash::make(123456),
            'email' => 'yuni@gmail.com',
            'created_at' => $startTime->copy()->addSeconds(1),
            'updated_at' => $startTime->copy()->addSeconds(1),
        ]);

        $user3 = User::factory()->create([
            'username' => 'ida',
            'role_id' => 3,
            'password' => Hash::make(123456),
            'email' => 'ida@gmail.com',
            'created_at' => $startTime->copy()->addSeconds(2),
            'updated_at' => $startTime->copy()->addSeconds(2),
        ]);

        $user4 = User::factory()->create([
            'username' => 'bagus',
            'role_id' => 3,
            'password' => Hash::make(123456),
            'email' => 'bagus@gmail.com',
            'created_at' => $startTime->copy()->addSeconds(3),
            'updated_at' => $startTime->copy()->addSeconds(3),
        ]);


        //? User Detail
        DB::table('user_details')->insert([
            'user_id' => $user1->id,
            'name' => 'Gusti Giustianto',
            'nik' => 'UEB8342',
            'gender' => 'Male',
            'dob' => '2000-04-25',
            'address' => 'Tanjungsari, Sumedang',
            'created_at' => $startTime,
            'updated_at' => $startTime,
        ]);

        DB::table('user_details')->insert([
            'user_id' => $user2->id,
            'name' => 'Yuni Rahayu',
            'nik' => 'URBGS84',
            'gender' => 'Female',
            'dob' => '1989-05-11',
            'address' => '',
            'created_at' => $startTime->copy()->addSeconds(1),
            'updated_at' => $startTime->copy()->addSeconds(1),
        ]);

        DB::table('user_details')->insert([
            'user_id' => $user3->id,
            'name' => 'Ida Eliyanti',
            'nik' => 'NMQOPD8',
            'gender' => 'Female',
            'dob' => '1994-04-20',
            'address' => '',
            'created_at' => $startTime->copy()->addSeconds(2),
            'updated_at' => $startTime->copy()->addSeconds(2),
        ]);

        DB::table('user_details')->insert([
            'user_id' => $user4->id,
            'name' => 'Bagus Indra',
            'nik' => 'PQJFV84',
            'gender' => 'Male',
            'dob' => '1991-07-18',
            'address' => '',
            'created_at' => $startTime->copy()->addSeconds(3),
            'updated_at' => $startTime->copy()->addSeconds(3),
        ]);


        //? BRANDS
        DB::table('brands')->insert([
            'brand_name' => 'Kadaka',
            'brand_desc' => 'Kadaka is the best brand',
            'created_at' => $startTime,
            'updated_at' => $startTime,
        ]);

        DB::table('brands')->insert([
            'brand_name' => 'Jogger',
            'brand_desc' => 'Jogger is the best brand',
            'created_at' => $startTime->copy()->addSeconds(1),
            'updated_at' => $startTime->copy()->addSeconds(1),
        ]);


        //? APP SETTING
        DB::table('app_settings')->insert([
            'name_app' => 'App Name',
            'desc_app' => 'Apllication Description',
            'created_at' => $startTime->copy()->addSeconds(2),
            'updated_at' => $startTime->copy()->addSeconds(2),
        ]);
    }
}

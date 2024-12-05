<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\SettingApp;
use App\Models\User;
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
        //? ROLES
        $adminSystemRole = Role::where('role_name', 'Admin System')->first();

        if (!$adminSystemRole) {
            DB::table('roles')->insert([
                'id' => 1,
                'role_name' => 'Admin System',
                'role_desc' => 'Can access all features',
            ]);

            DB::table('roles')->insert([
                'id' => 2,
                'role_name' => 'Admin Master',
                'role_desc' => 'Can do specific features',
            ]);

            DB::table('roles')->insert([
                'id' => 3,
                'role_name' => 'Admin',
                'role_desc' => 'Can do basic stuff',
            ]);
        }


        //? MENUS
        DB::table('menus')->insert([
            'id' => 1,
            'menu_name' => 'Followup',
            'menu_desc' => 'User can acces crud menu followup',
        ]);

        DB::table('menus')->insert([
            'id' => 2,
            'menu_name' => 'Cutting',
            'menu_desc' => 'User can acces crud menu cutting',
        ]);

        DB::table('menus')->insert([
            'id' => 3,
            'menu_name' => 'Embro',
            'menu_desc' => 'User can acces crud menu embro',
        ]);

        DB::table('menus')->insert([
            'id' => 4,
            'menu_name' => 'Sewing',
            'menu_desc' => 'User can access crud menu sewing',
        ]);

        DB::table('menus')->insert([
            'id' => 5,
            'menu_name' => 'Delivery',
            'menu_desc' => 'User can access crud menu delivery',
        ]);

        DB::table('menus')->insert([
            'id' => 6,
            'menu_name' => 'Payment',
            'menu_desc' => 'User can acces crud menu payment',
        ]);


        //? USERS
        $user1 = User::factory()->create([
            'username' => 'gustigiyus',
            'role_id' => 1,
            'password' => Hash::make(123456),
        ]);

        $user2 = User::factory()->create([
            'username' => 'yuni',
            'role_id' => 2,
            'password' => Hash::make(123456),
        ]);

        $user3 = User::factory()->create([
            'username' => 'ida',
            'role_id' => 3,
            'password' => Hash::make(123456),
        ]);

        $user4 = User::factory()->create([
            'username' => 'bagus',
            'role_id' => 3,
            'password' => Hash::make(123456),
        ]);


        //? User Detail
        DB::table('user_details')->insert([
            'user_id' => $user1->id,
            'name' => 'Gusti Giustianto',
            'nik' => 'UEB8342',
            'gender' => 'Male',
        ]);

        DB::table('user_details')->insert([
            'user_id' => $user2->id,
            'name' => 'Yuni Rahayu',
            'nik' => 'URBGS84',
            'gender' => 'Female',
        ]);

        DB::table('user_details')->insert([
            'user_id' => $user3->id,
            'name' => 'Ida Eliyanti',
            'nik' => 'NMQOPD8',
            'gender' => 'Female',
        ]);

        DB::table('user_details')->insert([
            'user_id' => $user4->id,
            'name' => 'Bagus Indra',
            'nik' => 'PQJFV84',
            'gender' => 'Male',
        ]);


        //? BRANDS
        DB::table('brands')->insert([
            'brand_name' => 'Kadaka',
            'brand_desc' => 'Kadaka is the best brand',
        ]);

        DB::table('brands')->insert([
            'brand_name' => 'Jogger',
            'brand_desc' => 'Jogger is the best brand',
        ]);


        //? APP SETTING
        DB::table('app_settings')->insert([
            'name_app' => 'App Name',
            'desc_app' => 'Apllication Description',
        ]);
    }
}

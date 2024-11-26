<?php

namespace Database\Seeders;

use App\Models\Role;
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
        ]);

        DB::table('user_details')->insert([
            'user_id' => $user2->id,
            'name' => 'Yuni Rahayu',
        ]);

        DB::table('user_details')->insert([
            'user_id' => $user3->id,
            'name' => 'Ida Eliyanti',
        ]);

        DB::table('user_details')->insert([
            'user_id' => $user4->id,
            'name' => 'Bagus Indra',
        ]);
    }
}

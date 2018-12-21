<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigureProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userId = Uuid::generate()->string;

        DB::table('users')->insert([
            [
                'id' => $userId,
                'first_name' => 'Admin',
                'last_name' => '',
                'email' => 'admin@admin.com',
                'password' => bcrypt('secret'),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]
        ]);


        DB::table('roles')->insert([
            [
                'name' => 'Admin',
                'slug' => str_slug('Admin'),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'name' => 'Client',
                'slug' => str_slug('Client'),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]
        ]);


        DB::table('permissions')->insert([
            [
                'name' => 'Create User',
                'slug' => str_slug('Create User'),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'name' => 'Update User',
                'slug' => str_slug('Update User'),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'name' => 'View User',
                'slug' => str_slug('View User'),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'name' => 'Delete User',
                'slug' => str_slug('Delete User'),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]
        ]);

        DB::table('role_permissions')->insert([
            [
                'role_slug' => str_slug('Admin'),
                'permission_slug' => str_slug('Create User'),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'role_slug' => str_slug('Admin'),
                'permission_slug' => str_slug('Update User'),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'role_slug' => str_slug('Admin'),
                'permission_slug' => str_slug('View User'),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'role_slug' => str_slug('Admin'),
                'permission_slug' => str_slug('Delete User'),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]
        ]);

        DB::table('user_role')->insert([
            [
                'user_id' => $userId,
                'role_slug' => str_slug('Admin'),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]
        ]);

    }
}

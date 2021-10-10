<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'owner',
            'guard_name' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('model_has_roles')->insert([
            'role_id' => 1,
            'model_type' => 'App\Models\Admin',
            'model_id' => 1
        ]);


        \Artisan::call('permissions:update');

        $permessions = Permission::pluck('id');
        foreach ($permessions as $permission) {
            DB::table('role_has_permissions')->insert([
                'permission_id' => $permission,
                'role_id' => 1,
            ]);
        }
    }
}

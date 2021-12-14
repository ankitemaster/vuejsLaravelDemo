<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['Super Admin', 'Admin', 'User'];
        foreach($roles as $role) {
            Role::create(['guard_name' => 'api', 'name' => $role]);
        }
        $permissions = [
            "add_user",
            "edit_user",
            "delete_user",
            "add_project",
            "edit_project",
            "delete_project",
            "add_user_to_project",
            "delete_user_to_project",
            "hide_sample_from_project",
            "show_sample_from_project",
            "approve_project",
            "add_sample",
            "upload_photo_to_sample",
            "sign_sample",
            "delete_sign",
            "update_sign",
            "add_user_to_sample",
            "add_dynamic_signature_to_sample"
        ];
        foreach($permissions as $permission) {
            Permission::create(['guard_name' => 'api', 'name' => $permission]);
        }
        $role = Role::where('name', 'Admin')->where('guard_name', 'api')->first();
        $role->syncPermissions([
            "add_user",
            "edit_user",
            "delete_user",
            "add_user_to_project",
            "delete_user_to_project",
            "hide_sample_from_project",
            "show_sample_from_project",
            "approve_project",
            "add_user_to_sample",
            "update_sign",
            "delete_sign",
            "add_dynamic_signature_to_sample"
        ]);
        $role = Role::where('name', 'User')->where('guard_name', 'api')->first();
        $role->syncPermissions([
            "add_sample",
            "upload_photo_to_sample",
            "sign_sample"
        ]);
    }
}

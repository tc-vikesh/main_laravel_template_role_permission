<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // make role first
        $roleSuperAdmin = Role::create(['name' => 'superadmin']);

        // Assign Permissions
        $all_permissions = Permission::all();
        foreach($all_permissions as $permission){
            $roleSuperAdmin->givePermissionTo($permission);
            $permission->assignRole($roleSuperAdmin);
        }
        

        $user = User::where('username', 'superadmin')->first();

        if (is_null($user)) {
            $user           = new User();
            $user->name     = "Super Admin";
            $user->email    = "superadmin@transcorpint.com";
            $user->username = "superadmin";
            $user->password = Hash::make('Admin@321');
            $user->save();

            $user->assignRole($roleSuperAdmin);
        }
    }
}

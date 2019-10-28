<?php

use App\Permission;
use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //roles
        $admin_role = Role::where('slug', 'admin')->first();
        $manager_role = Role::where('slug', 'manager')->first();

        //permissions
        $admin_perm = Permission::where('slug', 'delete-users')->first();
        $manager_perm = Permission::where('slug', 'view-users')->first();

        $developer = new User();
        $developer->first_name = 'Foo';
        $developer->last_name = 'Bar';
        $developer->email = 'foo@bar.com';
        $developer->password = bcrypt('secret');
        $developer->save();
        $developer->roles()->attach($admin_role);
        $developer->permissions()->attach($admin_perm);


        $manager = new User();
        $manager->first_name = 'Lorem';
        $manager->last_name = 'ipsum';
        $manager->email = 'lorem@ipsum.com';
        $manager->password = bcrypt('secret');
        $manager->save();
        $manager->roles()->attach($manager_role);
        $manager->permissions()->attach($manager_perm);
    }
}

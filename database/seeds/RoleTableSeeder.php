<?php

use App\Permission;
use App\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		$admin_permission   = Permission::where( 'slug', 'delete-users' )->first();
		$manager_permission = Permission::where( 'slug', 'view-users' )->first();

		$admin_role       = new Role();
		$admin_role->slug = 'admin';
		$admin_role->name = 'Application Administrator';
		$admin_role->save();
		$admin_role->permissions()->attach( $admin_permission );

		$manager_role       = new Role();
		$manager_role->slug = 'manager';
		$manager_role->name = 'Application Manager';
		$manager_role->save();
		$manager_role->permissions()->attach( $manager_permission );
	}
}

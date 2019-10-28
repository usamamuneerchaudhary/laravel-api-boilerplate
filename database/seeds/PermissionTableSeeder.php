<?php

use App\Permission;
use App\Role;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		$admin_role   = Role::where( 'slug', 'admin' )->first();
		$manager_role = Role::where( 'slug', 'manager' )->first();

		$createTasks       = new Permission();
		$createTasks->slug = 'delete-users';
		$createTasks->name = 'Delete Users';
		$createTasks->save();
		$createTasks->roles()->attach( $admin_role );

		$editUsers       = new Permission();
		$editUsers->slug = 'view-users';
		$editUsers->name = 'View Users';
		$editUsers->save();
		$editUsers->roles()->attach( $manager_role );
	}
}

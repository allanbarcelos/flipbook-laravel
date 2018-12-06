<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
  /**
  * Run the database seeds.
  *
  * @return void
  */
  public function run()
  {

    if(!DB::table('roles')->where('name', 'client')->first())
    {
      $role_employee = new Role();
      $role_employee->name = 'client';
      $role_employee->description = 'Client role';
      $role_employee->save();
    }

    if(!DB::table('roles')->where('name', 'administrator')->first())
    {
      $role_manager = new Role();
      $role_manager->name = 'administrator';
      $role_manager->description = 'System admin';
      $role_manager->save();
    }
  }
}

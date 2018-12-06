<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
  /**
  * Run the database seeds.
  *
  * @return void
  */
  public function run()
  {

    //$users = factory(User::class, 10000)->create();

    $role_employee = Role::where('name', 'client')->first();
    $role_manager  = Role::where('name', 'administrator')->first();

    if(!DB::table('users')->where('email', 'jeff@mail.com')->first())
    {
      $employee = new User();
      $employee->name = 'Jeff Barns';
      $employee->email = 'jeff@mail.com';
      $employee->password = bcrypt('jeff123456');
      $employee->save();
      $employee->roles()->attach($role_employee);
    }

    if(!DB::table('users')->where('email', 'admin@mail.com')->first())
    {
      $manager = new User();
      $manager->name = 'Administrator';
      $manager->email = 'admin@mail.com';
      $manager->password = bcrypt('admin123456');
      $manager->save();
      $manager->roles()->attach($role_manager);
    }
  }
}

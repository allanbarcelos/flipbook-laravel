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
          $role_employee = Role::where('name', 'client')->first();
          $role_manager  = Role::where('name', 'administrator')->first();

          $employee = new User();
          $employee->name = 'Jeff Barns';
          $employee->email = 'jeff@mail.com';
          $employee->password = bcrypt('jeff123456');
          $employee->save();
          $employee->roles()->attach($role_employee);

          $manager = new User();
          $manager->name = 'Administrator';
          $manager->email = 'admin@mail.com';
          $manager->password = bcrypt('admin123456');
          $manager->save();
          $manager->roles()->attach($role_manager);
    }
}

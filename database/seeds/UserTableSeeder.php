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

    //$users = factory(User::class, 50)->create()->roles()->attach($role_client);

    $role_client = Role::where('name', 'client')->first();
    $role_admin  = Role::where('name', 'administrator')->first();

    $users = factory(User::class, 50)->create()->each(function($u) {
        //$u->posts()->save(factory(App\Post::class)->make());
        $role_client = Role::where('name', 'client')->first();
        $u->roles()->attach($role_client);
    });


    if(!DB::table('users')->where('email', 'jeff@mail.com')->first())
    {
      $employee = new User();
      $employee->name = 'Jeff Barns';
      $employee->email = 'jeff@mail.com';
      $employee->password = bcrypt('jeff123456');
      $employee->save();
      $employee->roles()->attach($role_client);
    }

    if(!DB::table('users')->where('email', 'admin@mail.com')->first())
    {
      $manager = new User();
      $manager->name = 'Administrator';
      $manager->email = 'admin@mail.com';
      $manager->password = bcrypt('admin123456');
      $manager->save();
      $manager->roles()->attach($role_admin);
    }
  }
}

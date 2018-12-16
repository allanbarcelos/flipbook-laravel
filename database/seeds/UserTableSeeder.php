<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\Address;

class UserTableSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        $role_client = Role::where('name', 'client')->first();
        $role_admin  = Role::where('name', 'administrator')->first();

        $users = factory(User::class, 5)->create()->each(function($u) {
            $role_client = Role::where('name', 'client')->first();
            $u->roles()->attach($role_client);
            $u->address()->save(factory(App\Address::class)->make());
            $u->cpf()->save(factory(App\Cpf::class)->make());
            for($i=0;$i < mt_rand(1,2);$i++)
            {
                $u->phones()->save(factory(App\Phone::class)->make());
            }
            $u->contract()->save(factory(App\Contract::class)->make());
        });

        if(!DB::table('users')->where('email', 'jeff@mail.com')->first())
        {
            $addressuser = factory(App\Address::class);
            $employee = new User();
            $employee->name = 'Jeff Barns';
            $employee->email = 'jeff@mail.com';
            $employee->password = bcrypt('jeff123456');
            $employee->save();
            $employee->roles()->attach($role_client);
            $employee->address()->save(factory(App\Address::class)->make());
            $employee->cpf()->create(['cpf' => '909.786.935-82'])->save();
            for($i=0; $i < mt_rand(1,2); $i++)
            {
                $employee->phones()->save(factory(App\Phone::class)->make());
            }

            $employee->contract()->save(factory(App\Contract::class)->make());
        }

        if(!DB::table('users')->where('email', 'admin@mail.com')->first())
        {
            $addressuser = factory(App\Address::class);
            $manager = new User();
            $manager->name = 'Administrator';
            $manager->email = 'admin@mail.com';
            $manager->password = bcrypt('admin123456');
            $manager->save();
            $manager->roles()->attach($role_admin);
            $manager->address()->save(factory(App\Address::class)->make());
            $manager->cpf()->create(['cpf' => '118.463.866-75'])->save();

            for($i=0; $i < mt_rand(1,2); $i++)
            {
                $manager->phones()->save(factory(App\Phone::class)->make());
            }
        }
    }
}

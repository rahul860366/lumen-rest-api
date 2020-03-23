<?php

use App\Entry;
use App\Group;
use App\GroupUser;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call('UserTableSeeder');
        $this->call('GroupTableSeeder');
        $this->call('EntryTableSeeder');
        $this->call('GroupUserTableSeeder');
    }
}

class UserTableSeeder extends Seeder
{

    public function run()
    {
        $faker = Faker\Factory::create();
        DB::table('users')->delete();

        $count = 1;
        while ($count <= 50) {
            User::create(array('email' => $faker->email,
                'first_name' => $faker->firstName(),
                'last_name' => $faker->lastName,
                'social_login_id' => $faker->uuid,
            )
            );
            $count++;
        }
    }

}

class GroupTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('groups')->delete();
        $faker = Faker\Factory::create();
        $users = User::all();
        $count = 1;
        while ($count <= 10) {
            Group::create(array('name' => $faker->sentence(),
                'user_id' => $faker->randomElement($users)->id,
                'status' => 1,
            )
            );
            $count++;
        }

    }

}

class EntryTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('entries')->delete();
        $faker = Faker\Factory::create();

        $users = User::all();
        $groups = Group::all();

        $count = 1;
        while ($count <= 50) {

            Entry::create(array('user_id' => $faker->randomElement($users)->id,
                'group_id' => $faker->randomElement($groups)->id,
                'description' => $faker->sentence(),
                'amount' => $faker->numberBetween(1,9999),
            )
            );

            $count++;
        }
    }

}

class GroupUserTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('group_users')->delete();

        $faker = Faker\Factory::create();

        $users = User::all();
        $groups = Group::all();

        $count = 1;
        while ($count <= 50) {
            GroupUser::create(array('user_id' => $faker->randomElement($users)->id,
                'group_id' => $faker->randomElement($groups)->id,
                'status' => 1,
            )
            );
            $count++;
        }
    }

}

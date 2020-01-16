<?php

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
        $data = array([
            'name' => 'CASTANER Antony',
            'last_name' => 'CASTANER',
            'first_name' => 'Antony',
            'email' => 'antony@mail.fr',
            'bio' => 'Développeur Full-Stack',
            'status' => 1,
            'email_verified_at' => now(),
            'password' => Hash::make('azertyuiop'), // password
            'remember_token' => Str::random(10),
        ]);

        App\User::insert($data);

        $skills = array([
            'user_id' => 1,
            'skill_id' => 1,
            'level' => 5
        ], [
            'user_id' => 1,
            'skill_id' => 2,
            'level' => 5
        ],[
            'user_id' => 1,
            'skill_id' => 3,
            'level' => 5
        ],[
            'user_id' => 1,
            'skill_id' => 4,
            'level' => 5
        ],);

        DB::table('skill_user')->insert($skills);
    }
}

<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SkillTableSeeder::class);
        factory(App\User::class, 10)->create()->each(function ($user) {
            $skills_number = rand(1, 4);
            $skills_id = [];

            for ($i = 1; $i <= $skills_number; $i++) {
                do {
                    $skill_id = rand(1, 4);
                } while (in_array($skill_id, $skills_id));
                array_push($skills_id, $skill_id);
                $level = rand(1, 5);
                DB::table('user_skill')->insert([
                    'user_id' => $user->id,
                    'skill_id' => $skill_id,
                    'level' => $level
                ]);
            }
        });
    }
}

<?php

use Illuminate\Database\Seeder;

class SkillTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array([
            'name' => 'Laravel',
            'description' => 'Framework PHP 7.0',
            'logo' => 'laravel.png'
        ], [
            'name' => 'Angular',
            'description' => 'Framework Front',
            'logo' => 'angular.png'
        ], [
            'name' => 'Python',
            'description' => 'Pas un serpent',
            'logo' => 'python.png'
        ], [
            'name' => 'JavaScript',
            'description' => 'Inventé par GISSELMANN Olivier',
            'logo' => 'javascript.png'
        ]);

        App\Skill::insert($data);
    }
}

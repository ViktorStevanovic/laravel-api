<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        $projects = config('projects.project');

        $typeIds = Type::all()->pluck('id');

        foreach ($projects as $project) {
            $newProject = new Project();
            $newProject->title = $project['title'];
            $newProject->type_id = $faker->randomElement($typeIds);
            $newProject->description = $project['description'];
            $newProject->project_url = $project['project_url'];
            $newProject->used_languages = $project['used_languages'];
            $newProject->save();
        }
    }
}

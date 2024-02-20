<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $technologies = [
            'Html' => 'https://www.w3schools.com/html/html_intro.asp',
            'Css' => 'https://www.w3schools.com/css/css_intro.asp',
            'Sass' => 'https://sass-lang.com/documentation/',
            'Java-script' => 'https://www.w3schools.com/js/js_intro.asp',
            'Vue-3' => 'https://vuejs.org/guide/introduction.html',
            'MySql' => 'https://dev.mysql.com/doc/',
            'PHP' => 'https://www.php.net/docs.php',
            'Laravel' => 'https://laravel.com/docs/10.x',
        ];

        foreach ($technologies as $singleTechnology => $link) {
            $technology = new Technology();
            $technology->name = $singleTechnology;
            $technology->documentation_link = $link;
            $technology->save();
            $technology->slug = Str::slug($technology->id . ' ' . $technology->name);
            $technology->update();
        }
    }
}

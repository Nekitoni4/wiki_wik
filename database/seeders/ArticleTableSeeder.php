<?php

namespace Database\Seeders;

use App\Models\Article;
use Faker\Factory;
use Illuminate\Database\Seeder;

class ArticleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        for ($i = 0; $i < 50; $i++) {
            Article::create([
                'title' => $faker->title,
                'content' => $faker->text,
                'count_words' => $faker->numberBetween(5, 60),
                'size' => $faker->numberBetween(10, 50)
            ]);
        }
    }
}

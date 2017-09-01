<?php

use Illuminate\Database\Seeder;
use App\Models\Article;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user_ids = ['1','2','3'];
        $faker = app(Faker\Generator::class);

        $articles = factory(Article::class)->times(100)->make()->each(function ($articles) use ($faker, $user_ids) {
            $articles->user_id = $faker->randomElement($user_ids);
        });

        Article::insert($articles->toArray());
    }
}

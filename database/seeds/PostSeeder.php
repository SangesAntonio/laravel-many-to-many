<?php

use App\Post;
use App\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Faker\Generator as faker;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $category_ids = category::pluck('id')->toArray();

        for ($i = 0; $i < 50; $i++) {
            $post = new Post();
            $post->title = $faker->text(25);
            $post->category_id = Arr::random($category_ids);
            $post->content = $faker->paragraph(2, false);
            $post->image = $faker->imageUrl(250, 250);
            $post->slug = Str::slug($post->title, '-');
            $post->save();
        }
    }
}

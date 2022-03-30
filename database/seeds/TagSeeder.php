<?php

use Illuminate\Database\Seeder;
use App\Tag;
use Faker\Generator as faker;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $tag_names = ['guerra', 'finanza', 'religione', 'moda', 'calcio'];

        foreach ($tag_names as $tag_name) {
            $new_tag = new Tag();
            $new_tag->label = $tag_name;
            $new_tag->color = $faker->hexColor();
            $new_tag->save();
        }
    }
}

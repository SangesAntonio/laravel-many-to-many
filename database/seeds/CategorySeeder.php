<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['label' => 'Attualità', 'color' => 'primary'],
            ['label' => 'Tecnologia', 'color' => 'success'],
            ['label' => 'Sport', 'color' => 'danger'],
            ['label' => 'Gossip', 'color' => 'light'],
            ['label' => 'Politica', 'color' => 'warning'],
        ];

        foreach ($categories as $category) {
            $new_category = new Category();
            $new_category->label = $category['label'];
            $new_category->color = $category['color'];
            $new_category->save();
        }
    }
}

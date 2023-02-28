<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class BookCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $books = DB::table('books')->pluck('id');
        $categories = DB::table('categories')->pluck('id');

        foreach ($books as $book_id) {
            $num_categories = $faker->numberBetween(1, 3);
            $selected_categories = $faker->randomElements($categories, $num_categories);

            foreach ($selected_categories as $category_id) {
                DB::table('book_category')->insert([
                    'book_id' => $book_id,
                    'category_id' => $category_id,
                ]);
            }
        }
    }
}
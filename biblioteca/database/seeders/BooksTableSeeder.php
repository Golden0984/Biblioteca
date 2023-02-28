<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            DB::table('books')->insert([
                'isbn' => $faker->isbn13(),
                'title' => $faker->sentence(),
                'author' => $faker->name(),
                'published_date' => $faker->date(),
                'description' => $faker->paragraph(),
                'price' => $faker->randomFloat(2, 10, 50),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Asignar categorías aleatorias al libro
            $categories = DB::table('categories')->pluck('id');
            $book_id = DB::table('books')->max('id');

            DB::table('book_category')->insert([
                'book_id' => $book_id,
                'category_id' => $faker->randomElement($categories),
            ]);
        }
    }
}
<?php

use Illuminate\Database\Seeder;

class VocabulariesTableSeeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for ($i = 1; $i <= 30; $i++) {
            App\Models\Vocabulary::create([
                'word' => $faker->word,
            ]);
        }
    }
}

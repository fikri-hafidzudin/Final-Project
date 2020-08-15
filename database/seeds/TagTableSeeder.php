<?php

use Illuminate\Database\Seeder;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->insert([
            'tag' => 'Laravel',
        ]);

        DB::table('tags')->insert([
            'tag' => 'Python',
        ]);

        DB::table('tags')->insert([
            'tag' => 'Java',
        ]);

        DB::table('tags')->insert([
            'tag' => 'Javascript',
        ]);
        DB::table('tags')->insert([
            'tag' => 'PHP',
        ]);
        DB::table('tags')->insert([
            'tag' => 'C#',
        ]);
        DB::table('tags')->insert([
            'tag' => 'HTML',
        ]);
        DB::table('tags')->insert([
            'tag' => 'JQuery',
        ]); 
        DB::table('tags')->insert([
            'tag' => 'C++',
        ]);
        DB::table('tags')->insert([
            'tag' => 'CSS',
        ]);
        DB::table('tags')->insert([
            'tag' => 'SQL',
        ]);
    }
}

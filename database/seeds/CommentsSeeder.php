<?php

use Illuminate\Database\Seeder;

class CommentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(1, 200) as $j) {
            DB::table('comments')->insert([
                'article_id'=>random_int(1,50),
                'user_id'=>random_int(1,50),
                'content'=>str_random(100),
                'created_at' => gmdate('Y-m-d H:i:s'),
                'updated_at' => gmdate('Y-m-d H:i:s')
            ]);
        }
    }
}
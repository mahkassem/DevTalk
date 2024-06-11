<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Like;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Like::factory()
            ->count(1000)
            ->create();

        // Update the `likes_count` column in the `articles` table
        $articles = Article::all();

        foreach ($articles as $article) {
            $likesCount = DB::table('likes')
                ->where('article_id', $article->id)
                ->count();

            $article->update([
                'likes_count' => $likesCount,
            ]);
        }
    }
}

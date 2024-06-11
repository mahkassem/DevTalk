<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Comment::factory()
            ->count(1000)
            ->create();

        // Update the `comments_count` column in the `articles` table
        $articles = Article::all();

        foreach ($articles as $article) {
            $commentsCount = DB::table('comments')
                ->where('article_id', $article->id)
                ->count();

            $article->update([
                'comments_count' => $commentsCount,
            ]);
        }
    }
}

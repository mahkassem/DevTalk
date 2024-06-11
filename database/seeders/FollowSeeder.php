<?php

namespace Database\Seeders;

use App\Models\Follow;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FollowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {
            $randTopics = Topic::inRandomOrder()
                ->limit(rand(1, 7))
                ->get();

            foreach ($randTopics as $topic) {
                Follow::create([
                    'user_id' => $user->id,
                    'topic_id' => $topic->id,
                ]);
            }
        }
    }
}

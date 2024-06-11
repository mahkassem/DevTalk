<?php

namespace Database\Seeders;

use App\Models\Topic;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Topics
        $topics = array(
            'Frontend',
            'Backend',
            'DevOps',
            'Mobile',
            'AI',
            'IoT',
            'Blockchain',
            'Cybersecurity',
            'Cloud',
            'Big Data',
            'Machine Learning',
            'Data Science',
            'Quantum Computing',
            'AR/VR',
            'Game Development',
            'Web Development',
        );

        Topic::insert(array_map(fn ($topic) => ['name' => $topic], $topics));
    }
}

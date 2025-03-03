<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            "name" => "Project ",
            "description" => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting,",
        ];

        for ($i = 1; $i <= 16; $i++) {
            Project::create(
                [
                    "name" => $data["name"] . $i,
                    "description" => $data["description"],
                    "user_id" => rand(1, 5)
                ]
            );
        }
    }
}

<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Task;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            "title" => "Task ",
            "description" => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting,",
        ];
        $currentDate = Carbon::now();

        for ($i = 1; $i <= 30; $i++) {

            $randomDate = Carbon::create($currentDate->year, $currentDate->month, rand(1, $currentDate->daysInMonth));
            Task::create(
                [
                    "title" => $data["title"] . $i,
                    "description" => $data["description"],
                    "due_date" => $randomDate,
                    "project_id" => rand(1, 16)
                ]
            );
        }
    }
}

<?php

use App\Models\Project;
use App\Models\Task;

return [
    'LOAD_LIMIT' => 10,
    'PROJECT' => [
        'STATES' => [
            'ID' => [Project::DEVELOP, Project::MAINTAIN, Project::FEATURE],
            'TEXT' => [
                Project::DEVELOP => 'Develop',
                Project::MAINTAIN => 'Maintain',
                Project::FEATURE => 'Feature'
            ]
        ],
        'PRIORITIES' => [
            'ID' => [Project::PRIORITY_LOW, Project::PRIORITY_MEDIUM, Project::PRIORITY_HIGH],
            'TEXT' => [
                Project::PRIORITY_LOW => 'Low',
                Project::PRIORITY_MEDIUM => 'Medium',
                Project::PRIORITY_HIGH => 'High'
            ]
        ],
    ],
    'TASK' => [
        'STATES' => [
            'ID' => [Task::PENDING, Task::DEVELOPING, Task::TESTING, Task::FIXING, Task::COMPLETED],
            'TEXT' => [
                Task::PENDING => 'Pending',
                Task::DEVELOPING => 'Developing',
                Task::TESTING => 'Testing',
                Task::FIXING => 'Fixing',
                Task::COMPLETED => 'Completed'
            ]
        ],
        'PRIORITIES' => [
            'ID' => [Task::PRIORITY_LOW, Task::PRIORITY_MEDIUM, Task::PRIORITY_HIGH],
            'TEXT' => [
                Task::PRIORITY_LOW => 'Low',
                Task::PRIORITY_MEDIUM => 'Medium',
                Task::PRIORITY_HIGH => 'High'
            ]
        ]
    ],
];

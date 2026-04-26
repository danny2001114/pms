<?php

use App\Models\Project;
use App\Models\Task;
use App\Models\User;

return [
    'LOAD_LIMIT' => 10,
    'PROJECT' => [
        'STATES' => [
            'ID' => [Project::DEVELOP, Project::MAINTAIN, Project::FEATURE],
            'TEXT' => [
                Project::DEVELOP => 'Develop',
                Project::MAINTAIN => 'Maintain',
                Project::FEATURE => 'Feature'
            ],
            'OPTIONS' => [
                ['value' => Project::DEVELOP, 'text' => 'Develop'],
                ['value' => Project::MAINTAIN, 'text' => 'Maintain'],
                ['value' => Project::FEATURE, 'text' => 'Feature']
            ]
        ],
        'PRIORITIES' => [
            'ID' => [Project::PRIORITY_LOW, Project::PRIORITY_MEDIUM, Project::PRIORITY_HIGH],
            'TEXT' => [
                Project::PRIORITY_LOW => 'Low',
                Project::PRIORITY_MEDIUM => 'Medium',
                Project::PRIORITY_HIGH => 'High'
            ],
            'OPTIONS' => [
                ['value' => Project::PRIORITY_LOW, 'text' => 'Low'],
                ['value' => Project::PRIORITY_MEDIUM, 'text' => 'Medium'],
                ['value' => Project::PRIORITY_HIGH, 'text' => 'High']
            ]
        ]
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
    'USER' => [
        'ROLES' => [
            'ID' => [User::MEMBER, User::LEADER, User::ADMIN],
            'TEXT' => [
                User::MEMBER => 'Member',
                User::LEADER => 'Leader',
                User::ADMIN => 'Admin',
                User::SUPER => 'Super'
            ],
            'OPTIONS' => [
                ['value' => User::MEMBER, 'text' => 'Member'],
                ['value' => User::LEADER, 'text' => 'Leader'],
                ['value' => User::ADMIN, 'text' => 'Admin']
            ]
        ],
        'GENDERS' => [
            'ID' => [User::MALE, User::FEMALE],
            'TEXT' => [
                User::MALE => 'Male',
                User::FEMALE => 'Female'
            ],
            'OPTIONS' => [
                ['value' => User::MALE, 'text' => 'Male'],
                ['value' => User::FEMALE, 'text' => 'Female']
            ]
        ]
    ],
];

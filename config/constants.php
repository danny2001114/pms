<?php

use App\Models\Project;

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

];

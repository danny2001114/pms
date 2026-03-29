<?php

use App\Models\Project;

return [
    'LOAD_LIMIT' => 10,
    'PROJECT_STATES' => [
        'ID' => [Project::DEVELOP, Project::MAINTAIN, Project::FEATURE],
        'TEXT' => [
            Project::DEVELOP => 'develop',
            Project::MAINTAIN => 'maintain',
            Project::FEATURE => 'feature'
        ]
    ],
];

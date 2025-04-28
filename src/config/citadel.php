<?php

return [
    'views' => [
        'page' => "citadel-template::core"
    ],
    'template' => [
        'js' => [
            asset('citadelkit/citadel/citadel.js'),
            'resources/js/app.js',
            'resources/js/bootstrap.js',
        ]
    ],
    'sidebar' => \Citadel\Handler\SidebarHandler::class,
    'header' => \Citadel\Handler\HeaderHandler::class
];

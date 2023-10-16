<?php

return [
    "first_provider" => [
        'title' => "First Service",
        'url' => env('FIRST_SERVICE_JOBS_URL'),
        'request' => \App\JobProvider\Request\RestRequest::class,
        'mapper' => \App\JobProvider\Mapper\FirstServiceMapper::class
    ],
    "second_provider" => [
        'title' => "Second Service",
        'url' => env('SECOND_SERVICE_JOBS_URL'),
        'request' => \App\JobProvider\Request\RestRequest::class,
        'mapper' => \App\JobProvider\Mapper\SecondServiceMapper::class
    ],
];

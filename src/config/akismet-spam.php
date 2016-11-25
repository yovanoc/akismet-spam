<?php

return [

    'akismet' => [
        'website' => env('AKISMET_WEBSITE'),
        'secret' => env('AKISMET_SECRET'),
    ],

    'parameter_map' => [
        'body' => 'comment_content',
        'author' => 'comment_author',
        'author_email' => 'comment_author_email',
    ]

];

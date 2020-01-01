<?php
$EM_CONF[$_EXTKEY] = [
    'title' => '[NITSAN] News Slick Slider',
    'description' => 'This extension allow you to create beautiful slider for your news images on your website.',
    'category' => 'plugin',
    'author' => 'NITSAN Technologies',
    'author_email' => 'sanjay@nitsan.in',
    'author_company' => 'NITSAN Technologies Pvt Ltd',
    'state' => 'stable',
    'internal' => '',
    'uploadfolder' => 0,
    'createDirs' => '',
    'clearCacheOnLoad' => 0,
    'version' => '1.0.0',
    'constraints' => [
        'depends' => [
            'typo3' => '6.2.0-9.9.99',
            'news' => '3.0.0-7.9.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];

<?php
$EM_CONF[$_EXTKEY] = [
    'title' => 'News Slick Slider',
    'description' => 'Easily display your TYPO3 news images in an attractive and responsive slick slider. Enhance user engagement by showcasing featured news articles with a modern and flexible carousel layout.',
    'category' => 'plugin',
    'author' => 'Team T3Planet',
    'author_email' => 'info@t3planet.de',
    'author_company' => 'T3Planet',
    'state' => 'stable',
    'internal' => '',
    'uploadfolder' => 0,
    'createDirs' => '',
    'clearCacheOnLoad' => 0,
    'version' => '1.0.2',
    'constraints' => [
        'depends' => [
            'typo3' => '6.2.0-9.9.99',
            'news' => '3.0.0-7.9.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];

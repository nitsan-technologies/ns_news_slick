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
    'version' => '2.0.0',
    'constraints' => [
        'depends' => [
            'typo3' => '12.4.37-14.9.99',
            'news' => '14.0.0-14.9.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];

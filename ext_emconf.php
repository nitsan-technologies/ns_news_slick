<?php
$EM_CONF[$_EXTKEY] = [
    'title' => '[NITSAN] News Slick Slider Plugin',
    'description' => 'This extension will create beautiful slider for your favourite EXT:news extesnion with most-poular jQuery slick slider. Live-Demo: https://demo.t3terminal.com/t3t-extensions/ You can download PRO version for more-features & free-support at https://t3terminal.com/',
    'category' => 'plugin',
    'author' => 'T3: Nilesh Malankiya, QA: Siddharth Sheth',
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

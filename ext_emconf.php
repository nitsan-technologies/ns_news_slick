<?php

$EM_CONF['ns_news_slick'] = [
    'title' => 'News Slick Slider',
    'description' => 'This extension allow you to create beautiful slider for your news images on your website. https://t3planet.com/news-slick-slider-typo3-extension',    'category' => 'plugin',
    'author' => 'T3: Nilesh Malankiya, T3: Himanshu Ramavat, QA: Krishna Dhapa',
    'author_email' => 'sanjay@nitsan.in',
    'author_company' => 'T3Planet // NITSAN',
    'state' => 'stable',
    'internal' => '',
    'uploadfolder' => 0,
    'createDirs' => '',
    'version' => '13.0.0',
    'constraints' => [
        'depends' => [
            'typo3' => '12.0.0-13.9.99',
            'news' => '12.0.0-12.9.99',
            'ns_license' => '13.0.4-13.9.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];

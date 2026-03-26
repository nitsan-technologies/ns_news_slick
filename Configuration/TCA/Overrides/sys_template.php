<?php

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3') || die('Access denied.');

$extKey = 'ns_news_slick';

// Adding fields to the tt_content table definition in TCA
ExtensionManagementUtility::addStaticFile(
    'ns_news_slick',
    'Configuration/TypoScript',
    'News Slick Slider'
);

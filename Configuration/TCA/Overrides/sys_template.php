<?php
defined('TYPO3_MODE') || die('Access denied.');

$extKey = 'ns_news_slick';

// Adding fields to the tt_content table definition in TCA
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('ns_news_slick', 'Configuration/TypoScript', '[NITSAN] News Slick Slider');

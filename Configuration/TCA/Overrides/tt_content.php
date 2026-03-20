<?php

use TYPO3\CMS\Extbase\Utility\ExtensionUtility;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3') or die();

/**
 * Plugin register
 */
$ctypeKey = ExtensionUtility::registerPlugin(
    'NsNewsSlick',
    'Newsslickslider',
    'News Slick Slider',
    'ns_news_slick-plugin-newsslickslider',
    'plugins'
);

/* Flexform configuration for the slider : START */
ExtensionManagementUtility::addToAllTCAtypes(
    'tt_content',
    '--div--;Configuration,pi_flexform,pages',
    $ctypeKey,
    'after:subheader',
);
// @extensionScannerIgnoreLine
ExtensionManagementUtility::addPiFlexFormValue(
    '*',
    'FILE:EXT:ns_news_slick/Configuration/FlexForms/PluginSettings.xml',
    $ctypeKey,
);
/* Flexform configuration for the slider : END */

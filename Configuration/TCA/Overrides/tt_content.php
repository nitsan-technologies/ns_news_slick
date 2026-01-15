<?php

use TYPO3\CMS\Extbase\Utility\ExtensionUtility;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3') or die();

/**
 * Plugin register
 */
ExtensionUtility::registerPlugin(
    'NsNewsSlick',
    'Newsslickslider',
    'News Slick Slider',
    'ns_news_slick-plugin-newsslickslider',
    'plugins'
);

/* Flexform configuration for the slider : START */
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['nsnewsslick_newsslickslider'] = 'layout,select_key,pages,recursive';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['nsnewsslick_newsslickslider'] = 'pi_flexform';
ExtensionManagementUtility::addPiFlexFormValue(
    'nsnewsslick_newsslickslider',
    'FILE:EXT:ns_news_slick/Configuration/FlexForms/PluginSettings.xml'
);
/* Flexform configuration for the slider : END */

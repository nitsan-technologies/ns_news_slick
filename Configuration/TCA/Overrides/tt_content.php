<?php
defined('TYPO3_MODE') or die();

/**
 * Plugin register
 */
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'NITSAN.NsNewsSlick',
    'Newsslickslider',
    'NS Slick Slider'
);

/* Flexform configuration for the slider : START */
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['nsnewsslick_newsslickslider']='layout,select_key,pages,recursive';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['nsnewsslick_newsslickslider'] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    'nsnewsslick_newsslickslider',
    'FILE:EXT:ns_news_slick/Configuration/FlexForms/PluginSettings.xml'
);
/* Flexform configuration for the slider : END */

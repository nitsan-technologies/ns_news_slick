<?php

defined('TYPO3') || die('Access denied.');

use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

call_user_func(
    function () {
        ExtensionUtility::configurePlugin(
            'NsNewsSlick',
            'Newsslickslider',
            [
                \NITSAN\NsNewsSlick\Controller\NewsSlickSliderController::class => 'slickSlider'
            ],
            [],
            ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT,
        );
    }
);

$GLOBALS['TYPO3_CONF_VARS']['SYS']['formEngine']['nodeResolver'][1792057164] = [
    'nodeName' => 'flexFormTabsContainer',
    'priority' => 42,
    'class' => \NITSAN\NsNewsSlick\Form\Resolver\PremiumStripFlexFormTabsContainerResolver::class,
];

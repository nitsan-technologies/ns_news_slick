<?php

defined('TYPO3') || die('Access denied.');

use TYPO3\CMS\Extbase\Utility\ExtensionUtility;
use NITSAN\NsNewsSlick\Controller\NewsSlickSliderController;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Imaging\IconRegistry;
use TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider;

call_user_func(
    function () {
        ExtensionUtility::configurePlugin(
            'NsNewsSlick',
            'Newsslickslider',
            [
                NewsSlickSliderController::class => 'slickSlider'
            ],
        );

        $iconRegistry = GeneralUtility::makeInstance(IconRegistry::class);
        $iconRegistry->registerIcon(
            'ns_news_slick-plugin-newsslickslider',
            SvgIconProvider::class,
            ['source' => 'EXT:ns_news_slick/Resources/Public/Icons/ns_news_slick.svg']
        );
    }
);

<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function () {
        if (version_compare(TYPO3_branch, '10.0', '>=')) {
            $moduleClass = \NITSAN\NsNewsSlick\Controller\NewsSlickSliderController::class;
        } else {
            $moduleClass = 'NewsSlickSlider';
        }

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'NITSAN.NsNewsSlick',
            'Newsslickslider',
            [
                $moduleClass => 'slickSlider'
            ],
            // non-cacheable actions
            [
                $moduleClass => ''
            ]
        );

        // wizards
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:ns_news_slick/Configuration/TSconfig/ContentElementWizard.tsconfig">');

        $iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
        $iconRegistry->registerIcon(
            'ns_news_slick-plugin-newsslickslider',
            \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
            ['source' => 'EXT:ns_news_slick/Resources/Public/Icons/plugin_icon.svg']
        );
    }
);

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['tt_content_drawItem']['nsnewsslick_newsslickslider'] = 'NITSAN\\NsNewsSlick\\Hooks\\PageLayoutView';

<?php
defined('TYPO3_MODE') || die('Access denied.');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('ns_news_slick', 'Configuration/TypoScript', '[NITSAN] News Slick Slider');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_nsnewsslick_domain_model_newsslickslider', 'EXT:ns_news_slick/Resources/Private/Language/locallang_csh_tx_nsnewsslick_domain_model_newsslickslider.xlf');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_nsnewsslick_domain_model_newsslickslider');

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['tt_content_drawItem']['nsnewsslick_newsslickslider']= \Nitsan\NsNewsSlick\Hooks\PageLayoutView::class;


<?php
namespace Nitsan\NsNewsSlick\Hooks;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Service\FlexFormService;
use TYPO3\CMS\Fluid\View\StandaloneView;

class PageLayoutView implements \TYPO3\CMS\Backend\View\PageLayoutViewDrawItemHookInterface {

    public function preProcess(\TYPO3\CMS\Backend\View\PageLayoutView &$parentObject, &$drawItem, &$headerContent, &$itemContent, array &$row) {

        $extKey = 'ns_news_slick';
        if ($row['CType'] == 'list' && $row['list_type'] == 'nsnewsslick_newsslickslider') {
            $drawItem = false;
            $headerContent = '';
            // template
            $view = $this->getFluidTemplate($extKey, 'NsNewsSlick');

            if (!empty($row['pi_flexform'])) {
                /** @var FlexFormService $flexFormService */
                $flexFormService = GeneralUtility::makeInstance(FlexFormService::class);
            }

            // assign all to view
            $view->assignMultiple([
                //'data' => $row,
                'flexformData' => $flexFormService->convertFlexFormContentToArray($row['pi_flexform']),
            ]);

            // return the preview
            $itemContent = $parentObject->linkEditContent($view->render(), $row);
        }

    }

    /**
     * @param string $extKey
     * @param string $templateName
     * @return string the fluid template
     */
    protected function getFluidTemplate($extKey, $templateName)
    {
        // prepare own template
        $fluidTemplateFile = GeneralUtility::getFileAbsFileName('EXT:' . $extKey . '/Resources/Private/Backend/' . $templateName . '.html');
        $view = GeneralUtility::makeInstance(StandaloneView::class);
        $view->setTemplatePathAndFilename($fluidTemplateFile);
        return $view;
    }
}
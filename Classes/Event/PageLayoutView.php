<?php

namespace NITSAN\NsNewsSlick\Event;

use TYPO3\CMS\Backend\View\Event\PageContentPreviewRenderingEvent;
use TYPO3\CMS\Core\Service\FlexFormService;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\View\StandaloneView;

final class PageLayoutView
{
    /**
     * @var FlexFormService $flexFormService
     */
    // @extensionScannerIgnoreLine
    protected FlexFormService $flexFormService;
    /**
     * @param PageContentPreviewRenderingEvent $event
     * @return void
     */
    public function __invoke(PageContentPreviewRenderingEvent $event): void
    {
        $extKey = 'ns_news_slick';
        $versionNumber =  \TYPO3\CMS\Core\Utility\VersionNumberUtility::convertVersionStringToArray(\TYPO3\CMS\Core\Utility\VersionNumberUtility::getCurrentTypo3Version());
        if ($versionNumber['version_main'] <= 13) {
            $row = $event->getRecord();
        } else {
            $row = $event->getRecord()->toArray();
        }
        if ($row['CType'] == 'list' && $row['list_type'] == 'nsnewsslick_newsslickslider') {
            // template
            $view = $this->getFluidTemplate($extKey, 'NsNewsSlick');
            if (!empty($row['pi_flexform'])) {
                // @extensionScannerIgnoreLine
                $this->flexFormService = GeneralUtility::makeInstance(FlexFormService::class);
            }

            // assign all to view
            $view->assignMultiple([
                'flexformData' => $this->flexFormService->convertFlexFormContentToArray($row['pi_flexform']),
            ]);

            // return the preview
            $event->setPreviewContent($view->render());
        }
    }

    /**
     * @param string $extKey
     * @param string $templateName
     * @return StandaloneView the fluid template
     */
    protected function getFluidTemplate(string $extKey, string $templateName)
    {
        // prepare own template
        $fluidTemplateFile = GeneralUtility::getFileAbsFileName('EXT:' . $extKey . '/Resources/Private/Backend/' . $templateName . '.html');
        $versionNumber =  \TYPO3\CMS\Core\Utility\VersionNumberUtility::convertVersionStringToArray(\TYPO3\CMS\Core\Utility\VersionNumberUtility::getCurrentTypo3Version());
        if ($versionNumber['version_main'] <= 12) {
            // @extensionScannerIgnoreLine
            $view = GeneralUtility::makeInstance(StandaloneView::class);
            $view->setTemplatePathAndFilename($fluidTemplateFile);
            return $view;
        } else {
            $viewFactory = GeneralUtility::makeInstance(\TYPO3\CMS\Core\View\ViewFactoryInterface::class);
            $viewFactoryData = new \TYPO3\CMS\Core\View\ViewFactoryData(
                templateRootPaths: ['EXT:' . $extKey . '/Resources/Private/Backend/'],
            );
            $view = $viewFactory->create($viewFactoryData);
            return $view->render($templateName . '.html');

        }
    }
}

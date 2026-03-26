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
    protected FlexFormService $flexFormService;
    /**
     * @param PageContentPreviewRenderingEvent $event
     * @return void
     */
    public function __invoke(PageContentPreviewRenderingEvent $event): void
    {
        $extKey = 'ns_news_slick';
        $row = $event->getRecord();
        if ($row['CType'] == 'list' && $row['list_type'] == 'nsnewsslick_newsslickslider') {
            $drawItem = false;
            $headerContent = '';
            // template
            $view = $this->getFluidTemplate($extKey, 'NsNewsSlick');
            if (!empty($row['pi_flexform'])) {
                $this->flexFormService = GeneralUtility::makeInstance(FlexFormService::class);
            }

            // assign all to view
            $view->assignMultiple([
                //'data' => $row,
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
    protected function getFluidTemplate(string $extKey, string $templateName): StandaloneView
    {
        // prepare own template
        $fluidTemplateFile = GeneralUtility::getFileAbsFileName('EXT:' . $extKey . '/Resources/Private/Backend/' . $templateName . '.html');
        $view = GeneralUtility::makeInstance(StandaloneView::class);
        $view->setTemplatePathAndFilename($fluidTemplateFile);
        return $view;
    }
}

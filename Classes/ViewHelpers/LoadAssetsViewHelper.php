<?php

namespace NITSAN\NsNewsSlick\ViewHelpers;

use TYPO3\CMS\Core\Core\Environment;
use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;

/**
 *
 */
class LoadAssetsViewHelper extends AbstractViewHelper
{
    use CompileWithRenderStatic;


    /**
     * @var string
     */
    protected string $dots = '';

    /**
     * @var string
     */
    protected string $autoScale;

    /**
     * @var string
     */
    protected string $loop = '';

    /**
     * @var string
     */
    protected string $variableWidth = '';

    /**
     * @var string
     */
    protected string $codeBlock = '';

    /**
     * @var string
     */
    protected string $autoplay = '';

    /**
     * @var string
     */
    protected string $pauseOnHover = '';

    /**
     * @var string
     */
    protected string $cid = '';

    /**
     * @var string
     */
    protected string $extPath = '';

    /**
     * Initialize
     *
     * @return void
     */
    public function initializeArguments(): void
    {
        parent::initializeArguments();
    }

    /**
     * @return void
     */
    public function render(): void
    {
        // Collect the settings.
        $settings = $this->templateVariableContainer->get('settings');
        $cData = $this->templateVariableContainer->get('contentObjectData');
        $this->cid = $elementId = 'nsslick-' . $cData['uid'];

        // Define assets path.
        $this->extPath = str_replace(Environment::getPublicPath() . '/', '', ExtensionManagementUtility::extPath('ns_news_slick') . 'Resources/Public/slider/');

        $settings['dots'] = $settings['dots'] ?? '0';
        $settings['autoScaleSlider'] = $settings['autoScaleSlider'] ?? '0';
        $settings['loop'] = $settings['loop'] ?? '0';
        $settings['variableWidth'] = $settings['variableWidth'] ?? '0';
        $settings['autoPlay'] = $settings['autoPlay'] ?? '0';
        $settings['pauseOnHover'] = $settings['pauseOnHover'] ?? '0';

        $this->dots = ($settings['dots'] == '1') ? 'true' : 'false';
        $this->autoScale = ($settings['autoScaleSlider'] == '1') ? 'true' : 'false';
        $this->loop = ($settings['loop'] == '1') ? 'true' : 'false';
        $this->variableWidth = ($settings['variableWidth'] == '1') ? 'true' : 'false';
        $this->autoplay = ($settings['autoPlay'] == '1') ? 'true' : 'false';
        $this->pauseOnHover = ($settings['pauseOnHover'] == '1') ? 'true' : 'false';
        // Create pageRender instance.
        $pageRender = GeneralUtility::makeInstance(PageRenderer::class);
        switch ($settings['slicksliderType']) {
            case 'single':
                $this->singleImageView($pageRender, $elementId, $settings);
                break;
            case 'multiple':
                $this->multipleView($pageRender, $elementId, $settings);
                break;
            case 'responsive':
                $this->responsiveView($pageRender, $elementId, $settings);
                break;
        }
    }

    /**
     * @param $pageRender
     * @param $selector
     * @param $settings
     * @return void
     */
    public function singleImageView($pageRender, $selector, $settings): void
    {
        $settings['transitionType'] = $settings['transitionType'] ?? 0 ;
        $this->startBlock($selector);
        $this->codeBlock .= '
          dots: ' . $this->dots . ',
          infinite: ' . $this->loop . ',
          fade:' . $settings['transitionType'] . ",
          cssEase: 'linear',
          adaptiveHeight: $this->autoScale,
          autoplay:" . $this->autoplay . ',
          pauseOnHover:' . $this->pauseOnHover . ',
        ';
        $this->commonSettings($settings, $pageRender);
    }

    /**
     * @param $pageRender
     * @param $selector
     * @param $settings
     * @return void
     */
    public function multipleView($pageRender, $selector, $settings): void
    {
        $this->startBlock($selector);
      
        $slideToShow = $settings['slideToShow'] ?? '1';
        $slideToScroll = $settings['slideToScroll'] ?? '1';

        $this->codeBlock .= '
          dots: ' . $this->dots . ',
          infinite: ' . $this->loop . ',
          slidesToShow: ' . $slideToShow . ',
          slidesToScroll: ' . $slideToScroll . ',
          variableWidth: ' . $this->variableWidth . ',
          autoplay:' . $this->autoplay . ',
          pauseOnHover:' . $this->pauseOnHover . ',';

        if (isset($settings['centerMode']) && $settings['centerMode'] != 0) {
            $this->codeBlock .= "
            centerMode: true,
            ";
            if (isset($settings['centerPadding'])) {
                $this->codeBlock .= "centerPadding:'" . $settings['centerPadding'] . "px',";
            }
        }

        $this->commonSettings($settings, $pageRender);
    }

    /**
     * @param $pageRender
     * @param $selector
     * @param $settings
     * @return void
     */
    public function responsiveView($pageRender, $selector, $settings): void
    {
        $this->startBlock($selector);
        $slideToShow = $settings['slideToShow'] ?? '1';
        $slideToScroll = $settings['slideToScroll'] ?? '1';

        $this->codeBlock .= '
          dots: ' . $this->dots . ',
          infinite: ' . $this->loop . ',
          slidesToShow: ' . $slideToShow . ',
          slidesToScroll: ' . $slideToScroll . ',
          variableWidth: ' . $this->variableWidth . ',
          autoplay:' . $this->autoplay . ',
          responsive: [
            {
              breakpoint: 1024,
              settings: {
                slidesToShow: 3,
                slidesToScroll: 3,
                infinite: true,
                dots: true
              }
            },
            {
              breakpoint: 600,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 2
              }
            },
            {
              breakpoint: 480,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1
              }
            }
          ],
          pauseOnHover:' . $this->pauseOnHover . ',';

        if (isset($settings['centerMode']) && $settings['centerMode'] != 0) {
          $centerPadding = $settings['centerPadding'] ?? '';
            $this->codeBlock .= "
            centerMode: true,
            centerPadding:'" .  $centerPadding . "px',
            ";
        }
        $this->commonSettings($settings, $pageRender);
    }

    /**
     * @param $selector
     * @return void
     */
    public function startBlock($selector): void
    {
        $this->codeBlock .= " $('#" . $selector . "').slick({ ";
    }

    /**
     * @param $pageRender
     * @return void
     */
    public function endBlock($pageRender): void
    {
        $this->codeBlock .= '});';
        $pageRender->addJsFooterInlineCode('slick-config-' . $this->cid, $this->codeBlock);
    }

    /**
     * @param $settings
     * @param $pageRender
     * @return void
     */
    public function commonSettings($settings, $pageRender): void
    {
        $settings['autoplaySpeed'] = ($settings['autoplaySpeed']) ?? 0;
        if ($settings['autoplaySpeed'] != 0 && $this->autoplay == 'true') {
            $this->codeBlock .= 'autoplaySpeed:' . $settings['autoplaySpeed'] . ',';
        }
        if ($settings['slideSpeed'] != 0 && $this->autoplay == 'false') {
            $this->codeBlock .= 'speed:' . $settings['slideSpeed'];
        }
        $this->endBlock($pageRender);
    }
}

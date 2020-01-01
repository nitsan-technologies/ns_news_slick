<?php
namespace Nitsan\NsNewsSlick\ViewHelpers;

use TYPO3\CMS\Core\Core\Environment;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;

class LoadAssetsViewHelper extends \TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper
{
    use CompileWithRenderStatic;
    protected $constant;
    protected $dots;
    protected $autoScale;
    protected $loop;
    protected $variableWidth;
    protected $codeBlock='';
    protected $autoplay;
    protected $pauseOnHover;
    /**
     * Initialize
     *
     * @return void
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
    }

    public function render()
    {

        // Collect the settings.
        $settings = $this->templateVariableContainer->get('settings');
        $cData = $this->templateVariableContainer->get('contentObjectData');
        $elementId = 'nsslick-' . $cData['uid'];

        // set js value for slider
        $this->constant = $GLOBALS['TSFE']->tmpl->setup['plugin.']['tx_.']['persistence.'];

        // Define assets path.
        $this->extPath = str_replace(Environment::getPublicPath() . '/', '', ExtensionManagementUtility::extPath('ns_news_slick') . 'Resources/Public/slider/');
        $this->dots = ($settings['dots']=='1') ? 'true':'false';
        $this->autoScale = ($settings['autoScaleSlider']=='1') ? 'true':'false';
        $this->loop = ($settings['loop']=='1') ? 'true':'false';
        $this->variableWidth = ($settings['variableWidth']=='1') ? 'true':'false';
        $this->autoplay = ($settings['autoPlay']=='1') ? 'true':'false';
        $this->pauseOnHover = ($settings['pauseOnHover']=='1') ? 'true':'false';
        // Create pageRender instance.
        $pageRender = GeneralUtility::makeInstance(\TYPO3\CMS\Core\Page\PageRenderer::class);

        switch ($settings[slicksliderType]) {
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

    public function singleImageView($pageRender, $selector, $settings)
    {
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
        if ($settings['autoplaySpeed'] !=0) {
            $this->codeBlock .= 'autoplaySpeed:' . $settings['autoplaySpeed'] . ',';
        }
        if ($settings['slideSpeed']!=0 && !$this->autoplay) {
            $this->codeBlock .= 'speed:' . $settings['slideSpeed'];
        }
        $this->endBlock($pageRender);
    }

    public function multipleView($pageRender, $selector, $settings)
    {
        $this->startBlock($selector);

        $this->codeBlock .= '
          dots: ' . $this->dots . ',
          infinite: ' . $this->loop . ',
          slidesToShow: ' . $settings['slideToShow'] . ',
          slidesToScroll: ' . $settings['slideToScroll'] . ',
          variableWidth: ' . $this->variableWidth . ',
          autoplay:' . $this->autoplay . ',
          pauseOnHover:' . $this->pauseOnHover . ',';

        if ($settings['centerMode']!=0) {
            $this->codeBlock .= "
            centerMode: true,
            centerPadding:'" . $settings['centerPadding'] . "px',
            ";
        }
        if ($settings['autoplaySpeed'] !=0) {
            $this->codeBlock .= 'autoplaySpeed:' . $settings['autoplaySpeed'] . ',';
        }
        if ($settings['slideSpeed']!=0 && !$this->autoplay) {
            $this->codeBlock .= 'speed:' . $settings['slideSpeed'];
        }

        $this->endBlock($pageRender);
    }

    public function responsiveView($pageRender, $selector, $settings)
    {
        $this->startBlock($selector);

        $this->codeBlock .= '
          dots: ' . $this->dots . ',
          infinite: ' . $this->loop . ',
          slidesToShow: ' . $settings['slideToShow'] . ',
          slidesToScroll: ' . $settings['slideToScroll'] . ',
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

        if ($settings['centerMode']!=0) {
            $this->codeBlock .= "
            centerMode: true,
            centerPadding:'" . $settings['centerPadding'] . "px',
            ";
        }
        if ($settings['autoplaySpeed'] !=0) {
            $this->codeBlock .= 'autoplaySpeed:' . $settings['autoplaySpeed'] . ',';
        }
        if ($settings['slideSpeed']!=0 && !$this->autoplay) {
            $this->codeBlock .= 'speed:' . $settings['slideSpeed'];
        }

        $this->endBlock($pageRender);
    }

    public function startBlock($selector)
    {
        $this->codeBlock = " $('#" . $selector . "').slick({ ";
    }

    public function endBlock($pageRender)
    {
        $this->codeBlock .= '});';
        $pageRender->addJsFooterInlineCode('slick-config', $this->codeBlock, true);
    }
}

<?php
namespace NITSAN\NsNewsSlick\ViewHelpers;

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
    protected $cid;
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
        $this->cid = $elementId = 'nsslick-' . $cData['uid'];
        
        // set js value for slider
        $this->constant = isset($GLOBALS['TSFE']->tmpl->setup['plugin.']['tx_.']['persistence.']) ? $GLOBALS['TSFE']->tmpl->setup['plugin.']['tx_.']['persistence.'] : '';

        // Define assets path.
        if (version_compare(TYPO3_branch, '9.0', '>')) {
            $this->extPath = str_replace(Environment::getPublicPath() . '/', '', ExtensionManagementUtility::extPath('ns_news_slick') . 'Resources/Public/slider/');
        } else {
            $this->extPath = str_replace(PATH_site . '/', '', ExtensionManagementUtility::extPath('ns_news_slick') . 'Resources/Public/slider/');
        }

        $settings['dots'] = isset($settings['dots']) ? $settings['dots'] : '';
        $settings['autoScaleSlider'] = isset($settings['autoScaleSlider']) ? $settings['autoScaleSlider'] : '';
        $settings['loop'] = isset($settings['loop']) ? $settings['loop'] : '';
        $settings['variableWidth'] = isset($settings['variableWidth']) ? $settings['variableWidth'] : '';
        $settings['autoPlay'] = isset($settings['autoPlay']) ? $settings['autoPlay'] : '';
        $settings['pauseOnHover'] = isset($settings['pauseOnHover']) ? $settings['pauseOnHover'] : '';
        $this->dots = ($settings['dots']=='1') ? 'true':'false';
        $this->autoScale = ($settings['autoScaleSlider']=='1') ? 'true':'false';
        $this->loop = ($settings['loop']=='1') ? 'true':'false';
        $this->variableWidth = ($settings['variableWidth']=='1') ? 'true':'false';
        $this->autoplay = ($settings['autoPlay']=='1') ? 'true':'false';
        $this->pauseOnHover = ($settings['pauseOnHover']=='1') ? 'true':'false';
        // Create pageRender instance.
        $pageRender = GeneralUtility::makeInstance(\TYPO3\CMS\Core\Page\PageRenderer::class);

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

    public function singleImageView($pageRender, $selector, $settings)
    {   
        $this->startBlock($selector);
        $settings['transitionType'] = isset($settings['transitionType']) ? $settings['transitionType'] : 'false';
        $settings['autoplaySpeed'] = isset($settings['autoplaySpeed']) ? $settings['autoplaySpeed'] : 1000;
        
        $this->codeBlock .= '
          dots: ' . $this->dots . ',
          infinite: ' . $this->loop . ',
          fade:' . $settings["transitionType"] . ',
          cssEase: "linear",
          adaptiveHeight:'. $this->autoScale .',
          autoplay:' . $this->autoplay . ',
          pauseOnHover:' . $this->pauseOnHover . ',
        ';
        if ($settings['autoplaySpeed'] !=0 && $this->autoplay == 'true') {
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

          $settings['centerMode'] = isset($settings['centerMode']) ? $settings['centerMode'] : 0;
        if ($settings['centerMode']!=0) {
            $settings['centerPadding'] = isset($settings['centerPadding']) ? $settings['centerPadding'] : 60;
            $this->codeBlock .= "
            centerMode: true,
            centerPadding:'" . $settings['centerPadding'] . "px',
            ";
        }
        $settings['autoplaySpeed'] = isset($settings['autoplaySpeed']) ? $settings['autoplaySpeed'] : '';
        if ($settings['autoplaySpeed'] !=0 && $this->autoplay == 'true') {
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
          $settings['centerMode'] = isset($settings['centerMode']) ? $settings['centerMode'] : 0;
        if ($settings['centerMode']!=0) {
            $settings['centerPadding'] = isset($settings['centerPadding']) ? $settings['centerPadding'] : 60;
            $this->codeBlock .= "
            centerMode: true,
            centerPadding:'" . $settings['centerPadding'] . "px',
            ";
        }
        $settings['autoplaySpeed'] = isset($settings['autoplaySpeed']) ? $settings['autoplaySpeed'] : 0;
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
        $this->codeBlock .= "setTimeout(function() { $('#" . $selector . "').slick({ ";
    }

    public function endBlock($pageRender)
    {
        $this->codeBlock .= '});}, 200);';
        $pageRender->addJsFooterInlineCode('slick-config-'. $this->cid, $this->codeBlock);
    }
}

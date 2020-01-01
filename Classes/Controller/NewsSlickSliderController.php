<?php
namespace Nitsan\NsNewsSlick\Controller;

use TYPO3\CMS\Core\Utility\GeneralUtility;

/***
 *
 * This file is part of the "[NITSAN] News Slick Slider" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2019 NITSAN Technologies <sanjay@nitsan.in>
 *
 ***/

/**
 * NewsSlickSliderController
 */
class NewsSlickSliderController extends \GeorgRinger\News\Controller\NewsController
{
    /**
     * @var \GeorgRinger\News\Domain\Repository\NewsRepository
     */
    protected $newsRepository;

    /**
      * action list
      *
      * @return void
      */
    public function slickSliderAction()
    {
        $newsParam = GeneralUtility::_GP('tx_news_pi1');
        if ($this->settings['singleNews']) {
            $newsId = $this->settings['singleNews'];
        } else {
            $newsId = $newsParam['news'];
        }

        $news = $this->newsRepository->findByUid($newsId);
        $this->view->assign('newsItem', $news);
    }
}

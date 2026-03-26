<?php

declare(strict_types=1);

namespace NITSAN\NsNewsSlick\Controller;

use Psr\Http\Message\ResponseInterface;
use GeorgRinger\News\Controller\NewsController;
use GeorgRinger\News\Domain\Repository\NewsRepository;

/***
 *
 * This file is part of the "News Slick Slider" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2023 NITSAN Technologies <sanjay@nitsan.in>
 *
 ***/

/**
 * NewsSlickSliderController
 */
class NewsSlickSliderController extends NewsController
{
    /**
     * @var NewsRepository
     */
    protected NewsRepository $newsRepository;

    /**
      * action list
      *
      * @return ResponseInterface
      */
    public function slickSliderAction(): ResponseInterface
    {
        $newsParam = $this->request->getQueryParams()['tx_news_pi1'] ?? null;
        if ($this->settings['singleNews']) {
            $newsId = $this->settings['singleNews'];
        } else {
            $newsId = $newsParam['news'] ?? 0;
        }

        $news = $this->newsRepository->findByUid($newsId);
        $this->view->assign('newsItem', $news);
        return $this->htmlResponse();
    }
}

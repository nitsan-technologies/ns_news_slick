# customsubcategory=01_Template=Template
# customsubcategory=02_JS=JQuery Library

plugin.tx_nsnewsslick {
    view {
        # cat=News Slick Slider/01_Template/01; type=string; label=Path to template root (FE)
        templateRootPath = EXT:ns_news_slick/Resources/Private/Templates/
        # cat=News Slick Slider/01_Template/02; type=string; label=Path to template partials (FE)
        partialRootPath = EXT:ns_news_slick/Resources/Private/Partials/
        # cat=News Slick Slider/01_Template/03; type=string; label=Path to template layouts (FE)
        layoutRootPath = EXT:ns_news_slick/Resources/Private/Layouts/
    }
    includejs {
        # cat=News Slick Slider/02_JS/04; type=boolean; label=Include Jquery
        includeJquery =
    }
}

plugin.tx_nsnewsslick {
    view {
        templateRootPaths.0 = EXT:ns_news_slick/Resources/Private/Templates/
        templateRootPaths.1 = {$plugin.tx_nsnewsslick.view.templateRootPath}
        partialRootPaths.0 = EXT:ns_news_slick/Resources/Private/Partials/
        partialRootPaths.1 = {$plugin.tx_nsnewsslick.view.partialRootPath}
        layoutRootPaths.0 = EXT:ns_news_slick/Resources/Private/Layouts/
        layoutRootPaths.1 = {$plugin.tx_nsnewsslick.view.layoutRootPath}
    }
    settings {
        detail {
            media {
                image{
                    maxWidth = 550
                    maxHeight =
                }
            }
        }
    }
}

page {
    includeCSS {
        slick = EXT:ns_news_slick/Resources/Public/css/slick.css
        slicktheme = EXT:ns_news_slick/Resources/Public/css/slick-theme.css
        nsslick = EXT:ns_news_slick/Resources/Public/css/nsslick.css
    }
    includeJSFooter {
        slickjs = EXT:ns_news_slick/Resources/Public/js/slick.js
    }
    settings < plugin.tx_nsnewsslick.settings
}

[globalVar = LIT:1 = {$plugin.tx_nsnewsslick.includejs.includeJquery}]
    page {
        includeJS {
            JQuery = EXT:ns_news_slick/Resources/Public/js/jquery-3.4.1.min.js
        }
    }
[global]
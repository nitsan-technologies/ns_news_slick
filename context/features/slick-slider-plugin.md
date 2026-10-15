# Feature — Slick slider plugin

*Status: Done (free version). Code-read (2026-10-15); content element, edit form and Page module preview seen on
v14.3.7, frontend not tested.*

## Editor flow

1. Add the content element "News Slick Slider" (wizard group plugins, CType `nsnewsslick_newsslickslider`).
2. Tab "Configuration", sheet "Settings": pick one news record (`settings.singleNews`); without it the plugin
   uses `tx_news_pi1[news]` from the URL, so it can sit on a news detail page.
3. Sheet "Slick Slider Configuration": slider type and options (see below).
4. Include the static template "News Slick Slider" or the site set `nitsan/ns-news-slick`.

## Rendering

- `slickSliderAction()` loads the news record and assigns `newsItem`. The template is a news detail view (title,
  date, categories, teaser, content elements, body, optional Opengraph / prev-next) with the record's
  non-preview media (`mediaNonPreviews`) in `<section class="slider" id="nsslick-<content uid>">`.
- `<slick:LoadAssets />` (layout) turns the FlexForm options into a `$('#nsslick-<uid>').slick({…})` call added as
  footer inline JS; `nsslick.js` shows the hidden `.slider` sections on document ready.
- jQuery must be available: included by the extension when `includeJquery` (classic) or
  `ns_news_slick.configuration.jQuery` (site set) is on.

## Slider options (`settings.*`, sheet "Slick Slider Configuration")

| Option | Notes |
|---|---|
| `slicksliderType` | `single`, `multiple`, `responsive` (reloads the form) |
| `slideToShow`, `slideToScroll`, `variableWidth` | Not for `single` |
| `transitionType` (fade/move), `autoScaleSlider` (adaptive height) | Only `single` |
| `slideSpeed`, `dots`, `loop`, `autoPlay` → `autoplaySpeed`, `pauseOnHover` | All types; speed only without autoplay |
| `centerMode` → `centerPadding` | `multiple` and `responsive` |

`responsive` adds fixed breakpoints (1024: 3 slides, 600: 2, 480: 1).

## Settings

| Classic constant | Site set setting |
|---|---|
| `plugin.tx_nsnewsslick.view.{templateRootPath,partialRootPath,layoutRootPath}` | `ns_news_slick.view.*` |
| `plugin.tx_nsnewsslick.includejs.includeJquery` | `ns_news_slick.configuration.jQuery` |

## Page module preview

Core's standard preview (header) + premium strip; the extension's own `NsNewsSlick.html` preview is not used
(see `core.md`).

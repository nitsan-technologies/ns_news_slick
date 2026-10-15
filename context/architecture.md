# ns_news_slick — Architecture

One Extbase content-element plugin (`nsnewsslick_newsslickslider`, action `slickSlider`, cached), no tables,
no backend module. Backend additions: FormEngine resolver and Page module preview listener for the premium
strip.

## Configuration

| File | What |
|---|---|
| `ext_localconf.php` | Plugin `NsNewsSlick`/`Newsslickslider` as `PLUGIN_TYPE_CONTENT_ELEMENT`; FormEngine `nodeResolver` 1792057164 (`flexFormTabsContainer`, priority 42) |
| `Configuration/TCA/Overrides/tt_content.php` | `registerPlugin()` (group `plugins`), "Configuration" tab with `pi_flexform`, `addPiFlexFormValue()` (see `core.md`) |
| `Configuration/FlexForms/PluginSettings.xml` | Four sheets: Settings (news labels: `singleNews`, `previewHiddenRecords`, `startingpoint`, `recursive`), Additional (`detailPid`, `listPid`, `backPid`, `tags`, `excludeAlreadyDisplayedNews`, `disableOverrideDemand`), Template (`cropMaxCharacters`, `templateLayout`, …), Slick Slider Configuration (slider options) |
| `Configuration/page.tsconfig` | Wizard item in group `plugins`. Loaded globally by core since v12; the site set imports it again |
| `Configuration/TCA/Overrides/sys_template.php` | Static template "News Slick Slider" (`Configuration/TypoScript`) |
| `Configuration/TypoScript/` | Constants `plugin.tx_nsnewsslick.{view,includejs}.*`; setup: view paths, `settings.detail.media.image.maxWidth = 550`, global `page.includeCSS` / `includeJSLibs` / `includeJSFooter` |
| `Configuration/Sets/NsNewsSlick/` | Site set `nitsan/ns-news-slick`; 4 settings (`ns_news_slick.view.*`, `ns_news_slick.configuration.jQuery`); setup imports the classic setup and overrides view paths and jQuery |
| `Configuration/Services.yaml` | Autowires `Classes/*`; tags `Event\PageLayoutView` (`ns-news-slick-flexform-process`) and `EventListener\PremiumStripPreview` (`ns-news-slick/premium-strip-preview`, after the former) |
| `Configuration/Icons.php` | `ns_news_slick-plugin-newsslickslider` |

## Classes

| Class | Role |
|---|---|
| `Controller\NewsSlickSliderController` | Extends news `NewsController`; `slickSliderAction` loads `settings.singleNews` or `tx_news_pi1[news]` from the query |
| `ViewHelpers\LoadAssetsViewHelper` | `<slick:LoadAssets />` in the layout; builds the Slick init JS per element (`#nsslick-<uid>`) and adds it as footer inline code |
| `Event\PageLayoutView` | Legacy Fluid preview for `list_type` elements (never fires for the CType, see `core.md`) |
| `Updates\PluginMigration` | Upgrade wizard `txNsNewsSlickPluginMigration`: `list` + `list_type` → CType |
| `Backend\PremiumStrip` | Strip HTML + trial URL; `''` when the ns_license route is missing |
| `Form\Resolver\PremiumStripFlexFormTabsContainerResolver` | Picks the strip container for `pi_flexform` of the plugin |
| `Form\Container\PremiumStripFlexFormTabsContainer` | Core multi-sheet FlexForm container + strip |
| `EventListener\PremiumStripPreview` | Strip in the Page module preview (`PageContentPreviewRenderingEvent`) |

## Views

- Frontend: `Templates/NewsSlickSlider/SlickSlider.html` → `Layouts/Default.html` →
  `Partials/Detail/{MediaContainer,MediaImage,MediaVideo,Opengraph,Shariff}.html`, `Partials/Category/Items.html`.
- Backend: `Resources/Private/Backend/NsNewsSlick.html` (not used, see `core.md`).

## Assets

- Frontend: `css/{slick.css,slick-theme.css,nsslick.css,font-awesome.css}`, `js/{jquery-3.4.1.min.js,slick.js,
  nsslick.js}`, `fonts/`, `css/fonts/`, `Icons/`.
- Backend: `css/backend-premium-strip.css`.

# Feature — Premium strip and ns_license free trial

*Status: Done. Verified live on TYPO3 14.3.7 (2026-10-15): strip in the Page module preview and above the
FlexForm sheet tabs (tab "Configuration"); the button opens the ns_license module with "Slick Slider
(ns_news_slick)" preselected in the trial modal. Requires ns_license 14.5.4 (deep-link support) to be released.
v12/v13 not tested.*

## Licensing status

Freemium. Premium product (T3Planet catalog): "Slick Slider", €79,
https://t3planet.de/en/typo3-slick-slider-extension (not linked from the UI; the trial stays inside the TYPO3
backend). Catalog features: touch swipe, infinite looping, autoplay controls, dots and arrow navigation,
unlimited slider images, single and multiple slides, mouse drag.

## Dependency

`composer.json` `"nitsan/ns-license": "^14.5.4"`, `ext_emconf.php` `'ns_license' => '14.5.4-14.9.99'`. Does not
raise the minimum TYPO3 version (see `core.md`).

## Placements

| Place | Position |
|---|---|
| Page module, preview of a News Slick Slider content element | Below the element header, as the preview body |
| Content element edit form, tab "Configuration" | Above the FlexForm sheet tabs (Settings, Additional, Template, Slick Slider Configuration) |

## How it works

- `Backend\PremiumStrip::render()`: `actions-rocket` icon, headline and description on two lines,
  `btn btn-primary` "Start Free Trial →" (the arrow is `aria-hidden` markup). Link = route
  `nitsan_nslicensemodule` + `trial=ns_news_slick` + `#free-section`, same frame. Returns `''` without
  ns_license, so neither placement shows anything.
- Preview: `EventListener\PremiumStripPreview` on `PageContentPreviewRenderingEvent` (tagged in `Services.yaml`,
  ordered after the extension's own `ns-news-slick-flexform-process`) prepends the strip to any existing preview
  content and adds the stylesheet through `PageRenderer`. It matches the CType (record type from
  `getRecordType()` on v13+, the row's `CType` on v12) and legacy `list` + `list_type`. For the CType the strip
  replaces core's standard preview body, which is empty for plugins apart from warnings.
- Edit form: `ext_localconf.php` registers `Form\Resolver\PremiumStripFlexFormTabsContainerResolver` for node
  `flexFormTabsContainer`, priority **42** (taken: ns_revolution_slider 40, ns_news_slider 41, ns_google_map 43; duplicates make
  core throw). It matches `tt_content.pi_flexform` of CType `nsnewsslick_newsslickslider` (or legacy `list` +
  `list_type`), not inline children, and returns `Form\Container\PremiumStripFlexFormTabsContainer`, which
  prepends the strip and adds the stylesheet. Core only uses `flexFormTabsContainer` for FlexForms with more than
  one sheet; if the FlexForm is reduced to one sheet the strip disappears from the form.

## Strip

- Labels in `locallang.xlf`: `premium.strip.headline` "You're using the free version of NS News Slick Slider",
  `premium.strip.description` "Unlock premium features and get more out of NS News Slick Slider.",
  `premium.strip.trial` "Start Free Trial".
- `Resources/Public/css/backend-premium-strip.css`: `.ns-news-slick-premium-strip` — team-wide design
  (light-blue card `#e7f2fc`, border `#8eb6e8`, 4px `#2b6cb0` left accent, 6px radius, padding 14px 18px,
  `light-dark()` for dark mode, button `#007bff` / hover `#0062cc`); inset 16px inside the FlexForm panel.
- Measured on v14.3.7: 849×67px in the edit form (883px panel); 482×119px in the Page module preview, where the
  button wraps below the text.
- ns_license's module requires system maintainer access; other users get access denied after clicking.

# ns_news_slick — Core facts

## Identity

| Item | Value |
|---|---|
| Extension key | `ns_news_slick` |
| Composer name | `nitsan/ns-news-slick` |
| Title (ext_emconf) / product name | News Slick Slider / Slick Slider |
| Namespace | `NITSAN\NsNewsSlick\` → `Classes/` (the upgrade wizard is declared as `Nitsan\…`, see known issues) |
| Version (ext_emconf) | 14.1.0 (latest tag 14.0.0) |
| Repository | https://github.com/nitsan-technologies/ns_news_slick (default branch `master`) |
| Licensing status | **Freemium** — this repo is the free version; a paid premium version exists in the T3Planet catalog (the NITSAN Free/Freemium sheet needs a Google login) |
| Premium version (T3Planet catalog) | "Slick Slider", €79, https://t3planet.de/en/typo3-slick-slider-extension |

## Compatibility

| Source | TYPO3 | news | PHP |
|---|---|---|---|
| `ext_emconf.php` | `12.4.37-14.9.99` | `13.0.0-14.9.99` | not declared |
| `composer.json` | `^12.4.37 \|\| ^13 \|\| ^14` | `^13 \|\| ^14` | not declared |
| ns_license 14.5.4 (dependency) | `12.4.18-14.9.99` | — | not declared (TYPO3 12.4 needs 8.1+) |

- ns_license does not raise the minimum: TYPO3 12.4.37, PHP 8.1.
- Tested here: TYPO3 14.3.7 with news 14.1.1.

## Dependencies

| Package | Constraint | Why |
|---|---|---|
| `typo3/cms-core` | see above | core |
| `georgringer/news` / `news` | `^13 \|\| ^14` / `13.0.0-14.9.99` | Controller extends `NewsController`, news ViewHelpers and labels |
| `nitsan/ns-license` / `ns_license` | `^14.5.4` / `14.5.4-14.9.99` | TYPO3 Shop module + free-trial deep link (see `features/premium-cta.md`) |

Bundled frontend libraries (no package manager): jQuery 3.4.1, Slick (`slick.js`, `slick.css`,
`slick-theme.css`), Font Awesome.

## Tooling

- No PHPUnit, PHPStan, CS fixer or package.json in the repo. `composer.json` has a `.Build/` vendor/web-dir
  config for standalone installs.
- CI: `.github/workflows/ter-release.yml` only (publishes tags to TER with tailor; PHP 7.4, deprecated
  `set-output`).
- `.gitattributes` export-ignores `.github/`, `.gitignore`, `AGENTS.md`, `CLAUDE.md`, `context/`, `tasks/` and
  itself, so they are not in the GitHub/Composer archive or the TER package (the TER release uploads the GitHub
  tag archive).
- Translations: only English sources (`locallang.xlf` frontend + premium strip, `locallang_db.xlf`
  plugin/FlexForm); no Crowdin config.

## Conventions

- PHP: 4 spaces; the controller, upgrade wizard and premium-strip classes use `declare(strict_types=1)`,
  `Event\PageLayoutView` and `LoadAssetsViewHelper` do not.
- TypoScript: 4 spaces; Fluid, XLF and FlexForm: tabs (some FlexForm lines use spaces).
- Frontend assets in lowercase folders `Resources/Public/{css,js,fonts}/`; backend CSS
  `Resources/Public/css/backend-premium-strip.css`.

## Known issues (existing, not fixed)

All code-read unless marked.

- **Own Page module preview never used (seen live on 14.3.7):** `Event\PageLayoutView` only handles
  `CType = list` + `list_type = nsnewsslick_newsslickslider`, but the plugin is a CType, so core shows its
  standard preview. For not yet migrated elements on v13+ it would fail: `getFluidTemplate()` returns the
  rendered string instead of a view, and `$flexFormService` is unset when `pi_flexform` is empty. The template
  `Backend/NsNewsSlick.html` uses `locallang_db.xl` (missing `f`) for most labels and repeats the
  `excludeAlreadyDisplayedNews` label for `disableOverrideDemand`.
- `Updates/PluginMigration` declares namespace `Nitsan\NsNewsSlick\Updates` while PSR-4 maps `NITSAN\`; it only
  loads because the DI sweep requests it as `NITSAN\…` and PHP class names are case-insensitive.
- `tt_content.php` calls `addPiFlexFormValue()` (deprecated in TYPO3 14) and adds a "Configuration" tab; on v14
  the plugin options appear there (seen live).
- Frontend CSS/JS (`slick.css`, `slick-theme.css`, `nsslick.css`, `slick.js`, `nsslick.js`, optional jQuery) are
  added to every page via `page.includeCSS` / `includeJSFooter`, not only pages with the plugin.
- jQuery default differs: classic constant `includeJquery` is empty (off), site set `configuration.jQuery`
  defaults to on.
- `LoadAssetsViewHelper` builds an unused `extPath` to the missing folder `Resources/Public/slider/`.
- Fonts exist twice (`Resources/Public/fonts/` and `Resources/Public/css/fonts/`).
- README badges show v1.0.2 / TYPO3 12 and GPL-3.0 and link t3terminal; `composer.json` uses the deprecated SPDX
  id `GPL-2.0+`; `.gitignore` lists `.git` and `.gitlab-ci`.

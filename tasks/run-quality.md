# Run quality checks

The repo has no PHPUnit, PHPStan or CS config. Available checks:

```bash
# PHP syntax; also run once with PHP 8.1, the lowest version TYPO3 12 supports
for f in $(find . -name "*.php" -not -path "./.git/*" -not -path "./.Build/*"); do php -l "$f"; done

# composer.json
composer validate --no-check-publish

# XLF well-formedness
for f in Resources/Private/Language/*.xlf; do xmllint --noout "$f"; done
```

## Manual test (per TYPO3 major 12 / 13 / 14, with news 13 and 14)

1. Page module, page with a "News Slick Slider" content element: strip below the element header (on every page,
   with or without the site set).
2. Edit the element, tab "Configuration": strip above the FlexForm sheet tabs. Other plugins' FlexForms show no
   ns_news_slick strip (other NITSAN strips may appear for their own plugins).
3. "Start Free Trial" (as system maintainer) opens the ns_license module and its trial modal with
   "Slick Slider (ns_news_slick)" preselected. Cancel; don't start a trial.
4. Deactivate ns_license (test system only): both placements show nothing and the form still saves.
5. Frontend: a news record with several images, each slider type (single, multiple, responsive) with autoplay,
   dots and loop; with and without the jQuery option.
6. Check light and dark backend themes.

Remove test content elements afterwards.

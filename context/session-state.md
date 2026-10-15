# ns_news_slick — Session state

## 2026-10-15 — ns_license integration + premium strip + agent context

- Branch `feature/ns-license-premium-strip` from `master` (0ba5532).
- Added `nitsan/ns-license ^14.5.4` / `ns_license 14.5.4-14.9.99` (minimum stays TYPO3 12.4.37). Version
  14.0.0 → 14.1.0.
- Premium strip with "Start Free Trial" → ns_license module `?trial=ns_news_slick#free-section` in the Page
  module preview (event listener, because the extension's own preview never fires for the CType) and above the
  FlexForm sheet tabs (tab "Configuration"), team-wide wording and design (see `features/premium-cta.md`).
- Verified live on TYPO3 14.3.7 classic with a temporary element on page 1 and a temporary system-maintainer
  admin (both removed; `settings.php` restored byte-identical). PHP 8.4 and 8.1 lint clean.
- Created agent context and `.gitattributes`; no previous context existed. Added "ns_news_slick 42" to the
  `flexFormTabsContainer` lists in ns_revolution_slider and ns_news_slider.
- Open: ns_license 14.5.4 not yet published; v12/v13 not tested; frontend only code-read.

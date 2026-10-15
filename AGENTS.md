# AGENTS.md — ns_news_slick (News Slick Slider)

Agent router for the News Slick Slider free extension. Load only what your task needs.

> **Principles:** `context/principles.md`
> **Session log:** `context/session-state.md`
> **Doc index:** `context/docs-map.md`

---

## Always load

| File | Why |
|---|---|
| `context/principles.md` | Guardrails, "nothing that works may break" rule |
| `context/core.md` | Identity, TYPO3/PHP/news/ns_license constraints, tooling, known issues |

---

## Task router

| Task | Load |
|---|---|
| Slick slider plugin: FlexForm, news item selection, slider options, frontend JS/CSS, TypoScript / site set, Page module preview | `context/features/slick-slider-plugin.md` |
| Premium strip / free trial / ns_license dependency | `context/features/premium-cta.md` |
| Files, classes, TypoScript structure, assets | `context/architecture.md` |
| Lint / validate / manual test | `tasks/run-quality.md` |
| Update agent context after a change | `tasks/context-update.md` |

---

## Feature status

| Feature | Status | Agent entry |
|---|---|---|
| Slick slider of one news record's media (single, multiple, responsive) | Done (code-read; edit form seen on v14.3.7) | `context/features/slick-slider-plugin.md` |
| Premium strip in the Page module preview and the plugin options + ns_license free-trial deep link | Done (needs ns_license 14.5.4 release) | `context/features/premium-cta.md` |

---

## Quick commands

```bash
cd packages/ns_news_slick          # or typo3conf/ext/ns_news_slick in Classic mode
for f in $(find . -name "*.php" -not -path "./.git/*"); do php -l "$f"; done
composer validate --no-check-publish
for f in Resources/Private/Language/*.xlf; do xmllint --noout "$f"; done
```

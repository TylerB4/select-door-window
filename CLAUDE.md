# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is a static website for **Select Door & Window**, a family-owned door and window contractor in Escondido, CA.

There is no build system, no package manager, no framework, and no server. Open any HTML file directly in a browser to develop and preview.

## Active Site: `SDWWebsite/`

The current working version lives in `SDWWebsite/` as a proper multi-page site:

| File | Page |
|---|---|
| `index.html` | Home — hero slideshow, service preview, brands, contact form |
| `services.html` | Services — 4 service cards, quote form |
| `products.html` | Products — 6 brand cards |
| `gallery.html` | Gallery — accordion + lightbox |
| `about.html` | About — story, showroom, family banner, values |
| `styles.css` | All shared CSS |
| `scripts.js` | Shared JS: mobile menu + scroll reveal |

The original `select_door_window.html` at the repo root is a legacy single-file SPA — kept for reference, not the active version.

## Architecture

No JavaScript framework — plain HTML, CSS, and vanilla JS. No external dependencies beyond two Google Fonts.

**Shared patterns (styles.css / scripts.js):**
- **CSS custom properties** (`--navy`, `--gold`, `--cream`, etc.) defined on `:root` drive the entire color palette. All style changes should use these variables.
- **Scroll reveal animations** use IntersectionObserver with `.reveal`, `.reveal-left`, `.reveal-right`, `.reveal-scale` classes. Elements animate in when they enter the viewport. Wired in `scripts.js`.
- **Mobile menu** (`#mobileMenu`) is `display: none` at desktop by default; shown as `display: flex` via `.open` class on mobile. Toggle functions `openMobileMenu()` / `closeMobileMenu()` are in `scripts.js`.
- **Service bullets** use `content: '\2736'` in CSS `::before` — keep as a CSS string literal, not a raw Unicode character.

**Page-specific JS (inline in each file):**
- `index.html` — Hero slideshow (IIFE using `setInterval` + `requestAnimationFrame` for the progress bar) and counter animation for the "15+" / "3,000+" stats.
- `gallery.html` — `galleryData` object, `buildGallery()`, accordion `togglePanel()`, lightbox open/close/navigate. `currentCategory` (array) and `currentIndex` (int) are module-level vars. Arrow key + Escape keyboard nav wired to `keydown`.

**Navigation** uses real `href` links between pages. Each page hardcodes `class="active"` on its own nav link.

## Customization Points

- **Photos**: Replace Unsplash URLs in `galleryData` in `gallery.html` and the `.hero-slide` background-image styles in `index.html`.
- **Contact info**: Phone, email, and address appear across multiple files — search for `760-432-0206` and `office@selectdw.com`.
- **Hero stats**: Counter targets for "15+" and "3,000+" are set in the inline `<script>` at the bottom of `index.html`.

## The `old/` Directory

Three prior HTML iterations of the site. Historical reference only — not deployed, not linked.

## Session State

_Updated automatically at session end. Resume here next time._

- **Branch:** `fix/service-bullets-unicode`
- **Last worked on:** Split single-file site into `SDWWebsite/` multi-page structure; fixed double-header bug (`display:none` on `.mobile-menu`); added `CLAUDE.md`; configured Stop hook to auto-update this section
- **Open:** PR not yet created — `gh` CLI not installed; open manually at `https://github.com/TylerB4/select-door-window/compare/fix/service-bullets-unicode`
- **Next session:** Merge or continue work on `SDWWebsite/`; install `gh` CLI if PR creation via terminal is wanted

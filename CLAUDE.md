# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is a static, single-file website for **Select Door & Window**, a family-owned door and window contractor in Escondido, CA. The entire site lives in one HTML file: `select_door_window.html`.

There is no build system, no package manager, no framework, and no server. Open `select_door_window.html` directly in a browser to develop and preview.

## Architecture

The site is a single-page application implemented entirely in one HTML file with no external dependencies beyond two Google Fonts. Navigation between the five "pages" (Home, Services, Products, Gallery, About) works by toggling a CSS `active` class — only the active `.page` div is shown (`display: block`); the rest are hidden (`display: none`). The `showPage(name)` function handles all navigation.

**Key structural patterns:**
- **CSS custom properties** (`--navy`, `--gold`, `--cream`, etc.) drive the entire color palette and are defined on `:root`. All styling changes should use these variables.
- **Scroll reveal animations** use IntersectionObserver with `.reveal`, `.reveal-left`, `.reveal-right`, `.reveal-scale` classes. Elements animate in when they enter the viewport. A `MutationObserver` re-registers elements when pages switch, since off-screen pages are hidden and elements may not have been observed yet.
- **Hero slideshow** is a self-contained IIFE at the bottom of `<script>` using `setInterval` + `requestAnimationFrame` for the progress bar.
- **Gallery** is data-driven: `galleryData` object maps category keys (`entry`, `windows`, `patio`, `interior`) to arrays of `{ src, label }`. `buildGallery()` generates DOM from this data at page load. To swap photos, edit only `galleryData`.
- **Lightbox** tracks `currentCategory` (array) and `currentIndex` (int) as module-level vars; arrow key navigation is wired in a `keydown` listener.
- **Service bullets** use the CSS `::before` pseudo-element with `content: '\2736'` (✶) — this is a Unicode escape that must stay as a CSS string literal, not a raw character.

## Customization Points

- **Photos**: Replace Unsplash URLs in `galleryData` (JS, ~line 1074) and in `.hero-slide` background-image styles (~line 641) with own hosted images.
- **Contact info**: Phone, email, and address appear in multiple sections — search for `760-432-0206` and `office@selectdw.com` to find all instances.
- **Stats**: "15+" and "3,000+" in the hero are animated by `statObserver`; the counter targets are set inline in the observer callback (~line 1284).

## The `old/` Directory

Contains three prior HTML iterations of the site (`select_door_window_no_testimonials.html`, `select_door_window_multipage.html`, `select_door_window_hero_update.html`). These are historical references — not deployed, not linked.

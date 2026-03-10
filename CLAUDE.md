# ACM Chapter Theme — Claude Context

This is a WordPress theme designed to be reusable across any ACM (Association for Computing Machinery) professional chapter. One install, configure city + social links via the WordPress Customizer, and the site is ready. No page builder — pure PHP templates + vanilla CSS.

## What you're working with

- **WordPress child theme** — PHP templates, no build step, no npm, no compiled assets
- **CSS variables** for all design tokens — one file to restyle everything
- **PHP helper functions** for all location-aware text — no hardcoded city/state in templates
- **WordPress Customizer** for non-developer configuration (city, state, email, social links)
- **Custom Post Types** (CPTs) for Events and Officers — managed in WP Admin
- **Slug-based template loading** — WordPress auto-loads `page-{slug}.php` for matching pages

## Directory structure

```
acm-chapter-theme/
├── style.css                     Theme registration header (Name, Version, Text Domain)
├── functions.php                 Everything: CPTs, meta boxes, Customizer, helper functions, page auto-creation
├── header.php                    Site header + nav (fallback menu hardcoded here)
├── footer.php                    Footer: logo, nav columns, dynamic social icons
├── front-page.php                Homepage — hero, pillars, membership section, events preview
├── page-about.php                About page (auto-loaded for slug: about)
├── page-contact.php              Contact page (auto-loaded for slug: contact)
├── page-events.php               Events listing — upcoming + past, paginated (auto-loaded for slug: events)
├── page-membership.php           Membership page — benefits, pricing, FAQ (auto-loaded for slug: membership)
├── page-officers.php             Officers page with role selector UI (auto-loaded for slug: officers)
├── single-acm_event.php          Single event detail view
├── index.php                     WordPress fallback — renders if no other template matches
├── assets/images/                All bundled images (logos, social icons, hero banner)
├── css/
│   ├── variables.css             ← ALL design tokens live here (colors, spacing, type scale)
│   ├── layout.css                Sections, hero, cards, events, contact, membership CSS
│   ├── typography.css            Headings, body text, eyebrow labels
│   ├── buttons.css               Button variants (btn-blue, btn-gold, btn-outline, etc.)
│   ├── header.css                Site header + nav styles
│   ├── footer.css                Footer grid + social icon styles
│   └── responsive.css            All breakpoint overrides
├── js/main.js                    Mobile nav toggle + smooth scroll only
├── page-templates/events.php     Legacy paginated events template (kept for reference)
└── template-parts/event-card.php Reusable event card — used on homepage + events page
```

## How the location system works

**Never hardcode city or state names in templates.** All location text goes through helper functions defined at the bottom of `functions.php`:

| Function | Returns | Example |
|---|---|---|
| `acm_chapter_city()` | City name from Customizer | `Austin` |
| `acm_chapter_state()` | State abbreviation | `TX` |
| `acm_chapter_city_state()` | "City, ST" | `Austin, TX` |
| `acm_chapter_city_area()` | "the City area" | `the Austin area` |
| `acm_chapter_name()` | "ACM City" | `ACM Austin` |
| `acm_chapter_email()` | Contact email or empty string | `info@austin.acm.org` |

Usage in templates:
```php
<h1>Welcome to <?php echo acm_chapter_name(); ?></h1>
<p>Serving computing professionals in <?php echo acm_chapter_city_area(); ?>.</p>
```

The city/state values come from **Appearance → Customize → ACM Chapter Settings → Chapter Identity**. Social links and email come from the **Contact & Social Links** section in the same panel.

## Design system

### Changing colors

Edit `css/variables.css` — this is the only file you need to touch for a full rebrand:

```css
--blue:      #0062A3;   /* Primary brand color — nav, buttons, accents */
--blue-dark: #002855;   /* Dark navy — hero backgrounds, headings */
--gold:      #F7A800;   /* Accent — CTA buttons, highlights */
```

### Spacing

All spacing uses CSS custom properties: `--space-1` (4px) through `--space-20` (80px). Use these in any new CSS rather than raw pixel values.

### Typography

- `--font-serif`: Merriweather — used for display headings (`h1`, `h2`, price amounts)
- `--font-sans`: Source Sans 3 — used for body text, labels, buttons, nav

Font sizes use `--text-xs` through `--text-hero`. The hero size uses `clamp()` for fluid scaling.

### Button classes

Defined in `css/buttons.css`:
- `.btn.btn-blue` — primary blue fill
- `.btn.btn-gold` — gold fill, used for primary CTAs
- `.btn.btn-outline` — bordered, transparent background
- `.btn.btn-outline-light` — bordered white, for dark backgrounds
- `.btn.btn-ghost` — text-only with subtle border
- `.btn.btn-block` — full-width
- `.btn.btn-rsvp` — compact RSVP button used on event cards

### Section patterns

Most page sections follow this structure:
```html
<section class="section [section-alt|section-light|section-cta]">
    <div class="section-inner [section-inner--center]">
        <span class="eyebrow">Label</span>
        <h2 class="section-title">Heading</h2>
        <p class="section-sub">Subtext</p>
        <!-- content -->
    </div>
</section>
```

Background variants: `.section` (white), `.section-light` (light gray), `.section-alt` (very light gray), `.section-cta` (dark navy with light text).

## How to make common changes

### Change a color sitewide
Edit the variable in `css/variables.css`. For example, to change the primary blue:
```css
--blue: #1A73E8;
```
This automatically updates buttons, nav links, card accents, and all other blue elements.

### Add a new section to the homepage
1. Open `front-page.php`
2. Copy an existing `<section class="section ...">` block as a starting point
3. Add your content inside `.section-inner`
4. Use existing CSS classes from `css/layout.css` wherever possible
5. For new layout patterns, add CSS at the bottom of `css/layout.css`

### Change static body copy (hero text, membership price, FAQ answers, etc.)
The homepage and inner pages have hardcoded copy in their PHP template files. The WP Admin page editor does not affect these pages — templates override it entirely.

Edit the text directly in the relevant PHP file:
- Hero headline/subtext → `front-page.php` (~line 14–15)
- Membership price ($150) → `front-page.php` and `page-membership.php` (search `$150`)
- Pillar card descriptions → `front-page.php`, inside `.pillars-grid`
- FAQ answers → `page-membership.php`, inside `.faq-list`
- About page mission text → `page-about.php`, inside `.about-mission-text`
- Contact card descriptions → `page-contact.php`, inside each `.contact-card`

**Important:** Only edit the human-readable text between HTML tags. Leave `<?php ... ?>` blocks untouched — those pull in Customizer values.

### Add a new page with its own template
1. Create `page-{slug}.php` in the theme root (copy `page-about.php` as a starting point)
2. Add the slug to the `$pages` array in `acm_chapter_create_pages()` in `functions.php` — this auto-creates the WP page on next theme activation/re-activation
3. Use `get_header()` at the top and `get_footer()` at the bottom

### Change the navigation links
The site uses WordPress's built-in nav menu system. If no menu is assigned in **Appearance → Menus**, the fallback hardcoded in `header.php` (`acm_chapter_fallback_menu()`) is shown. Edit that function to change fallback links, or assign a proper WP menu via WP Admin.

### Add or change footer columns
Edit `footer.php`. Each column is a `.footer-col` div with an `<h4>` heading and a `<ul>` list. The social icons are dynamic — they only render if their URL is set in the Customizer.

### Change the hero banner image
The hero background is set inline in `front-page.php`:
```php
<div class="hero-bg" style="background-image: url('<?php echo esc_url( get_template_directory_uri() . '/assets/images/acm_desktopbanner.jpeg' ); ?>');"></div>
```
Replace `acm_desktopbanner.jpeg` with a new image filename and drop the image into `assets/images/`.

### Add a Customizer setting
All Customizer settings are registered in `acm_chapter_customizer()` in `functions.php`. Follow the existing pattern:
```php
$wp_customize->add_setting( 'acm_chapter_my_field', [
    'default'           => '',
    'sanitize_callback' => 'sanitize_text_field',
    'transport'         => 'refresh',
]);
$wp_customize->add_control( 'acm_chapter_my_field', [
    'label'   => __( 'My Field', 'acm-chapter' ),
    'section' => 'acm_chapter_identity',  // or 'acm_chapter_social'
    'type'    => 'text',
]);
```
Then read it in any template with `get_theme_mod( 'acm_chapter_my_field', 'default' )`.

## Events system

Events are a Custom Post Type (`acm_event`) with meta fields:
- `_event_date` (YYYY-MM-DD) — used for sorting and upcoming/past split
- `_event_time` (text)
- `_event_location` (text)
- `_event_rsvp_url` (URL)
- `_event_ticket` (text, e.g. "Free for Members")

The events page (`page-events.php`) queries these directly with `WP_Query`. The homepage shows the 3 nearest upcoming events via `template-parts/event-card.php`.

Single event view uses `single-acm_event.php`.

## Officers system

Officers are a Custom Post Type (`acm_officer`, non-public — no individual URLs) with meta fields:
- `_officer_title` — role/title shown on card
- `_officer_duties` — responsibilities text
- `_officer_email`
- `_officer_linkedin`
- `_officer_order` — numeric, controls display order (1 = first)

The featured image is the officer's photo. Officers without a photo show a colored initial avatar (CSS-generated).

## What auto-creates on theme activation

`acm_chapter_create_pages()` in `functions.php` runs on `after_switch_theme` and creates these pages if they don't already exist: `home`, `about`, `events`, `officers`, `membership`, `contact`. It also sets the `home` page as the static front page via `show_on_front` and `page_on_front` options.

## CSS load order

WordPress enqueues CSS in this order (all in `acm_chapter_enqueue_assets()` in `functions.php`):
1. Google Fonts
2. `variables.css` — design tokens, loaded first
3. `typography.css`
4. `layout.css`
5. `buttons.css`
6. `header.css`
7. `footer.css`
8. `responsive.css` — loaded last so breakpoints can override anything

## What NOT to change without care

- **`acm_event` and `acm_officer` CPT slugs** — changing these breaks existing data queries in templates and the rewrite rules in WordPress
- **Helper function names** (`acm_chapter_city`, etc.) — used throughout every template; renaming one requires updating all call sites
- **`_event_date` meta key** — used directly in `WP_Query` `meta_key` sorting in `page-events.php`, `front-page.php`, and `single-acm_event.php`
- **Page slugs** (`about`, `events`, etc.) — WordPress uses these for slug-based template loading; changing a slug means the template stops auto-loading
- **`text_domain` string `'acm-chapter'`** — must match the `Text Domain` header in `style.css` for translations to work

## Bundled images

All images are in `assets/images/` and referenced via `get_template_directory_uri()` — no CDN dependency:
- `acm_logo.gif` — desktop header logo
- `acm_logo_tablet.svg` — tablet header logo
- `acm_logo_mobile.svg` — mobile header logo
- `logo_footer_acm.png` — footer logo
- `acm_desktopbanner.jpeg` — hero background
- `linkedin.svg`, `twitter.svg`, `facebook.svg`, `youtube.svg`, `instagram.svg`, `mail.svg` — footer social icons

# ACM Chapter Theme

A professional WordPress theme for any ACM Professional Chapter. Install it once, enter your city name and social links in a settings panel, and the entire site updates automatically — no code needed for initial setup.

This theme gives you a full public-facing website with the following pages built in: **Home, About, Events, Officers, Membership, and Contact.**

---

## What you'll need before starting

- A WordPress site (version 6.0 or newer) — either on a live web host or a local development tool like [Local](https://localwp.com/)
- PHP 8.0 or newer (any modern web host supports this)
- Admin access to WordPress

---

## Step 1 — Get the theme

Download the latest ZIP file from the [Releases page](../../releases/latest).

You're looking for a file named `acm-chapter-theme-v1.x.x.zip`. Don't unzip it — WordPress will handle that during installation.

---

## Step 2 — Install the theme in WordPress

1. Log in to your WordPress Admin (usually `yoursite.com/wp-admin`)
2. Go to **Appearance → Themes**
3. Click **Add New Theme** (top of page) → then **Upload Theme**
4. Click **Choose File**, select the ZIP you downloaded, and click **Install Now**
5. Once installed, click **Activate**

The theme is now active. When you activate it, WordPress automatically creates all six pages for you (Home, About, Events, Officers, Membership, Contact) and sets the Home page as your front page. Your site is ready to configure.

---

## Step 3 — Enter your chapter's information

This is where you personalize the site for your chapter. Everything you set here updates automatically across all pages.

1. In WP Admin, go to **Appearance → Customize**
2. Click **ACM Chapter Settings** in the left panel

### Chapter Identity

| Field | What to enter | Example |
|---|---|---|
| **Chapter City** | Your city name only — no state | `Charlotte` |
| **State Abbreviation** | Two-letter state code | `NC` |

Once set, your city appears in every page's hero text, section headings, footer description, and body copy. You'll see a live preview on the right as you type.

### Contact & Social Links

| Field | Notes |
|---|---|
| **Contact Email** | Your chapter's public email address. Appears as a mail icon in the footer and on the Contact page. Leave blank to hide. |
| **LinkedIn URL** | Full URL to your chapter's LinkedIn page. Leave blank to hide the icon. |
| **Twitter / X URL** | Leave blank to hide. |
| **Facebook URL** | Leave blank to hide. |
| **YouTube URL** | Leave blank to hide. |
| **Instagram URL** | Leave blank to hide. |

Social icons only appear in the footer if a URL is entered. Empty fields are invisible to visitors.

3. Click **Publish** (top of Customizer panel) to save all changes.

---

## Step 4 — Add your officers

Officers appear on the Officers page with their photo, title, and role description.

1. In WP Admin, go to **Officers → Add New Officer**
2. **Title** (at the top): Enter the officer's full name
3. In the **Officer Details** box on the right, fill in:
   - **Title / Role** — e.g. "Chapter President"
   - **Duties** — a short description of their responsibilities
   - **Email** — officer's contact email (optional)
   - **LinkedIn URL** — officer's personal LinkedIn (optional)
   - **Display Order** — a number controlling their position on the page (1 = shown first)
4. **Featured Image** — click "Set featured image" to upload the officer's photo. If you skip this, the theme shows a color-coded initial avatar instead.
5. Click **Publish**

Repeat for each officer. The Officers page displays all published officers sorted by Display Order.

---

## Step 5 — Add your first event

Events appear on both the homepage (the 3 nearest upcoming events) and the Events page (all upcoming + all past, paginated).

1. In WP Admin, go to **Events → Add New Event**
2. **Title** (at the top): Enter the event name
3. In the **Event Details** box, fill in:
   - **Date** — in `YYYY-MM-DD` format (e.g. `2026-05-15`)
   - **Time** — plain text, e.g. "6:30 PM – 8:00 PM"
   - **Location** — venue name and/or address
   - **RSVP URL** — a link to your Eventbrite, Meetup, or registration form (optional)
   - **Ticket / Cost** — e.g. "Free for Members" or "$10 General Admission" (optional)
4. You can add a full event description in the main editor area (optional)
5. Click **Publish**

The event automatically sorts itself into "Upcoming" or "Past Events" based on its date relative to today.

---

## Step 6 — Review and customize your pages

At this point your site is live with real content. Walk through each page and decide what else needs to be adjusted.

### What you can change without touching any files

Everything in the Customizer (from Step 3) is live-editable anytime:
- Chapter city and state
- Contact email
- Social media links

### What requires opening a file

The following text is written directly into the theme's template files (`.php` files). The WordPress page editor does not affect this content — you must edit the file itself.

> **What is a PHP file?** PHP files are the actual templates that build your pages. You don't need to understand the code inside them — just find the plain English text between the tags and edit it, like changing words in a document.

| Content to change | File to open | What to search for |
|---|---|---|
| Hero headline ("Connecting Computing Professionals...") | `front-page.php` | Around line 14, inside `<h1>` |
| Hero paragraph under the headline | `front-page.php` | Line ~15, the `<p>` after `<h1>` |
| Three purpose pillar cards | `front-page.php` | The section with class `pillars-grid` |
| Annual membership price ($150) | `front-page.php` and `page-membership.php` | Search both files for `$150` |
| Membership benefits list | `front-page.php` and `page-membership.php` | Look for `benefits-list` or `membership-benefits-grid` |
| Membership FAQ questions & answers | `page-membership.php` | The section with class `faq-list` |
| About page mission statement | `page-about.php` | The section with class `about-mission-text` |
| Contact page card descriptions | `page-contact.php` | Each block with class `contact-card` |

#### How to open and edit a template file

**Option A — Using Local (local development, recommended):**

1. Open the Local app → click your site → click **Go to site folder**
2. Navigate to `app/public/wp-content/themes/acm-chapter-theme/`
3. Open the file in a text editor (VS Code is a good free option)
4. Find the text you want to change using the table above
5. Edit the plain English text — **do not change anything inside `<?php ... ?>` tags**
6. Save the file — the change shows up immediately

**Option B — Using the WordPress file editor (live sites):**

1. In WP Admin, go to **Appearance → Theme File Editor**
2. Select the file you need from the list on the right
3. Use your browser's Find function (`Cmd+F` / `Ctrl+F`) to locate the text
4. Make your edit and click **Update File**

> **Safety rule for both options:** Only edit the human-readable words between HTML tags. If you see `<?php echo something(); ?>`, leave it alone — that's what pulls in your city name, email, and other Customizer settings automatically.

---

## Step 7 — Replace the hero banner image (optional)

The homepage has a default ACM banner image. To use your own:

1. Upload your image to WordPress via **Media → Add New**
2. Open `front-page.php` in your text editor
3. Find `acm_desktopbanner.jpeg` near the top of the file (around line 10)
4. Replace just the filename with your new image's filename
5. Save the file

Your image should be at least 1400px wide and landscape orientation for best results.

---

## Managing ongoing content

### Adding a new event
Repeat Step 5 whenever you have a new event. Past events are archived automatically once their date passes.

### Updating officers
Go to **Officers** in WP Admin. Edit or unpublish officers as your board changes. To change someone's photo, edit their officer entry and update the Featured Image.

### Editing an existing event
Go to **Events** in WP Admin, find the event, click to edit it, make your changes, and click **Update**.

---

## For developers: Releasing a new version

This repo includes a GitHub Actions workflow that automatically builds and publishes a WordPress-ready ZIP whenever you push a version tag.

### One-time setup

1. Push this repo to GitHub if you haven't already
2. Go to your repo on GitHub → **Settings → Actions → General**
3. Set **Workflow permissions** to **Read and write permissions** → **Save**

### Cutting a release

```bash
# 1. Update the version number in style.css, then commit it
git add style.css
git commit -m "chore: bump version to v1.1.0"

# 2. Create a tag and push — this triggers the build
git tag v1.1.0
git push origin main --tags
```

Within about 30 seconds, a ZIP file (`acm-chapter-theme-v1.1.0.zip`) will appear on the **Releases** page. Anyone can download it directly from there to install the theme.

The ZIP excludes `.git/`, `.github/`, `.gitignore`, and `*.md` files — only the theme files that WordPress needs are included.

---

## For developers: File structure

```
acm-chapter-theme/
├── style.css                     Theme registration (Name, Version, Text Domain)
├── functions.php                 CPTs, Customizer settings, helper functions, auto-creates pages
├── header.php                    Site header and navigation
├── footer.php                    Site footer with dynamic social icons
├── front-page.php                Homepage template
├── page-about.php                About page (auto-loaded for slug: about)
├── page-contact.php              Contact page (auto-loaded for slug: contact)
├── page-events.php               Events listing (auto-loaded for slug: events)
├── page-membership.php           Membership page (auto-loaded for slug: membership)
├── page-officers.php             Officers page (auto-loaded for slug: officers)
├── single-acm_event.php          Single event view
├── index.php                     Fallback template
├── assets/images/                Bundled logos and social icons
├── css/                          Modular stylesheets (variables, layout, typography, etc.)
├── js/main.js                    Mobile nav toggle + smooth scroll
├── template-parts/event-card.php Reusable event card component
└── .github/workflows/release.yml Automated ZIP release on version tag push
```

---

## For developers: PHP helper functions

These functions are available in any template file and always return the chapter's Customizer values:

| Function | Returns | Example (city = Charlotte, NC) |
|---|---|---|
| `acm_chapter_city()` | City name | `Charlotte` |
| `acm_chapter_state()` | State code | `NC` |
| `acm_chapter_city_state()` | City, State | `Charlotte, NC` |
| `acm_chapter_city_area()` | "the City area" | `the Charlotte area` |
| `acm_chapter_name()` | "ACM City" | `ACM Charlotte` |
| `acm_chapter_email()` | Contact email or empty string | `info@chapter.acm.org` |

Usage in templates:
```php
<h1>Welcome to <?php echo acm_chapter_name(); ?></h1>
<p>Serving professionals in <?php echo acm_chapter_city_area(); ?>.</p>
```

---

## Future direction: Making the theme fully editable without code

Currently, body copy like the hero headline, pillar card text, and FAQ answers must be edited in `.php` files. For chapters where a non-technical person manages the site day-to-day, this is a friction point.

### What is Full Site Editing (FSE)?

WordPress 6.0+ ships with a block-based Full Site Editor. A "block theme" replaces PHP templates with editable block templates — every section of every page becomes editable directly in the WordPress admin with no code required.

### What this would unlock

- Non-technical editors can change any text, image, or layout via **Appearance → Editor**
- The Customizer is replaced by `theme.json` for global colors, typography, and spacing
- Page sections become reusable "block patterns" that editors can add, remove, or reorder
- Works naturally with the growing ecosystem of Gutenberg block plugins

### What the migration involves

This is a near-complete rewrite, not an incremental change:

| Area | Current approach | Block theme equivalent |
|---|---|---|
| Templates | `front-page.php`, `page-*.php` | `templates/front-page.html`, `templates/page-*.html` |
| Design tokens | `css/variables.css` | `theme.json` |
| Page sections | Custom CSS classes | Block patterns |
| PHP helper functions | `acm_chapter_city()`, etc. | Replaced by static text or Customizer blocks |
| Events & Officers CPTs | Custom meta boxes | Compatible as-is, or replaced with ACF blocks |

**Estimated effort:** 3–6 weeks for someone experienced with WordPress block theme development. The PHP + CSS skills needed today shift to block pattern authoring and `theme.json` configuration.

### Why the current approach was chosen

PHP templates with CSS variables are straightforward, require zero plugins, and work on every WordPress hosting environment without compatibility concerns. The block theme path is more powerful for editors but adds architectural complexity and requires a different skill set to maintain.

This migration is the right long-term direction for chapters that need non-technical editorial control. Contributions toward a block theme version of this theme are welcome.

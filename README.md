# Feebas Theme

A custom WordPress theme built from the _S (underscores) boilerplate, using Tailwind CSS for modern styling.

## Features

- **Tailwind CSS**
  Utility‑first styling out of the box (compiled into `assets/css/`).
- **Multiple Header/Layout Templates**
  - `template-parts/primary-header.php` – your main site header
  - `template-parts/secondary-header.php` – logo/secondary menu/icons layout
- **Footer Templates**
  - `template-parts/secondary-footer.php` – logo, tagline, subscribe form, socials on the left; footer menu on the right; bottom bar with copyright, Terms & Privacy.
- **Menu Locations**
  - `primary`   – main navigation
  - `secondary` – secondary nav (centered in secondary header)
  - `footer`    – footer links
- **Camera List Shortcode**
  `template-parts/camera-list.php` loads camera items via AJAX, with filters for brand, type, and price.
- **Admin & Front‑End Cleanup (`inc/cleanup.php`)**
  - Removes block library CSS, emojis, WP version, default scripts
  - Disables core theme supports (feeds, custom header/background, block patterns)
  - Unregisters default widgets & dashboard widgets
  - Removes “At a Glance”, “Activity”, “Welcome” panels
  - Removes Appearance submenus: Customize, Widgets, Patterns
  - Unregisters default `post` post type & removes Posts menu
  - Disables all comments (UI + REST API)
  - Restricts REST API to authenticated users

## Installation

1. Copy the `feebas-theme` folder into your `wp-content/themes/` directory.
2. Activate the **Feebas Theme** in **Appearance → Themes**.
3. In **Appearance → Menus**, create and assign your Primary, Secondary, and Footer menus.
4. In **Appearance → Customize**, set your Site Logo (used by `the_custom_logo()`).

## Development

- This theme uses Tailwind CSS.
  - Run `npm install` to install dependencies.
  - Modify `assets/css/index.css` or your Tailwind config, then rebuild with your usual workflow.
- Internationalization
  - POT file at `languages/feebas-theme.pot`.
  - Run `npm run make-pot` to regenerate.


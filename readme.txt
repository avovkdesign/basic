=== Basic ===
Contributors: wppuzzle, avovkdesign
Requires at least: WordPress 4.0
Tested up to: WordPress 4.5.2
Version: 1.1.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Tags: two-columns, one-column, left-sidebar, right-sidebar, custom-background, custom-colors, custom-header, custom-menu, editor-style, featured-images,sticky-post, threaded-comments, translation-ready

== Description ==
Basic is simple responsive WordPress theme. It has custom color option, customized layout (left- or rightbar, full or centered content). Preset share buttons, structured data mark-up, clean, valid and SEO-friendly code.

* Responsive layout (mobile first)
* Customized page layouts (leftbar, rightbar, full and centered content)
* Custom main color
* Custom header and background
* Social share links (custom, Share42 or Yandex)
* The GPL v2.0 or later license. :) Use it to make something cool.

== Installation ==

1. In your admin panel, go to Appearance -> Themes and click the 'Add New' button.
2. Type in basic in the search form and press the 'Enter' key on your keyboard.
3. Click on the 'Activate' button to use your new theme right away.
4. Navigate to Appearance > Theme Options in your admin panel and customize to taste.


== Changelog ==

= 1.1.4 =
* add: backward compatible for old option name

= 1.1.3 =
* fix: renamed main theme option prefix (from `theme_option_*` to `basic_theme_option_*`)
* fix: some functions prefixed with `basic_`

= 1.1.2 =
* add: new option for customize header image repeatable and header height
* add: new option for add counters in footer
* add: new option for customize copyright text
* add: styles for gallery columns
* add: option for control site title position
* add: option for control site description show
* include the non-minified version for all minified scripts
* prefix some functions, script and styles with theme slug
* escape all home_url() functions with esc_url()
* escape HTML attributes like title="" and alt="" with esc_attr()
* backward title compatible function `basic_render_title()` removed
* remove constant with template directory path and URLS
* migrate all theme options to the Customizer

= 1.1.1 =

* Enable/disable sidebar show for mobile
* Fixed custom menu styles
* Fixed `comment_notes_after` problem in comments.php
* Footer menu depth changed to 1 level

= 1.1.0 =

* Added the following actionfor use in child themes or plugins:
 * `basic_before_header`
 * `basic_after_sitelogo`
 * `basic_before_topnav`
 * `basic_after_topnav`
 * `basic_after_header`
 * `basic_before_content`
 * `basic_after_content`
 * `basic_before_footer`
 * `basic_before_footer_menu`
 * `basic_before_footer_copyrights`
 * `basic_after_footer_copyrights`
* Added filter `basic_singular_content` (takes one argument, $content), to be able to change the text or add your code in child themes or plugins
* Added options for the html code before and after the entry
* Added displaying the description for the first page of the archive tags and author
* In Schema.org Article connected link to the full image (Google requires photo by 600 pixels)
* Fixed list bullets
* Fixed problem with incorrect display of menu styles
* Fixed a problem with options translation adjustments in child themes
* Fixed compatibility issues with PHP 5.5 or higher


= 1.0.4 =

* "Read more" button aligned on right side
* In main menu when displaying pages by default, also displayed link to home page
* Customizable color logo in header
* Fixed styles in header (block with logo on entire width now)
* Fixed bug with displaying menus in footer
* Fixed styles with absolute positioning in footer
* Added backward compatibility wp_title () for WordPress lower than 4.0

= 1.0.3 =

* Added styles to visual editor in admin
* Fixed style conflicts with galleries WordPress
* Small edits, code refactoring

= 1.0.2 =

* Fixed date format in micro markup
* Link to wp-puzzle.com removed to noindex, nofollow
* Made refinement in translation, added translation of new settings
* Fixed warning in pagination

= 1.0.1 =

* Fixed micro markup (from individual variants for yandex and google to one universal)
* Fixed comments output format, removed link on yourself in names of author’s article

= 1.0 =

* Release



== Copyright ==

Basic WordPress Theme, Copyright 2014-2015 WordPress.org
Basic theme files, scripts, icons and images is distributed under the terms of the GNU GPL

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.


Basic Theme bundles the following third-party resources:

Thumbnail image in theme screenshot
Author: Alexandra Vovk (http://avovkdesign.com)
License: GNU GPL, Version 2 (or later)

Script HTML5 Shiv v3.7.0, Copyright 2014 Alexander Farkas
License: MIT/GPL2
Source: https://github.com/aFarkas/html5shiv

Script Share42.com with icons (file `/js/icons.png`),  Copyright 23.09.2014 Dimox
License: GNU GPL, Version 2 (or later)
Source: http://share42.com

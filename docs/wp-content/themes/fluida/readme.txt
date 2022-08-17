===Fluida===

Contributors: Cryout Creations
Requires at least: 4.5
Tested up to: 5.8.0
Stable tag: 1.8.7.1
Requires PHP: 5.6
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl.html
Donate link: https://www.cryoutcreations.eu/donate/

Fluida is a modern, crystal clear and squeaky clean theme. It shines bright with a fluid and responsive layout and carries under its hood a light and powerful framework. All the theme's graphics are created using HTML5, CSS3 and icon fonts so it's extremely fast to load.

It's also SEO ready, using microformats and Google readable Schema.org microdata. Fluida also provides over 100 customizer theme settings that enable you to take full control of your site. You can change everything starting with layout (content and up to 2 sidebars), site and sidebar widths, colors, (Google) fonts and font sizes for all the important elements of your blog, featured images, post information metas, post excerpts, comments and much more.

Fluida also features social menus with over 100 social network icons available in 4 locations, 3 menus, 6 widget areas, 8 page templates, all post formats, is translation ready, RTL and compatible with older browsers.

Copyright 2015-2021 Cryout Creations
https://www.cryoutcreations.eu/

== License ==

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program. If not, see http://www.gnu.org/copyleft/gpl.html


== Third Party Resources ==

Fluida WordPress Theme bundles the following third-party resources:

HTML5Shiv, Copyright Alexander Farkas (aFarkas)
Dual licensed under the terms of the GPL v2 and MIT licenses
Source: https://github.com/aFarkas/html5shiv/

FitVids, Copyright Chris Coyier - http://css-tricks.com + Dave Rupert - http://daverupert.com
Licensed under the terms of the WTFPLlicense
Source: http://fitvidsjs.com/

== Bundled Fonts ==

Elusive-Icons, Copyright Aristeides Stathopoulos
Licensed under the SIL Open Font License, Version 1.1
Source: http://shoestrap.org/downloads/elusive-icons-webfont/

Zocial CSS social buttons, Copyright Sam Collins
Licensed under the terms of the MIT license
Source: https://github.com/smcllns/css-social-buttons

Feather icons, Copyright Cole Bemis
Licensed under the terms of the MIT license
Source: http://colebemis.com/feather/

== Bundled Images ==

The following bundled images are released into the public domain under Creative Commons CC0:
https://unsplash.com/photos/YeH5EIRFCIs
https://pixabay.com/en/water-priroda-drops-rain-815271/
https://pixabay.com/en/jellyfish-under-water-sea-ocean-698521/
https://pixabay.com/en/waterfall-water-level-movement-335985/
https://stocksnap.io/photo/UXDUCODR2B (Liquido)

The rest of the bundled images are created by Cryout Creations and released with the theme under GPLv3


== Changelog ==

= 1.8.7.1 = 
*Release date - 29.08.2021*

* Added 'fluida_box_readmore' filter for landing page featured boxes read more texts
* Fixed shortcodes being processed twice on landing page featured boxes read more fields
* Cleaned up remnant links to Google Plus
* Updated to Cryout Framework 0.8.6.1:
	* Improved handling of edge cases for featured boxes category filtering with Polylang

= 1.8.7 =
*Release date - 30.06.2021*

* Added Polylang support for featured boxes categories (thanks to espasso)
* Added 'fluida_navbelow_sameterm' filter to control previous/next post link behaviour
* Fixed scroll-to-link functionality
* Cleaned up frontend.js
* Removed min-height from .main class on the landing page
* Updated to Cryout Framework 0.8.6:
	* Improved PHP 8.0 compatibility

= 1.8.6.2 =
*Release date - 29.03.2021*

* Fixed landing page animated featured boxes missing the overlay effect since 1.8.6

= 1.8.6.1 =
*Release date - 29.03.2021*

* Added workaround for incorrect alignment on centered block butons with WordPress 5.7
* Fixed Team Members images being invisible since 1.8.6
* Fixed landing page text areas missing background images since 1.8.6

= 1.8.6 =
*Release date - 15.03.2021*

* Fixed "Inherit General Font" option not working as expected
* Fixed block editor galleries layout
* Fixed team members photos having a weird aspect ratio after Team Members plugin update
* Fixed text indent option adding indentation to icons (including shortcodes)
* Fixed search form overlapping mobile menu elements with small general font sizes
* Fixed left sidebar navigation not being displayed when there are no widgets assigned
* Fixed JS focus effects possibly breaking dynamic buttons functionality
* Improved main navigation fallback markup
* Renamed landing page 'static image' element to 'banner image' for clarity
* Removed all padding/margins from before/after content and top/bottom inner widget areas
* Added click-navigation to target panels in header content and site identity hints
* Added configuration hint for header image when the theme's slider / banner image is active on the homepage
* Cleaned up and optimized frontend scripts, including for WordPress 5.5/5.6 jQuery updates
* Updated to Cryout Framework 0.8.5.7:
	* Expanded hint control styling to apply in the Site Identity panel
	* Fixed multi-font choices failing to apply correctly
	* Added echo parameters to cryout_schema_microdata() and cryout_font_select() functions
	* Improved breadcrumbs compatibility with plugins that filter section titles and add HTML markup
	* Improved JS code to remove jQuery deprecation notices since WordPress 5.6
	* Changed custom post type label in breadcrumbs from singular_name to name
	* Better cleaning of weights in font enqueues
	* Added the ability to inherit the general font on all other font control options
	* Fixed Select2 selectors no longer working with WordPress 5.6 on Firefox
	* Removed PHP and WP versions checks as these are now handled by WordPress

= 1.8.5 =
*Release date - 03.09.2020*
* Improved mobile menu color options handling
* Additional accessibility improvements
* Fixed block editor font sizes using the incorrect 'regular' slug
* Fixed page layout meta option not working since 1.8.4
* Fixed social icons sometimes overlapping mobile menu toggler on RTL
* Updated to Cryout Framework 0.8.5.1:
	* Even more sanitization changes to comply with wp.org requirements

= 1.8.4.1 =
*Release date - 26.05.2020*
* Added 'Tested up' to and 'Requires PHP' header fields in style.css

= 1.8.4 =
*Release date - 06.05.2020*
* Added accessibility for mobile menu
* Enabled header socials menu location by default when a social menu exists
* Fixed plural forms in comments count for more complex languages - https://codex.wordpress.org/I18n_for_WordPress_Developers#Plurals
* Fixed non-prefixed global variable in content.php
* Fixed mobile menu overlapping WordPress admin bar on screens under 600px
* Fixed logo using incorrect height after assignment in the customize preview
* Renamed content/author-bio.php file to content/user-bio.php to avoid name colision with WordPress' templating system
* Removed "Category page with intro" page template per TRT guidelines - https://themes.trac.wordpress.org/ticket/30509#comment:20
* Code cleanup and sanitization improvements according to the theme sniffer rules
	* Fixed empty else statements in core.php, landing-page.php, styles.php
* Updated to Cryout Framework 0.8.5:
	* Fixed color selector malfunction since WordPress 5.3
	* Additional sanitization

= 1.8.3 =
*Release date - 16.03.2020*
* Fixed theme layout option missing from layout panel
* Fixed mobile menu in fixed mode causing rendering glitches in Firefox mobile with center-contained layout
* Fixed back-to-top button hiding no longer works
* Removed Custom CSS option as requested by the WordPress TRT team - https://themes.trac.wordpress.org/ticket/78556#comment:11
* Removed options save/load functionality to comply with guidelines - https://themes.trac.wordpress.org/ticket/39841#comment:27

= 1.8.2 =
* Updated fixed menu styling to account for WordPress admin bar responsiveness breakpoints changes
* Improved socials placement when mobile menu togglers is visible on larger screens
* Fixed bullets missing on Gutenberg block and landing page text areas ordered lists
* Fixed mobile menu toggler not following the correct height with mobile fixed menu
* Improved fixed mobile menu functionality to only execute when fixed menu option is enabled
* Fixed some landing page elements missing effects on older Edge releases due to :focus-within changes in 1.8.0

= 1.8.1 =
* Fixed landing page status notice not being displayed when not active due to homepage setting
* Fixed content left/right padding and top margin options missing since layout options were rearranged
* Removed news feed from theme's about page per TRT requirements - https://themes.trac.wordpress.org/ticket/73150#comment:3
* Hopefully fixed shaking footer on scroll on mobile Safari since 1.8.0
* Improved list bullets styling in landing page text areas
* Updated to Cryout Framework 0.8.4

= 1.8.0 =
* Added 'fluida_header_image' and 'fluida_header_image_url' filters to allow custom control over featured images in header functionality
* Added option to disable default pages navigation and improved mobile menu functionality to hide toggler when main navigation is empty
* Added WordPress 5.2 'wp_body_open' action call
* Added visibility on scroll functionality on the fixed menu on mobile devices
* Improved featured boxes responsiveness on smaller screens
* Improved icon blocks responsiveness with odd numbers
* Improved related posts section styling
* Improved main navigation usability on tablets by adding the option to force the mobile menu activation
* Improved dark color schemes support for HTML select elements
* Improved static slider image behavior on short screens
* Improved keyboard navigation accessibility:
	* Added 'skip to content' link
	* Added focus support for post featured images, landing page featured boxes, landing page portfolio
* Fixed breadcrumbs links in bbPress forums/topics sections
* Fixed line height on 'continue reading' button on hover
* Fixed Gutenberg lists displaying bullets outside of content on landing page sections
* Updated to Cryout Framework 0.8.3:
	* Fixed home icon missing link on WooCommerce sections
	* Optimized options migration check to reduce calls
	* (Finally?) fixed 'Too few arguments' warning in breadcrumbs on Polylang multi-lingual sites

= 1.7.0 =
* Added option to control featured images in the header size enforcement
* Improved Google Fonts functionality to load all weights for the general font
* Improved footer widgets responsiveness when set to center align
* Improved content spacing on single pages/posts when comment form is not displayed
* Improved page/post meta options support for the block editor
* Improved block editor styling for dark color schemes
* Optimized layout detection code and moved to the framework
* Optimized frontend scripts
* Renamed top and bottom widget areas for clarity
* Renamed and rearranged some theme options for consistency between themes
* Fixed normalized tags still having different sizes
* Fixed editor style option not applying to the block editor styling
* Fixed deferring functionality applying to some dashboard scripts
* Fixed $content_width not being defined in the dashboard
* Multiple fixes for older IEs
* Disabled featured images on post formats
* Disabled search form display on the landing page when no posts are available
* Updated Cryout Framework to 0.8.2:
	* Activated Select2 functionality on font selector controls
	* Added Select2 functionality to icon-select controls
	* Fixed RTL issues with color controls, toggle controls, half/third width selectors, number slider
	* Switched enable/disable options to use the new toggle control
	* Switched number options to use the new number slider control

= 1.6.0.2 =
* Fixed notice about malformed number format in setup.php since 1.6.0
* Fixed Gutenberg editor background color missing

= 1.6.0.1 =
* Fixed block embeds responsiveness conflict with Fitvids script
* Fixed notice about malformed number format in custom-styles.php since 1.6.0
* Fixed classic editor styling not working since 1.6.0

= 1.6.0 =
* Adjusted headings color option to apply to landing page text area inner headings as well
* Fixed WP Globus translations not working in landing page icon blocks excerpts (should improve support for other plugins as well)
* Added 'fluida_header_crop' filter for header image crop position
* Improved standards compliance CSS cleanup
* Fixed long submenus sometimes causing horizontal scrollbar with non-fixed menus
* Gutenberg editor tweaks and improvements:
	* Added styles for the new block horizontal separators
	* Added editor styles for the Gutenberg editor
	* Added support for theme colors and font sizes in the Gutenberg editor
	* Added wide image support
	* Improved list appearance in blocks
	* Fixed margins on gallery blocks
	* Fixed caption alignment in blocks
	* Fixed cover block text styling
* Updated to Cryout Framework 0.7.8.5:
	* Improved manual excerpts detection in landing page blocks and boxes to detect <!--more--> and <!--nextpage--> tags

= 1.5.6.1 =
* Updated Cryout Framework to v0.7.8.2:
	* Fixed landing page sometimes ending unexpectedly while WPML is used

= 1.5.6 =
* Added landing page featured icon blocks overall disable option
* Added support for shortcodes in custom footer text field
* Fixed header widgets being present on the landing page when a header image is not used
* Fixed height discrepancy between main navigation items and search icon item in some cases
* Fixed landing page icon blocks, featured boxes and text areas WPML support
* Fixed some animation hiccups on main navigation
* Fixed site logo size shrinking on mobile devices
* Fixed long site titles overlapping mobile menu placeholder
* Fixed main navigation cannot be clicked in some cases on IE, Edge and Chrome
* Fixed landing page content generation after first activation failing to retrieve all available static pages in some cases
* Fixed landing page icon blocks, featured boxes, text areas background color options not working
* Fixed slider / static slider using wrong title font after latest Serious Slider plugin update
* Rearranged landing page 'featured content' options to dedicated options section
* Updated Cryout Framework to v0.7.8.1
		* Sorted icon block icons list alphabetically
		* Added required PHP version check
		* Improved required WordPress version check

= 1.5.5 =
* Added support for custom embedded fonts
* Added main navigation keyboard accessibility support
* Added mobile menu close on click/tap functionality
* Added hints in the customizer interface for Site Identity / Header options
* Improved mobile menu multi-line menu items behaviour
* Increased mobile menu width on smaller devices
* Fixed GDPR-related checkbox missing on comment form
* Fixed comment form fields center alignment on checkboxes and radio controls
* Fixed static slider positioning on <720px with RTL
* Fixed site tagline positioning with RTL
* Fixed spacing between title and logo on RTL
* Fixed mobile menu items alignment on RTL
* Fixed header image not visible when active on the landing page
* Fixed header widgets being present on the landing page when the header image is not used
* Updated to Cryout Framework 0.7.6.1

= 1.5.4.1 =
* Improved landing page featured boxes and text areas spacing
* Fixed featured icon blocks container still visible when all icon blocks are disabled
* Bumped required PHP version to 5.3

= 1.5.4 =
* Fixed first content title spacing above rule being too broad
* Fixed logo overlapping mobile menu placeholder when image wider than available width
* Fixed main navigation search box not working with some color combinations

= 1.5.3.2 =
* Fixed landing page text areas cannot be completely disabled
* Fixed scroll-to-anchor functionality with Tabs/Panels
* Improved first content title before spacing

= 1.5.3.1 =
* Reverted heading sizes apply to main content headings only
* Added compatibility styling for Jetpack Portfolio titles sizes in widgets
* Fixed cover+fixed background images zoomed incorrectly on Safari
* Fixed cover+fixed background images shaky on IEs and Edge
* Fixed q tag missing styling

= 1.5.3 =
* Added query resets to landing page custom queries
* Added featured box titles link functionality
* Improved accessibility for landing page block icons, boxes links and titles, edit button, read more links and back-to-top button
* Improved 'scroll to anchor' functionality and extended to content and menu links
* Changed heading sizes to apply to main content headings only
* Fixed duplicate classname on featured image element
* Fixed incorrect options indication in widget areas
* Fixed featured images opacity-based animations glitch on Chrome
* Optimized similar translations strings in theme options

= 1.5.2.1 =
* Re-upload of 1.5.2 due to repository issues

= 1.5.2 =
* Added support for WooCommerce breadcrumbs
* Added landing page icon blocks read more links
* Added landing page sections support for WPML/Polylang localization
* Added missing fields to WPML/Polylang wpml-config.xml file
* Changed example static slider image and updated screenshot to reflect this change
* Changed search widget, landing page icon blocks, main navigation submenus appearance
* Changed site title to use first accent color (instead of second)
* Improved on-page SEO
* Improved tables styling
* Fixed HTML markup validation warning due to empty 'media' attribute
* Fixed CSS validation warnings due to empty color fields and invalid 'default' values
* Fixed landing page featured page section using H1 tag for title
* Fixed landing page featured boxes not being disable-able
* Fixed language flag images being improperly aligned in menus
* Updated to Cryout Framework v0.7.4

= 1.5.1 =
* Fixed WooCommerce products missing styling in search results
* Fixed quantity input being too short for double digits with WooCommerce 3.3+
* Removed 'defer' loading of comments script due to conflict with Jetpack

= 1.5.0.3 =
* Fixed 'Category page with intro' template missing pagination since v1.5.0
* Fixed landing page slider CTA buttons missing due to incomplete callback check
* Fixed WooCommerce store and category pages using wrong title font size

= 1.5.0.2 =
* Improved featured images srcset functionality to support more usage cases
* Improved compatibility of dark color schemes with Crayon Syntax Highlighter plugin's editor styling
* Improved sublists appearance in sidebar widgets
* Added all weight values for the typography options
* Added missing styling for landing page featured content container
* Fixed comment block being visible on landing page featured page
* Updated to Cryout Framework 0.7.3

= 1.5.0.1 =
* Reverted theme's main style move and restored style.css to resolve a serious styles loading issues with some child themes
* Fixed header image missing on homepage when landing page is enabled but not active
* Moved sidebar empty checks outside of sidebar container
* Updated to Cryout Framework 0.7.2

= 1.5.0 =
* Moved theme's styling to resources/main-style.css
* Changed landing page activation behaviour to bring in sync with our other themes (and general WordPress repository behaviour) *** this will require adjusting WordPress' reading settings and the theme's landing page options to restore the landing page after update
* Added notifications for landing page activation in the customizer panel
* Added notifications for image recreated on specific options in the customizer panels
* Moved theme's styling enqueues from wp_head to wp_enqueue_scripts hook to improve child themes compatibility *** this will require updating the child theme if it uses style enqueues
* Improved featured image srcset functionality to support more browsers; added fluida_set_featured_srcset_picture() function
* Fixed featured image to remove unwanted bottom space on IEs
* Added demo featured images for when theme is previewed
* Added support for the theme preview sample sidebar
* Fixed not working translation in article publish date
* Fixed page layout option overlapping category/search/archive layout when last item uses custom layout
* Fixed 'Category page with intro' query reset
* Improved 'comments moderated' text positioning
* Updated to Cryout Framework 0.7.1
	* Framework: added cryout_get_picture(), cryout_get_picture_src() functions
	* Framework: fixed invalid count() call in prototypes.php triggering warnings on PHP 7+

= 1.3.6.1 =
* Fixed featured image sizes on landing page posts
* Made static slider CTA fields visibility conditional to the static slider setting

= 1.3.6 =
* Fixed submenus missing background color on hover and color transitions animations since 1.3.5
* Fixed main menu search icon going white on hover since 1.3.5
* Fixed static slider overlapping icon blocks on mobile devices
* Fixed Serious Slider responsiveness when using the 'theme' style
* (Finally) fixed editor styling
* Changed landing page icon blocks content source values behaviour to be consistent with other options *** this will require adjusting the option to restore the desired configuration after update
* Improved content_width() and featured_width() functions to better calculate the correct value on landing page
* Rearranged post meta hooks to be in sync with our other themes
* Changed featured boxes 'read more' buttons styling
* Slightly tweaked mobile menu styling
* Tweaked 'more posts' button styling
* Increased default sidebar sizes to 320px
* Added filters on landing page element titles; added class filter on landing page text areas containers
* Added compatibility styling for Team Members plugin
* Added new theme default header image, new default static slider image and updated theme screenshot
* Moved image size options descriptions to separate hints
* Updated Cryout Framework to v0.7.1

= 1.3.5 =
* Fixed site title overlapping menu icon on mobile
* Fixed featured boxes not deactivating by setting the category to 'disabled'
* Fixed dropdown menu width issue in Chrome with very short menu items
* Renamed landing page icon blocks related options (with auto-migration of existing settings)
* Added CTA buttons feature on the static slider image area
* Added integrated styling for our Serious Slider plugin
* Adjusted landing page static slider image responsiveness to cover more usage scenarios
* Fixed static slider caption container being displayed when no static slider caption fields are used
* Renamed $fluids variables to be more generic
* Fixed editor styling option not controlling style.css enqueue
* Escaped variables in custom-styles.php, loop.php, meta.php and main.php
* Added auto-match for mailto: URL in social icons
* Improved masonry initiation to check if function is available
* Added workaround for horizontal scrollbar on mobile devices when large menus are used
* Fixed 'Category page with intro' page template pagination not working when set on static home page
* Fixed missing text areas numbers in theme options
* Fixed non-translatable strings in theme options
* Corrected custom footer text sample information
* Added cryout_before_content_hook, cryout_after_content_hook, cryout_empty_page_hook, cryout_absolute_top_hook, cryout_absolute_bottom_hook and cryout_singular_before_comments_hook
* Added landing page icon blocks, featured boxes and featured text areas background color options
* Unpplugged fluida_get_theme_options() and fluida_get_theme_structure() functions
* Updated to Cryout Framework 0.7.0
* Added filters: cryout_landingpage_indexquery on landing page posts query, cryout_breadcrumbs_excluded_templates in breadcrumbs
* Improved header video support and fixed header height on non-homepage sections
* Moved moved menu background colors from list items to anchors, rem mobile menu anchor color, improved menu items height
* Improved static slider image check
* Adjusted registered image sizes filters and crop settings; added new square image size for certain usage cases
* Moved older changelog entries to changelog.txt

= 1.3.4 =
* Default sidebar message is now only shown for users that have widget editing capabilities
* Adjusted dropdown menu z-index to improve appearance on multi-line menus; also moved background colors from list items to anchors
* Improved mobile menu appearance (submenus indentation, items color inherited from the main menu, removed submenu items bottom line)
* Fixed image vertical alignment in main menu
* Fixed headings font sizes in editor styling

= 1.3.3 =
* Added styling to disable Chrome's built-in blue border on focused form elements
* Added explicit support for WooCommerce 3.0 new product gallery
* Removed 'wp_calculate_image_srcset' filter support due to Jetpack_Photon::filter_srcset_array() issue

= 1.3.2 =
* Changed post titles in posts lists from 60 units smaller to 75%
* Improved srcset functionality by switching to viewpoint units for better responsiveness
* Improved srcset sizes for the landing page featured images
* Improved backwards compatibility for browsers that do not use srcsets
* Fixed srcset sizes for 1 column posts list layout
* Added 'fluida_featured_srcset' filter and support for 'wp_calculate_image_srcset' filter for disabling srcset functionality
* Fixed renaming .mobile class
* Changed default value for Featured Image Alignment from center/center to center/top
* Updated Cryout Framework to v0.6.5

= 1.3.1.1 =
* Changed H1 to H2 in the static slider
* Fixed post titles wrong size in the landing page posts list (since 1.3.1)
* Added site title always present in the source of the site (for SEO purposes)
* Fixed WordPress' "Display Site Title and Tagline" option not hiding tagline

= 1.3.1 =
* Added srcset support for featured images and two additional featured image sizes to improve responsiveness and cross-device compatibility
* Added colour option for the H1-H4 content headings
* Extended Featured Image Alignment option to apply to all featured image crop variants added by the new srcset feature
* Slightly adjusted headings font sizes generator function and added separate distinct styling for h5 and h6
* Increased page/post titles default value to 250% and made post titles in page list 60 units smaller
* Fixed responsive styling arranging footer widgets in two columns even when option was set to one column
* Added site title accent position option
* Fixed pages manual excerpts not working and added support for <!--nextpage--> tag in icon blocks
* Fixed search results showing meta information for pages
* Fixed floats in content not clearing properly
* Updated Cryout Framework to v0.6.4
* Updated translation files

= 1.3.0 =
* Improved landing page behaviour for the contained and wide theme layouts
* Added support for <!--more--> tag in landing page text area pages
* Fixed author pages displaying broken titles in certain cases
* Added landing page slider shortcode field to translatable fields in WPML / Polylang
* Made header video centered on wide layouts
* Removed wp_kses() filtering from landing page blocks/boxes/texts titles/contents
* Extended fitVids status option to add desktop/mobile separate control
* Improved content_width internal handling to take layouts into account (for better handling of embed media sizing)

Older changes can be found in changelog.txt

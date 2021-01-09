=== Hoot Ubix ===
Contributors: wphoot
Tags: one-column, two-columns, three-columns, left-sidebar, right-sidebar, custom-background, custom-colors, custom-menu, custom-logo, featured-images, footer-widgets, full-width-template, microformats, sticky-post, theme-options, threaded-comments, translation-ready, blog, e-commerce, news
Requires at least: 4.7
Tested up to: 5.4
Requires PHP: 5.6
License: GPLv3 or later
License URI: https://www.gnu.org/licenses/gpl-3.0.en.html

Hoot Ubix is a responsive WordPress theme with a bold modern design.

== Description ==

Hoot Ubix is a responsive WordPress theme with a bold modern design. For more information about Hoot Ubix please go to https://wphoot.com/themes/hoot-ubix/ Theme support is available at https://wphoot.com/support/ You can also check out the theme instructions at https://wphoot.com/support/hoot-ubix/ and demo at https://demo.wphoot.com/hoot-ubix/ for a closer look.

== Frequently Asked Questions ==

= How to install Hoot Ubix =

1. In your admin panel, go to Appearance -> Themes and click the 'Add New' button.
2. Type in 'Hoot Ubix' in the search form and press the 'Enter' key on your keyboard.
3. Click on the 'Activate' button to use your new theme right away.

= How to get theme support =

You can look at the theme instructions at https://wphoot.com/support/hoot-ubix/ To get support beyond the scope of documentation provided, please open a support ticket via https://wphoot.com/support/

== Changelog ==

= 1.9.9 =
* # Hybrid 4.0.0 HybridExtend 2.2.7 #
* Fix container class for jetpack infinite-scroll (when frontpage set to display blog)
* Fix compatibility with wp-megamenu plugin (plugin css hiding logo area)

= 1.9.8 =
* # Hybrid 4.0.0 HybridExtend 2.2.7 #
* Update sanitization for text in sortlist to wp_kses_post
* Misc Woocommerce stylings (tabs on single product page, pagination, buttons, table radius)
* Improved pagination styling - archive, post links, woocommerce
* Added Options builder helper product functions
* Fix block button when user adds the button class manually (to display theme's button style)
* Updated deprecated syntax (jQuery 3.0) in parallax script from .on('ready',handler) to $(handler) https://api.jquery.com/ready/

= 1.9.7 =
* # Hybrid 4.0.0 HybridExtend 2.2.7 #
* Fix for AMP menu with fixed menu javascript
* CSS fix for Image block (caption overflow image in default settings) and Cover block (image overflow due to padding)

= 1.9.6 =
* # Hybrid 4.0.0 HybridExtend 2.2.7 #
* Mobile Fixed Menu - Fix display for logged in users with admin bar
* Improve accessibility - fix keyboard navigation issues (menu, mobile menu, search widget etc)

= 1.9.5 =
* # Hybrid 4.0.0 HybridExtend 2.2.7 #
* Remove WC 4.4 bug fix from last update (bug removed in WC 4.4.1)
* Remove top/bottom margin for main content area added in last update (fixes no space issue in certain displays theme)

= 1.9.4 =
* # Hybrid 4.0.0 HybridExtend 2.2.7 #
* Fix woocommerce pagination display on archive pages (woocommerce 4.4)
* Fix woocommerce column display on archive pages (woocommerce 4.4)
* Remove column/total item options in favor of WC default options

= 1.9.3 =
* # Hybrid 4.0.0 HybridExtend 2.2.7 #
* AMP support for search (remove JS for input text field)
* Return empty read more text for feed
* Fix: color rgba sanitization in style builder for dynamic css
* Fix Safari bug for sidebars when percentage width gets rounds up (in flex model)

= 1.9.2 =
* # Hybrid 4.0.0 HybridExtend 2.2.7 #
* Fix site title with icon (flex to inline flex) when branding is center of header
* Removed orphan sourceMappingURL from third party library files
* AMP plugin support
* Fix mobile safari bug when telephone numbers are automatically converted to links with hidden font color
* Minor fix: Removed for attribute for label in search form widget
* Fix mosaic layout for blog when displayed on frontpage - add archive-wrap div wrap
* Bug fix: Sidebar did not display in frontpage content module if "Hoot > Blog Posts" widget used in an area before it
* Removed deprecated second argument from get_terms function

= 1.9.1 =
* # Hybrid 4.0.0 HybridExtend 2.2.7 #
* CSS for block elements in WP5.4 (social icons)
* CSS for block editor dropcap, generic font sizes used in blocks, other minor adjustments
* Update 'get_the_archive_title' hooked function to remove prefixes from translated WordPress strings as well
* Remove deprecated array offset using {} for PHP 7.4 #8681

= 1.9.0 =
* # Hybrid 4.0.0 HybridExtend 2.2.7 #
* Updated Requires at least, Tested up to and Requires PHP tags in style.css and readme.txt
* Add sidebar layout option for archives/blog to lite
* CSS updates for Block gallery (margins for gallery grid, Gallery Captions, image captions)
* Various CSS fixes and other minor adjustments
* Add script for interlinking customizer control/section/panel
* Improved hybridextend_get_attr function to accept classes when other custom attributes also present
* Refactor frontpage template code
* Fix Customizer Settings Priorities
* Add separate sidebar layout option for frontpage content block (blog / static page)
* Remove HootKit and TGMPA code

= 1.8.7 =
* # Hybrid 4.0.0 HybridExtend 2.2.6 #
* Hide Menu Toggle when Max Mega Menu active
* Add font-display:swap to font icons (fixes Google Pagespeed error: Ensure text remains visible during webfont load)
* Check for parent theme object before assigning parent theme details to framework variables (fixes edge case scenario on certain server configurations)
* Add 'entry-title' class to h1.loop-title (to make title compatibile with Elementor hide-title option)
* Remove filter=5 attribute from wordpress.org review url

= 1.8.6 =
* # Hybrid 4.0.0 HybridExtend 2.2.6 #
* Polylang menu flag image alignment
* Fix bbPress Forums view (archive view was being displayed instead of forums list)
* Fix title/descriptions for bbPress User view, Single Forum view, Forums view

= 1.8.5 =
* # Hybrid 4.0.0 HybridExtend 2.2.6 #
* Add gravatar to loop meta for authors

= 1.8.4 =
* # Hybrid 4.0.0 HybridExtend 2.2.6 #
* Internal Version. Not Released

= 1.8.3 =
* # Hybrid 4.0.0 HybridExtend 2.2.6 #
* Update ul.wp-block-gallery css for WP 5.3 compatibility
* Added HTML5 Supports Argument for Script and Style Tags for WP 5.3
* Added semibold option for typography settings
* Fix custom logo bug (fix warning when default value does not have all options defined for sortitem line)
* Apply filter to frontpage id index for background options
* CSS fix for sortitem checkbox input in customizer
* CSS fix for woocommerce message button on small screen (ticket#4621)
* Upgrade logo-with-icon from Table to Flexbox
* Add filter for Custom Text Logo

= 1.8.2 =
* # Hybrid 4.0.0 HybridExtend 2.2.6 #
* Logo and Site Description css fixes
* Fix social icons widget color for footer nand invert/non-invert topbar

= 1.8.1 =
* # Hybrid 4.0.0 HybridExtend 2.2.6 #
* Accessibility Improvements: Skip to Content link fixed
* Accessibility Improvements: Keyboard Navigation improved (link and form field outlines, improved button focus visual)
* Removed min-width for grid (mobile view)
* Fix iframe and embed margins in wp embed blocks
* Fix label max-width for contact forms to display properly on mobile
* Fix for woocommerce pagination when inifinite scroll is active
* Fix required fonticon for Contact Form 7 plugin
* Bug Fix: Add space for loop-meta-wrap class (for mods)

= 1.8.0 =
* # Hybrid 4.0.0 HybridExtend 2.2.6 #
* Remove shim for the_custom_logo
* Fix: Inline menu display css fix with mega menu plugin
* Apply filter on arguments array for the_posts_pagination
* Add help link to One Click Demo documentation
* Replace support for HootKit with OCDI plugin

= 1.7.8 =
* # Hybrid 4.0.0 HybridExtend 2.2.6 #
* Removed One Click Demo for compatibility with TRT guidelines
* Removed admin_list_item_count limit
* CSS fix: last menu item dropdown
* Added missing argument for 'the_title' filter to prevent error with certain plugins
* Remove shim for the_custom_logo

= 1.7.7 =
* Internal Version. Not Released

= 1.7.6 =
* # Hybrid 4.0.0 HybridExtend 2.2.6 #
* Added sortable capability to widgets group type

= 1.7.5 =
* # Hybrid 4.0.0 HybridExtend 2.2.6 #
* Added support for 'inherit' value in css sanitization for dynamic css build
* Bug fix for 'box-shadow' property in css sanitization for dynamic css build
* Bug fix by unsetting selective refresh from passing into $settings array in customizer interface builder

= 1.7.4 =
* # Hybrid 4.0.0 HybridExtend 2.2.6 #
* Added the new 'wp_body_open' function
* Improved dynamic css for ajax login form

= 1.7.3 =
* # Hybrid 4.0.0 HybridExtend 2.2.6 #
* Added Tribe 'The Events Calendar' plugin support - template fixes
* Improved logic for hootubix_get_mod function

= 1.7.2 =
* # Hybrid 4.0.0 HybridExtend 2.2.5 #
* Add css support for Gutenberg gallery block
* Fix parallax image misalignment on load when lightslider is present
* Sanitize debug data for logged in admin users

= 1.7.1 =
* Internal Version. Not Released

= 1.7.0 =
* # Hybrid 4.0.0 HybridExtend 2.2.5 #
* Fix <!--default--> content for postfooter in new theme installations
* Removed older IE css support
* Fixed Color class name
* Removed minified script/style from admin
* Add support for selective refresh in customizer settings
* Added HootKit support
* One click demo import support added (via HootKit plugin)
* Updated welcome page to help users with OCDI
* Added TGMPA library to recommend HootKit

= 1.6.6 =
* # Hybrid 4.0.0 HybridExtend 2.2.4 #
* Improved 404 handeling using default wordpress template
* 404 template update
* Fix: Frontpage section action hook passes $type instead of $key
* Fix: Jetpack lazy load exception for slider images
* Update schema links from http:// to https://
* Add helper messages to sidebars
* Use 'nav_menu_item_title' filter for menu instead of extending Walker_Nav_Menu
* Remove document title filters (not needed for new wp versions)
* Remove archive description filter (not needed for new wp versions)
* Update Wordpress to WordPress for display in enum sets
* Sortlist - add otpion for default open (custom module)

= 1.6.3 =
* # Hybrid 4.0.0 HybridExtend 2.2.3 #
* Improved frontpage template for easy modification (separate content-blog/page cases)
* Display a message in inactive sidebars instead of hiding them
* Removed deprecated attribte filters for content block image
* Added 'hybridextend_get_template_part' function
* Improved the way 'hybridextend_get_attr' handles custom classes param
* Improved headings for better SEO
* Added 'loop_meta_displayed' flag
* Escaped custom site_info (post footer content)
* Fixed google font url syntax
* Fixed review url
* Added open state to customize sortlist, added radio/radioimage option to sortlist items
* Removed $global variable for base directory path (error on some servers)
* Added limit constraint to group type in widgets
* Set default grid to max choice available for calculating image size
* Improved enum font size function
* Updated get_temrs (taxonomy) args for latest WP version in widgets admin

= 1.6.2 =
* # Hybrid 4.0.0 HybridExtend 2.2.2 #
* Minor js bug fix to work with Page Builder plugin

= 1.6.1 =
* # Hybrid 4.0.0 HybridExtend 2.2.2 #
* Use SCRIPT_DEBUG to define HYBRIDEXTEND_DEBUG
* Remove empty div containers if no slider to show (widgetized template)
* Add filters for titles in included widgets
* Add Privacy Policy page (if defined) to default Post Footer text - GDPR compliance
* Add 'hootubix_searchresults_hide_pages' filter instead of global variable
* Add hook to filter google font query

= 1.6.0 =
* # Hybrid 4.0.0 HybridExtend 2.2.2 #
* Fixed 'main-content-grid' class for Frontpage Template
* Fixed CSS class for Frontpage Page Content (when set to static Page)
* Content Block Page widget - excerpt length option
* Improved implementation of Widget Margin option
* Remove Edit link from Meta information in non archive and non singular context
* Register sidebars even when not displayed (added a note message to inform users)
* Fixed: Widget color options display hexa input field
* Fixed: Widget color option in customizer screen not responsive when widget added for first time
* 'startwrap' option (css class) for customizer group types
* Load minified assets (admin) in customizer screen if available
* Improved customizer css (admin) styles
* Improved Framework constants

= 1.5.4 =
* # Hybrid 4.0.0 HybridExtend 2.2.1 #
* Removed redundant update_browser notification
* Pass type argument for lite_slider filter hook
* Allow style builder to store dynamic css as variable (for external stylesheet plugin)
* Add hooks to modify query hooks for content block widgets

= 1.5.3 =
* # Hybrid 4.0.0 HybridExtend 2.2.1 #
* Added backward compatibility for font icons for plugins using older version (missing font names)

= 1.5.1 =
* # Hybrid 4.0.0 HybridExtend 2.2.1 #
* Updated Font Awesome Version for Enqueue

= 1.5.0 =
* # Hybrid 4.0.0 HybridExtend 2.2.1 #
* Updated Font Awesome Library 5.0.10
* CSS fix for Comment Respond Form checkboxes
* Updated woocommerce template (archive-product) to v3.4.0
* Removed redundant Customizer Premium upsell code
* Jetpack Infinite Scroll fix

= 1.4.5 =
* # Hybrid 4.0.0 HybridExtend 2.2.0 #
* Add 'current' status to individual slides during render
* Hide empty entry-byline block when nothing to show
* Allow social profile enum to skip skype and email when not needed
* Fix link and link hover color css for footer

= 1.4.4 =
* # Hybrid 4.0.0 HybridExtend 2.2.0 #
* Fixed menu hover z-index css
* Remove override mod value filter from hootubix_get_mod function
* Add tagline display option for image logo
* Update sanitization filter for values returned using hootubix_get_mod function

= 1.4.1 =
* # Hybrid 4.0.0 HybridExtend 2.2.0 #
* Prefixed filter names in various files
* Fix: font awesome version number for enqueue
* Fix: Customizer CSS for latest WP version

= 1.4.0 =
* # Hybrid 4.0.0 HybridExtend 2.2.0 #
* Updated Hybrid framework to latest version
* Woocommerce hooks triggered using 'wp' action hook
* Fix: Widget user defined margins set to 0
* Loop pretitle encapsulated in span for css styling
* Fix: Custom logo with icon and custom size empty
* Fixed attribute filters priority
* Added opacity control and sanitization for colors (code only)

= 1.3.6 =
* # Hybrid 3.0.0 HybridExtend 2.1.14 #
* Content Block widgets - Add option for no content/excerpt
* Loop meta - Add context for attributes (update attributes accordingly)
* Dynamic Icon alignment for Custom Logo Lines

= 1.3.5 =
* # Hybrid 3.0.0 HybridExtend 2.1.14 #
* Apply 'the_excerpt' filter to hybridextend_get_excerpt
* Widgets - Fix standard value bug for collapse, group and checkbox

= 1.3.4 =
* # Hybrid 3.0.0 HybridExtend 2.1.13 #
* Add arguments to action hooks in content block widgets
* Fix: Conditional tag for meta info on static page set as frontpage
* Fix: Hide background button for Slider modules in Customizer
* Pass widget values to global variable (including widget id)
* Fix: z-order for flygroup and flyicon windows in Customizer

= 1.3.3 =
* # Hybrid 3.0.0 HybridExtend 2.1.13 #
* Load dynamic styles (theme/woocommerce) before child theme stylesheet
* Fix: Wiget Module Accent background
* Added extra parameters to image size filter for content block (pages/posts) widgets
* Slider module background option
* Added support for vk.com social site

= 1.3.1 =
* # Hybrid 3.0.0 HybridExtend 2.1.13 #
* Hide meta info display container when nothing to show

= 1.3.0 =
* # Hybrid 3.0.0 HybridExtend 2.1.13 #
* Content Blocks Post widget: Add offset and custom excerpt length options
* Widgets css options: Display Widget ID
* Use div instead of h1 for site logo on non front pages

= 1.2.3 =
* # Hybrid 3.0.0 HybridExtend 2.1.12 #
* CSS: Added Elementor plugin compatibility
* CSS: Prefix grid and column classes

= 1.2.2 =
* # Hybrid 3.0.0 HybridExtend 2.1.11 #
* Remove 'array_replace_recursive' from edit functions (customizer class) for PHP<5.3 compatibility
* Add 'get_search_query' to search form
* Updated hook names to use hoot prefix
* Multiple data sanitization
* Add 'Content Block (Posts)' widget
* Add custom css option to hoot widgets
* Add minified files for all admin js/css
* Remove global $post mod (for pricetable plugin - wpalchemy)

= 1.2.1 =
* # Hybrid 3.0.0 HybridExtend 2.1.10 #
* Fix: Dont enqueue google font style if no google font selected
* Fix: Use relative path to find upload attachment id from url - fix when images have same name in different folders
* Fix: Wordpress admin bar position for logged in users on mobile
* Fix: Missing strings from .pot file (added functions like esc_html__ etc)

= 1.2.0 =
* # Hybrid 3.0.0 HybridExtend 2.1.8 #
* Multiple features

= 1.1.0 =
* # Hybrid Framework 3.0.0 #
* Initial release.

== Upgrade Notice ==

= 1.9 =
* This is the officially supported stable release version. Please update to this version before opening a support ticket.

== Resources ==

= This Theme has code derived/modified from the following resources all of which, like WordPress, are distributed under the terms of the GNU GPL =

* Underscores WordPress Theme, Copyright 2012 Automattic http://underscores.me/
* Hybrid Core Framework v3.0.0, Copyright 2008 - 2015, Justin Tadlock  http://themehybrid.com/
* Hybrid Base WordPress Theme v1.0.0, Copyright 2013 - 2015, Justin Tadlock  http://themehybrid.com/
* Customizer Library v1.3.0, Copyright 2010 WP Theming http://wptheming.com

= This theme bundles the following third-party resources =

* FitVids http://fitvidsjs.com/ Copyright 2013, Chris Coyier - http://css-tricks.com + Dave Rupert - http://daverupert.com : WTFPL license http://sam.zoy.org/wtfpl/
* Modernizr http://modernizr.com/ Copyright 2009—2014 : MIT License
* lightSlider http://sachinchoolur.github.io/lightslider/ Copyright sachi77n@gmail.com : MIT License
* Superfish https://github.com/joeldbirch/superfish/ Copyright Joel Birch : MIT License
* Font Awesome http://fontawesome.io/ Copyright (c) 2015, Dave Gandy : SIL OFL 1.1 (Font) MIT License (Code)
* TRT Customizer Pro https://github.com/justintadlock/trt-customizer-pro Copyright 2016 Justin Tadlock : GNU GPL Version 2
* TGM-Plugin-Activation https://github.com/TGMPA/TGM-Plugin-Activation Copyright (c) 2016 TGM : GNU GPL Version 2
* Parallax http://pixelcog.com/parallax.js/ Copyright 2016 PixelCog Inc. : MIT License

= This theme screenshot contains the following images =

* Image: Laptop Computer https://stocksnap.io/photo/DBSD2MR19O : CC0

= Bundled Images: The theme bundles patterns =

* Background Patterns, Copyright 2015, wpHoot : CC0

= Bundled Images: The theme bundles composite images in /include/admin/images using the following resources =

* Misc UI Grpahics, Copyright 2015, wpHoot : CC0
* Image: Wild Hair https://pxhere.com/en/photo/606493 : CC0
* Image: Wood Spice Cooking https://pxhere.com/en/photo/444 : CC0
* Image: Desk https://pxhere.com/en/photo/1434235 : CC0
* Image: Analysis Background https://pxhere.com/en/photo/1445331 : CC0
* Image: Aerial Background https://pxhere.com/en/photo/1430841 : CC0
* Image: Article Assortment https://pxhere.com/en/photo/1452883 : CC0
* Image: Avatar Network https://pxhere.com/en/photo/1444327 : CC0
* Image: Mans Avatar https://publicdomainvectors.org/en/free-clipart/Mans-avatar/49761.html : CC0
* Image: Man with beard https://publicdomainvectors.org/en/free-clipart/Man-with-beard-profile-picture-vector-clip-art/16285.html : CC0
* Image: Faceless Female Avatar https://publicdomainvectors.org/en/free-clipart/Faceless-female-avatar/71113.html : CC0
<?php
/**
 * Headerdata of Theme Customizer.
 * @package HappenStance
 * @since HappenStance 1.0.0
*/  

// Include Fonts
if(	!is_admin() ) {
function happenstance_fonts_include() {
$bodyfont = get_theme_mod('happenstance_body_google_fonts');
$headingfont = get_theme_mod('happenstance_headings_google_fonts');
$descriptionfont = get_theme_mod('happenstance_description_google_fonts');
$headlinefont = get_theme_mod('happenstance_headline_google_fonts');
$postentryfont = get_theme_mod('happenstance_postentry_google_fonts');
$sidebarfont = get_theme_mod('happenstance_sidebar_google_fonts');
$menufont = get_theme_mod('happenstance_menu_google_fonts');
$secondarymenufont = get_theme_mod('happenstance_secondary_menu_google_fonts');
$blogwidgetfont = get_theme_mod('happenstance_blog_widgets_google_fonts');

$fonturl = "//fonts.googleapis.com/css?family=";
$character_set = "&amp;subset=" . get_theme_mod('happenstance_character_set', 'latin');

$bodyfonturl = $fonturl.$bodyfont.$character_set;
$headingfonturl = $fonturl.$headingfont.$character_set;
$descriptionfonturl = $fonturl.$descriptionfont.$character_set;
$headlinefonturl = $fonturl.$headlinefont.$character_set;
$postentryfonturl = $fonturl.$postentryfont.$character_set;
$sidebarfonturl = $fonturl.$sidebarfont.$character_set;
$menufonturl = $fonturl.$menufont.$character_set;
$secondarymenufonturl = $fonturl.$secondarymenufont.$character_set;
$blogwidgetfonturl = $fonturl.$blogwidgetfont.$character_set;

if ($bodyfont != 'default' && $bodyfont != ''){
	wp_enqueue_style('happenstance-google-font1', $bodyfonturl); 
}
if ($headingfont != 'default' && $headingfont != ''){
	wp_enqueue_style('happenstance-google-font2', $headingfonturl);
}
if ($descriptionfont != 'default' && $descriptionfont != ''){
	wp_enqueue_style('happenstance-google-font3', $descriptionfonturl);
}
if ($headlinefont != 'default' && $headlinefont != ''){
	wp_enqueue_style('happenstance-google-font4', $headlinefonturl); 
}
if ($postentryfont != 'default' && $postentryfont != ''){
	wp_enqueue_style('happenstance-google-font5', $postentryfonturl); 
}
if ($sidebarfont != 'default' && $sidebarfont != ''){
	wp_enqueue_style('happenstance-google-font6', $sidebarfonturl);
}
if ($menufont != 'default' && $menufont != ''){
	wp_enqueue_style('happenstance-google-font7', $menufonturl);
} 
if ($secondarymenufont != 'default' && $secondarymenufont != ''){
	wp_enqueue_style('happenstance-google-font8', $secondarymenufonturl);
}
if ($blogwidgetfont != 'default' && $blogwidgetfont != ''){
	wp_enqueue_style('happenstance-google-font9', $blogwidgetfonturl);
}
}
add_action( 'wp_enqueue_scripts', 'happenstance_fonts_include' );
}

// Additional CSS
function happenstance_css_include() {    
if ( get_theme_mod('happenstance_layout') == 'Wide' ) {
	wp_enqueue_style('happenstance-wide-layout', get_template_directory_uri().'/css/wide-layout.css');
}
}
add_action( 'wp_enqueue_scripts', 'happenstance_css_include' );

// Outputs additional CSS based on the Theme Customizer settings.
function happenstance_styles_method() {
	wp_enqueue_style( 'happenstance-style', get_stylesheet_uri() );
        $color_scheme = get_theme_mod('happenstance_color_scheme');
        $header_image_headline_color = get_theme_mod('happenstance_header_image_headline_color');
        $background_color = get_background_color();
        $background_image = get_background_image();
        $layout_style = get_theme_mod('happenstance_layout');
        $background_image_size = get_theme_mod('happenstance_background_image_size');
        $background_pattern_opacity = get_theme_mod('happenstance_background_pattern_opacity');
        $display_main_shadow = get_theme_mod('happenstance_display_main_shadow');
        $display_sidebar = get_theme_mod('happenstance_display_sidebar');
        $header_address = get_theme_mod('happenstance_header_address'); 
        $header_email = get_theme_mod('happenstance_header_email');
        $header_phone = get_theme_mod('happenstance_header_phone');
        $header_skype = get_theme_mod('happenstance_header_skype');
        $display_search_form = get_theme_mod('happenstance_display_search_form');
        $grid_columns = get_theme_mod('happenstance_grid_columns');
        $display_meta_post_entry = get_theme_mod('happenstance_display_meta_post_entry');
        $featured_image_hover = get_theme_mod('happenstance_featured_image_hover');
        $bodyfont = get_theme_mod('happenstance_body_google_fonts');
        $headingfont = get_theme_mod('happenstance_headings_google_fonts');
        $descriptionfont = get_theme_mod('happenstance_description_google_fonts');
        $headlinefont = get_theme_mod('happenstance_headline_google_fonts');
        $postentryfont = get_theme_mod('happenstance_postentry_google_fonts');
        $sidebarfont = get_theme_mod('happenstance_sidebar_google_fonts');
        $menufont = get_theme_mod('happenstance_menu_google_fonts'); 
        $secondarymenufont = get_theme_mod('happenstance_secondary_menu_google_fonts');
        $blogwidgetfont = get_theme_mod('happenstance_blog_widgets_google_fonts');
        $body_google_fonts_size = get_theme_mod('happenstance_body_google_fonts_size')."px";
        $headingfont_size = get_theme_mod('happenstance_headings_google_fonts_size')."px";
        $descriptionfont_size = get_theme_mod('happenstance_description_google_fonts_size')."px";
        $headline_h1_size = get_theme_mod('happenstance_headline_h1_size')."px";
        $headline_h2_size = get_theme_mod('happenstance_headline_h2_size')."px";
        $headline_h3_size = get_theme_mod('happenstance_headline_h3_size')."px";
        $headline_h4_size = get_theme_mod('happenstance_headline_h4_size')."px";
        $headline_h5_size = get_theme_mod('happenstance_headline_h5_size')."px";
        $headline_h6_size = get_theme_mod('happenstance_headline_h6_size')."px";
        $postentryfont_size = get_theme_mod('happenstance_postentry_google_fonts_size')."px";
        $sidebarfont_size = get_theme_mod('happenstance_sidebar_google_fonts_size')."px";
        $footerfont_size = get_theme_mod('happenstance_footer_google_fonts_size')."px";
        $menufont_size = get_theme_mod('happenstance_menu_google_fonts_size')."px";
        $secondarymenufont_size = get_theme_mod('happenstance_secondary_menu_google_fonts_size')."px";
        $blogwidgetfont_size = get_theme_mod('happenstance_blog_widgets_google_fonts_size')."px";
        
// Color scheme
if ($color_scheme != '#169fe6' && $color_scheme != '') {
        $color_scheme_custom_css = "body #ticker-wrapper, body .ticker-box .ticker-arrow-1, body .ticker-box .ticker-arrow-2, body .post-entry .read-more-button, body .grid-entry .read-more-button, body input[type='submit'], body input[type='reset'], body #searchform .searchform-wrapper .send, body .header-image .header-image-text .header-image-link, body .tribe-events-list-event-description .tribe-events-read-more, body #header .menu-box .current-menu-item > a, body #header .menu-box .current-menu-ancestor > a, body #header .menu-box .current_page_item > a, body #header .menu-box .current-page-ancestor > a, .home #container #header .menu-box .link-home { background-color: $color_scheme; } body .post-entry .read-more-button, body .grid-entry .read-more-button, body input[type='submit'], body input[type='reset'], body .header-image .header-image-text .header-image-link, body .tribe-events-list-event-description .tribe-events-read-more, body .menu-box-wrapper, body .menu-box ul ul { border-color: $color_scheme; } body a, body .site-title a, body .post-entry .post-entry-headline a, body .grid-entry .grid-entry-headline a, body .wrapper-related-posts .flexslider .slides li a, body .sidebar-widget a, body .post-entry .read-more-button:hover, body .grid-entry .read-more-button:hover, body input[type='submit']:hover, body input[type='reset']:hover, body #searchform .searchform-wrapper .send:hover, .tribe-events-list-event-description .tribe-events-read-more:hover { color: $color_scheme; }";
        wp_add_inline_style( 'happenstance-style', wp_strip_all_tags($color_scheme_custom_css) );
} 

// Header Image Headline color
if ($header_image_headline_color != '#ffffff' && $header_image_headline_color != '') {
        $header_image_headline_color_custom_css = "html #wrapper .header-image .header-image-text .header-image-headline { color: $header_image_headline_color; }";
        wp_add_inline_style( 'happenstance-style', wp_strip_all_tags($header_image_headline_color_custom_css) );
}

// Background color and image - Entry Headlines background
if ($background_color != '' && $layout_style == 'Wide') {
        $background_color_custom_css = ".entry-headline .entry-headline-text, .sidebar-headline .sidebar-headline-text, #content .blog-headline .blog-headline-text, body .tribe-events-list-separator-month span { background-color: #$background_color; }";
        wp_add_inline_style( 'happenstance-style', wp_strip_all_tags($background_color_custom_css) );
}
if ($background_image != '' && $layout_style == 'Wide') {
        $background_image_custom_css = "body .entry-headline, body .sidebar-widget .sidebar-headline, body #content .blog-headline, body .entry-headline .entry-headline-text, body .sidebar-headline .sidebar-headline-text, body #content .blog-headline .blog-headline-text, body .tribe-events-list-separator-month span { background: none !important; } body .tribe-events-list-separator-month:after {border: none !important;}";
        wp_add_inline_style( 'happenstance-style', $background_image_custom_css );
}

// Background Image Size
if ($background_image_size == 'Cover') {
        $background_image_size_custom_css = "#wrapper { background-size: cover; }";
        wp_add_inline_style( 'happenstance-style', $background_image_size_custom_css );
}

// Background Pattern Opacity
if ($background_pattern_opacity != '' && $background_pattern_opacity != '100' && $background_pattern_opacity != '50') {
        $background_pattern_opacity_custom_css = "#wrapper .pattern { opacity: 0.$background_pattern_opacity; filter: alpha(opacity=$background_pattern_opacity); }";
        wp_add_inline_style( 'happenstance-style', wp_strip_all_tags($background_pattern_opacity_custom_css) );
}
elseif ($background_pattern_opacity == '100') {
        $background_pattern_opacity_custom_css = "#wrapper .pattern { opacity: 1; filter: alpha(opacity=100); }";
        wp_add_inline_style( 'happenstance-style', $background_pattern_opacity_custom_css );
}

// Display Shadow
if ($display_main_shadow == 'Hide') {
        $display_main_shadow_custom_css = "#wrapper #container-shadow { -webkit-box-shadow: none; -moz-box-shadow: none; box-shadow: none; }";
        wp_add_inline_style( 'happenstance-style', $display_main_shadow_custom_css );
}

// Sidebar Position
if ($display_sidebar == 'Without Sidebar') {
        $display_sidebar_custom_css = "#wrapper #container #main-content #content { width: 100%; }";
        wp_add_inline_style( 'happenstance-style', $display_sidebar_custom_css );
}
if ($display_sidebar == 'Left') {
        $display_sidebar_left_custom_css = "body #content { float: right; } body #sidebar { float: left; margin-left: 0; margin-right: 28px; }";
        wp_add_inline_style( 'happenstance-style', $display_sidebar_left_custom_css );
}

// Header Contact Information - Social Links position
if ($header_address != '' || $header_email != '' || $header_phone != '' || $header_skype != '') {
        $social_links_custom_css = ".top-navigation ul { float: right; } body .top-navigation a, body .top-navigation a:visited { padding: 0 0 0 10px; }";
        wp_add_inline_style( 'happenstance-style', $social_links_custom_css );
}

// Display header Search Form - header content width
if ($display_search_form == 'Hide') {
        $display_search_form_custom_css = "#wrapper #header .header-content .site-title, #wrapper #header .header-content .site-description, #wrapper #header .header-content .header-logo { max-width: 100%; }";
        wp_add_inline_style( 'happenstance-style', $display_search_form_custom_css );
}

// Number of Columns in Grid - Masonry Format
if ($grid_columns == '4') {
        $grid_columns_custom_css = "body .grid-entry, body #main-content .js-masonry .sticky { width: 25%; }";
        wp_add_inline_style( 'happenstance-style', $grid_columns_custom_css );
}
elseif ($grid_columns == '2') {
        $grid_columns_custom_css = "body .grid-entry, body #main-content .js-masonry .sticky { width: 50%; }";
        wp_add_inline_style( 'happenstance-style', $grid_columns_custom_css );
}

// Display Meta Box on post entries - styling
if ($display_meta_post_entry == 'Hide') {
        $display_meta_post_entry_custom_css = "#wrapper #main-content .post-entry .attachment-post-thumbnail, #wrapper #main-content .post-entry .attachment-thumbnail { margin-bottom: 17px; } #wrapper #main-content .post-entry .post-entry-content { margin-bottom: -4px; }";
        wp_add_inline_style( 'happenstance-style', $display_meta_post_entry_custom_css );
}

// Featured Images Hover Effect
if ($featured_image_hover == 'Fade') {
        $featured_image_hover_custom_css = "#wrapper .post-entry .attachment-post-thumbnail, #wrapper .post-entry .attachment-thumbnail, #wrapper .grid-entry .attachment-post-thumbnail, #wrapper .grid-entry .attachment-thumbnail, #wrapper .tribe-events-list .attachment-post-thumbnail { -webkit-transition: all 1s ease; -moz-transition: all 1s ease; -o-transition: all 1s ease; -ms-transition: all 1s ease; transition: all 1s ease; } #wrapper .post-entry .attachment-post-thumbnail:hover, #wrapper .post-entry .attachment-thumbnail:hover, #wrapper .grid-entry .attachment-post-thumbnail:hover, #wrapper .grid-entry .attachment-thumbnail:hover, #wrapper .tribe-events-list .attachment-post-thumbnail:hover { opacity: 0.8; filter: alpha(opacity=80); }";
        wp_add_inline_style( 'happenstance-style', $featured_image_hover_custom_css );
}
elseif ($featured_image_hover == 'Tilt') {
        $featured_image_hover_custom_css = "#wrapper .post-entry .attachment-post-thumbnail, #wrapper .post-entry .attachment-thumbnail, #wrapper .grid-entry .attachment-post-thumbnail, #wrapper .grid-entry .attachment-thumbnail, #wrapper .tribe-events-list .attachment-post-thumbnail { -webkit-transition: all 1s ease; -moz-transition: all 1s ease; -o-transition: all 1s ease; -ms-transition: all 1s ease; transition: all 1s ease; overflow: hidden; } #wrapper .post-entry .attachment-post-thumbnail:hover, #wrapper .post-entry .attachment-thumbnail:hover, #wrapper .grid-entry .attachment-post-thumbnail:hover, #wrapper .grid-entry .attachment-thumbnail:hover, #wrapper .tribe-events-list .attachment-post-thumbnail:hover { -webkit-transform: rotate(2deg); -moz-transform: rotate(2deg); -o-transform: rotate(2deg); -ms-transform: rotate(2deg); transform: rotate(2deg); }";
        wp_add_inline_style( 'happenstance-style', $featured_image_hover_custom_css );
}
elseif ($featured_image_hover == 'Focus') {
        $featured_image_hover_custom_css = "#wrapper .post-entry .attachment-post-thumbnail, #wrapper .post-entry .attachment-thumbnail, #wrapper .grid-entry .attachment-post-thumbnail, #wrapper .grid-entry .attachment-thumbnail, #wrapper .tribe-events-list .attachment-post-thumbnail { -webkit-transition: all 1s ease; -moz-transition: all 1s ease; -o-transition: all 1s ease; -ms-transition: all 1s ease; transition: all 1s ease; overflow: hidden; } #wrapper .post-entry .attachment-post-thumbnail:hover, #wrapper .post-entry .attachment-thumbnail:hover, #wrapper .grid-entry .attachment-post-thumbnail:hover, #wrapper .grid-entry .attachment-thumbnail:hover, #wrapper .tribe-events-list .attachment-post-thumbnail:hover { border-radius: 50%; }";
        wp_add_inline_style( 'happenstance-style', $featured_image_hover_custom_css );
}
elseif ($featured_image_hover == 'Shadow') {
        $featured_image_hover_custom_css = "#wrapper .post-entry .attachment-post-thumbnail, #wrapper .post-entry .attachment-thumbnail, #wrapper .grid-entry .attachment-post-thumbnail, #wrapper .grid-entry .attachment-thumbnail, #wrapper .tribe-events-list .attachment-post-thumbnail { -webkit-transition: all 1s ease; -moz-transition: all 1s ease; -o-transition: all 1s ease; -ms-transition: all 1s ease; transition: all 1s ease; } #wrapper .post-entry .attachment-post-thumbnail:hover, #wrapper .post-entry .attachment-thumbnail:hover, #wrapper .grid-entry .attachment-post-thumbnail:hover, #wrapper .grid-entry .attachment-thumbnail:hover, #wrapper .tribe-events-list .attachment-post-thumbnail:hover { -webkit-box-shadow: 0 0 5px #333333; -moz-box-shadow: 0 0 5px #333333; box-shadow: 0 0 5px #333333; }";
        wp_add_inline_style( 'happenstance-style', $featured_image_hover_custom_css );
}

// Body font
if ($bodyfont != 'default' && $bodyfont != '') {
        $bodyfont_custom_css = "html body, #wrapper blockquote, #wrapper q, #wrapper #container #comments .comment, #wrapper #container #comments .comment time, #wrapper #container #commentform .form-allowed-tags, #wrapper #container #commentform p, #wrapper input, #wrapper textarea, #wrapper button, #wrapper select, #wrapper #content .breadcrumb-navigation, #wrapper #main-content .post-meta, html #wrapper .tribe-events-schedule h3, html #wrapper .tribe-events-schedule span, #wrapper #tribe-events-content .tribe-events-calendar .tribe-events-month-event-title { font-family: $bodyfont, Arial, Helvetica, sans-serif; }";
        wp_add_inline_style( 'happenstance-style', $bodyfont_custom_css );
}

// Site Title font
if ($headingfont != 'default' && $headingfont != '') {
        $headingfont_custom_css = "#wrapper #header .site-title { font-family: $headingfont, Arial, Helvetica, sans-serif; }";
        wp_add_inline_style( 'happenstance-style', wp_strip_all_tags($headingfont_custom_css) );
}

// Site Description font
if ($descriptionfont != 'default' && $descriptionfont != '') {
        $descriptionfont_custom_css = "#wrapper #header .site-description {font-family: $descriptionfont, Arial, Helvetica, sans-serif; }";
        wp_add_inline_style( 'happenstance-style', wp_strip_all_tags($descriptionfont_custom_css) );
}

// Headlines font
if ($headlinefont != 'default' && $headlinefont != '') {
        $headlinefont_custom_css = "#wrapper h1, #wrapper h2, #wrapper h3, #wrapper h4, #wrapper h5, #wrapper h6, #wrapper #container .navigation .section-heading, #wrapper .info-box .info-box-headline, #wrapper #comments .entry-headline, #wrapper #main-content .wrapper-related-posts .flexslider .slides li a, html #wrapper .header-image .header-image-text .header-image-headline { font-family: $headlinefont, Arial, Helvetica, sans-serif; }";
        wp_add_inline_style( 'happenstance-style', wp_strip_all_tags($headlinefont_custom_css) );
}

// Post Entry headline font
if ($postentryfont != 'default' && $postentryfont != '') {
        $postentryfont_custom_css = "#wrapper #main-content .post-entry .post-entry-headline, #wrapper #main-content .grid-entry .grid-entry-headline, html #wrapper #main-content .tribe-events-list-event-title { font-family: $postentryfont, Arial, Helvetica, sans-serif; }";
        wp_add_inline_style( 'happenstance-style', wp_strip_all_tags($postentryfont_custom_css) );
}

// Sidebar and Footer widget headlines font
if ($sidebarfont != 'default' && $sidebarfont != '') {
        $sidebarfont_custom_css = "#wrapper #container #sidebar .sidebar-widget .sidebar-headline, #wrapper #wrapper-footer #footer .footer-widget .footer-headline { font-family: $sidebarfont, Arial, Helvetica, sans-serif; }";
        wp_add_inline_style( 'happenstance-style', wp_strip_all_tags($sidebarfont_custom_css) );
}

// Primary Header menu font
if ($menufont != 'default' && $menufont != '') {
        $menufont_custom_css = "#wrapper #header .menu-box ul li a { font-family: $menufont, Arial, Helvetica, sans-serif; }";
        wp_add_inline_style( 'happenstance-style', wp_strip_all_tags($menufont_custom_css) );
}

// Secondary Header menu font
if ($secondarymenufont != 'default' && $secondarymenufont != '') {
        $secondarymenufont_custom_css = "#wrapper #header .secondary-menu-box ul li, #wrapper #header .secondary-menu-box ul li a, #wrapper #ticker-wrapper ul li, #wrapper #ticker-wrapper ul li a { font-family: $secondarymenufont, Arial, Helvetica, sans-serif; }";
        wp_add_inline_style( 'happenstance-style', wp_strip_all_tags($secondarymenufont_custom_css) );
}

// Latest Posts Page Widgets headline font
if ($blogwidgetfont != 'default' && $blogwidgetfont != '') {
        $blogwidgetfont_custom_css = "#wrapper #content .blog-widget .blog-headline { font-family: $blogwidgetfont, Arial, Helvetica, sans-serif; }";
        wp_add_inline_style( 'happenstance-style', wp_strip_all_tags($blogwidgetfont_custom_css) );
}

// Body font size
if ($body_google_fonts_size != '14px' && $body_google_fonts_size != 'px' && $body_google_fonts_size != '') {
        $body_google_fonts_size_custom_css = "body p, body ul, body ol, body li, body dl, body address, body table, body .header-contact, body .header-image .header-image-text, body #content .breadcrumb-navigation, body #main-content .post-meta, body #main-content .post-info, body .grid-entry .grid-category, body .grid-entry .grid-tags, body .wrapper-related-posts .flexslider .slides li a, body .footer-signature, body .tribe-events-list-event-description .tribe-events-read-more, body .tribe-events-list-widget-events h4 { font-size: $body_google_fonts_size; }";
        wp_add_inline_style( 'happenstance-style', wp_strip_all_tags($body_google_fonts_size_custom_css) );
}

// Site Title font size
if ($headingfont_size != '48px' && $headingfont_size != 'px' && $headingfont_size != '') {
        $headingfont_size_custom_css = "#wrapper #header .site-title { font-size: $headingfont_size; }";
        wp_add_inline_style( 'happenstance-style', wp_strip_all_tags($headingfont_size_custom_css) );
}

// Site Description font size
if ($descriptionfont_size != '20px' && $descriptionfont_size != 'px' && $descriptionfont_size != '') {
        $descriptionfont_size_custom_css = "#wrapper #header .site-description { font-size: $descriptionfont_size; }";
        wp_add_inline_style( 'happenstance-style', wp_strip_all_tags($descriptionfont_size_custom_css) );
}

// H1 Headlines font size
if ($headline_h1_size != '27px' && $headline_h1_size != 'px' && $headline_h1_size != '') {
        $headline_h1_size_custom_css = "#wrapper h1, html #wrapper #container .tribe-events-single-event-title, html #wrapper #container .tribe-events-page-title { font-size: $headline_h1_size; }";
        wp_add_inline_style( 'happenstance-style', wp_strip_all_tags($headline_h1_size_custom_css) );
}

// H2 Headlines font size
if ($headline_h2_size != '21px' && $headline_h2_size != 'px' && $headline_h2_size != '') {
        $headline_h2_size_custom_css = "#wrapper h2, #wrapper #comments .entry-headline { font-size: $headline_h2_size; }";
        wp_add_inline_style( 'happenstance-style', wp_strip_all_tags($headline_h2_size_custom_css) );
}

// H3 Headlines font size
if ($headline_h3_size != '18px' && $headline_h3_size != 'px' && $headline_h3_size != '') {
        $headline_h3_size_custom_css = "#wrapper h3 { font-size: $headline_h3_size; }";
        wp_add_inline_style( 'happenstance-style', wp_strip_all_tags($headline_h3_size_custom_css) );
}

// H4 Headlines font size
if ($headline_h4_size != '16px' && $headline_h4_size != 'px' && $headline_h4_size != '') {
        $headline_h4_size_custom_css = "#wrapper h4 { font-size: $headline_h4_size; }";
        wp_add_inline_style( 'happenstance-style', wp_strip_all_tags($headline_h4_size_custom_css) );
}

// H5 Headlines font size
if ($headline_h5_size != '15px' && $headline_h5_size != 'px' && $headline_h5_size != '') {
        $headline_h5_size_custom_css = "#wrapper h5 { font-size: $headline_h5_size; }";
        wp_add_inline_style( 'happenstance-style', wp_strip_all_tags($headline_h5_size_custom_css) );
}

// H6 Headlines font size
if ($headline_h6_size != '14px' && $headline_h6_size != 'px' && $headline_h6_size != '') {
        $headline_h6_size_custom_css = "#wrapper h6 { font-size: $headline_h6_size; }";
        wp_add_inline_style( 'happenstance-style', wp_strip_all_tags($headline_h6_size_custom_css) );
}

// Post Entry Headline font size
if ($postentryfont_size != '21px' && $postentryfont_size != 'px' && $postentryfont_size != '') {
        $postentryfont_size_custom_css = "#wrapper #main-content .post-entry .post-entry-headline, #wrapper #main-content .grid-entry .grid-entry-headline, html #wrapper #main-content .tribe-events-list-event-title { font-size: $postentryfont_size; }";
        wp_add_inline_style( 'happenstance-style', wp_strip_all_tags($postentryfont_size_custom_css) );
}

// Sidebar Widget Headlines font size
if ($sidebarfont_size != '19px' && $sidebarfont_size != 'px' && $sidebarfont_size != '') {
        $sidebarfont_size_custom_css = "#wrapper #container #sidebar .sidebar-widget .sidebar-headline { font-size: $sidebarfont_size; }";
        wp_add_inline_style( 'happenstance-style', wp_strip_all_tags($sidebarfont_size_custom_css) );
}

// Footer Widget Headlines font size
if ($footerfont_size != '19px' && $footerfont_size != 'px' && $footerfont_size != '') {
        $footerfont_size_custom_css = "#wrapper #wrapper-footer #footer .footer-widget .footer-headline { font-size: $footerfont_size; }";
        wp_add_inline_style( 'happenstance-style', wp_strip_all_tags($footerfont_size_custom_css) );
}

// Primary Header Menu font size
if ($menufont_size != '14px' && $menufont_size != 'px' && $menufont_size != '') {
        $menufont_size_custom_css = "#wrapper #header .menu-box ul li a { font-size: $menufont_size; }";
        wp_add_inline_style( 'happenstance-style', wp_strip_all_tags($menufont_size_custom_css) );
}

// Secondary Header Menu font size
if ($secondarymenufont_size != '13px' && $secondarymenufont_size != 'px' && $secondarymenufont_size != '') {
        $secondarymenufont_size_custom_css = "#wrapper #header .secondary-menu-box ul li, #wrapper #header .secondary-menu-box ul li a, #wrapper #ticker-wrapper ul li, #wrapper #ticker-wrapper ul li a { font-size: $secondarymenufont_size; }";
        wp_add_inline_style( 'happenstance-style', wp_strip_all_tags($secondarymenufont_size_custom_css) );
}

// Latest Posts Page Widgets Headline font size
if ($blogwidgetfont_size != '27px' && $blogwidgetfont_size != 'px' && $blogwidgetfont_size != '') {
        $blogwidgetfont_size_custom_css = "#wrapper #content .blog-widget .blog-headline { font-size: $blogwidgetfont_size; }";
        wp_add_inline_style( 'happenstance-style', wp_strip_all_tags($blogwidgetfont_size_custom_css) );
}

}
add_action( 'wp_enqueue_scripts', 'happenstance_styles_method' ); ?>
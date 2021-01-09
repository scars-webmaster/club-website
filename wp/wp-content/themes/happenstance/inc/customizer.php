<?php
/**
 * HappenStance Theme Customizer.
 * @package HappenStance
 * @since HappenStance 1.0.0
*/

/**
 * Contextual controls
*/
function happenstance_is_boxed_layout(){
    $happenstance_layout = get_theme_mod('happenstance_layout');
    if( $happenstance_layout != 'Wide' ) {
      return true;
    }
      return false;
}

function happenstance_customize_register($wp_customize){

$happenstance_fonts = array(
			'default' => __( 'default' , 'happenstance' ),	
			'Abel' => 'Abel',			
			'Aclonica' => 'Aclonica',
			'Actor' => 'Actor',
			'Adamina' => 'Adamina',
			'Aldrich' => 'Aldrich',
			'Alef' => 'Alef',
			'Alegreya Sans' => 'Alegreya Sans',
			'Alice' => 'Alice',
			'Alike' => 'Alike',
			'Allan' => 'Allan',
			'Allerta' => 'Allerta',
      'Amarante' => 'Amarante',
			'Amaranth' => 'Amaranth',
			'Amiri' => 'Amiri',
      'Andika' => 'Andika',
			'Antic' => 'Antic',
			'Anton' => 'Anton',
			'Arimo' => 'Arimo',	
			'Artifika' => 'Artifika',
			'Arvo' => 'Arvo',
			'Assistant' => 'Assistant',
			'Atma' => 'Atma',
			'Baloo Da' => 'Baloo Da',
			'Bitter' => 'Bitter',
			'Brawler' => 'Brawler',
			'Buda' => 'Buda',	
      'Butcherman' => 'Butcherman',	
      'Cabin' => 'Cabin',
      'Cairo' => 'Cairo',
			'Candal' => 'Candal',
			'Cantarell' => 'Cantarell',	
			'Changa' => 'Changa',
      'Cherry Swash' => 'Cherry Swash',				
			'Chivo' => 'Chivo',			
			'Coda' => 'Coda',	
      'Concert One' => 'Concert One',		
			'Copse' => 'Copse',
			'Corben' => 'Corben',
			'Cousine' => 'Cousine',			
			'Coustard' => 'Coustard',
			'Covered By Your Grace' => 'Covered By Your Grace',
			'Crafty Girls' => 'Crafty Girls',
			'Crimson Text' => 'Crimson Text',
			'Crushed' => 'Crushed',
			'Cuprum' => 'Cuprum',
			'Damion' => 'Damion',
			'Dancing Script' => 'Dancing Script',
			'David Libre' => 'David Libre',
			'Dawning of a New Day' => 'Dawning of a New Day',
			'Days One' => 'Days One',
			'Delius' => 'Delius',
			'Delius Swash Caps' => 'Delius Swash Caps',
			'Delius Unicase' => 'Delius Unicase',
			'Didact Gothic' => 'Didact Gothic',
			'Dorsa' => 'Dorsa',
			'Dosis' => 'Dosis',
			'Droid Sans' => 'Droid Sans',
			'Droid Sans Mono' => 'Droid Sans Mono',
      'Droid Serif' => 'Droid Serif',
			'EB Garamond' => 'EB Garamond',
			'El Messiri' => 'El Messiri',
			'Expletus Sans' => 'Expletus Sans',
			'Fanwood Text' => 'Fanwood Text',
			'Federo' => 'Federo',
			'Fontdiner Swanky' => 'Fontdiner Swanky',
			'Forum' => 'Forum',
			'Francois One' => 'Francois One',
			'Frank Ruhl Libre' => 'Frank Ruhl Libre',
			'Galada' => 'Galada',
			'Gentium Basic' => 'Gentium Basic',
			'Gentium Book Basic' => 'Gentium Book Basic',
			'Geo' => 'Geo',
			'Geostar' => 'Geostar',
			'Geostar Fill' => 'Geostar Fill',
      'Gilda Display' => 'Gilda Display',
			'Give You Glory' => 'Give You Glory',
			'Gloria Hallelujah' => 'Gloria Hallelujah',
			'Goblin One' => 'Goblin One',
			'Goudy Bookletter 1911' => 'Goudy Bookletter 1911',
			'Gravitas One' => 'Gravitas One',
			'Gruppo' => 'Gruppo',
			'Hammersmith One' => 'Hammersmith One',
			'Heebo' => 'Heebo',
			'Hind' => 'Hind',
			'Hind Siliguri' => 'Hind Siliguri',
			'Holtwood One SC' => 'Holtwood One SC',
			'Homemade Apple' => 'Homemade Apple',
			'Inconsolata' => 'Inconsolata',
			'Indie Flower' => 'Indie Flower',
      'IM Fell English' => 'IM Fell English',
			'Irish Grover' => 'Irish Grover',
			'Irish Growler' => 'Irish Growler',
			'Istok Web' => 'Istok Web',
			'Judson' => 'Judson',
			'Julee' => 'Julee',
			'Just Another Hand' => 'Just Another Hand',
			'Just Me Again Down Here' => 'Just Me Again Down Here',
			'Kameron' => 'Kameron',
			'Katibeh' => 'Katibeh',
			'Kelly Slab' => 'Kelly Slab',
			'Kenia' => 'Kenia',
			'Kranky' => 'Kranky',
			'Kreon' => 'Kreon',
			'Kristi' => 'Kristi',
			'La Belle Aurore' => 'La Belle Aurore',
      'Lalezar' => 'Lalezar',
      'Lato' => 'Lato',
			'League Script' => 'League Script',
			'Leckerli One' => 'Leckerli One',
			'Lekton' => 'Lekton',
			'Lemonada' => 'Lemonada',
      'Lily Script One' => 'Lily Script One',
			'Limelight' => 'Limelight',
			'Lobster' => 'Lobster',
			'Lobster Two' => 'Lobster Two',
			'Lora' => 'Lora',
			'Love Ya Like A Sister' => 'Love Ya Like A Sister',
			'Loved by the King' => 'Loved by the King',
      'Lovers Quarrel' => 'Lovers Quarrel',
			'Luckiest Guy' => 'Luckiest Guy',
			'Mada' => 'Mada',
			'Maiden Orange' => 'Maiden Orange',
			'Mako' => 'Mako',
			'Marvel' => 'Marvel',
			'Maven Pro' => 'Maven Pro',
			'Meddon' => 'Meddon',
			'MedievalSharp' => 'MedievalSharp',
      'Medula One' => 'Medula One',
			'Megrim' => 'Megrim',
			'Merienda One' => 'Merienda One',
			'Merriweather' => 'Merriweather',
			'Metrophobic' => 'Metrophobic',
			'Michroma' => 'Michroma',
			'Miltonian Tattoo' => 'Miltonian Tattoo',
			'Miltonian' => 'Miltonian',
			'Miriam Libre' => 'Miriam Libre',
			'Mirza' => 'Mirza',
			'Modern Antiqua' => 'Modern Antiqua',
			'Molengo' => 'Molengo',
      'Monofett' => 'Monofett',
			'Monoton' => 'Monoton',
      'Montaga' => 'Montaga',
			'Montez' => 'Montez',
      'Montserrat' => 'Montserrat',
			'Mountains of Christmas' => 'Mountains of Christmas',
			'Muli' => 'Muli',
			'Neucha' => 'Neucha',
			'Neuton' => 'Neuton',
			'News Cycle' => 'News Cycle',
			'Nixie One' => 'Nixie One',
			'Nobile' => 'Nobile',
			'Noto Sans' => 'Noto Sans',
			'Nova Cut' => 'Nova Cut',
			'Nova Flat' => 'Nova Flat',
			'Nova Mono' => 'Nova Mono',
			'Nova Oval' => 'Nova Oval',
			'Nova Round' => 'Nova Round',
			'Nova Script' => 'Nova Script',
			'Nova Slim' => 'Nova Slim',
			'Nova Square' => 'Nova Square',
			'Numans' => 'Numans',
			'Nunito' => 'Nunito',
      'Open Sans' => 'Open Sans',
			'Oswald' => 'Oswald',
			'Over the Rainbow' => 'Over the Rainbow',
			'Ovo' => 'Ovo',
			'Oxygen' => 'Oxygen',
			'Pacifico' => 'Pacifico',
			'Passero One' => 'Passero One',
			'Passion One' => 'Passion One',
			'Patrick Hand' => 'Patrick Hand',
			'Paytone One' => 'Paytone One',
			'Permanent Marker' => 'Permanent Marker',
			'Philosopher' => 'Philosopher',
			'Play' => 'Play',
			'Playfair Display' => 'Playfair Display',
			'Podkova' => 'Podkova',
			'Poller One' => 'Poller One',
			'Pompiere' => 'Pompiere',
			'Prata' => 'Prata',
			'Prociono' => 'Prociono',
			'PT Sans' => 'PT Sans',
			'PT Sans Caption' => 'PT Sans Caption',
			'PT Sans Narrow' => 'PT Sans Narrow',
			'PT Serif' => 'PT Serif',
			'PT Serif Caption' => 'PT Serif Caption',
			'Puritan' => 'Puritan',
			'Quattrocento' => 'Quattrocento',
			'Quattrocento Sans' => 'Quattrocento Sans',
			'Questrial' => 'Questrial',
			'Radley' => 'Radley',
			'Rakkas' => 'Rakkas',
			'Raleway' => 'Raleway', 
      'Rationale' => 'Rationale',
			'Redressed' => 'Redressed',
      'Reenie Beanie' => 'Reenie Beanie', 
      'Roboto' => 'Roboto',
      'Roboto Condensed' => 'Roboto Condensed',
			'Rock Salt' => 'Rock Salt',
			'Rochester' => 'Rochester',
			'Rokkitt' => 'Rokkitt',
			'Rosario' => 'Rosario',
			'Rubik' => 'Rubik',
			'Ruslan Display' => 'Ruslan Display',
      'Sancreek' => 'Sancreek',
			'Sansita One' => 'Sansita One',
			'Schoolbell' => 'Schoolbell',
			'Secular One' => 'Secular One',
			'Shadows Into Light' => 'Shadows Into Light',
			'Shanti' => 'Shanti',
			'Short Stack' => 'Short Stack',
			'Sigmar One' => 'Sigmar One',
			'Six Caps' => 'Six Caps',
			'Slackey' => 'Slackey',
			'Smokum' => 'Smokum',
			'Smythe' => 'Smythe',
			'Sniglet' => 'Sniglet',
			'Snippet' => 'Snippet',
			'Sorts Mill Goudy' => 'Sorts Mill Goudy',
			'Special Elite' => 'Special Elite',
			'Spinnaker' => 'Spinnaker',
			'Stardos Stencil' => 'Stardos Stencil',
			'Sue Ellen Francisco' => 'Sue Ellen Francisco',
			'Suez One' => 'Suez One',
			'Sunshiney' => 'Sunshiney',
			'Swanky and Moo Moo' => 'Swanky and Moo Moo',
			'Syncopate' => 'Syncopate',
			'Tangerine' => 'Tangerine',
			'Tenor Sans' => 'Tenor Sans',
			'Terminal Dosis Light' => 'Terminal Dosis Light',
			'Tinos' => 'Tinos',
			'Titillium Web' => 'Titillium Web',
			'Tulpen One' => 'Tulpen One',
			'Ubuntu' => 'Ubuntu',
			'Ultra' => 'Ultra',
      'UnifrakturCook' => 'UnifrakturCook',
			'UnifrakturMaguntia' => 'UnifrakturMaguntia',
      'Unkempt' => 'Unkempt',
			'Unna' => 'Unna',
			'Varela' => 'Varela',
			'Varela Round' => 'Varela Round',
			'Vibur' => 'Vibur',
			'Vidaloka' => 'Vidaloka',
			'Volkhov' => 'Volkhov',
			'Vollkorn' => 'Vollkorn',
			'Voltaire' => 'Voltaire',
			'VT323' => 'VT323',
			'Waiting for the Sunrise' => 'Waiting for the Sunrise',
			'Wallpoet' => 'Wallpoet',
			'Walter Turncoat' => 'Walter Turncoat',
			'Wire One' => 'Wire One',
			'Yanone Kaffeesatz' => 'Yanone Kaffeesatz',
			'Yellowtail' => 'Yellowtail',
			'Yeseva One' => 'Yeseva One',
			'Zeyada' => 'Zeyada');

/**
 * Sections and Options.
 *  
*/     
    $wp_customize->add_section('happenstance_general_settings', array(
        'title'    => __('HappenStance General Settings', 'happenstance'),
        'description' => '',
        'priority' => 120,
    ));
    $wp_customize->add_section('happenstance_header_settings', array(
        'title'    => __('HappenStance Header Settings', 'happenstance'),
        'description' => '',
        'priority' => 130,
    ));    
    $wp_customize->add_section('happenstance_posts_settings', array(
        'title'    => __('HappenStance Posts Settings', 'happenstance'),
        'description' => '',
        'priority' => 140,
    ));
    $wp_customize->add_section('happenstance_post_entries_settings', array(
        'title'    => __('HappenStance Post Entries/Blog Page Settings', 'happenstance'),
        'description' => '',
        'priority' => 150,
    ));
    $wp_customize->add_section('happenstance_font_settings', array(
        'title'    => __('HappenStance Font Settings', 'happenstance'),
        'description' => '',
        'priority' => 160,
    ));
    
    //  =============================
    //  = Color Scheme              =
    //  =============================
    $wp_customize->add_setting('happenstance_color_scheme', array(
        'default'           => '#169fe6',
        'capability'        => 'edit_theme_options',
        'type'              => 'theme_mod',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'happenstance_color_scheme_control', array(
        'label'    => __('Color Scheme', 'happenstance'),
        'section'  => 'colors',
        'settings' => 'happenstance_color_scheme',
    )));
    
    //  =============================
    //  = Layout Style              =
    //  =============================
    $wp_customize->add_setting('happenstance_layout', array(
        'default'        => 'Boxed',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'happenstance_sanitize_text',
    ));
 
    $wp_customize->add_control('happenstance_layout_control', array(
        'label'      => __('Layout Style', 'happenstance'),
        'section'    => 'happenstance_general_settings',
        'settings'   => 'happenstance_layout',
        'type'       => 'radio',
        'choices'    => array(
            'Boxed' => __( 'Boxed' , 'happenstance' ),
            'Wide' => __( 'Wide' , 'happenstance' ),
        ),
    ));
    
    //  =================================
    //  = Background Image Size         =
    //  =================================
    $wp_customize->add_setting('happenstance_background_image_size', array(
        'default'        => 'Default',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'happenstance_sanitize_text',
    ));
 
    $wp_customize->add_control('happenstance_background_image_size_control', array(
        'label'      => __('Background Image Size', 'happenstance'),
        'section'    => 'background_image',
        'settings'   => 'happenstance_background_image_size',
        'type'       => 'radio',
        'choices'    => array(
            'Default' => __( 'Default' , 'happenstance' ),
            'Cover' => __( 'Cover' , 'happenstance' ),
        ),
    ));
    
    //  =================================
    //  = Background Pattern            =
    //  =================================
    $wp_customize->add_setting('happenstance_display_background_pattern', array(
        'default'        => 'Display',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'happenstance_sanitize_text',
    ));
 
    $wp_customize->add_control('happenstance_display_background_pattern_control', array(
        'label'      => __('Background Pattern (in Boxed layout style)', 'happenstance'),
        'section'    => 'happenstance_general_settings',
        'settings'   => 'happenstance_display_background_pattern',
        'type'       => 'radio',
        'active_callback' => 'happenstance_is_boxed_layout',
        'choices'    => array(
            'Display' => __( 'Display' , 'happenstance' ),
            'Hide' => __( 'Hide' , 'happenstance' ),
        ),
    ));
    
    //  =================================
    //  = Background Pattern Opacity    =
    //  =================================
    $wp_customize->add_setting('happenstance_background_pattern_opacity', array(
        'default'        => '50',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'happenstance_sanitize_text',
    ));
 
    $wp_customize->add_control('happenstance_background_pattern_opacity_control', array(
        'label'      => __('Background Pattern Opacity', 'happenstance'),
        'section'    => 'happenstance_general_settings',
        'settings'   => 'happenstance_background_pattern_opacity',
        'type'       => 'radio',
        'active_callback' => 'happenstance_is_boxed_layout',
        'choices'    => array(
            '100' => '100',
            '90' => '90',
            '80' => '80',
            '70' => '70',
            '60' => '60',
            '50' => '50',
            '40' => '40',
            '30' => '30',
            '20' => '20',
            '10' => '10',
        ),
    ));
    
    //  =================================
    //  = Display Scroll-top Button     =
    //  =================================
    $wp_customize->add_setting('happenstance_display_scroll_top', array(
        'default'        => 'Display',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'happenstance_sanitize_text',
    ));
 
    $wp_customize->add_control('happenstance_display_scroll_top_control', array(
        'label'      => __('Display Scroll-top Button', 'happenstance'),
        'section'    => 'happenstance_general_settings',
        'settings'   => 'happenstance_display_scroll_top',
        'type'       => 'radio',
        'choices'    => array(
            'Display' => __( 'Display' , 'happenstance' ),
            'Hide' => __( 'Hide' , 'happenstance' ),
        ),
    ));
    
    //  ==================================
    //  = Display Shadow                 =
    //  ==================================
    $wp_customize->add_setting('happenstance_display_main_shadow', array(
        'default'        => 'Display',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'happenstance_sanitize_text',
    ));
 
    $wp_customize->add_control('happenstance_display_main_shadow_control', array(
        'label'      => __('Display Shadow (in Boxed layout style)', 'happenstance'),
        'section'    => 'happenstance_general_settings',
        'settings'   => 'happenstance_display_main_shadow',
        'type'       => 'radio',
        'active_callback' => 'happenstance_is_boxed_layout',
        'choices'    => array(
            'Display' => __( 'Display' , 'happenstance' ),
            'Hide' => __( 'Hide' , 'happenstance' ),
        ),
    ));
    
    //  ==================================
    //  = Sidebar Position               =
    //  ==================================
    $wp_customize->add_setting('happenstance_display_sidebar', array(
        'default'        => 'Right',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'happenstance_sanitize_text',
    ));
 
    $wp_customize->add_control('happenstance_display_sidebar_control', array(
        'label'      => __('Sidebar Position', 'happenstance'),
        'section'    => 'happenstance_general_settings',
        'settings'   => 'happenstance_display_sidebar',
        'type'       => 'radio',
        'choices'    => array(
            'Right' => __( 'Right' , 'happenstance' ),
            'Left' => __( 'Left' , 'happenstance' ),
            'Without Sidebar' => __( 'Without Sidebar' , 'happenstance' ),
        ),
    ));
    
    //  ==================================
    //  = Display Header Image           =
    //  ==================================
    $wp_customize->add_setting('happenstance_display_header_image', array(
        'default'        => 'Everywhere',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'happenstance_sanitize_text',
    ));
 
    $wp_customize->add_control('happenstance_display_header_image_control', array(
        'label'      => __('Display Header Image', 'happenstance'),
        'section'    => 'header_image',
        'settings'   => 'happenstance_display_header_image',
        'type'       => 'radio',
        'choices'    => array(
            'Everywhere' => __( 'Everywhere' , 'happenstance' ),
            'Only on Homepage' => __( 'Only on Homepage' , 'happenstance' ),
        ),
    ));
    
    //  =============================
    //  = Header Image Headline     =
    //  =============================
    $wp_customize->add_setting('happenstance_header_image_headline', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'happenstance_sanitize_text',
    ));
 
    $wp_customize->add_control('happenstance_header_image_headline_control', array(
        'label'      => __('Homepage Header Image Headline', 'happenstance'),
        'section'    => 'header_image',
        'settings'   => 'happenstance_header_image_headline',
    ));
    
    //  ===============================
    //  = Header Image Headline Color =
    //  ===============================
    $wp_customize->add_setting('happenstance_header_image_headline_color', array(
        'default'           => '#ffffff',
        'capability'        => 'edit_theme_options',
        'type'              => 'theme_mod',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'happenstance_header_image_headline_color_control', array(
        'label'    => __('Homepage Header Image Headline Color', 'happenstance'),
        'section'  => 'header_image',
        'settings' => 'happenstance_header_image_headline_color',
    )));
    
    //  =============================
    //  = Header Image Link URL     =
    //  =============================
    $wp_customize->add_setting('happenstance_header_image_link_url', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'happenstance_sanitize_uri',
    ));
 
    $wp_customize->add_control('happenstance_header_image_link_url_control', array(
        'label'      => __('Homepage Header Image Link URL', 'happenstance'),
        'section'    => 'header_image',
        'type'       => 'url',
        'settings'   => 'happenstance_header_image_link_url',
    ));
    
    //  =============================
    //  = Header Image Link Text    =
    //  =============================
    $wp_customize->add_setting('happenstance_header_image_link_text', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'happenstance_sanitize_text',
    ));
 
    $wp_customize->add_control('happenstance_header_image_link_text_control', array(
        'label'      => __('Homepage Header Image Link Text', 'happenstance'),
        'section'    => 'header_image',  
        'settings'   => 'happenstance_header_image_link_text',
    ));
    
    //  ====================================
    //  = Display Site Description         =
    //  ====================================
    $wp_customize->add_setting('happenstance_display_site_description', array(
        'default'        => 'Display',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'happenstance_sanitize_text',
    ));
 
    $wp_customize->add_control('happenstance_display_site_description_control', array(
        'label'      => __('Display Site Description', 'happenstance'),
        'section'    => 'happenstance_header_settings',
        'settings'   => 'happenstance_display_site_description',
        'type'       => 'radio',
        'choices'    => array(
            'Display' => __( 'Display' , 'happenstance' ),
            'Hide' => __( 'Hide' , 'happenstance' ),
        ),
    ));
    
    //  ====================================
    //  = Display Search Form              =
    //  ====================================
    $wp_customize->add_setting('happenstance_display_search_form', array(
        'default'        => 'Display',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'happenstance_sanitize_text',
    ));
 
    $wp_customize->add_control('happenstance_display_search_form_control', array(
        'label'      => __('Display Search Form', 'happenstance'),
        'section'    => 'happenstance_header_settings',
        'settings'   => 'happenstance_display_search_form',
        'type'       => 'radio',
        'choices'    => array(
            'Display' => __( 'Display' , 'happenstance' ),
            'Hide' => __( 'Hide' , 'happenstance' ),
        ),
    ));

    //  ====================================
    //  = Fixed Primary Menu               =
    //  ====================================
    $wp_customize->add_setting('happenstance_fixed_menu', array(
        'default'        => 'Enable',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'happenstance_sanitize_text',
    ));
 
    $wp_customize->add_control('happenstance_fixed_menu_control', array(
        'label'      => __('Fixed Primary Menu while Scrolling', 'happenstance'),
        'section'    => 'happenstance_header_settings',
        'settings'   => 'happenstance_fixed_menu',
        'type'       => 'radio',
        'choices'    => array(
            'Enable' => __( 'Enable' , 'happenstance' ),
            'Disable' => __( 'Disable' , 'happenstance' ),
        ),
    ));
    
    //  ====================================
    //  = Secondary Menu Format            =
    //  ====================================
    $wp_customize->add_setting('happenstance_secondary_menu_format', array(
        'default'        => 'Static',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'happenstance_sanitize_text',
    ));
 
    $wp_customize->add_control('happenstance_secondary_menu_format_control', array(
        'label'      => __('Secondary Menu Format', 'happenstance'),
        'section'    => 'happenstance_header_settings',
        'settings'   => 'happenstance_secondary_menu_format',
        'type'       => 'radio',
        'choices'    => array(
            'Static' => __( 'Static' , 'happenstance' ),
            'Slider' => __( 'Slider' , 'happenstance' ),
        ),
    ));
    
    //  =============================
    //  = Postal Address            =
    //  =============================
    $wp_customize->add_setting('happenstance_header_address', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'happenstance_sanitize_text',
    ));
 
    $wp_customize->add_control('happenstance_header_address_control', array(
        'label'      => __('Postal Address', 'happenstance'),
        'section'    => 'happenstance_header_settings',
        'settings'   => 'happenstance_header_address',
    ));
    
    //  =============================
    //  = Email Address             =
    //  =============================
    $wp_customize->add_setting('happenstance_header_email', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'happenstance_sanitize_text',
    ));
 
    $wp_customize->add_control('happenstance_header_email_control', array(
        'label'      => __('Email Address', 'happenstance'),
        'section'    => 'happenstance_header_settings',
        'settings'   => 'happenstance_header_email',
    ));
    
    //  =============================
    //  = Phone Number              =
    //  =============================
    $wp_customize->add_setting('happenstance_header_phone', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'happenstance_sanitize_text',
    ));
 
    $wp_customize->add_control('happenstance_header_phone_control', array(
        'label'      => __('Phone Number', 'happenstance'),
        'section'    => 'happenstance_header_settings',
        'settings'   => 'happenstance_header_phone',
    ));
    
    //  =============================
    //  = Skype Name                =
    //  =============================
    $wp_customize->add_setting('happenstance_header_skype', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'happenstance_sanitize_text',
    ));
 
    $wp_customize->add_control('happenstance_header_skype_control', array(
        'label'      => __('Skype Name', 'happenstance'),
        'section'    => 'happenstance_header_settings',
        'settings'   => 'happenstance_header_skype',
    ));
    
    //  ==========================================
    //  = Display Featured Image on single posts =
    //  ==========================================
    $wp_customize->add_setting('happenstance_display_image_post', array(
        'default'        => 'Display',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'happenstance_sanitize_text',
    ));
 
    $wp_customize->add_control('happenstance_display_image_post_control', array(
        'label'      => __('Display Featured Image on single posts', 'happenstance'),
        'section'    => 'happenstance_posts_settings',
        'settings'   => 'happenstance_display_image_post',
        'type'       => 'radio',
        'choices'    => array(
            'Display' => __( 'Display' , 'happenstance' ),
            'Hide' => __( 'Hide' , 'happenstance' ),
        ),
    ));
    
    //  ==========================================
    //  = Display Manual Excerpt on single posts =
    //  ==========================================
    $wp_customize->add_setting('happenstance_display_excerpt_post', array(
        'default'        => 'Display',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'happenstance_sanitize_text',
    ));
 
    $wp_customize->add_control('happenstance_display_excerpt_post_control', array(
        'label'      => __('Display Manual Excerpt on single posts', 'happenstance'),
        'section'    => 'happenstance_posts_settings',
        'settings'   => 'happenstance_display_excerpt_post',
        'type'       => 'radio',
        'choices'    => array(
            'Display' => __( 'Display' , 'happenstance' ),
            'Hide' => __( 'Hide' , 'happenstance' ),
        ),
    ));
    
    //  ====================================
    //  = Display Meta Box on single posts =
    //  ====================================
    $wp_customize->add_setting('happenstance_display_meta_post', array(
        'default'        => 'Display',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'happenstance_sanitize_text',
    ));
 
    $wp_customize->add_control('happenstance_display_meta_post_control', array(
        'label'      => __('Display Meta Box on single posts', 'happenstance'),
        'section'    => 'happenstance_posts_settings',
        'settings'   => 'happenstance_display_meta_post',
        'type'       => 'radio',
        'choices'    => array(
            'Display' => __( 'Display' , 'happenstance' ),
            'Hide' => __( 'Hide' , 'happenstance' ),
        ),
    ));
    
    //  =================================
    //  = Next/Previous Post Navigation =
    //  =================================
    $wp_customize->add_setting('happenstance_next_preview_post', array(
        'default'        => 'Display',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'happenstance_sanitize_text',
    ));
 
    $wp_customize->add_control('happenstance_next_preview_post_control', array(
        'label'      => __('Display Next/Previous Post Navigation on single posts', 'happenstance'),
        'section'    => 'happenstance_posts_settings',
        'settings'   => 'happenstance_next_preview_post',
        'type'       => 'radio',
        'choices'    => array(
            'Display' => __( 'Display' , 'happenstance' ),
            'Hide' => __( 'Hide' , 'happenstance' ),
        ),
    ));
    
    //  =================================
    //  = Display Related Posts         =
    //  =================================
    $wp_customize->add_setting('happenstance_display_related_posts', array(
        'default'        => 'Display',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'happenstance_sanitize_text',
    ));
 
    $wp_customize->add_control('happenstance_display_related_posts_control', array(
        'label'      => __('Display Related Posts on single posts', 'happenstance'),
        'section'    => 'happenstance_posts_settings',
        'settings'   => 'happenstance_display_related_posts',
        'type'       => 'radio',
        'choices'    => array(
            'Display' => __( 'Display' , 'happenstance' ),
            'Hide' => __( 'Hide' , 'happenstance' ),
        ),
    ));
    
    //  =============================
    //  = Related Posts Headline    =
    //  =============================
    $wp_customize->add_setting('happenstance_related_posts_headline', array(
        'default'        => __( 'Related Posts' , 'happenstance' ),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'happenstance_sanitize_text',
    ));
 
    $wp_customize->add_control('happenstance_related_posts_headline_control', array(
        'label'      => __('Related Posts Headline', 'happenstance'),
        'section'    => 'happenstance_posts_settings',
        'settings'   => 'happenstance_related_posts_headline',
    ));
    
    //  =============================
    //  = Number of Related Posts   =
    //  =============================
    $wp_customize->add_setting('happenstance_related_posts_number', array(
        'default'        => '6',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'happenstance_sanitize_text',
    ));
 
    $wp_customize->add_control('happenstance_related_posts_number_control', array(
        'label'      => __('Number of Related Posts', 'happenstance'),
        'section'    => 'happenstance_posts_settings',
        'type'       => 'number',
        'settings'   => 'happenstance_related_posts_number',
    ));
    
    //  =================================
    //  = Related Posts Format          =
    //  =================================
    $wp_customize->add_setting('happenstance_related_posts_format', array(
        'default'        => 'Slider',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'happenstance_sanitize_text',
    ));
 
    $wp_customize->add_control('happenstance_related_posts_format_control', array(
        'label'      => __('Related Posts Format', 'happenstance'),
        'section'    => 'happenstance_posts_settings',
        'settings'   => 'happenstance_related_posts_format',
        'type'       => 'radio',
        'choices'    => array(
            'Slider' => __( 'Slider' , 'happenstance' ),
            'Unordered List' => __( 'Unordered List' , 'happenstance' ),
        ),
    ));
    
    //  ==================================
    //  = Post Entries Format            =
    //  ==================================
    $wp_customize->add_setting('happenstance_post_entry_format', array(
        'default'        => 'One Column',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'happenstance_sanitize_text',
    ));
 
    $wp_customize->add_control('happenstance_post_entry_format_control', array(
        'label'      => __('Post Entries Format', 'happenstance'),
        'section'    => 'happenstance_post_entries_settings',
        'settings'   => 'happenstance_post_entry_format',
        'type'       => 'radio',
        'choices'    => array(
            'One Column' => __( 'One Column' , 'happenstance' ),
            'Grid - Masonry' => __( 'Grid - Masonry' , 'happenstance' ),
        ),
    ));
    
    //  ==============================================
    //  = Number of Columns in Grid - Masonry Format =
    //  ==============================================
    $wp_customize->add_setting('happenstance_grid_columns', array(
        'default'        => '3',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'happenstance_sanitize_text',
    ));
 
    $wp_customize->add_control('happenstance_grid_columns_control', array(
        'label'      => __('Number of Columns in Grid - Masonry Format', 'happenstance'),
        'section'    => 'happenstance_post_entries_settings',
        'settings'   => 'happenstance_grid_columns',
        'type'       => 'radio',
        'choices'    => array(
            '2' => '2',
            '3' => '3',
            '4' => '4',
        ),
    ));
    
    //  ====================================
    //  = Display Meta Box on Post Entries =
    //  ====================================
    $wp_customize->add_setting('happenstance_display_meta_post_entry', array(
        'default'        => 'Display',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'happenstance_sanitize_text',
    ));
 
    $wp_customize->add_control('happenstance_display_meta_post_entry_control', array(
        'label'      => __('Display Meta Box on Post Entries', 'happenstance'),
        'section'    => 'happenstance_post_entries_settings',
        'settings'   => 'happenstance_display_meta_post_entry',
        'type'       => 'radio',
        'choices'    => array(
            'Display' => __( 'Display' , 'happenstance' ),
            'Hide' => __( 'Hide' , 'happenstance' ),
        ),
    ));
    
    //  ===============================
    //  = Featured Images Size        =
    //  ===============================
    $wp_customize->add_setting('happenstance_featured_image_size', array(
        'default'        => 'Full Size',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'happenstance_sanitize_text',
    ));
 
    $wp_customize->add_control('happenstance_featured_image_size_control', array(
        'label'      => __('Featured Images Size', 'happenstance'),
        'section'    => 'happenstance_post_entries_settings',
        'settings'   => 'happenstance_featured_image_size',
        'type'       => 'radio',
        'choices'    => array(
            'Full Size' => __( 'Full Size' , 'happenstance' ),
            'Thumbnail Size' => __( 'Thumbnail Size' , 'happenstance' ),
        ),
    ));
    
    //  ================================
    //  = Featured Images Hover Effect =
    //  ================================
    $wp_customize->add_setting('happenstance_featured_image_hover', array(
        'default'        => 'None',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'happenstance_sanitize_text',
    ));
 
    $wp_customize->add_control('happenstance_featured_image_hover_control', array(
        'label'      => __('Featured Images Hover Effect', 'happenstance'),
        'section'    => 'happenstance_post_entries_settings',
        'settings'   => 'happenstance_featured_image_hover',
        'type'       => 'radio',
        'choices'    => array(
            'None' => __( 'None' , 'happenstance' ),
            'Fade' => __( 'Fade' , 'happenstance' ),
            'Focus' => __( 'Focus' , 'happenstance' ),
            'Shadow' => __( 'Shadow' , 'happenstance' ),
            'Tilt' => __( 'Tilt' , 'happenstance' ),
        ),
    ));
    
    //  ===============================
    //  = Content/Excerpt Displaying  =
    //  ===============================
    $wp_customize->add_setting('happenstance_content_archives', array(
        'default'        => 'Excerpt',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'happenstance_sanitize_text',
    ));
 
    $wp_customize->add_control('happenstance_content_archives_control', array(
        'label'      => __('Content/Excerpt Displaying', 'happenstance'),
        'section'    => 'happenstance_post_entries_settings',
        'settings'   => 'happenstance_content_archives',
        'type'       => 'radio',
        'choices'    => array(
            'Excerpt' => __( 'Excerpt' , 'happenstance' ),
            'Content' => __( 'Content' , 'happenstance' ),
        ),
    ));
    
    //  =============================
    //  = Excerpt Length            =
    //  =============================
    $wp_customize->add_setting('happenstance_excerpt_length', array(
        'default'        => '40',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'happenstance_sanitize_text',
    ));
 
    $wp_customize->add_control('happenstance_excerpt_length_control', array(
        'label'      => __('Excerpt Length (number of words)', 'happenstance'),
        'section'    => 'happenstance_post_entries_settings',
        'type'       => 'number',
        'settings'   => 'happenstance_excerpt_length',
    ));
    
    //  =================================
    //  = Latest Posts Page Headline    =
    //  =================================
    $wp_customize->add_setting('happenstance_latest_posts_headline', array(
        'default'        => __( 'Latest Posts' , 'happenstance' ),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'happenstance_sanitize_text',
    ));
 
    $wp_customize->add_control('happenstance_latest_posts_headline_control', array(
        'label'      => __('Latest Posts (Blog) Page Headline', 'happenstance'),
        'section'    => 'happenstance_post_entries_settings',
        'settings'   => 'happenstance_latest_posts_headline',
    ));
    
    //  ==============================
    //  = Character Set              =
    //  ==============================
    $wp_customize->add_setting('happenstance_character_set', array(
        'default'        => 'latin',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'happenstance_sanitize_text',
    ));
 
    $wp_customize->add_control('happenstance_character_set_control', array(
        'label'      => __('Character Set', 'happenstance'),
        'section'    => 'happenstance_font_settings',
        'settings'   => 'happenstance_character_set',
        'type'       => 'radio',
        'choices'    => array(
            'latin' => __( 'Latin' , 'happenstance' ),
            'latin-ext' => __( 'Latin Extended' , 'happenstance' ),
            'cyrillic' => __( 'Cyrillic' , 'happenstance' ),
            'cyrillic-ext' => __( 'Cyrillic Extended' , 'happenstance' ),
            'greek' => __( 'Greek' , 'happenstance' ),
            'greek-ext' => __( 'Greek Extended' , 'happenstance' ),   
            'vietnamese' => __( 'Vietnamese' , 'happenstance' ),
            'arabic' => __( 'Arabic' , 'happenstance' ),
            'bengali' => __( 'Bengali' , 'happenstance' ),
            'hebrew' => __( 'Hebrew' , 'happenstance' ),
        ),
    ));
 
    //  =============================
    //  = Body font                 =
    //  =============================
     $wp_customize->add_setting('happenstance_body_google_fonts', array(
        'default'        => 'default',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'happenstance_sanitize_text', 
    ));
    
    $wp_customize->add_control( 'happenstance_body_google_fonts_control', array(
        'settings' => 'happenstance_body_google_fonts',
        'label'   => __('Body font', 'happenstance'),
        'section' => 'happenstance_font_settings',
        'type'    => 'select',
        'choices'    => $happenstance_fonts,
    ));
    
    //  ==========================
    //  = Body font size         =
    //  ==========================
    $wp_customize->add_setting('happenstance_body_google_fonts_size', array(
        'default'        => '14',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'happenstance_sanitize_text',
    ));
 
    $wp_customize->add_control('happenstance_body_google_fonts_size_control', array(
        'label'      => __('Body font size', 'happenstance'),
        'section'    => 'happenstance_font_settings',
        'type'       => 'number',
        'settings'   => 'happenstance_body_google_fonts_size',
    ));
    
    //  =============================
    //  = Site Title font           =
    //  =============================
     $wp_customize->add_setting('happenstance_headings_google_fonts', array(
        'default'        => 'default',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'happenstance_sanitize_text', 
    ));
    
    $wp_customize->add_control( 'happenstance_headings_google_fonts_control', array(
        'settings' => 'happenstance_headings_google_fonts',
        'label'   => __('Site Title font', 'happenstance'),
        'section' => 'happenstance_font_settings',
        'type'    => 'select',
        'choices'    => $happenstance_fonts,
    ));
    
    //  ==========================
    //  = Site Title font size   =
    //  ==========================
    $wp_customize->add_setting('happenstance_headings_google_fonts_size', array(
        'default'        => '48',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'happenstance_sanitize_text',
    ));
 
    $wp_customize->add_control('happenstance_headings_google_fonts_size_control', array(
        'label'      => __('Site Title font size', 'happenstance'),
        'section'    => 'happenstance_font_settings',
        'type'       => 'number',
        'settings'   => 'happenstance_headings_google_fonts_size',
    ));
    
    //  =============================
    //  = Site Description font     =
    //  =============================
     $wp_customize->add_setting('happenstance_description_google_fonts', array(
        'default'        => 'default',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'happenstance_sanitize_text',
    ));
    
    $wp_customize->add_control( 'happenstance_description_google_fonts_control', array(
        'settings' => 'happenstance_description_google_fonts',
        'label'   => __('Site Description font', 'happenstance'),
        'section' => 'happenstance_font_settings',
        'type'    => 'select',
        'choices'    => $happenstance_fonts,
    ));
    
    //  ==============================
    //  = Site Description font size =
    //  ==============================
    $wp_customize->add_setting('happenstance_description_google_fonts_size', array(
        'default'        => '20',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'happenstance_sanitize_text',
    ));
 
    $wp_customize->add_control('happenstance_description_google_fonts_size_control', array(
        'label'      => __('Site Description font size', 'happenstance'),
        'section'    => 'happenstance_font_settings',
        'type'       => 'number',
        'settings'   => 'happenstance_description_google_fonts_size',
    ));
    
    //  =============================
    //  = H1- H6 Headlines font     =
    //  =============================
     $wp_customize->add_setting('happenstance_headline_google_fonts', array(
        'default'        => 'default',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'happenstance_sanitize_text', 
    ));
    
    $wp_customize->add_control( 'happenstance_headline_google_fonts_control', array(
        'settings' => 'happenstance_headline_google_fonts',
        'label'   => __('Page/Post Headlines (h1 - h6) font', 'happenstance'),
        'section' => 'happenstance_font_settings',
        'type'    => 'select',
        'choices'    => $happenstance_fonts,
    ));
    
    //  ==========================
    //  = H1 Headlines font size =
    //  ==========================
    $wp_customize->add_setting('happenstance_headline_h1_size', array(
        'default'        => '27',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'happenstance_sanitize_text',
    ));
 
    $wp_customize->add_control('happenstance_headline_h1_size_control', array(
        'label'      => __('H1 Headlines font size', 'happenstance'),
        'section'    => 'happenstance_font_settings',
        'type'       => 'number',
        'settings'   => 'happenstance_headline_h1_size',
    ));
    
    //  ==========================
    //  = H2 Headlines font size =
    //  ==========================
    $wp_customize->add_setting('happenstance_headline_h2_size', array(
        'default'        => '21',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'happenstance_sanitize_text',
    ));
 
    $wp_customize->add_control('happenstance_headline_h2_size_control', array(
        'label'      => __('H2 Headlines font size', 'happenstance'),
        'section'    => 'happenstance_font_settings',
        'type'       => 'number',
        'settings'   => 'happenstance_headline_h2_size',
    ));
    
    //  ==========================
    //  = H3 Headlines font size =
    //  ==========================
    $wp_customize->add_setting('happenstance_headline_h3_size', array(
        'default'        => '18',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'happenstance_sanitize_text',
    ));
 
    $wp_customize->add_control('happenstance_headline_h3_size_control', array(
        'label'      => __('H3 Headlines font size', 'happenstance'),
        'section'    => 'happenstance_font_settings',
        'type'       => 'number',
        'settings'   => 'happenstance_headline_h3_size',
    ));
    
    //  ==========================
    //  = H4 Headlines font size =
    //  ==========================
    $wp_customize->add_setting('happenstance_headline_h4_size', array(
        'default'        => '16',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'happenstance_sanitize_text',
    ));
 
    $wp_customize->add_control('happenstance_headline_h4_size_control', array(
        'label'      => __('H4 Headlines font size', 'happenstance'),
        'section'    => 'happenstance_font_settings',
        'type'       => 'number',
        'settings'   => 'happenstance_headline_h4_size',
    ));
    
    //  ==========================
    //  = H5 Headlines font size =
    //  ==========================
    $wp_customize->add_setting('happenstance_headline_h5_size', array(
        'default'        => '15',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'happenstance_sanitize_text',
    ));
 
    $wp_customize->add_control('happenstance_headline_h5_size_control', array(
        'label'      => __('H5 Headlines font size', 'happenstance'),
        'section'    => 'happenstance_font_settings',
        'type'       => 'number',
        'settings'   => 'happenstance_headline_h5_size',
    ));
    
    //  ==========================
    //  = H6 Headlines font size =
    //  ==========================
    $wp_customize->add_setting('happenstance_headline_h6_size', array(
        'default'        => '14',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'happenstance_sanitize_text',
    ));
 
    $wp_customize->add_control('happenstance_headline_h6_size_control', array(
        'label'      => __('H6 Headlines font size', 'happenstance'),
        'section'    => 'happenstance_font_settings',
        'type'       => 'number',
        'settings'   => 'happenstance_headline_h6_size',
    ));
    
    //  =============================
    //  = Post Entry Headline font  =
    //  =============================
     $wp_customize->add_setting('happenstance_postentry_google_fonts', array(
        'default'        => 'default',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'happenstance_sanitize_text', 
    ));
    
    $wp_customize->add_control( 'happenstance_postentry_google_fonts_control', array(
        'settings' => 'happenstance_postentry_google_fonts',
        'label'   => __('Post Entry Headline font', 'happenstance'),
        'section' => 'happenstance_font_settings',
        'type'    => 'select',
        'choices'    => $happenstance_fonts,
    ));
    
    //  =================================
    //  = Post Entry Headline font size =
    //  =================================
    $wp_customize->add_setting('happenstance_postentry_google_fonts_size', array(
        'default'        => '21',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'happenstance_sanitize_text',
    ));
 
    $wp_customize->add_control('happenstance_postentry_google_fonts_size_control', array(
        'label'      => __('Post Entry Headline font size', 'happenstance'),
        'section'    => 'happenstance_font_settings',
        'type'       => 'number',
        'settings'   => 'happenstance_postentry_google_fonts_size',
    ));
    
    //  ========================================
    //  = Sidebar/Footer Widget Headlines font =
    //  ========================================
     $wp_customize->add_setting('happenstance_sidebar_google_fonts', array(
        'default'        => 'default',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'happenstance_sanitize_text', 
    ));
    
    $wp_customize->add_control( 'happenstance_sidebar_google_fonts_control', array(
        'settings' => 'happenstance_sidebar_google_fonts',
        'label'   => __('Sidebar/Footer Widget Headlines font', 'happenstance'),
        'section' => 'happenstance_font_settings',
        'type'    => 'select',
        'choices'    => $happenstance_fonts,
    ));
    
    //  ======================================
    //  = Sidebar Widget Headlines font size =
    //  ======================================
    $wp_customize->add_setting('happenstance_sidebar_google_fonts_size', array(
        'default'        => '19',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'happenstance_sanitize_text',
    ));
 
    $wp_customize->add_control('happenstance_sidebar_google_fonts_size_control', array(
        'label'      => __('Sidebar Widget Headlines font size', 'happenstance'),
        'section'    => 'happenstance_font_settings',
        'type'       => 'number',
        'settings'   => 'happenstance_sidebar_google_fonts_size',
    ));
    
    //  ======================================
    //  = Footer Widget Headlines font size  =
    //  ======================================
    $wp_customize->add_setting('happenstance_footer_google_fonts_size', array(
        'default'        => '19',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'happenstance_sanitize_text',
    ));
 
    $wp_customize->add_control('happenstance_footer_google_fonts_size_control', array(
        'label'      => __('Footer Widget Headlines font size', 'happenstance'),
        'section'    => 'happenstance_font_settings',
        'type'       => 'number',
        'settings'   => 'happenstance_footer_google_fonts_size',
    ));
    
    //  ===========================================
    //  = Latest Posts Page Widgets Headline font =
    //  ===========================================
     $wp_customize->add_setting('happenstance_blog_widgets_google_fonts', array(
        'default'        => 'default',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'happenstance_sanitize_text', 
    ));
    
    $wp_customize->add_control( 'happenstance_blog_widgets_google_fonts_control', array(
        'settings' => 'happenstance_blog_widgets_google_fonts',
        'label'   => __('Latest Posts Page Widgets Headline font', 'happenstance'),
        'section' => 'happenstance_font_settings',
        'type'    => 'select',
        'choices'    => $happenstance_fonts,
    ));
    
    //  ================================================
    //  = Latest Posts Page Widgets Headline font size =
    //  ================================================
    $wp_customize->add_setting('happenstance_blog_widgets_google_fonts_size', array(
        'default'        => '27',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'happenstance_sanitize_text',
    ));
 
    $wp_customize->add_control('happenstance_blog_widgets_google_fonts_size_control', array(
        'label'      => __('Latest Posts Page Widgets Headline font size', 'happenstance'),
        'section'    => 'happenstance_font_settings',
        'type'       => 'number',
        'settings'   => 'happenstance_blog_widgets_google_fonts_size',
    ));
    
    //  =============================
    //  = Primary Header Menu font  =
    //  =============================
     $wp_customize->add_setting('happenstance_menu_google_fonts', array(
        'default'        => 'default',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'happenstance_sanitize_text', 
    ));
    
    $wp_customize->add_control( 'happenstance_menu_google_fonts_control', array(
        'settings' => 'happenstance_menu_google_fonts',
        'label'   => __('Primary Header Menu font', 'happenstance'),
        'section' => 'happenstance_font_settings',
        'type'    => 'select',
        'choices'    => $happenstance_fonts,
    ));
    
    //  =================================
    //  = Primary Header Menu font size =
    //  =================================
    $wp_customize->add_setting('happenstance_menu_google_fonts_size', array(
        'default'        => '14',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'happenstance_sanitize_text',
    ));
 
    $wp_customize->add_control('happenstance_menu_google_fonts_size_control', array(
        'label'      => __('Primary Header Menu font size', 'happenstance'),
        'section'    => 'happenstance_font_settings',
        'type'       => 'number',
        'settings'   => 'happenstance_menu_google_fonts_size',
    ));
    
    //  ==============================
    //  = Secondary Header Menu font =
    //  ==============================
     $wp_customize->add_setting('happenstance_secondary_menu_google_fonts', array(
        'default'        => 'default',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'happenstance_sanitize_text', 
    ));
    
    $wp_customize->add_control( 'happenstance_secondary_menu_google_fonts_control', array(
        'settings' => 'happenstance_secondary_menu_google_fonts',
        'label'   => __('Secondary Header Menu font', 'happenstance'),
        'section' => 'happenstance_font_settings',
        'type'    => 'select',
        'choices'    => $happenstance_fonts,
    ));
    
    //  ===================================
    //  = Secondary Header Menu font size =
    //  ===================================
    $wp_customize->add_setting('happenstance_secondary_menu_google_fonts_size', array(
        'default'        => '13',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'happenstance_sanitize_text',
    ));
 
    $wp_customize->add_control('happenstance_secondary_menu_google_fonts_size_control', array(
        'label'      => __('Secondary Header Menu font size', 'happenstance'),
        'section'    => 'happenstance_font_settings',
        'type'       => 'number',
        'settings'   => 'happenstance_secondary_menu_google_fonts_size',
    ));
}
 
add_action('customize_register', 'happenstance_customize_register');

/**
 * Sanitize URIs
*/
function happenstance_sanitize_uri($uri) {
	if('' === $uri){
		return '';
	}
	return esc_url_raw($uri);
}

/**
 * Sanitize Texts
*/
function happenstance_sanitize_text($str) {
	if('' === $str){
		return '';
	}
	return sanitize_text_field($str);
} ?>
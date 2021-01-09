<?php
/**
* Contains WordPress widget class
*
*/

class super_rss_reader_widget extends WP_Widget{

    // Initialize
    public function __construct(){
        $widget_ops = array(
            'classname' => 'widget_super_rss_reader',
            'description' => __( 'An RSS feed reader widget with advanced features', 'super-rss-reader' )
        );
        
        $control_ops = array( 'width' => 500, 'height' => 500 );
        parent::__construct( 'super_rss_reader', 'Super RSS Reader', $widget_ops, $control_ops );
    }
    
    // Display the Widget
    public function widget( $args, $instance ){

        extract( $args );

        if( empty( $instance[ 'title' ] ) ){
            $title = '';
        }else{
            $title = $before_title . apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) . $after_title;
        }

        echo $before_widget . $title;

        echo '<!-- Start - Super RSS Reader v' . SRR_VERSION . '-->
        <div class="super-rss-reader-widget">';

        SRR_Widget::render_feed( $instance );

        echo '</div><!-- End - Super RSS Reader -->';
        echo $after_widget;

    }
    
    // Save settings
    public function update( $new_instance, $old_instance ){

        $instance = $old_instance;

        $instance[ 'title' ] = stripslashes( $new_instance['title'] );
        $instance[ 'urls' ] = stripslashes( $new_instance['urls']) ;
        $instance[ 'tab_titles' ] = stripslashes( $new_instance['tab_titles'] );
        
        $instance[ 'count' ] = intval( $new_instance['count'] );
        $instance[ 'show_date' ] = intval( isset( $new_instance['show_date'] ) ? $new_instance['show_date'] : 0 );
        $instance[ 'show_desc' ] = intval( isset( $new_instance['show_desc'] ) ? $new_instance['show_desc'] : 0 );
        $instance[ 'show_author' ] = intval( isset( $new_instance['show_author'] ) ? $new_instance['show_author'] : 0 );
        $instance[ 'show_thumb' ] = intval( isset( $new_instance['show_thumb'] ) ? $new_instance['show_thumb'] : 0 );
        $instance[ 'strip_desc' ] = intval( $new_instance['strip_desc'] );
        $instance[ 'strip_title' ] = intval( $new_instance['strip_title'] );
        $instance[ 'read_more' ] = stripslashes( $new_instance['read_more'] );
        $instance[ 'add_nofollow' ] = intval( isset( $new_instance['add_nofollow'] ) ? $new_instance['add_nofollow'] : 0 );
        $instance[ 'open_newtab' ] = intval( isset( $new_instance['open_newtab'] ) ? $new_instance['open_newtab'] : 0 );
        $instance[ 'rich_desc' ] = intval( isset( $new_instance['rich_desc'] ) ? $new_instance['rich_desc'] : 0 );
        $instance[ 'thumbnail_position' ] = stripslashes( $new_instance['thumbnail_position'] );
        $instance[ 'thumbnail_size' ] = stripslashes( $new_instance['thumbnail_size'] );

        $instance[ 'color_style' ] = stripslashes( $new_instance['color_style']);
        $instance[ 'display_type' ] = stripslashes( $new_instance['display_type']);
        $instance[ 'visible_items' ] = intval( $new_instance['visible_items']);
        $instance[ 'ticker_speed' ] = intval( $new_instance['ticker_speed']);
        
        return $instance;
    }
    
    // Widget form
    public function form( $instance ){

        $instance = wp_parse_args( (array) $instance, SRR_Options::defaults() );

        $title = htmlspecialchars( isset( $instance['title'] ) ? $instance[ 'title' ] : '' );
        $urls = htmlspecialchars($instance['urls']);
        $tab_titles = htmlspecialchars($instance['tab_titles']);
        
        $count = intval($instance['count']);
        $show_date = intval($instance['show_date']);
        $show_desc = intval($instance['show_desc']);
        $show_author = intval($instance['show_author']);
        $show_thumb = intval($instance['show_thumb']);
        $open_newtab = intval($instance['open_newtab']);
        $add_nofollow = intval($instance['add_nofollow']);
        $strip_desc = intval($instance['strip_desc']);
        $strip_title = intval($instance['strip_title']);
        $read_more = htmlspecialchars($instance['read_more']);
        $rich_desc = intval($instance['rich_desc']);
        $thumbnail_position = htmlspecialchars($instance['thumbnail_position']);
        $thumbnail_size = htmlspecialchars($instance['thumbnail_size']);
        
        $color_style = stripslashes($instance['color_style']);
        $display_type = stripslashes($instance['display_type']);
        $visible_items = intval($instance['visible_items']);
        $ticker_speed = intval($instance['ticker_speed']);
        
        $option_lists = SRR_Options::select_options();

        // Replacing commas with new lines
        $urls = str_replace( ',', "\n", $urls );
        $tab_titles = str_replace( ',', "\n", $tab_titles );

        ?>

        <div class="srr_settings">

        <div class="srr_row">
            <div class="srr_label srr_xsm"><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title', 'super-rss-reader' ); ?></label></div>
            <div class="srr_field"><input id="<?php echo $this->get_field_id('title');?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" class="widefat"/></div>
        </div>

        <div class="srr_row">
            <div class="srr_label srr_xsm"><label for="<?php echo $this->get_field_id('urls'); ?>"><?php _e( 'URL(s)', 'super-rss-reader' ); ?></label></div>
            <div class="srr_field"><textarea id="<?php echo $this->get_field_id('urls');?>" name="<?php echo $this->get_field_name('urls'); ?>" class="widefat"><?php echo $urls; ?></textarea>
            <small class="srr_small_text"><?php _e( 'Can enter multiple RSS/atom feed URLs in new line', 'super-rss-reader' ); ?></small></div>
        </div>

        <div class="srr_row">
            <div class="srr_label srr_xsm"><label for="<?php echo $this->get_field_id('tab_titles'); ?>"><?php _e( 'Tab titles', 'super-rss-reader' ); ?></label></div>
            <div class="srr_field"><textarea id="<?php echo $this->get_field_id('tab_titles');?>" name="<?php echo $this->get_field_name('tab_titles'); ?>" class="widefat"><?php echo $tab_titles; ?></textarea>
            <small class="srr_small_text"><?php _e( 'Enter corresponding tab titles in new line. Leave empty to take from feed.', 'super-rss-reader' ); ?></small></div>
        </div>

        <ul class="srr_tab_list">
            <li><a href="#" data-tab="general" class="active"><?php _e( 'General', 'super-rss-reader' ); ?></a></li>
            <li><a href="#" data-tab="content"><?php _e( 'Content', 'super-rss-reader' ); ?></a></li>
            <li><a href="#" data-tab="display"><?php _e( 'Display', 'super-rss-reader' ); ?></a></li>
        </ul>

        <section data-tab-id="general" class="active">

            <div class="srr_row">
                <div class="srr_label"><label for="<?php echo $this->get_field_id('count');?>"><?php _e( 'Total items to show', 'super-rss-reader' ); ?></label><?php $this->tt( __( 'Number of feed items to be displayed', 'super-rss-reader' ) ); ?></div>
                <div class="srr_field"><input id="<?php echo $this->get_field_id('count');?>" name="<?php echo $this->get_field_name('count'); ?>" type="number" value="<?php echo $count; ?>" class="widefat" /></div>
            </div>

            <div class="srr_row">
                <div class="srr_label"><label for="<?php echo $this->get_field_id('show_desc'); ?>"><?php _e( 'Show Description', 'super-rss-reader' ); ?></label></div>
                <div class="srr_field"><input id="<?php echo $this->get_field_id('show_desc'); ?>" type="checkbox"  name="<?php echo $this->get_field_name('show_desc'); ?>" value="1" <?php echo $show_desc == "1" ? 'checked="checked"' : ""; ?> /></div>
            </div>

            <div class="srr_row">
                <div class="srr_label"><label for="<?php echo $this->get_field_id('show_date'); ?>"><?php _e( 'Show Date', 'super-rss-reader' ); ?></label></div>
                <div class="srr_field"><input id="<?php echo $this->get_field_id('show_date'); ?>" type="checkbox"  name="<?php echo $this->get_field_name('show_date'); ?>" value="1" <?php echo $show_date == "1" ? 'checked="checked"' : ""; ?> /></div>
            </div>
            
            <div class="srr_row">
                <div class="srr_label"><label for="<?php echo $this->get_field_id('show_author'); ?>"><?php _e( 'Show Author', 'super-rss-reader' ); ?></label></div>
                <div class="srr_field"><input id="<?php echo $this->get_field_id('show_author'); ?>" type="checkbox"  name="<?php echo $this->get_field_name('show_author'); ?>" value="1" <?php echo $show_author == "1" ? 'checked="checked"' : ""; ?> /></div>
            </div>

            <div class="srr_row">
                <div class="srr_label"><label for="<?php echo $this->get_field_id('show_thumb'); ?>"><?php _e( 'Show thumbnail if present', 'super-rss-reader' ); ?></label></div>
                <div class="srr_field"><input id="<?php echo $this->get_field_id('show_thumb'); ?>" type="checkbox"  name="<?php echo $this->get_field_name('show_thumb'); ?>" value="1" <?php echo $show_thumb == "1" ? 'checked="checked"' : ""; ?> /></div>
            </div>
        </section>

        <section data-tab-id="content">

            <div class="srr_row">
                <div class="srr_label"><label for="<?php echo $this->get_field_id('add_nofollow'); ?>"><?php _e( 'Add "no follow" attribute to links', 'super-rss-reader' ); ?></label></div>
                <div class="srr_field"><input id="<?php echo $this->get_field_id('add_nofollow'); ?>" type="checkbox" name="<?php echo $this->get_field_name('add_nofollow'); ?>" value="1" <?php echo $add_nofollow == "1" ? 'checked="checked"' : ""; ?> /></div>
            </div>

            <div class="srr_row">
                <div class="srr_label"><label for="<?php echo $this->get_field_id('open_newtab'); ?>"><?php _e( 'Open links in new tab', 'super-rss-reader' ); ?></label></div>
                <div class="srr_field"><input id="<?php echo $this->get_field_id('open_newtab'); ?>" type="checkbox"  name="<?php echo $this->get_field_name('open_newtab'); ?>" value="1" <?php echo $open_newtab == "1" ? 'checked="checked"' : ""; ?> /></div>
            </div>

            <div class="srr_row">
                <div class="srr_label"><label for="<?php echo $this->get_field_id('strip_title'); ?>"><?php _e( 'Trim title to words', 'super-rss-reader' ); ?></label><?php $this->tt( __( 'The number of words to be displayed. Use 0 to disable trimming', 'super-rss-reader' ) ); ?></div>
                <div class="srr_field"><input id="<?php echo $this->get_field_id('strip_title');?>" name="<?php echo $this->get_field_name('strip_title'); ?>" type="number" value="<?php echo $strip_title; ?>" class="widefat" /></div>
            </div>

            <h4><?php _e( 'Description', 'super-rss-reader' ); ?></h4>

            <div class="srr_row">
                <div class="srr_label"><label for="<?php echo $this->get_field_id('strip_desc');?>"><?php _e( 'Trim description to words', 'super-rss-reader' ); ?></label><?php $this->tt( __( 'The number of words to be displayed. Use 0 to disable trimming', 'super-rss-reader' ) ); ?></div>
                <div class="srr_field"><input id="<?php echo $this->get_field_id('strip_desc');?>" name="<?php echo $this->get_field_name('strip_desc'); ?>" type="number" value="<?php echo $strip_desc; ?>" class="widefat" /></div>
            </div>

            <div class="srr_row">
                <div class="srr_label"><label for="<?php echo $this->get_field_id('read_more'); ?>"><?php _e( 'Read more text', 'super-rss-reader' ); ?></label><?php $this->tt( __( 'Leave blank to hide read more text', 'super-rss-reader' ) ); ?></div>
                <div class="srr_field"><input id="<?php echo $this->get_field_id('read_more'); ?>" name="<?php echo $this->get_field_name('read_more'); ?>" type="text" value="<?php echo $read_more; ?>" class="widefat" /></div>
            </div>

            <div class="srr_row">
                <div class="srr_label"><label for="<?php echo $this->get_field_id('rich_desc'); ?>"><?php _e( 'Enable rich description', 'super-rss-reader' ); ?></label></div>
                <div class="srr_field"><input id="<?php echo $this->get_field_id('rich_desc'); ?>" type="checkbox" name="<?php echo $this->get_field_name('rich_desc'); ?>" value="1" <?php echo $rich_desc == "1" ? 'checked="checked"' : ""; ?> /></div>
            </div>

            <?php if( $rich_desc == 1 ): ?>
            <span class="srr_note"><?php _e( 'Note: You have enabled "Full/Rich HTML". If no description is present, then the full content will be displayed. Please make sure that the feed(s) are from trusted sources and do not contain any harmful scripts. If there are some alignment issues in the description, please use custom CSS to fix that.', 'super-rss-reader' ); ?></span>
            <?php endif; ?>

            <h4><?php _e( 'Thumbnail', 'super-rss-reader' ); ?></h4>

            <div class="srr_row">
                <div class="srr_label"><label for="<?php echo $this->get_field_id('thumbnail_position');?>"><?php _e( 'Thumbnail position', 'super-rss-reader' ); ?></label></div>
                <div class="srr_field">
                <?php
                    echo '<select name="' . $this->get_field_name('thumbnail_position') . '" id="' . $this->get_field_id('thumbnail_position') . '">';
                    foreach( $option_lists[ 'thumbnail_position' ] as $k => $v ){
                        echo '<option value="' . $k . '" ' . selected( $thumbnail_position, $k ) . '>' . $v . '</option>';
                    }
                    echo '</select>';
                ?>
                </div>
            </div>

            <div class="srr_row">
                <div class="srr_label"><label for="<?php echo $this->get_field_id('thumbnail_size'); ?>"><?php _e( 'Thumbnail size', 'super-rss-reader' ); ?></label><?php $this->tt( __( 'The size of the thumbnail including the units. Example 64px, 10%', 'super-rss-reader' ) ); ?></div>
                <div class="srr_field"><input id="<?php echo $this->get_field_id('thumbnail_size');?>" name="<?php echo $this->get_field_name('thumbnail_size'); ?>" type="text" value="<?php echo $thumbnail_size; ?>" class="widefat" /></div>
            </div>

        </section>

        <section data-tab-id="display">

            <div class="srr_row">
                <div class="srr_label srr_sm"><label for="<?php echo $this->get_field_id('color_style');?>"><?php _e( 'Color theme', 'super-rss-reader' ); ?></label></div>
                <div class="srr_field">
                <?php
                    echo '<select name="' . $this->get_field_name('color_style') . '" id="' . $this->get_field_id('color_style') . '">';
                    foreach( $option_lists[ 'color_style' ] as $k => $v ){
                        echo '<option value="' . $k . '" ' . selected( $color_style, $k ) . '>' . $v . '</option>';
                    }
                    echo '</select>';
                ?>
                </div>
            </div>

            <div class="srr_row">
                <div class="srr_label srr_sm"><label for="<?php echo $this->get_field_id('display_type');?>"><?php _e( 'Display type', 'super-rss-reader' ); ?></label></div>
                <div class="srr_field">
                <?php
                    echo '<select name="' . $this->get_field_name('display_type') . '" id="' . $this->get_field_id('display_type') . '">';
                    foreach( $option_lists[ 'display_type' ] as $k => $v ){
                        echo '<option value="' . $k . '" ' . selected( $display_type, $k ) . '>' . $v . '</option>';
                    }
                    echo '</select>';
                ?>
                </div>
            </div>

            <div class="srr_row">
                <div class="srr_label srr_sm"><label for="<?php echo $this->get_field_id('ticker_speed');?>"><?php _e( 'Ticker speed', 'super-rss-reader' ); ?></label></div>
                <div class="srr_field"><input id="<?php echo $this->get_field_id('ticker_speed');?>" name="<?php echo $this->get_field_name('ticker_speed'); ?>" type="number" value="<?php echo $ticker_speed; ?>" title="Speed of the ticker in seconds"/> seconds</div>
            </div>

            <div class="srr_row">
                <div class="srr_label srr_sm"><label for="<?php echo $this->get_field_id('visible_items');?>"><?php _e( 'Widget height', 'super-rss-reader' ); ?><?php $this->tt( __( 'The height of the widget when display type is "ticker"', 'super-rss-reader' ) ); ?></label></div>
                <div class="srr_field"><input id="<?php echo $this->get_field_id('visible_items');?>" name="<?php echo $this->get_field_name('visible_items'); ?>" type="number" value="<?php echo $visible_items; ?>" /><br/>
                <small class="srr_small_text"><?php _e( 'Set value less than 20 to show visible feed items. Example: <b>5</b> items', 'super-rss-reader' ); ?></small></br>
                <small class="srr_small_text"><?php _e( 'Set value greater than 20 for fixed widget height. Example: <b>400</b> px', 'super-rss-reader' ); ?></small></div>
            </div>

        </section>

        </div>

        <div class="srr_pro">
            <div class="srr_pro_intro">
                <div><span class="srr_pro_label">PRO</span></div>
                <p>Get the PRO version to enjoy more features like<br/> <span>Shortcode, Grid display, Custom feed item template</span> and more !</p>
                <div><span class="dashicons dashicons-arrow-down-alt2 srr_pro_more"></span></div>
            </div>
            <div class="srr_pro_details">
                <ul class="srr_pro_features">
                    <li>Shortcode - <span>Display RSS feed anywhere in your website</span></li>
                    <li>Grid display - <span>Display feed item in rows and columns</span></li>
                    <li>Custom template - <span>Change order of feed item content, add HTML</span></li>
                    <li>4+ new color themes</li>
                    <li>Updates and support for 1 year</li>
                </ul>
                <p><a href="https://www.aakashweb.com/wordpress-plugins/super-rss-reader-pro/?utm_source=admin&utm_medium=widget-get&utm_campaign=srr-pro#purchase" class="button button-primary">Get PRO version</a> <a href="https://www.aakashweb.com/wordpress-plugins/super-rss-reader-pro/?utm_source=admin&utm_medium=widget-info&utm_campaign=srr-pro" class="button">More information</a></p>
            </div>
        </div>

        <div class="srr_info">
          <p><a href="https://www.aakashweb.com/docs/super-rss-reader/faq/" target="_blank">FAQ</a> | <a href="https://www.aakashweb.com/forum/discuss/wordpress-plugins/super-rss-reader/" target="_blank">Report issue</a> | <a href="https://wordpress.org/support/plugin/super-rss-reader/reviews/?rate=5#new-post" target="_blank">Rate 5 stars & review</a> | v<?php echo SRR_VERSION; ?></p>
        </div>

        <?php
    }

    public function tt( $text ){
        echo '<div class="srr_tt" tabindex="0"><span class="dashicons dashicons-editor-help"></span><span class="srr_tt_text"><span>' . $text . '</span></span></div>';
    }

}

?>
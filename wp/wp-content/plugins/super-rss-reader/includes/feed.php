<?php
/**
* Prepares the feed HTML
*
*/

if( ! defined( 'ABSPATH' ) ) exit;

class SRR_Feed{

    public $options = array();

    public function __construct( $options ){

        $this->options = wp_parse_args( $options, SRR_Options::defaults() );

    }

    public function html(){

        $urls = stripslashes( trim( $this->options['urls'] ) );
        $tab_titles = stripslashes( $this->options['tab_titles'] );
        $count = intval( $this->options['count'] );

        $show_date = intval( $this->options['show_date'] );
        $show_desc = intval( $this->options['show_desc'] );
        $show_author = intval( $this->options['show_author'] );
        $show_thumb = stripslashes( $this->options['show_thumb'] );
        $open_newtab = intval( $this->options['open_newtab'] );
        $add_nofollow = intval( $this->options['add_nofollow'] );
        $strip_desc = intval( $this->options['strip_desc'] );
        $strip_title = intval( $this->options['strip_title'] );
        $read_more = htmlspecialchars( $this->options['read_more'] );
        $rich_desc = intval( $this->options['rich_desc'] );
        $thumbnail_position = htmlspecialchars( $this->options['thumbnail_position'] );
        $thumbnail_size = htmlspecialchars( $this->options['thumbnail_size'] );

        $color_theme = stripslashes( $this->options['color_style'] );
        $display_type = stripslashes( $this->options['display_type'] );
        $visible_items = intval( $this->options['visible_items'] );
        $ticker_speed = intval( $this->options['ticker_speed'] ) * 1000;

        if( empty( $urls ) ){
            return '';
        }

        $url_delim = strpos( $urls, ',' ) !== false ? ',' : "\n";
        $tab_title_delim = strpos( $tab_titles, ',' ) !== false ? ',' : "\n";

        $urls = explode( $url_delim, $urls );
        $tab_titles = explode( $tab_title_delim, $tab_titles );
        $url_count = count( $urls );

        $feeds = array();
        $html = '';

        $classes = array( 'srr-wrap', 'srr-style-' . $color_theme );
        if( $display_type == 'vertical_ticker' ) array_push( $classes, 'srr-vticker' );
        $class = implode( ' ', $classes );

        // Fetch the feed
        for( $i=0; $i < $url_count; $i++ ){
            $feed_url = trim( $urls[$i] );
            $feed = fetch_feed( $feed_url );

            if( is_wp_error( $feed ) ){
                $feed_title = 'Error';
            }else{
                $feed_title = ( isset( $tab_titles[$i] ) && !empty( $tab_titles[$i] ) ) ? $tab_titles[$i] : esc_attr( strip_tags( $feed->get_title() ) );
            }

            $feeds[ $feed_url ] = array(
                'id' => rand( 100, 999 ),
                'feed' => $feed,
                'title' => $feed_title
            );
        }

        // Generate tabs
        if( $url_count > 1 ){
            $html .= '<ul class="srr-tab-wrap srr-tab-style-' . $color_theme . ' srr-clearfix">';
            foreach( $feeds as $url => $data ){
                $id = $data[ 'id' ];
                $feed = $data[ 'feed' ];
                if( is_wp_error( $feed ) ){
                    $html .= '<li data-tab="srr-tab-' . $id . '">Error</li>';
                }else{
                    $html .= '<li data-tab="srr-tab-' . $id . '">' . $data[ 'title' ] . '</li>';
                }
            }
            $html .= '</ul>';
        }

        // Generate feed items
        foreach( $feeds as $url => $data ){

            $id = $data[ 'id' ];
            $feed = $data[ 'feed' ];

            // Check for feed errors
            if ( is_wp_error( $feed ) ){
                $html .= '<div class="srr-wrap srr-style-' . $color_theme .'" data-id="srr-tab-' . $id . '"><p>RSS Error: ' . $feed->get_error_message() . '</p></div>';
                continue;
            }

            if( method_exists( $feed, 'enable_order_by_date' ) ){
                $feed->enable_order_by_date( false );
            }

            $max_items = $feed->get_item_quantity( $count );
            $feed_items = $feed->get_items( 0, $max_items );

            // Outer wrap start
            $html .= '<div class="' . $class . '" data-visible="' . $visible_items . '" data-speed="' . $ticker_speed . '" data-id="srr-tab-' . $id . '">';
            $html .= '<div>';

            // Check feed items
            if ( $max_items == 0 ){
                $html .= '<div>' . __( 'No items', 'super-rss-reader' ) . '</div>';
            }else{
                $j=1;
                // Loop through each feed item
                foreach( $feed_items as $item ){

                    // Link
                    $link = $item->get_link();
                    while ( stristr( $link, 'http' ) != $link ){ $link = substr( $link, 1 ); }
                    $link = esc_url( strip_tags($link) );

                    // Title
                    $title = esc_attr( strip_tags( $item->get_title() ) );
                    $title_full = $title;

                    if ( empty( $title ) ){
                        $title = __( 'No Title', 'super-rss-reader' );
                    }

                    if( $strip_title > 0 && strlen( $title ) > $strip_title ){
                        $title = wp_trim_words( $title, $strip_title );
                    }

                    // Open links in new tab
                    $new_tab = $open_newtab ? ' target="_blank"' : '';

                    // Add no follow attribute
                    $no_follow = $add_nofollow ? ' rel="nofollow noopener noreferrer"' : '';

                    // Date
                    $date = $item->get_date( 'j F Y' );
                    $date_full = esc_attr( $item->get_date() );

                    // Thumbnail
                    $thumb = '';
                    if ( $show_thumb == 1 ){
                        $thumb_url = $this->get_thumbnail_url( $item );
                        if( !empty( $thumb_url ) ){
                            $thumb_styles = array(
                                'width' => $thumbnail_size,
                                'height' => $thumbnail_size
                            );
                            $thumb_style = '';
                            foreach( $thumb_styles as $prop => $val ){
                                $thumb_style .= "$prop:$val;";
                            }
                            $thumb = '<a href="' . $link . '" class="srr-thumb srr-thumb-' . $thumbnail_position . '" style="' . $thumb_style . '" ' . $new_tab . $no_follow . '><img src="' . $thumb_url . '" alt="' . $title_full . '" align="left" /></a>';
                        }
                    }

                    // Description
                    $desc = '';
                    if( $show_desc ){
                        if( $rich_desc ){
                            $desc = strip_tags( $item->get_description(), '<p><a><img><em><strong><font><strike><s><u><i>' );
                        }else{

                            $desc = str_replace( array( "\n", "\r" ), ' ', esc_attr( strip_tags( @html_entity_decode( $item->get_description(), ENT_QUOTES, get_option('blog_charset') ) ) ) );
                            $read_more_link = '';

                            if( $strip_desc != 0 ){
                                $desc = wp_trim_words( $desc, $strip_desc );
                                $read_more_link = !empty( $read_more ) ? ' <a href="' . $link . '" title="' . __( 'Read more', 'super-rss-reader' ) . '"' . $new_tab . $no_follow . ' class="srr-read-more">' . $read_more . '</a>' : '';

                                if ( '[...]' == substr( $desc, -5 ) ){
                                    $desc = substr( $desc, 0, -5 );
                                }elseif ( '[&hellip;]' != substr( $desc, -10 ) ){
                                    $desc .= '';
                                }

                                $desc = esc_html( $desc );
                            }

                            $desc = $desc . $read_more_link;

                        }
                    }

                    // Author
                    $author = $item->get_author();
                    if ( is_object( $author ) ) {
                        $author = $author->get_name();
                        $author = esc_html( strip_tags( $author ) );
                    }

                    // Display the feed items
                    $html .= '<div class="srr-item ' . ( ( $j%2 == 0 ) ? 'srr-stripe' : '') . '">';
                    $html .= '<div class="srr-clearfix">';

                    $html .= '<div class="srr-title"><a href="' . $link . '"' . $new_tab . $no_follow . ' title="' . $title_full . '">' . $title . '</a></div>';

                    // Metadata
                    if( $show_date || $show_author ){
                        $html .= '<div class="srr-meta">';
                        if( $show_date && !empty( $date ) ){
                            $html .= '<time class="srr-date" title="' . $date_full . '">' . $date . '</time>';
                        }

                        if( $show_author && !empty( $author ) ){
                            $html .= ' - <cite class="srr-author">' . $author . '</cite>';
                        }
                        $html .= '</div>'; // End meta
                    }

                    if ( $show_thumb ){
                        $html .= $thumb;
                    }

                    if( $show_desc ){
                        $html .= '<div class="srr-summary srr-clearfix">';
                        $html .= $rich_desc ? $desc : ( '<p>' . $desc . '</p>' );
                        $html .= '</div>'; // End summary
                    }

                    $html .= '</div>'; // End item inner clearfix
                    $html .= '</div>'; // End feed item

                    $j++;
                }
            }
            
            // Outer wrap end
            $html .= '</div></div>' ;
            
            if( !is_wp_error( $feed ) )
                $feed->__destruct();

            unset( $feed );

        }

        $html = '<div class="srr-main">' . $html . '</div>';

        return $html;

    }

    function get_thumbnail_url( $item ){

        // Try to get from the item enclosure
        $enclosure = $item->get_enclosure();

        if ( $enclosure->get_thumbnail() ) {
            return $enclosure->get_thumbnail();
        }

        if ( $enclosure->get_link() ) {
            return $enclosure->get_link();
        }

        // Try to get from item content
        $content = $item->get_content();

        preg_match_all('~<img.*?src=["\']+(.*?)["\']+~', $content, $urls);
        $urls = $urls[1];

        if( !empty( $urls ) ){
            return $urls[0];
        }

        // Try to get the image tag finally if available
        $image = $item->get_item_tags( '', 'image' );

        if( isset( $image[0]['data'] ) ){
            return $image[0]['data'];
        }

        return '';

    }

}

?>
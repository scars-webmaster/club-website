<?php
if (!function_exists('newsup_header_section')) :
/**
 *  Slider
 *
 * @since Newsup
 *
 */
function newsup_header_section()
{
?>
<div class="mg-head-detail hidden-xs">
    <div class="container-fluid">
        <div class="row">
            <?php
            $header_social_icon_enable = esc_attr(get_theme_mod('header_social_icon_enable','true'));
            $newsup_header_fb_link = get_theme_mod('newsup_header_fb_link');
            $newsup_header_fb_target = esc_attr(get_theme_mod('newsup_header_fb_target','true'));
            $newsup_header_twt_link = get_theme_mod('newsup_header_twt_link');
            $newsup_header_twt_target = esc_attr(get_theme_mod('newsup_header_twt_target','true'));
            $newsup_header_lnkd_link = get_theme_mod('newsup_header_lnkd_link');
            $newsup_header_lnkd_target = esc_attr(get_theme_mod('newsup_header_lnkd_target','true'));
            $newsup_header_insta_link = get_theme_mod('newsup_header_insta_link');
            $newsup_insta_insta_target = esc_attr(get_theme_mod('newsup_insta_insta_target','true'));
            $newsup_header_youtube_link = get_theme_mod('newsup_header_youtube_link');
            $newsup_header_youtube_target = esc_attr(get_theme_mod('newsup_header_youtube_target','true'));
            $newsup_header_pintrest_link = get_theme_mod('newsup_header_pintrest_link');
            $newsup_header_pintrest_target = esc_attr(get_theme_mod('newsup_header_pintrest_target','true'));
            $newsup_header_telegram_link = get_theme_mod('newsup_header_tele_link');
            $newsup_header_telegram_target = esc_attr(get_theme_mod('newsup_header_telegram_target','true'));
              ?>
            <div class="col-md-6 col-xs-12">
                <ul class="info-left">
                    <?php newsup_date_display_type(); ?>
                </ul>
            </div>
            <?php 
            if($header_social_icon_enable == true)
            {
            ?>
            <div class="col-md-6 col-xs-12">
                <ul class="mg-social info-right">
                    
                      <?php if($newsup_header_fb_link !=''){?>
                      <a <?php if($newsup_header_fb_target) { ?> target="_blank" <?php } ?>href="<?php echo esc_url($newsup_header_fb_link); ?>">
                      <li><span class="icon-soci facebook"><i class="fa fa-facebook"></i></span> </li></a>
                      <?php } ?> 
                      <a <?php if($newsup_header_twt_target) { ?>target="_blank" <?php } ?>href="<?php echo esc_url($newsup_header_twt_link);?>">
                      <?php if($newsup_header_twt_link !=''){ ?>
                      <li><span class="icon-soci twitter"><i class="fa fa-twitter"></i></span></li></a>
                      <?php } ?>
                      <a <?php if($newsup_header_lnkd_target) { ?>target="_blank" <?php } ?> href="<?php echo esc_url($newsup_header_lnkd_link); ?>">
                      <?php if($newsup_header_lnkd_link !=''){ ?>
                      <li><span class="icon-soci linkedin"><i class="fa fa-linkedin"></i></span></li></a>
                      <?php } ?>
                      <a <?php if($newsup_insta_insta_target) { ?>target="_blank" <?php } ?> href="<?php echo esc_url($newsup_header_insta_link); ?>">
                      <?php if($newsup_header_insta_link !=''){ ?>
                      <li><span class="icon-soci instagram"><i class="fa fa-instagram"></i></span></li></a>
                      <?php } ?>
                      <a <?php if($newsup_header_youtube_target) { ?>target="_blank" <?php } ?> href="<?php echo esc_url($newsup_header_youtube_link); ?>">
                     <?php if($newsup_header_youtube_link !=''){ ?>
                      <li><span class="icon-soci youtube"><i class="fa fa-youtube"></i></span></li></a>
                      <?php } ?> <?php if($newsup_header_pintrest_link !=''){ ?>
                      <a <?php if($newsup_header_pintrest_target) { ?>target="_blank" <?php } ?> href="<?php echo esc_url($newsup_header_pintrest_link); ?>">
                      <li><span class="icon-soci pinterest"><i class="fa fa-pinterest-p"></i></span></li></a>
                      <?php } ?> <?php if($newsup_header_telegram_link !=''){ ?>
                      <a <?php if($newsup_header_telegram_target) { ?>target="_blank" <?php } ?> href="<?php echo esc_url($newsup_header_telegram_link); ?>">
                      <li><span class="icon-soci telegram"><i class="fa fa-telegram"></i></span></li></a>
                      <?php } ?>
                </ul>
            </div>
            <?php }?>
        </div>
    </div>
</div>
<?php 
}
endif;
add_action('newsup_action_header_section', 'newsup_header_section', 5);
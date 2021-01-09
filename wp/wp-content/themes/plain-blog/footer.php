<?php
/**
 * This file is responsible for the theme footer.
 */
?>
                </div> <!--row end-->
            </div> <!--container end-->
        </div> <!--middle section End here-->

        <!--footer wrapper Start here-->
        <div class="footer_wrapper">
            <div class="container">
                <div class="row">
                    <?php if(is_active_sidebar('footer_area_1')) { ?>
                    <div class="col-md-4">
                        <?php dynamic_sidebar('footer_area_1'); ?>
                    </div>
                    <?php } ?>

                    <?php if(is_active_sidebar('footer_area_2')) { ?>
                    <div class="col-md-5">
                        <?php dynamic_sidebar('footer_area_2'); ?>
                    </div>
                    <?php } ?>

                    <?php if(is_active_sidebar('footer_area_3')) { ?>
                    <div class="col-md-3">
                        <?php
                        dynamic_sidebar('footer_area_3');
                        ?>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <!--footer wrapper End here-->
	<div class="copyright">
     <div class="container">	
      <div class="clearboth"></div>      
     <a target="_blank" href="http://www.navthemes.com/plain-blog-theme"><?php _e('Plain Blog Theme', 'plain-blog'); ?></a> <?php _e('By', 'plain-blog') ?> <a target="_blank" href="http://navthemes.com">NavThemes.com</a>   
    </div>        
   </div>       
    
    </div> <!--main_container end-->
    <?php wp_footer(); ?>
</body>
</html>
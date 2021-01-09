<?php
/**
 * This file is responsible for the appearance of comments below each post.
 */
?>
<div id="comments" class="comment list">
    <?php wp_list_comments( array( 'style' => 'div' ) ); 
	      ?>
   
<div class="clearboth"></div>
<div class="comment-pagination"> 
	 <?php    
		  paginate_comments_links(); 
	?>
    </div>
<div class="clearboth" style="height:50px;"></div>    
</div>
<?php

//////////////////////////////////////////////////////////////
//===========================================================
// template_import.php
//===========================================================
// PAGELAYER
// Inspired by the DESIRE to be the BEST OF ALL
// ----------------------------------------------------------
// Started by: Pulkit Gupta
// Date:	   23rd Jan 2017
// Time:	   23:00 hrs
// Site:	   http://pagelayer.com/wordpress (PAGELAYER)
// ----------------------------------------------------------
// Please Read the Terms of use at http://pagelayer.com/tos
// ----------------------------------------------------------
//===========================================================
// (c)Pagelayer Team
//===========================================================
//////////////////////////////////////////////////////////////

// Are we being accessed directly ?
if(!defined('PAGELAYER_VERSION')) {
	exit('Hacking Attempt !');
}

include_once(PAGELAYER_DIR.'/main/settings.php');

function pagelayer_import(){
	
	global $pagelayer, $pagelayer_theme, $pagelayer_theme_url, $pagelayer_theme_path, $pagelayer_pages, $pl_error;
		
	$pagelayer_theme = wp_get_theme();
	$pagelayer_theme_url = get_stylesheet_directory_uri();
	$pagelayer_theme_path = get_stylesheet_directory();
	
	// Get the pages
	$pagelayer_templates = @json_decode(file_get_contents($pagelayer_theme_path.'/pagelayer.conf'), true);
	$pagelayer_pages = @json_decode(file_get_contents($pagelayer_theme_path.'/pagelayer-data.conf'), true);
	
	if(isset($_POST['theme'])){
		check_admin_referer('pagelayer-import');
		$GLOBALS['pl_saved'] = pagelayer_import_theme($pagelayer_theme->template);
	}
	
	// Have we already imported ?
	$imported = get_option('pagelayer_theme_'.get_template().'_imported');
	if(!empty($imported)){
		$GLOBALS['pl_warn'] = __('You have already imported the content of this theme. You can re-import the same by either choosing to over-write existing pages / pagelayer templates OR creating duplicate content !', 'pagelayer');
	}
	
	
	
	// Call the theme
	pagelayer_import_T();
	
}

function pagelayer_import_T(){
	
	global $pagelayer, $pagelayer_theme, $pagelayer_theme_url, $pagelayer_theme_path, $pagelayer_pages, $pl_error;
	
	pagelayer_page_header('Pagelayer - Import Template');
	
	// Any errors ?
	if(!empty($pl_error)){
		pagelayer_report_error($pl_error);echo '<br />';
	}

	// Saved ?
	if(!empty($GLOBALS['pl_saved'])){
		echo '<div class="notice notice-success"><p>'. __('The theme content was successfully imported', 'pagelayer'). '</p></div>';

	// Warn ?
	}elseif(!empty($GLOBALS['pl_warn'])){
		echo '<div class="notice notice-warning"><p>'.$GLOBALS['pl_warn'].'</p></div>';
	}
	
	// Is it a pagelayer theme ?
	if(!file_exists($pagelayer_theme_path.'/pagelayer.conf')){
		echo 'This utility is for importing content of the current active theme if its a Pagelayer Theme. Your current theme is <b>not</b> a Pagelayer exported theme ! If you want to export your content and make it into a distributable theme, please refer to the guide <a href="">here</a>.';
		die();
	}
	
	echo '
<style>
.pagelayer_img_screen{
width: 120px;
margin: 0px 15px 10px 15px;
display: inline-block;
border: 1px solid transparent;
border-radius: 3px;
}

.pagelayer_img_selected{
border: 1px solid #1A9CDB;
}

.pagelayer_img_div{
overflow: hidden;
height: 160px;
}

.pagelayer_img_name{
text-align: center;
background: #fff;
padding: 5px 10px;
border-top: 1px solid #ccc;
}

/* The Modal (background) */
.pagelayer-modal {
display: none;
position: fixed;
z-index: 10000;
left: 0;
top: 0;
width: 100%;
height: 100%;
overflow: auto;
background-color: rgb(0,0,0);
background-color: rgba(0,0,0,0.4);
}

/* Modal Content/Box */
.pagelayer-modal-holder {
background-color: #fefefe;
margin: 15% auto; /* 15% from the top and centered */
border: 1px solid #888;
width: 50%;
min-height: 200px;
position: relative;
}

/* The Close Button */
.pagelayer-modal-close {
color: #aaa;
float: right;
font-size: 28px;
font-weight: bold;
}

.pagelayer-modal-close:hover,
.pagelayer-modal-close:focus {
color: black;
text-decoration: none;
cursor: pointer;
}

.pagelayer-modal-header{
max-height: 80px;
top: 0px;
border-bottom: 1px solid #ccc;
}

.pagelayer-modal-footer{
max-height: 80px;
bottom: 0px;
border-top: 1px solid #ccc;
text-align: right;
}

.pagelayer-modal-header,
.pagelayer-modal-content,
.pagelayer-modal-footer{
padding: 15px;
width: 100%;
box-sizing: border-box;
}

#pagelayer-import-form>div{
padding: 4px;
font-weight: 600;
}

</style>

<!-- The Modal -->
<div id="pagelayerModal" class="pagelayer-modal">

	<!-- Modal holder -->
	<div class="pagelayer-modal-holder">

		<!-- Modal header -->
		<div class="pagelayer-modal-header">
			<b>Import Theme Contents</b> <span class="pagelayer-modal-close">&times;</span>
		</div>
		
		<!-- Modal content -->
		<div class="pagelayer-modal-content">		
			<form id="pagelayer-import-form" method="post" enctype="multipart/form-data">';
				wp_nonce_field('pagelayer-import');
				echo '<input name="theme" value="'.get_template().'" type="hidden" />
				<div><input type="checkbox" name="delete_old_import" id="delete_old_import" /> Delete Previously Imported Content</div>
				<div><input type="checkbox" name="overwrite" /> Overwrite existing Pages with same name</div>
				<div><input type="checkbox" name="set_home_page" checked /> Set the Home Page as per the content</div>
			</form>
		</div>
		
		<!-- Modal footer -->
		<div class="pagelayer-modal-footer">
			<button class="button button-primary" onclick="jQuery(\'#pagelayer-import-form\').submit()">Import</button> &nbsp;
			<button class="button pagelayer-cancel">Cancel</button>
		</div>
	</div>

</div>

<script>

function pagelayer_modal(sel){
	
	var modal = jQuery(sel);
	
	modal.show();

	// Get the <span> element that closes the modal
	var span = modal.find(".pagelayer-modal-close, .pagelayer-cancel");

	// When the user clicks on <span> (x), close the modal
	span.on("click", function() {
		modal.hide();
	});

	// When the user clicks anywhere outside of the modal, close it
	window.onclick = function(event) {
		if(event.target == modal[0]){
			modal.hide();
		}
	}
}

jQuery(document).ready(function(){
	var $ = jQuery;

	var choose_image = function(jEle){		
		$("#pagelayer_display_image").attr("src", jEle.find("img").attr("src"));
		
		$(".pagelayer_img_screen").removeClass("pagelayer_img_selected");
		jEle.addClass("pagelayer_img_selected");
	}
	
	var first = $(".pagelayer_img_screen:first");
	var home = $(".pagelayer_img_screen[page=home]");
	
	if(home.length > 0){
		first = home;
	}
	
	choose_image(first);
	
	$(".pagelayer_img_screen").on("click", function(){
		choose_image($(this));
	});
	
	$("#pagelayer-import-form").on("submit", function(){
		
		if(!jQuery("#delete_old_import").is(":checked")){
			return true;
		}
		
		if(confirm("This will delete any pages / pagelayer templates imported earlier. Should we proceed ?")){
			return true;
		}else{
			return false;
		}
		
	});
	
});
</script>

<div><h1 style="margin-bottom: 10px; padding-top: 0px;">'.$pagelayer_theme->name.'</h1></div>
<div style="margin: 0px -10px; vertical-align: top;">
	<div style="width: 52%; display: inline-block; text-align: center;">
		<div style="width: 100%; max-height: 400px; overflow: auto; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
			<img id="pagelayer_display_image" src="'.$pagelayer_theme_url.'/screenshots/home.jpg" width="100%">
		</div>
	</div>
	<div style="width: 45%; display: inline-block; padding: 0px 10px; vertical-align: top;">';
	
	foreach($pagelayer_pages['page'] as $k => $v){
		echo '<div class="pagelayer_img_screen" page="'.$k.'">
			<div class="pagelayer_img_div"><img src="'.$pagelayer_theme_url.'/screenshots/'.$k.'.jpg" width="100%" /></div>
			<div class="pagelayer_img_name">'.$v['post_title'].'</div>
		</div>';
	}
	
	echo '</div>
</div>

<div style="position:fixed; bottom: 30px; right: 30px;">
	<input name="import_theme" class="button button-pagelayer" value="Import Theme Content" type="button" onclick="pagelayer_modal(\'#pagelayerModal\')" />
</div>';

add_filter('pagelayer_right_bar_promos', '__return_false');

pagelayer_page_footer(1);
	
}

// Imports the required conf
function pagelayer_import_conf(&$conf){
	
	foreach($conf as $k => $v){
		
		if(in_array($k, ['page_for_posts'])){
			continue;
		}
		
		update_option($k, $v);		
	}
	
}

// The actual function to import the theme
function pagelayer_import_single($template_name, $items, $pagelayer_theme_path = ''){
	
global $wpdb, $wp_rewrite;	
global $pagelayer, $pl_error;
	
	if(empty($pagelayer_theme_path)){
		$pagelayer_theme_path = get_stylesheet_directory();
	}
	
	if(empty($items)){
		$pl_error[] = 'Items were not submitted';
		return false;
	}
	
	/////////////////////////
	// Handle the PAGES Data
	/////////////////////////
	
	// Load the new themes pages array
	$data = file_get_contents($pagelayer_theme_path.'/pagelayer-data.conf');
	$data = @json_decode($data, true);
	//r_print($data);die();
	
	if(empty($data['page'])){
		$pl_error[] = 'Pages list not found. This is not a proper template !';
		return false;
	}
	
	// Check the theme files
	foreach($data['page'] as $k => $v){
		
		$path = pagelayer_cleanpath($pagelayer_theme_path.'/data/page/'.$k);
		
		// Does it have the title and slug ?
		if(empty($v['post_title']) || empty($v['post_name'])){
			$pl_error[] = 'Something is fishy with this theme as there is no title or slug for '.$k;
			return false;
		}
		
		// Does the page exist ?
		if(!file_exists($path) || pagelayer_cleanpath(realpath($path)) != $path){
			$pl_error[] = 'Something is fishy with this theme';
			return false;
		}
		
	}
	
	$status = empty($_POST['save_as_draft']) ? 'publish' : 'draft';
	
	// Now check the pages if it exist in this installation ?
	foreach($data['page'] as $k => $v){
		
		if(!in_array($k, $items['page'])){
			continue;
		}
		
		$path = pagelayer_cleanpath($pagelayer_theme_path.'/data/page/'.$k);
		
		// Is the page there ?
		$page = get_page_by_path($v['post_name']);
		//r_print($page);
			
		$new_post = array();
		
		// It does exist so save the revision IF its the header and footer
		if(!empty($page) && isset($_POST['overwrite'])){
			
			$rev = wp_save_post_revision($page->ID);
			
			$new_post['ID'] = $page->ID;
			
		}
			
		// Make an array
		$new_post['post_content'] = file_get_contents($path);
		$new_post['post_title'] = $v['post_title'];
		$new_post['post_name'] = $v['post_name'];
		$new_post['post_type'] = 'page';
		$new_post['post_status'] = $status;			
		//r_print($new_post);die();
		
		// Now insert / update the post
		$ret = pagelayer_insert_content($new_post, $err);
		
		// Did we save the post ?
		if(empty($ret)){
			$pl_error[] = 'Could not update the page '.$v['post_name'];
			return false;
		}
		
		update_post_meta($ret, 'pagelayer_imported_content', $template_name);
		
	}
	
	//To import typography and breakpoint
	if(!empty($data['conf'])){		
		pagelayer_import_conf($data['conf']);
	}
	
	return true;
	
}

// The actual function to import the theme
function pagelayer_import_theme($template_name, $pagelayer_theme_path = ''){

global $wpdb, $wp_rewrite;
global $pagelayer, $pl_error, $sitepad;
	
	if(empty($pagelayer_theme_path)){
		$pagelayer_theme_path = get_stylesheet_directory();
	}
	//die($pagelayer_theme_path);
	
	// Delete Old Data ?
	if(isset($_POST['delete_old_import'])){
		$args = array(
			'post_type' => ['page', 'post', $pagelayer->builder['name']],
			'meta_query' => array(
				array(
					'key' => 'pagelayer_imported_content',
					'compare' => 'EXISTS'
				)
			)
		);
		$query = new WP_Query($args);

		foreach ( $query->posts as $p ) {
			//echo $p->ID.'<br>';
			wp_delete_post($p->ID);
		}
	}
	
	$pagelayer->import_links = [];
	
	/////////////////////////
	// Handle PAGELAYER DATA
	/////////////////////////
	
	// Load the PGL conf
	$pgl = file_get_contents($pagelayer_theme_path.'/pagelayer.conf');
	$pgl = @json_decode($pgl, true);
	
	if(empty($pgl['header'])){
		$pl_error[] = 'Header list not found. Report to Website Builder Team';
		return false;
	}
	
	// Load the new themes pages array
	$data = file_get_contents($pagelayer_theme_path.'/pagelayer-data.conf');
	$data = @json_decode($data, true);
	//r_print($data);die();
	
	if(empty($data['page'])){
		$pl_error[] = 'Pages list not found. This is not a proper template !';
		return false;
	}
	
	// Check the theme files
	foreach($pgl as $k => $v){
		
		$path = pagelayer_cleanpath($pagelayer_theme_path.'/'.$k.'.pgl');
		//print_r($path);
		
		// Does the page exist ?
		if(!file_exists($path) || (empty($GLOBALS['sitepad']['dev']) && pagelayer_cleanpath(realpath($path)) != $path)){
			$pl_error[] = 'Something is fishy with this theme as the template - '.$k.' - of type - '.$v['type'].' - was not found';
			return false;
		}
		
	}
	
	// Are we to add default templates ?
	if(empty($_POST['no_blog_templates'])){
		add_filter('pagelayer_importing_templates', 'pagelayer_blog_templates', 10, 1);
	}
	
	///////////////////////////
	// Lets import all MEDIA
	///////////////////////////
		
	// Now lets download the templates
	if(!function_exists( 'list_files' ) ) {
		require_once ABSPATH . PAGELAYER_CMS_DIR_PREFIX.'-admin/includes/file.php';
	}
	
	$_media = list_files($pagelayer_theme_path.'/images', 1);
	//r_print($_media);die();
	
	foreach($_media as $k => $v){
		$file_name = basename($v);
		$ret = pagelayer_upload_media($file_name, file_get_contents($v));
		if(!empty($ret)){
			$pagelayer->import_media['{{theme_url}}/images/'.$file_name] = $ret;
		}
	}	
	//r_print($pagelayer->import_media);die();
	
	// If we are to import default templates
	$pgl = apply_filters('pagelayer_importing_templates', $pgl);
	
	//////////////////////
	// Create Menus
	//////////////////////
	
	// Create the menu
	if(empty($_POST['no_header_menu'])){
		
		// Is there any MENU in this theme ?
		if(empty($data['menus'])){		
			$menu_id = pagelayer_import_create_menu($template_name.' Header Menu');
		}else{
			
			foreach($data['menus'] as $k => $v){
				$new_id = pagelayer_import_create_menu($v['name']);
				$pagelayer->imported_menus[$v['term_id']] = $new_id;
				$pagelayer->imported_menus_slug[$new_id] = $k;
			}
			
			//r_print($pagelayer->imported_menus);die();
			
			$menu_id = current($pagelayer->imported_menus);
			
		}
		
	}else{
		
		// Get the first menu that has items if we still can't find a menu.
		$menus = wp_get_nav_menus();
		foreach ( $menus as $menu_maybe ) {
			$menu_items = wp_get_nav_menu_items( $menu_maybe->term_id, array( 'update_post_term_cache' => false ) );
			if ( $menu_items ) {
				$menu_id = $menu_maybe->term_id;
				break;
			}
		}
		
	}
	
	// Make a array of OLD IDs => NEW IDs for replace
	$pagelayer->imported_menus_preg = [];
	
	// If we have menus !
	if(!empty($pagelayer->imported_menus)){
		
		foreach($pagelayer->imported_menus as $k => $v){
			$pagelayer->imported_menus_preg['('.$k.')'] = $v;
		}
		
	// Theme didnt import menus, so lets replace with 0
	}else{
		$pagelayer->imported_menus_preg['(\d*)'] = $menu_id;
	}
	
	//////////////////////
	// Start import
	//////////////////////
	
	// Import the Pagelayer Templates files
	foreach($pgl as $k => $v){
		
		$path = pagelayer_cleanpath($pagelayer_theme_path.'/'.$k.'.pgl');
		
		$new_post = array();
	
		// Is the page there ?
		$template = get_page_by_path($k, OBJECT, $pagelayer->builder['name']);
		
		// It does exist so save the revision IF its the header and footer
		if(!empty($template)){
			
			$rev = wp_save_post_revision($template->ID);
			
			// Did we save the rev ?
			if(empty($rev)){
				// TODO : Throw error
			}
			
			$new_post['ID'] = $template->ID;
			
		}
		
		// Make an array
		$new_post['post_content'] = empty($v['post_content']) ? file_get_contents($path) : $v['post_content'];
		$new_post['post_title'] = $v['title'];
		$new_post['post_name'] = $k;
		$new_post['post_type'] = $pagelayer->builder['name'];
		$new_post['post_status'] = 'publish';
		$new_post['comment_status'] = 'closed';
		$new_post['ping_status'] = 'closed';		
		//pagelayer_print($new_post);die();
		
		// Handle Menu data
		$new_post['post_content'] = pagelayer_import_handle_replaces($new_post['post_content']);
		
		//pagelayer_print($new_post);die();
		
		// Now insert / update the post
		$ret = pagelayer_insert_content($new_post, $err);
		$post_id = $ret;
		$pagelayer->import_map[$k] = $ret;
		$pagelayer->imported_ids[$new_post['post_type']][$new_post['post_name']] = $ret;
		
		// Did we save the rev ?
		if(empty($ret)){
			$pl_error[] = 'Could not update the Pagelayer Template '.$k;
			return false;
		}
		
		// Save our template type
		update_post_meta($post_id, 'pagelayer_template_type', $v['type']);
		update_post_meta($post_id, 'pagelayer_template_conditions', $v['conditions']);
		update_post_meta($post_id, 'pagelayer_imported_content', $template_name);
		
		// Any conditions having Page IDs that need to be updated ?
		if(!empty($v['conditions'])){
			
			foreach($v['conditions'] as $ck => $cv){
				if(!empty($cv['id'])){
					$conditions[$post_id][$ck] = $cv['id'];
				}
			}
			
		}
		
	}
	
	/////////////////////////
	// Handle the PAGES Data
	/////////////////////////
	
	//pagelayer_print($data);
	
	foreach($data as $data_type => $data_v){
		
		$pagelayer->imported[$data_type] = 1;
		
		// To import theme related settings
		if($data_type == 'conf'){
			pagelayer_import_conf($data['conf']);
			continue;
		}
		
		if($data_type == 'menus'){
			continue;
		}
	
		// Check the theme files
		foreach($data[$data_type] as $k => $v){
			
			$path = pagelayer_cleanpath($pagelayer_theme_path.'/data/'.$data_type.'/'.$k);
			
			// Does it have the title and slug ?
			if(empty($v['post_title']) || empty($v['post_name'])){
				$pl_error[] = 'Something is fishy with this theme as there is no title or slug for '.$k;
				return false;
			}
			
			// Does the file exist ?
			if(!file_exists($path) || (empty($GLOBALS['sitepad']['dev']) && pagelayer_cleanpath(realpath($path)) != $path)){
				$pl_error[] = 'Something is fishy with this theme';
				return false;
			}
			
		}
		
		$menu_pages = [];
		
		// Now check the pages if it exist in this installation ?
		foreach($data[$data_type] as $k => $v){
			
			$path = pagelayer_cleanpath($pagelayer_theme_path.'/data/'.$data_type.'/'.$k);
			
			// Is the page there ?
			$page = get_page_by_path($v['post_name']);
			//r_print($page);
				
			$new_post = array();
			$insert_meta = 1;
			
			// It does exist so save the revision IF its the header and footer
			if(!empty($page)){
				
				$insert_meta = 0;
				
				if(isset($_POST['overwrite'])){
					$rev = wp_save_post_revision($page->ID);
					$new_post['ID'] = $page->ID;	
					$insert_meta = 1;			
				}
				
			}
			
			// Make an array
			$new_post['post_content'] = file_get_contents($path);
			$new_post['post_title'] = $v['post_title'];
			$new_post['post_name'] = $v['post_name'];
			$new_post['post_type'] = $data_type;
			$new_post['post_status'] = 'publish';
			
			// Meta file path
			$meta_path = pagelayer_cleanpath($pagelayer_theme_path.'/data/'.$data_type.'/'.$k.'.meta');
			
			if($insert_meta && file_exists($meta_path)){
				$meta_path = pagelayer_cleanpath($pagelayer_theme_path.'/data/'.$data_type.'/'.$k.'.meta');
				$new_post['meta_input'] = file_get_contents($meta_path);
				$new_post['meta_input'] = json_decode($new_post['meta_input']);
			}
			
			//r_print($new_post);die();
		
			// Handle Menu data
			$new_post['post_content'] = pagelayer_import_handle_replaces($new_post['post_content']);
			
			// Now insert / update the post
			$ret = pagelayer_insert_content($new_post, $err);
			
			// Did we save the post ?
			if(empty($ret)){
				$pl_error[] = 'Could not update the '.$data_type.' '.$v['post_name'];
				return false;
			}
			
			update_post_meta($ret, 'pagelayer_imported_content', $template_name);
			
			$pagelayer->import_map[$v['ID']] = $ret;
			$pagelayer->imported_ids[$new_post['post_type']][$new_post['post_name']] = $ret;
			
			// Skip Header, Footer and Home pages
			if($data_type == 'page' && preg_match('/^home/is', $new_post['post_name'])){
				$home_page = $ret;
			}
			
			if(defined('SITEPAD')){
				
				// Does the screenshot exist ?
				$screenshot_file = $pagelayer_theme_path.'/screenshots/'.$v['post_name'].'.jpg';
				if(file_exists($screenshot_file)){
					@mkdir($sitepad['screenshots_path'], 0755, true);
					@copy($screenshot_file, $sitepad['screenshots_path'].'/'.$v['post_name'].'.jpg');
				}
			
			}
			
		}
	
	}
	
	// Update Post for import
	if(!empty($conditions)){
		
		foreach($conditions as $post_ID => $v){
			
			$cond = get_post_meta($post_ID, 'pagelayer_template_conditions', 1);
			
			foreach($v as $ck => $cv){
			
				if(!empty($pagelayer->import_map[$cv])){
					$cond[$ck]['id'] = $pagelayer->import_map[$cv];
				}
			
			}
			
			update_post_meta($post_id, 'pagelayer_template_conditions', $cond);
			
		}
		
	}
	
	// Call a function for the theme if they want to execute something like create more templates, etc
	$ret = apply_filters('pagelayer_theme_imported', $template_name);
	
	if(isset($_POST['set_home_page']) || isset($_POST['create_blog_page'])){
		
		// Get the home page ID
		$blog = get_page_by_path('blog');
		
		// Insert the blog page
		if(empty($blog)){
			
			$new_post['post_content'] = '';
			$new_post['post_title'] = 'Blog';
			$new_post['post_name'] = 'blog';
			$new_post['post_type'] = 'page';
			$new_post['post_status'] = 'publish';
		
			// Now insert / update the post
			$blog_id = wp_insert_post($new_post);
			
		}else{
			$blog_id = $blog->ID;
		}
		
		// Set the blog page
		update_option('page_for_posts', $blog_id);
		
	}
	
	if(!empty($data['conf']['page_for_posts'])){
		$pagelayer->import_map[$data['conf']['page_for_posts']] = $blog_id;
		$pagelayer->imported_ids['page']['blog'] = $blog_id;
	}
	
	// Update any links that are to be updated
	if(!empty($pagelayer->import_links)){
		
		foreach($pagelayer->import_links as $post_type => $v){
			foreach($v as $slug => $link_maps){
				
				// Lets get the post
				$tmp_post = get_post($pagelayer->imported_ids[$post_type][$slug]);
				
				foreach($link_maps as $old_link_type => $old_link_slugs){
					
					//pagelayer_print($old_link_slugs);die();
					
					foreach($old_link_slugs as $old_link_slug){
						
						// Did we have such a link ?
						$new_link_id = @$pagelayer->imported_ids[$old_link_type][$old_link_slug];
						
						// If not found, lets try to find a similar post
						if(empty($new_link_id)){
							
							$args = ['name' => $old_link_slug,
								'post_type' => $old_link_type];
							
							// Make query
							$query = new WP_Query($args);
							
							// Get post
							if(!empty($query->posts)){
								$link_post = current($query->posts);
								//echo $old_link_slug.' - ';pagelayer_print($link_post->post_name);die();
								
								$new_link_id = @$link_post->ID;
							}
							
						}
						
						if(empty($new_link_id)){
							continue;
						}
						
						$tmp_post->post_content = str_replace('||link_id|'.$old_link_type.'|'.$old_link_slug.'||', $new_link_id, $tmp_post->post_content);
					}
				}
				
				//pagelayer_print($tmp_post);
				wp_update_post($tmp_post);
			}
		}
		
	}
	
	if(isset($_POST['set_home_page'])){
		
		// Set the blog page
		update_option('show_on_front', 'page');
		
		// Set home page as the default page
		if(!empty($home_page)){
			update_option('page_on_front', $home_page);
		}
		
	}
	
	// Update the menu
	if(empty($_POST['no_header_menu'])){
		
		// Are we importing from the theme ?
		if(!empty($pagelayer->imported_menus)){
			
			foreach($pagelayer->imported_menus as $k => $v){
				pagelayer_import_update_menus($v, $pagelayer_theme_path);
			}
			
		// We created the menu, lets update it
		}else{
			pagelayer_update_header_menu($menu_id, $pagelayer->import_map);
		}
	}
	
	// Save that we have imported the theme
	update_option('pagelayer_theme_'.$template_name.'_imported', time(), true);
	
	return true;

}

add_filter('pagelayer_start_insert_content', 'pagelayer_import_start_insert_content');
function pagelayer_import_start_insert_content($post){
	
	global $pagelayer;
	
	$_post = json_encode($post);
	
	// Does it have links ?
	if(preg_match_all('/(\|\|link_id\|([\w-]*)\|([\w-]*)\|\|)/', $_post, $matches)){
		foreach($matches[3] as $kk => $link){
			$pagelayer->import_links[$post['post_type']][$post['post_name']][$matches[2][$kk]][] = $link;
		}
		//pagelayer_print($matches);pagelayer_print($pagelayer->import_links);die();
	}
	
	if(preg_match('/theme_url/is', $_post)){
		$do = 1;
	}
	
	// Lets replace the images
	foreach($pagelayer->import_media as $k => $v){
		$_post = str_replace($k, $v, $_post);
		$k = str_replace('/', '\/', $k);// Handle JSON
		$_post = str_replace($k, $v, $_post);
		$k = str_replace('/', '\/', addslashes($k));// Handle Doubled JSON
		$_post = str_replace($k, $v, $_post);
	}
	
	$post = json_decode($_post, true);
	
	if(!empty($do)){
		//echo $_post;
		//pagelayer_print($post);die();
	}
	
	return $post;
}

// Create the menu
function pagelayer_import_create_menu($name){
		
	// Create the menu if not exists
	$menu_name = (empty($name) ? 'Pagelayer Menu' : $name);
	$menu_exists = wp_get_nav_menu_object($menu_name);
	
	// If there is no menu we will need to add it
	if(!empty($menu_exists)){
		wp_delete_nav_menu($menu_exists);
	}
	
	// Insert the Menu
	$menu_id = wp_create_nav_menu($menu_name);
	
	//r_print($menu_exists);r_print($menu_name);r_print($menu_id);die();
	
	if(!is_int($menu_id)){
		return false;
	}
	
	// We need to DISABLE auto add TEMPORARILY
	$options = (array) get_option('nav_menu_options');
	
	if (isset($options['auto_add'])){
		$key = array_search($menu_id, $options['auto_add']);
		
		if(!empty($key)){
			unset($options['auto_add'][$key]);
			update_option('nav_menu_options', $options);
		}
	}
	
	return $menu_id;

}

// Callback for menu replacement	
function pagelayer_import_handle_replaces($content){
	global $pagelayer;
	
	foreach($pagelayer->imported_menus_preg as $k => $v){
		$content = preg_replace('/\[pl_wp_menu ([^\]]*)nav_list="'.$k.'"([^\]]*)\]/is', '[pl_wp_menu ${1}nav_list="'.$v.'"${3}]', $content);
	}
	
	// Also for block format
	$content = preg_replace_callback('/<!--\s+(?P<closer>\/)?sp:pagelayer\/pl_wp_menu\s+(?P<attrs>{(?:(?:[^}]+|}+(?=})|(?!}\s+\/?-->).)*+)?}\s+)?(?P<void>\/)?-->/s', 'pagelayer_handle_wp_menu', $content);
		
	// Lets replace the variables for social icons
	$content = preg_replace_callback('/\[pl_social ([^\]]*)\]/is', 'pagelayer_handle_social_urls', $content);
	
	$content = preg_replace_callback('/<!--\s+(?P<closer>\/)?sp:pagelayer\/pl_social\s+(?P<attrs>{(?:(?:[^}]+|}+(?=})|(?!}\s+\/?-->).)*+)?}\s+)?(?P<void>\/)?-->/s', 'pagelayer_handle_social_urls_blocks', $content);
	
	return $content;
}

// Update the header menu
function pagelayer_update_header_menu($menu_id, $pages){
	
	$menu_pages = [];
	
	$home = get_option('page_on_front');
	if(!empty($home)){
		$menu_pages[] = $home;
	}
	
	$blog = get_option('page_for_posts');
	if(!empty($blog)){
		$menu_pages[] = $blog;
	}
	
	// The other links
	foreach($pages as $pk => $pv){
		
		$tmp = get_post($pv);
		
		if(is_wp_error($tmp) || $tmp->post_type !== 'page'){
			continue;
		}
		
		// Skip Header, Footer and Home pages
		if(in_array($pv, $menu_pages)){
			continue;
		}
		
		$menu_pages[] = $pv;
		
	}
	
	// Get the pages
	foreach($menu_pages as $pk => $page_id){
		$menu_pages[$pk] = get_post($page_id);
	}
	
	// The other links
	foreach($menu_pages as $pk => $pv){
		
		wp_update_nav_menu_item($menu_id, 0, array(
			'menu-item-title' =>  $pv->post_title,
			'menu-item-url' => home_url( '/'.$pv->post_name.'/' ),
			'menu-item-status' => 'publish',
			'menu-item-type' => 'post_type',
			'menu-item-object' => 'page',
			'menu-item-object-id' => $pv->ID));
		
	}
	
	// We need to enable auto add new pages
	$options = (array) get_option('nav_menu_options');
	
	if (!isset($options['auto_add'])){
		$options['auto_add'] = array();
	}
	
	$options['auto_add'][] = $menu_id;
	update_option('nav_menu_options', $options);
	
}

// For import of our exported menus
function pagelayer_import_update_menus($menu_id, $pagelayer_theme_path = ''){
	
	global $pagelayer;
	
	$old_id = array_search($menu_id, $pagelayer->imported_menus);
	$slug = $pagelayer->imported_menus_slug[$menu_id];
	
	$data = file_get_contents($pagelayer_theme_path.'/data/menus/'.$slug);
	$data = @json_decode($data, true);
	
	$ids = [];
	
	// Insert the links
	foreach($data as $k => $v){
		
		$r = [];		
		$r['menu-item-title'] = $v['post']['title'];
		$r['menu-item-status'] = $v['post']['post_status'];
		$r['menu-item-type'] = $v['post']['type'];
		$r['menu-item-object'] = $v['post']['object'];
		
		// Any parent ?
		if(!empty($v['post']['menu_item_parent'])){
			
			$parent = $ids[$v['post']['menu_item_parent']];
			
			if(!empty($parent)){
				$r['menu-item-parent-id'] = $parent;
			}
			
		}
		
		// Regular Data Object
		if($r['menu-item-type'] !== 'custom'){
			
			$r['menu-item-object-id'] = $pagelayer->import_map[$v['post']['object_id']];
			
			if(empty($r['menu-item-object-id'])){
				continue;
			}
			
			$r['menu-item-url'] = get_permalink($r['menu-item-object-id']);
		
		// Custom URL
		}else{
			$r['menu-item-url'] = $v['post']['url'];
		}
		
		//r_print($r);
		
		$ids[$v['post']['db_id']] = wp_update_nav_menu_item($menu_id, 0, $r);
		
	}

	// We need to enable auto add new pages
	$options = (array) get_option('nav_menu_options');
	
	if (!isset($options['auto_add'])){
		$options['auto_add'] = array();
	}
	
	$options['auto_add'][] = $menu_id;
	update_option('nav_menu_options', $options);

}

// Callback for menu replacement	
function pagelayer_handle_wp_menu($matches){
	global $pagelayer;
	
	foreach($pagelayer->imported_menus_preg as $k => $v){
		$matches[0] = preg_replace('/nav_list"\s*:\s*"'.$k.'"/is', 'nav_list":"'.$v.'"', $matches[0]);
	}
	
	return $matches[0];
	
}

// Replace Social URLs with the one given in setup
function pagelayer_handle_social_urls($matches){
	//r_print($matches);die();
	
	// Get the icon
	preg_match('/icon=(\'|")([^\'"]*)(\'|")/is', $matches[0], $icon);
	$icon = $icon[2];
	
	$urls = pagelayer_get_social_urls();
	
	foreach($urls as $k => $v){
		if(preg_match('/'.preg_quote($k, '/').'/is', $icon)){
			$social_url = $v;
			break;
		}
	}
	
	if(!empty($social_url)){
		
		// Is the social_url param there ?
		if(!preg_match('/social_url=/is', $matches[0])){
			$matches[0] = substr($matches[0], 0, -1).'social_url="#"]';
		}
		
		$matches[0] = preg_replace('/social_url=(\'|")([^\'"]*)(\'|")/is', 'social_url="'.$social_url.'"', $matches[0]);
	}
	
	//r_print($matches);die();
	
	return $matches[0];
	
}

// Replace Social URLs with the one given in setup
function pagelayer_handle_social_urls_blocks($matches){
	
	// Get the icon
	preg_match('/icon":"([^"]*)"/is', $matches[0], $icon);
	$icon = $icon[1];
	
	$urls = pagelayer_get_social_urls();
	
	foreach($urls as $k => $v){
		if(preg_match('/'.preg_quote($k, '/').'/is', $icon)){
			$social_url = $v;
			break;
		}
	}
	
	if(!empty($social_url)){
		
		// Is the social_url param there ?
		if(!preg_match('/"social_url"/is', $matches[0])){
			$matches[0] = preg_replace('/("icon"\s*:\s*"([^"]*)")/is', '"icon":"'.$icon.'","social_url":"#"', $matches[0]);
		}
		
		$matches[0] = preg_replace('/social_url"\s*:\s*"([^"]*)"/is', 'social_url":"'.$social_url.'"', $matches[0]);
	}
	
	return $matches[0];
	
}

// Add the blog templates
function pagelayer_blog_templates($pgl){

	$conf = '{
		"single-template": {
			"type": "single",
			"title": "Single Template",
			"conditions": [
				{
					"type": "include",
					"template": "singular",
					"sub_template": "post",
					"id": ""
				},
				{
					"type": "include",
					"template": "singular",
					"sub_template": "attachment",
					"id": ""
				}
			]
		},
		"blog-template": {
			"type": "archive",
			"title": "Blog Template",
			"conditions": [
				{
					"type": "include",
					"template": "archives",
					"sub_template": "",
					"id": ""
				}
			]
		}
		
	}';
	
	$conf = json_decode($conf, true);
	
	// Do we have the blog template ?
	if(empty($pgl['blog-template'])){
	
		$conf['blog-template']['post_content'] = '[pl_row pagelayer-id="ffbgB5e4xPIruUJC" stretch="auto" col_gap="10" width_content="auto" row_height="default" overlay_hover_delay="400" row_shape_top_color="#227bc3" row_shape_top_width="100" row_shape_top_height="100" row_shape_bottom_color="#e44993" row_shape_bottom_width="100" row_shape_bottom_height="100"]
[pl_col pagelayer-id="aF6cze85x0CVnb4I" overlay_hover_delay="400"]
[pl_archive_title pagelayer-id="a6sL2H8c5FJDwHmL" align="left" typo=",,,,,,Solid,,,," ele_margin="0px,0px,18px,0px" font_size="28"]
[/pl_archive_title]
[pl_archive_posts pagelayer-id="CrFuxlpqwrKx1cok" type="default" columns="3" columns_mobile="1" col_gap="20" row_gap="40" data_padding="5,5,5,5" bg_color="#ffffff" show_thumb="true" show_title="true" meta="author,date,comments" meta_sep="|" show_content="excerpt" content_color="#121212" content_align="left" pagination="number_prev_next" thumb_size="medium_large" ratio="0.7" title_color="#0986c0" title_typo=",18,,,,,solid,,,," exc_length="10" pagi_prev_text="Previous" pagi_next_text="Next" pagi_end_size="1" pagi_mid_size="2" pagi_align="center"]
[/pl_archive_posts]
[/pl_col]
[/pl_row]';
	
		$pgl['blog-template'] = $conf['blog-template'];

	}
	
	// Do we have the blog template ?
	if(empty($pgl['single-template'])){
		
		$conf['single-template']['post_content'] = '[pl_row pagelayer-id="TeNMIn3gRsvsyDZj" stretch="auto" col_gap="10" width_content="auto" row_height="default" overlay_hover_delay="400" row_shape_top_color="#227bc3" row_shape_top_width="100" row_shape_top_height="100" row_shape_bottom_color="#e44993" row_shape_bottom_width="100" row_shape_bottom_height="100"]
[pl_col pagelayer-id="qyP2XV3ClSd9cEWM" overlay_hover_delay="400"]
[pl_post_title pagelayer-id="nNt87422AXwZoBQg" title_color="" typo=",35,,700,,,solid,,,," align="center"]
[/pl_post_title]
[/pl_col]
[/pl_row]
[pl_row pagelayer-id="6UuOjtSrBDhWOnWG" stretch="auto" col_gap="10" width_content="fixed" row_height="default" overlay_hover_delay="400" row_shape_top_color="#227bc3" row_shape_top_width="100" row_shape_top_height="100" row_shape_bottom_color="#e44993" row_shape_bottom_width="100" row_shape_bottom_height="100" row_width="70%" fixed_width="70%" fixed_width_tablet="85%" fixed_width_mobile="100%"]
[pl_col pagelayer-id="gzGSF2JVwcPcNUk6" overlay_hover_delay="400" col_width="80" col="12"]
[pl_post_info pagelayer-id="gBDuE9nYBu0bIHyv" layout="vertical" space_between="15" align="center" icon_colors="normal" text_colors="normal"]
[pl_post_info_list pagelayer-id="ZMZjpaTiEc9Ien3t" type="author" info_link="true" info_icon_on="true" info_icon="fas fa-user-circle"]
[/pl_post_info_list]
[pl_post_info_list pagelayer-id="xI8gpn9VRfPDkZ0Q" type="date" info_link="true" info_icon_on="true" info_icon="fas fa-calendar-alt" date_format="default"]
[/pl_post_info_list]
[pl_post_info_list pagelayer-id="LaEZYd9SjEnQHsg3" type="time" info_link="true" info_icon_on="true" info_icon="fas fa-clock" time_format="default"]
[/pl_post_info_list]
[pl_post_info_list pagelayer-id="9lTHiEQJQqESt6YG" type="comments" info_link="true" info_icon_on="true" info_icon="fas fa-comment"]
[/pl_post_info_list]
[/pl_post_info]
[pl_post_excerpt pagelayer-id="NklzzZGW3ve1X8BS" ele_margin="15px,0px,15px,0px" align="left"]
[/pl_post_excerpt]
[pl_featured_img pagelayer-id="sZLiICVhGCbBTx1a" size="full" img_filter="0,100,100,0,0,100,100" caption_color="#0986c0" img_hover_delay="400" custom_size="70%,0%" align="center"]
[/pl_featured_img]
[pl_post_content pagelayer-id="7JbkxQEvq0skyUUl" ele_margin="35px,0px,35px,0px" font_size="NaN"]
[/pl_post_content]
[pl_post_info pagelayer-id="tvno5FCIKdwGa8IE" layout="horizontal" space_between="5" align="left" icon_colors="normal" text_colors="normal" input_typo=",,,,,,Solid,,,,"]
[pl_post_info_list pagelayer-id="SwoZ4cxl3XFMLE3l" type="terms" info_link="true" info_icon_on="" info_icon="fas fa-user-circle" taxonomy="category" info_before="Category :"]
[/pl_post_info_list]
[pl_post_info_list pagelayer-id="sgTqNx5LkBHODkrG" type="terms" info_link="true" info_icon_on="" info_icon="fas fa-user-circle" taxonomy="post_tag" info_before="Tags :"]
[/pl_post_info_list]
[/pl_post_info]
[/pl_col]
[/pl_row]
[pl_row pagelayer-id="heO1UxRj8lIQZ52M" stretch="auto" col_gap="10" width_content="auto" row_height="default" overlay_hover_delay="400" row_shape_top_color="#227bc3" row_shape_top_width="100" row_shape_top_height="100" row_shape_bottom_color="#e44993" row_shape_bottom_width="100" row_shape_bottom_height="100"]
[pl_col pagelayer-id="s3sgObVllcHz0CB7" overlay_hover_delay="400"]
[pl_post_nav pagelayer-id="RrRky7duRa9KGmsA" lables="true" post_title="true" arrows="true" sep_color="#bdbdbd" sep_rotate="20" sep_width="5" prev_label="Previous" next_label="Next" label_colors="normal" title_colors="normal" arrows_list="angle" icon_colors="normal"]
[/pl_post_nav]
[/pl_col]
[/pl_row]
[pl_row pagelayer-id="duGtpLrwHkOWbE0m" stretch="auto" col_gap="10" width_content="auto" row_height="default" overlay_hover_delay="400" row_shape_top_color="#227bc3" row_shape_top_width="100" row_shape_top_height="100" row_shape_bottom_color="#e44993" row_shape_bottom_width="100" row_shape_bottom_height="100"]
[pl_col pagelayer-id="ad58IjV6dHjcRBmV" overlay_hover_delay="400"]
[pl_post_comment pagelayer-id="bwueyBxPgdNLC1Ec" comment_skin="theme_comment" post_type="current"]
[/pl_post_comment]
[/pl_col]
[/pl_row]';
	
		$pgl['single-template'] = $conf['single-template'];

	}
	
	return $pgl;
	
}

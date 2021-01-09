<?php

// Check for boolean values in shortcode
function r34ics_boolean_check($val) {
	$check = strtolower(trim(strip_tags((string)$val)));
	if ($check === '1' || $check === 'true') { return true; }
	if ($check === '0' || $check === 'false' || $check === 'none') { return false; }
	if ($check === 'null' || $check === '') { return null; }
	return (bool)$val;
}


// Convert hex color to rgba
function r34ics_hex2rgba($color, $alpha=1, $tint=false, $output_array=false) {
	$r = $g = $b = 0;
	$color = trim($color);
	// Strip #
	if (strpos($color, '#') === 0) { $color = str_replace('#', '', $color); }
	// rgb() or rgba() -- we ignore the alpha value in rgba()
	if (strpos($color, 'rgb') === 0) {
		$rgb = explode(',', preg_replace('/[^0-9,]/', '', $color));
		$r = intval($rgb[0]);
		$g = intval($rgb[1]);
		$b = intval($rgb[2]);
	}
	// 3-digit hex
	elseif (strlen($color) == 3) {
		$r = hexdec(substr($color,0,1));
		$g = hexdec(substr($color,1,1));
		$b = hexdec(substr($color,2,1));
	}
	// 6-digit hex
	elseif (strlen($color) == 6) {
		$r = hexdec(substr($color,0,2));
		$g = hexdec(substr($color,2,2));
		$b = hexdec(substr($color,4,2));
	}
	// Lighten tint
	if (!empty($tint)) {
		$r = $r + ((255 - $r) / 1.3333);
		$g = $g + ((255 - $g) / 1.3333);
		$b = $b + ((255 - $b) / 1.3333);
	}
	if (!empty($output_array)) { return array($r, $g, $b); }
	elseif ($alpha !== null) { return 'rgba(' . $r . ',' . $g . ',' . $b . ',' . floatval($alpha) . ')'; }
	else { return 'rgb(' . $r . ',' . $g . ',' . $b . ')'; }
}


// Build array of base and accent colors
function r34ics_color_set($colors, $alpha=0.75) {
	$arr = array();
	foreach ((array)$colors as $key => $color) {
		if (empty($color)) { continue; }
		$arr[$key] = array(
			'base' => r34ics_hex2rgba($color,1),
			'highlight' => r34ics_hex2rgba($color, $alpha, true),
		);
	}
	return $arr;
}


// Determine if white or black is a better text color for background color
function r34ics_color_text4bg($hex,$trimhash=false) {
	$rgb = r34ics_hex2rgba($hex, null, false, true);
	$white_threshold_multiplier = 0.6;
	$threshold = (255 * 3) * $white_threshold_multiplier;
	$text_color = '#191919';
	$reversed_color = '#ffffff';
	$output = (array_sum($rgb) < $threshold) ? $reversed_color : $text_color;
	if ($trimhash) { $output = ltrim($output,'#'); }
	return $output;
}


// Set a display date format based on a passed-in format or a default that adds day of week and removes year from site format
function r34ics_date_format($format=null, $short_day=false) {
	$day_format = !empty($short_day) ? 'D' : 'l';
	return !empty($format) ? strip_tags($format) : $day_format . ' ' . trim(preg_replace('/((, )?Y|l(, )?)/', '', get_option('date_format')), ',/-');
}


// Check if a URL's domain is the same as the current site
function r34ics_domain_match($url) {
	return (parse_url($url, PHP_URL_HOST) == $_SERVER['SERVER_NAME']);
}


// Check if a string is empty of text content
function r34ics_empty_content($str) {
	return empty(trim(str_replace('&nbsp;', '', strip_tags($str, '<img><iframe><audio><video>'))));
}


// Replicate (some of) the effects of 'the_content' filter without actually calling that filter because we might pull actual post content in along the way
// Note: It's perhaps a gray area whether or not 'the_content' should be used for this but Elementor, for one, messes things up for us with this filter!
// Also note: This skips some of the functions WP normally runs on 'the_content' because we're assuming this is general-purpose text, not WP content
function r34ics_filter_the_content($text) {
	return trim(wpautop(convert_chars(wptexturize($text))));
}


// Generate CSS classes to apply to wrapper for an event
function r34ics_event_css_classes($event, $time, $args) {
	$classes = array('event', $time);
	if (!empty($event['multiday']['position'])) {
		$classes[] = 'multiday_' . $event['multiday']['position'];
	}
	// Deprecated
	elseif (!empty($event['multiday_position'])) {
		$classes[] = 'multiday_' . $event['multiday_position'];
	}
	if (isset($args['view'])) {
		switch ($args['view']) {
			// @todo Add view-specific class handling here
			default:
				break;
		}
	}
	return esc_attr(implode(' ', $classes));
}


// Generate dynamic feed colors CSS
function r34ics_feed_colors_css($ics_data, $padding=false, $hover=false) {
	?>
	<style type="text/css">
		<?php
		foreach ($ics_data['colors'] as $feed_key => $color) {
			?>
			#<?php echo $ics_data['guid']; ?> *[data-feed-color="<?php echo esc_attr($color['base']); ?>"]:not([type=checkbox]) {
				background: <?php echo $color['highlight']; ?>;
				<?php
				if (!empty($padding)) {
					?>
					padding: 0.1em 0.5em;
					<?php
				}
				if (!empty($hover)) {
					?>
					border: 1px solid <?php echo r34ics_hex2rgba($color['base'],0.25); ?>;
					z-index: 1;
					<?php
				}
				?>
				border-left: 4px solid <?php echo $color['base']; ?>;
			}
			<?php
			if (!empty($hover) && function_exists('r34ics_hex2rgba') && function_exists('r34ics_color_text4bg')) {
				?>
				#<?php echo $ics_data['guid']; ?> *[data-feed-color="<?php echo esc_attr($color['base']); ?>"]:not([type=checkbox]):hover {
					background: <?php echo r34ics_hex2rgba($color['base'],0.8333); ?>;
					color: <?php echo r34ics_color_text4bg($color['base']); ?>;
					height: auto !important;
					z-index: 2;
				}
				<?php
			}
		}
		?>
	</style>
	<?php
}


// Get first day of current week/month/year
function r34ics_first_day_of_current($interval) {
	$first_day = false;
	switch ($interval) {
		case 'year':
			$first_day = gmmktime(0,0,0,1,1,date('Y'));
			break;
		case 'week':
			$start_of_week = get_option('start_of_week', 0);
			$this_day = date('w');
			$days_offset = $this_day - $start_of_week;
			if ($days_offset < 0) { $days_offset = $days_offset + 7; }
			$first_day = gmmktime(0,0,0,date('n'),date('j')-$days_offset,date('Y'));
			break;
		case 'month':
		default:
			$first_day = gmmktime(0,0,0,date('n'),1,date('Y'));
			break;
	}
	return $first_day;
}


function r34ics_get_feed_tz($ics_data, $feed_key) {
	$tzid = null;
	if (is_array($ics_data['tz'])) {
		$tzid = isset($ics_data['tz'][$feed_key]) ? trim($ics_data['tz'][$feed_key]) : trim($ics_data['tz'][0]);
	}
	elseif (!empty($ics_data['tz'])) {
		$tzid = $ics_data['tz'];
	}
	return r34ics_is_valid_tz($tzid) ? timezone_open($tzid) : wp_timezone();
}


// Generate a custom GUID
// Based on: http://php.net/manual/en/function.com-create-guid.php#99425
function r34ics_guid($lowercase=true, $letter_prefix=true) {
	$guid = null;
	if (function_exists('com_create_guid') === true) {
		$guid = trim(com_create_guid(), '{}');
	}
	else {
		$guid = sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
	}
	if (!empty($lowercase)) { $guid = strtolower($guid); }
	if (!empty($letter_prefix)) { $guid = 'r' . $guid; }
	return $guid;
}


// Determine whether or not event has a description to be displayed
function r34ics_has_desc($args, $event) {
	// Override all other factors if maskinfo is on
	if (!empty($args['maskinfo'])) {
		return false;
	}
	// Assess settings and presence of content to determine whether or not there is a description to display
	else {
		return	(!empty($args['eventdesc']) && (!empty($event['eventdesc']) || !empty($event['url']) || !empty($event['attach']))) ||
				(!empty($args['location']) && !empty($event['location'])) ||
				(!empty($args['organizer']) && !empty($event['organizer']));
	}
}


// Get an hour format (e.g. for grid headings) based on the site's time format
function r34ics_hour_format($time_format=null) {
	$hour_format = null;
	if (empty($time_format)) { $time_format = get_option('time_format'); }
	switch ($time_format) {
		case 'H:i':
			$hour_format = 'H:00';
			break;
		case 'h:i':
			$hour_format = 'h:00';
			break;
		case 'Hi':
			$hour_format = 'H00';
			break;
		case 'g:i a':
			$hour_format = 'g a';
			break;
		case 'g:i A':
		default:
			$hour_format = 'g A';
			break;
	}
	return $hour_format;
}


// Detect if a string contains HTML
// Source: https://stackoverflow.com/a/33614682
function r34ics_is_html($str) {
	return preg_match('/\/[a-z]*>/i', $str) != 0;
}


// Stupid exceptions!
// Source: https://stackoverflow.com/a/37231388
function r34ics_is_valid_tz($tzid) {
	if (empty($tzid)) { return false; }
	foreach (timezone_abbreviations_list() as $zone) {
		foreach ($zone as $item) { if ($item['timezone_id'] == $tzid) { return true; } }
	}
	return false;
}


// Debugging tool: output a given string as a JavaScript alert
function r34ics_js_alert($str) {
	if (current_user_can('manage_options')) {
		echo '<script>alert("' . str_replace('"', '&quot;', $str) . '");</script>';
	}
}


// Get last day of current week/month/year
function r34ics_last_day_of_current($interval) {
	$last_day = false;
	switch ($interval) {
		case 'year':
			$last_day = gmmktime(0,0,0,12,31,date('Y'));
			break;
		case 'week':
			$end_of_week = get_option('start_of_week', 0) - 1;
			if ($end_of_week < 0) { $end_of_week = $end_of_week + 7; }
			$this_day = date('w');
			$days_offset = $end_of_week - $this_day;
			if ($days_offset < 0) { $days_offset = $days_offset + 7; }
			$last_day = gmmktime(0,0,0,date('n'),date('j')+$days_offset,date('Y'));
			break;
		case 'month':
		default:
			$last_day = gmmktime(0,0,0,date('n'),date('t'),date('Y'));
			break;
	}
	return $last_day;
}


// Apply make_clickable() function only if string does not contain HTML
function r34ics_maybe_make_clickable($str) {
	$str = html_entity_decode($str);
	if (!r34ics_is_html($str)) {
		$str = make_clickable(nl2br($str));
	}
	return $str;
}


// Format organizer array data
function r34ics_organizer_format($organizer=null) {
	$output = '';
	if (is_array($organizer)) {
		if (count((array)$organizer) == 2 && isset($organizer[0]['CN'])) {
			$output .= '<div class="organizer_email"><a href="' . esc_url($organizer[1]) . '">' . rawurldecode($organizer[0]['CN']) . '</a></div>';
		}
		elseif (!empty($organizer[1]) && is_scalar($organizer[1])) {
			$output .= '<div>' . $organizer[1] . '</div>';
		}
	}
	elseif (!empty($organizer)) {
		$output .= '<div>' . $organizer . '</div>';
	}
	return $output;
}


// Break a string into an array using spaces OR pipes as the delimiter
function r34ics_space_pipe_explode($str) {
	if (strpos($str, ' ') !== false) {
		return explode(' ', $str);
	}
	elseif (strpos($str, '|') !== false) {
		return explode('|', $str);
	}
	return $str;
}


// Simple time formatter that will take a basic time string and convert it to a time in the desired format
function r34ics_time_format($time_string, $format=null) {
	$output = null;
	// Get time format from WP settings if not passed in
	if (empty($format)) { $format = get_option('time_format'); }
	// Get digits from time string
	$time_digits = preg_replace('/[^0-9]+/', '', $time_string);
	// Get am/pm from time string
	$time_ampm = preg_replace('/[^amp]+/', '', strtolower($time_string));
	if ($time_ampm != 'am' && $time_ampm != 'pm') { $time_ampm = null; }
	// Prepend zero to digits if length is odd
	if (strlen($time_digits) % 2 == 1) { $time_digits = '0' . $time_digits; }
	// Get hour, minutes and seconds from time digits
	$time_h = substr($time_digits, 0, 2);
	$time_m = substr($time_digits, 2, 2);
	$time_s = strlen($time_digits) == 6 ? substr($time_digits, 4, 2) : null;
	// Convert hour to correct 24-hour value if needed
	if ($time_ampm == 'pm') { $time_h = (int)$time_h + 12; }
	if ($time_ampm == 'am' && $time_h == '12') { $time_h = '00'; }
	// Determine am/pm if not passed in
	if (empty($time_ampm)) { $time_ampm = (int)$time_h >= 12 ? 'pm' : 'am'; }
	// Get 12-hour version of hour
	$time_h12 = (int)$time_h % 12;
	if ($time_h12 == 0) { $time_h12 = 12; }
	if ($time_h12 < 10) { $time_h12 = '0' . (string)$time_h12; }
	// Convert am/pm abbreviations for Greek (this is simpler than putting it in the i18n files)
	if (get_locale() == 'el') { $time_ampm = ($time_ampm == 'am') ? 'πμ' : 'μμ'; }
	// Format output
	switch ($format) {
		// 12-hour formats without seconds
		case 'g:i a':			$output = intval($time_h12) . ':' . $time_m . '&nbsp;' . $time_ampm;								break;
		case 'g:ia':			$output = intval($time_h12) . ':' . $time_m . $time_ampm;											break;
		case 'g:i A':			$output = intval($time_h12) . ':' . $time_m . '&nbsp;' . strtoupper($time_ampm);					break;
		case 'g:iA':			$output = intval($time_h12) . ':' . $time_m . strtoupper($time_ampm);								break;
		case 'h:i a':			$output = $time_h12 . ':' . $time_m . '&nbsp;' . $time_ampm;										break;
		case 'h:ia':			$output = $time_h12 . ':' . $time_m . $time_ampm;													break;
		case 'h:i A':			$output = $time_h12 . ':' . $time_m . '&nbsp;' . strtoupper($time_ampm);							break;
		case 'h:iA':			$output = $time_h12 . ':' . $time_m . strtoupper($time_ampm);										break;
		// 24-hour formats without seconds
		case 'G:i':				$output = intval($time_h) . ':' . $time_m;															break;
		case 'Gi':				$output = intval($time_h) . $time_m;																break;
		// case 'H:i': is the default, below
		case 'Hi':				$output = $time_h . $time_m;																		break;
		// 24-hour formats without seconds, using h and m or min
		case 'G \h i \m\i\n':	$output = intval($time_h) . '&nbsp;h&nbsp;' . $time_m . '&nbsp;min';								break;
		case 'G\h i\m\i\n':		$output = intval($time_h) . 'h&nbsp;' . $time_m . 'min';											break;
		case 'G\hi\m\i\n':		$output = intval($time_h) . 'h' . $time_m . 'min';													break;
		case 'G \h i \m':		$output = intval($time_h) . '&nbsp;h&nbsp;' . $time_m . '&nbsp;m';									break;
		case 'G\h i\m':			$output = intval($time_h) . 'h&nbsp;' . $time_m . 'm';												break;
		case 'G\hi\m':			$output = intval($time_h) . 'h' . $time_m . 'm';													break;
		case 'H \h i \m\i\n':	$output = $time_h . '&nbsp;h&nbsp;' . $time_m . '&nbsp;min';										break;
		case 'H\h i\m\i\n':		$output = $time_h . 'h&nbsp;' . $time_m . 'min';													break;
		case 'H\hi\m\i\n':		$output = $time_h . 'h' . $time_m . 'min';															break;
		case 'H \h i \m':		$output = $time_h . '&nbsp;h&nbsp;' . $time_m . '&nbsp;m';											break;
		case 'H\h i\m':			$output = $time_h . 'h&nbsp;' . $time_m . 'm';														break;
		case 'H\hi\m':			$output = $time_h . 'h' . $time_m . 'm';															break;
		// 12-hour formats with seconds
		case 'g:i:s a':			$output = intval($time_h12) . ':' . $time_m . ':' . $time_s . '&nbsp;' . $time_ampm;				break;
		case 'g:i:sa':			$output = intval($time_h12) . ':' . $time_m . ':' . $time_s . $time_ampm;							break;
		case 'g:i:s A':			$output = intval($time_h12) . ':' . $time_m . ':' . $time_s . '&nbsp;' . strtoupper($time_ampm);	break;
		case 'g:i:sA':			$output = intval($time_h12) . ':' . $time_m . ':' . $time_s . strtoupper($time_ampm);				break;
		case 'h:i:s a':			$output = $time_h12 . ':' . $time_m . ':' . $time_s . '&nbsp;' . $time_ampm;						break;
		case 'h:i:sa':			$output = $time_h12 . ':' . $time_m . ':' . $time_s . $time_ampm;									break;
		case 'h:i:s A':			$output = $time_h12 . ':' . $time_m . ':' . $time_s . '&nbsp;' . strtoupper($time_ampm);			break;
		case 'h:i:sA':			$output = $time_h12 . ':' . $time_m . ':' . $time_s . strtoupper($time_ampm);						break;
		// 24-hour formats with seconds
		case 'G:i:s':			$output = intval($time_h) . ':' . $time_m . ':' . $time_s;											break;
		case 'H:i:s':			$output = $time_h . ':' . $time_m . ':' . $time_s;													break;
		case 'His':				$output = $time_h . $time_m . $time_s;																break;
		// Default
		case 'H:i':
		default:				$output = $time_h . ':' . $time_m;																	break;
	}
	// Return output
	return $output;
}


// Retrieve file from remote server with fallback methods
// Based on: https://stackoverflow.com/a/21177510
function r34ics_url_get_contents($url, $recursion=false) {
	global $R34ICS;
	
	// Must have a URL
	if (empty($url)) {
		$R34ICS->debug_messages[$url]['Errors'][] = 'No ICS URL provided.';
		return false;
	}
	
	// Convert ampersand entities in URL to plain ampersands
	$url = str_replace('&amp;', '&', $url);
	
	// Debugging messages
	if ($R34ICS->debug) {
		if (empty($url)) { $R34ICS->debug_messages[$url]['Errors'][] = 'No URL provided to function ' . __FUNCTION__ . '().'; }
		else {
			$R34ICS->debug_messages[$url]['ICS Feed'] = '<a href="' . $url . '" target="_blank" download="' . pathinfo($url,PATHINFO_BASENAME) . '">DOWNLOAD</a> // <a href="https://icalendar.org/validator.html?url=' . esc_url($url) . '#results" target="_blank">VALIDATE</a>';
		}
	}

	$url_contents = null;
	$curl_response_code = null;
	$curl_redirect_url = null;
	
	// Some servers (e.g. Airbnb) will require a user_agent string or return 403 Forbidden
	ini_set('user_agent', 'ICS Calendar for WordPress');
	
	// Attempt to use cURL functions
	if (defined('CURLVERSION_NOW') && function_exists('curl_exec')) { 
		if ($R34ICS->debug) { $R34ICS->debug_messages[$url]['Load status'][] = 'Attempted to load URL via cURL'; }
		$conn = curl_init($url);
		if (file_exists(ABSPATH . 'wp-includes/certificates/ca-bundle.crt')) {
			curl_setopt($conn, CURLOPT_CAINFO, ABSPATH . 'wp-includes/certificates/ca-bundle.crt');
		}
		curl_setopt($conn, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($conn, CURLOPT_FRESH_CONNECT,  true);
		curl_setopt($conn, CURLOPT_MAXREDIRS, 5);
		curl_setopt($conn, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($conn, CURLOPT_SSL_VERIFYPEER, true);
		$url_contents = (curl_exec($conn));
		$curl_response_code = curl_getinfo($conn, CURLINFO_RESPONSE_CODE);
		$curl_redirect_url = curl_getinfo($conn, CURLINFO_REDIRECT_URL);
		if ($R34ICS->debug == '2') { $R34ICS->debug_messages[$url]['cURL info'][] = curl_getinfo($conn); }
		elseif ($R34ICS->debug) { $R34ICS->debug_messages[$url]['Load status'][] = 'HTTP response: ' . $curl_response_code; }
		curl_close($conn);
	}

	// Attempt to use fopen functions
	if (empty($url_contents) && ini_get('allow_url_fopen')) {
		if ($R34ICS->debug) { $R34ICS->debug_messages[$url]['Load status'][] = 'Attempted to load URL via file_get_contents()'; }
		$url_contents = file_get_contents($url);
	}

	// Follow rewrites (if CURLOPT_FOLLOWLOCATION failed or using fopen)
	// If possible, we check for a 301 or 302 response code, falling back on certain text strings contained in the response
	// Outlook rewrites may include the string '">Found</a>' in the output
	// Most other feeds (e.g. Google Calendar) will include 'Moved Permanently' in the output
	if (!$recursion && (
			$curl_response_code == '301' ||
			$curl_response_code == '302' ||
			stripos($url_contents, '">Found</a>') !== false ||
			stripos($url_contents, 'Moved Permanently') !== false ||
			strpos($url_contents, 'Object moved') !== false
	)) {

		// Use cURL redirect URL if provided
		if (!empty($curl_redirect_url)) {
			if ($R34ICS->debug) { $R34ICS->debug_messages[$url]['Load status'][] = 'Recursively loaded URL ' . $curl_redirect_url . ' by following a rewrite returned by the server'; }
			$url_contents = r34ics_url_get_contents($curl_redirect_url, true);
		}

		// Scrape URL from returned HTML if necessary
		else {
			preg_match('/<(a href|A HREF)="([^"]+)"/', $url_contents, $url_match);
			if (isset($url_match[2])) {
				if ($R34ICS->debug) { $R34ICS->debug_messages[$url]['Load status'][] = 'Recursively loaded URL ' . $url_match[2] . ' by following a rewrite returned by the server'; }
				$url_contents = r34ics_url_get_contents($url_match[2], true);
			}
			else {
				if ($R34ICS->debug) { $R34ICS->debug_messages[$url]['Errors'][] = 'No redirect URL provided by server'; }
			}
		}
	}

	// Cannot retrieve file
	if (empty($url_contents)) {
		if ($R34ICS->debug) { $R34ICS->debug_messages[$url]['Errors'][] = 'URL contents empty (' . $url . ')'; }
		$url_contents = false;
	}
	else {
		if ($R34ICS->debug == 2) { $R34ICS->debug_messages[$url]['URL contents retrieved'] = $url_contents; }
		elseif ($R34ICS->debug) { $R34ICS->debug_messages[$url]['URL contents retrieved'] = strlen($url_contents) . ' bytes'; }
	}
	
	return $url_contents;
}


// Determine if it will be possible to retrieve a remote URL
function r34ics_url_open_allowed() {
	return (defined('CURLVERSION_NOW') || ini_get('allow_url_fopen'));
}


// Print an array with preformatted HTML -- for debugging only
function r34ics_debug($arr) {
	if (!current_user_can('manage_options')) { return false; }
	global $r34ics_debug_output;
	ob_start();
	echo '<hr /><pre>';
	print_r($arr);
	echo '</pre>';
	$r34ics_debug_output .= ob_get_clean();
	return null;
}
function r34ics_wp_footer_debug_output() {
	if (!current_user_can('manage_options')) { return false; }
	global $r34ics_debug_output;
	if (empty($r34ics_debug_output)) { return false; }
	echo '<div class="r34ics_debug_wrapper minimized"><div class="r34ics_debug_toggle">&#9662;</div><div class="r34ics_debug_header"><h4>ICS Calendar Debugger</h4></div><div class="r34ics_debug_content">';
	echo $r34ics_debug_output;
	echo '</div></div>';
	return true;
}
// Output final debugging results
add_action('wp_footer', 'r34ics_wp_footer_debug_output');

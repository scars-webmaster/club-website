<?php
global $R34ICS, $R34ICSPro;
?>

<div class="wrap r34ics">

	<h2><?php echo get_admin_page_title(); ?></h2>
	
	<div class="metabox-holder columns-2">
	
		<div class="column-1">
		
			<h2 class="nav-tab-wrapper">
				<a href="#overview" class="nav-tab nav-tab-active">Overview</a>
				<a href="#view-layout-options" class="nav-tab">View/Layout</a>
				<a href="#event-display-options" class="nav-tab">Display</a>
				<a href="#advanced-options" class="nav-tab">Advanced</a>
				<a href="#all-parameters" class="nav-tab">All Parameters</a>
				<a href="#developer" class="nav-tab">Developer</a>
				<?php
				if (isset($R34ICSPro)) {
					?>
					<a href="#pro" class="nav-tab">Pro</a>
					<?php
				}
				?>
			</h2><br />
			
			<div class="postbox" id="overview">

				<h3 class="hndle"><span>Basic Shortcode Example</span></h3>
		
				<div class="inside">
	
					<p>To insert an ICS calendar in a page, use the following shortcode format, replacing the all-caps text with your information as appropriate.</p>
	
					<p><input type="text" name="null" readonly="readonly" value="[ics_calendar url=&quot;CALENDAR_FEED_URL&quot; title=&quot;DISPLAY_TITLE&quot; description=&quot;DISPLAY_DESCRIPTION&quot;]" style="width: 97%; background: white;" onclick="this.select();" /></p>
		
					<h4>Calendar Feed URL</h4>
					<p>Be sure you are using a <strong>subscribe</strong> URL (which may end in <code>.ics</code> or have no filename extension), not a web calendar URL (ending in <code>.html</code>).</p>
					
					<h4>Multiple Feeds in One Calendar</h4>
					<p>This plugin supports multiple feeds in a single calendar display. Enter multiple URLs in the <code>url</code> parameter, separated by one space, or by the pipe character <code>|</code>. Do not include other delimiter characters, as they will be interpreted as part of the URL. (We are using the space as a delimiter since properly formed URLs cannot contain spaces, but this has been known in rare cases to cause conflicts with some other third-party plugins.)</p>
		
					<h4>Display Title and Description</h4>
					<p>The <code>title</code> and <code>description</code> parameters are optional. If omitted, the title and description provided by the calendar feed will be displayed. Use "false" (e.g. <code>title="false"</code>) to hide the title or description altogether.</p>
		
					<p><small><em><strong>Deprecation notice:</strong> For backwards compatibility with earlier versions, title and description also support <code>"none"</code> as a value for hiding the default title and description. This support may be removed in a future version.</em></small></p>
				
				</div>
					
				<h3 class="hndle"><span>General Notes</span></h3>
		
				<div class="inside">
					
					<h4>Shortcode Formatting</h4>
					<p>WordPress likes to convert "straight quotes" into &ldquo;smart quotes,&rdquo; which can cause problems with parsing shortcodes. Be sure that you are only using straight quotes in your shortcode. You can also <em>omit the quotes entirely</em> in most cases — parameters in the shortcode only need to be wrapped in quotes if they contain a space, such as if you're including multiple URLs in your <code>url</code> parameter.
					
					<h4>WordPress General Settings</h4>
					<p>Whenever possible, the plugin relies on your site's <a href="options-general.php">general settings</a> to determine display parameters. Specifically: <strong>Site Language, Date Format, Time Format</strong> and <strong>Week Starts On.</strong> If any of these elements of the calendar are not displaying to your liking, please check these settings before trying anything else.</p>

				</div>
	
			</div>

			<div class="postbox hidden" id="view-layout-options">

				<h3 class="hndle"><span>View/Layout Options</span></h3>
		
				<div class="inside">
	
					<h4>Month View</h4>
					<p>The default display is a month calendar grid. The month grid collapses to a CSS-styled list at phone screen sizes. You can use this view by setting <code>view="month"</code> or omitting this parameter entirely.</p>
					
					<p>By default the grid's column labels will be the full names of the days of the week. For tighter layouts you can add <code>columnlabels="short"</code> to use 3-letter abbreviations, or <code>columnlabels="min"</code> to use 1- or 2-letter abbreviations. (The full day names and abbreviations are in the plugin's translation files for all supported languages.)</p>

					<h4>Week View</h4>
					<p>You can display just the <strong>current</strong> week (with a selector to choose the previous and next week) in a grid style similar to month view by using <code>view="week"</code>. If desired, the selector can be hidden using custom CSS.</p>
					
					<p>You can also display a <strong>fixed</strong> "week" (i.e. a short range of days) by adding <code>startdate="YYYYMMDD"</code> and setting <code>limitdays="n"</code> where <em>n</em> is the number of days. Use <code>startdate="today"</code> to always start from the current date. (Maximum supported number of days in this view is 7.)</p>
					
					<p><small><em><strong>Deprecation notice:</strong> For backwards compatibility with earlier versions, <code>view="currentweek"</code> is also supported and works interchangeably. This support may be removed in a future version.</em></small></p>
	
					<h4>List View</h4>
					<p>To display upcoming events as a plain list on all screen sizes (which you can style with your own CSS), add <code>view="list"</code> to the shortcode, with the optional <code>count="5"</code> parameter to indicate the number of events to display. (By default, <em>all</em> upcoming events will be displayed.)</p>
	
					<p>By default list view will display dates in the U.S. standard day-month-date format (e.g. "Thursday March 14"). To customize the format to your locale, you can use standard <a href="https://secure.php.net/manual/en/function.date.php" target="_blank">PHP date format strings</a> with the <code>format</code> parameter. For example, to use the day-month format (e.g. "14 March"), use <code>format="j F"</code>, or for an abbreviated numbered month/day format (e.g. "Thu 3/14"), use <code>format="D n/j"</code>.</p>
						
					<p><small><em><strong>Note:</strong> The <code>count</code> parameter are supported in <strong>list</strong> view only. The <code>format</code> parameter is supported in <strong>list</strong> view, and on the mobile breakpoint only for <strong>week</strong> and <strong>month</strong> views. The <code>startdate</code> parameter is supported in <strong>week</strong> view only.</em></small></p>
		
				</div>
	
			</div>

			<div class="postbox hidden" id="event-display-options">

				<h3 class="hndle"><span>Display Options</span></h3>
		
				<div class="inside">
	
					<h4>Event Attachments</h4>
					<p>Use the <code>attach="true"</code> parameter to display attachments with events. Attachments that are browser-friendly images (e.g. JPEG or PNG) will display directly on the page along with the event's description. Other attachments will display as a clickable download link. <strong>Note for Google Calendar users:</strong> Google Calendar handles all attachments as links to a Google Drive page, not direct file links, so images are treated as downloads. We hope to resolve this issue in a future update.</p>
					
					<h4>Event Descriptions</h4>
					<p>Use the <code>eventdesc="true"</code> parameter to display event descriptions. Note: In the month view, descriptions will display on hover; in the list view, descriptions will display in full on the page below the event title (and location/organizer, if shown). In the list view, you can choose to display an excerpt of the description by entering the number of words to show, e.g. <code>eventdesc="12"</code>. Clicking the excerpt will reveal the full description. Other views always shows the full description.</p>
					
					<h4>Event Locations</h4>
					<p>Use the <code>location="true"</code> parameter to display event locations (if available). Note: In the month view, locations will display on hover; in the list view, locations will display in full on the page below the event title.</p>
					
					<h4>Event Organizers</h4>
					<p>Use the <code>organizer="true"</code> parameter to display event organizer (if available). Note: In the month view, organizers will display on hover; in the list view, locations will display in full on the page below the event title (and location, if shown).</p>
					
					<h4>Event URLs (Links)</h4>
					<p>If the event data contains a URL, the URL can be added to the display as a clickable link in one of two ways. Use the <code>linktitles="true"</code> parameter to make the <em>event title</em> into a clickable link to that URL. If <code>linktitles</code> is <em>not</em> used, and <code>eventdesc="true"</code> is used, then the URL will be displayed as a clickable link after the event description. These links will always open in a new tab/window. If you do <em>not</em> wish to have event URL links appear <em>at all,</em> use <code>nolink="true"</code>.</p>
					
					<h4>Feed Color Coding</h4>
					<p>You can apply a color to events in your feed by using the <code>color</code> parameter. This is especially helpful if you have multiple feeds and you want to use color coding to distinguish the feeds within your calendar. Add hex color values to this parameter and they will be applied to your feeds in the same order as the feeds are entered in the <code>url</code> parameter. For example, if you have three feeds and you want to color them purple, green and orange, you could use <code>color="#800080 #008000 #ffa500"</code>. The base color will be used as a left border on each event, and a lighter tint of that color will be used as the background on the events. Use a tool like the <a href="https://www.w3schools.com/colors/colors_picker.asp" target="_blank">HTML Color Picker</a> to select hex values, if necessary. (Note: the <code>color</code> parameter supports either space- or pipe-delimited lists.)</p>

					<h4>Feed Color Coding Legend</h4>
					<p>The <code>legendposition</code> and <code>legendstyle</code> parameters control the placement and display format of the legend. Use <code>legendposition</code> to determine where to display the legend relative to the calendar. Valid values are <code>"above"</code> and <code>"below"</code>. If omitted or an invalid value, will default to above. Use <code>legendstyle</code> to determine how to display the legend. Valid values are <code>"block"</code>, <code>"inline"</code> and <code>"none"</code>. If omitted or an invalid value, will default to block.</p>
					
					<h4>Feed Labels</h4>
					<p>By default, each calendar in the color key will be labeled using the title provided in that calendar's feed. You can override the titles by using <code>feedlabel</code>. Note that because feed labels may need to contain spaces, the values for this parameter are <em>pipe-delimited</em> <code>|</code> rather than space-delimited. You can provide custom labels for some feeds and use the default titles as labels for others. For example, if you had three feeds and wanted to keep the default title for the second one, you could use <code>feedlabel="Calendar Label 1||Calendar Label 3"</code>. (Note two pipes together; this is leaving the second delimited value empty.)</p>

					<h4>Mask Event Details</h4>
					<p>In some cases, such as for vacation rental availability, you may <em>not</em> want to show any event details, but simply block out days and times. Use <code>maskinfo="MASK"</code>, replacing <code>MASK</code> with the text you wish to display in place of the event title. Event details, location and organizer will also be hidden automatically, regardless of any other settings.</p>
					
					<h4>Month Navigation Options</h4>
					<p>By default, the month view shows a dropdown (select) menu to navigate available months. Add <code>monthnav</code> with a value of <code>select</code>, <code>arrows</code>, <code>both</code> or <code>compact</code> (both, inline without header) to change how this is displayed. <em>Applies to month view only.</em></p>
					
					<h4>Month/Year Format</h4>
					<p>Headers and dropdowns that display a month and year (e.g. "March 2020") can be customized using <code>formatmonthyear="F Y"</code>, replacing <code>F Y</code> with a <a href="https://secure.php.net/manual/en/function.date.php" target="_blank">PHP date format string</a> of your choice. <strong>Note:</strong> This option <strong>only</strong> supports month and year characters (<em>F, m, M, n, Y, y</em>), plus spaces, hyphens, periods and slashes. All other formatting characters will be stripped from the output.</p>
					
					<h4>Time Display</h4>
					<p>By default, start times are always displayed, and end times are displayed on hover. To hide all times (for instance, if the times are also in your event description), add the <code>hidetimes="true"</code> parameter. Conversely, to <em>always</em> display end times (not just on hover), add the <code>showendtimes="true"</code> parameter.</p>
		
				</div>
	
			</div>
		
			<div class="postbox hidden" id="advanced-options">

				<h3 class="hndle"><span>Advanced Options</span></h3>
		
				<div class="inside">
				
					<h4>Custom Options</h4>
					<p>If you are writing your own custom code to extend the plugin's functionality, use <code>customoptions</code> to create your own configuration options for the shortcode. The value passed in this attribute is automatically converted into an array using the pipe character <code>|</code> as a delimiter. (Note that if no pipes are present in the value, it will still be converted into an array with one node.)
				
					<h4>Debugging</h4>
					<p>By default the plugin uses WordPress transients to cache parsed calendar data for 10 minutes. This improves performance and avoids exceeding request limits that may be set on your calendar server. To <em>temporarily</em> bypass this caching while testing configuration changes, use <code>reload="true"</code>. <em>Please note: you should <strong>only</strong> use this feature when you need to force a reload for testing purposes. Do not leave this setting on permanently, especially if your site receives a large amount of traffic.</em>
					
					<p>Use <code>debug="true"</code> to turn on the debugger. Only Administrator-level users will see debugging code. When turned on, a panel will appear at the bottom of the screen with a raw dump of the ICS data array, and possibly additional debugging information.</p>
		
					<h4>Hide "All Day" Indicator</h4>
					<p>By default, an "ALL DAY" label appears above all-day events in the display. You can set <code>hidealldayindicator="true"</code> to prevent displaying this label.
	
					<h4>Limit Days</h4>
					<p>By default, the plugin limits the displayed date range to the farthest future event in your feed. Use <code>limitdays="NUMBER"</code> to override the default limit. Replace <code>NUMBER</code> with your desired number of days. Note: If your calendar has a very large number of events, setting this value above 365 may affect performance.</p>
	
					<h4>"No Mobile"</h4>
					<p>The standard treatment for month and week views on mobile is to stack the display in a list style, because the grid does not work well scaled to the small size of a mobile display. However, if you wish to retain the grid, add <code>nomobile="true"</code> to your shortcode. Note that you will <em>probably</em> need to add your own custom CSS to make this display usable. Be sure to wrap your CSS in <code>@media screen and (max-width: 782px) { }</code> and use <code>.ics-calendar.nomobile .ics-calendar-month-grid</code> in your CSS selectors.</p>
					
					<h4>Past Days</h4>
					<p>By default, list and month views do not include past dates (before the first of the current month, in month view) unless <code>startdate</code> is used to set an arbitrary start date. You can also set a <em>rolling</em> start by using <code>pastdays="NUMBER"</code> where <code>NUMBER</code> is replaced with the number of days back you wish to begin. For instance, to show 3 previous months you could enter <code>pastdays="90"</code>. This option has no effect in week view. <strong>Note:</strong> You may need to make adjustments to the `limitdays` option when this is used, as it calculates from the first displayed date, not the current date.</p>
					
					<h4>Recurrence</h4>
					<p>By default, the plugin will show all instances of recurring events that fall within the displayed date range of your calendar. Add the <code>skiprecurrence="true"</code> parameter to skip parsing recurring events. Use of this setting is discouraged in most cases, as it will prevent recurring events from displaying; however it may be useful for improved performance with extremely large calendars, if recurrences are not needed.</p>
					
					<h4>Timezone Override (new in version 6)</h4>
					<p>Version 6 introduces a new way of parsing date/time values from the feed that allows for timezone overrides. By default, the feed will display events with times adjusted for the local timezone configured under <strong>Settings &gt; General &gt; Timezone</strong>. You can override the site's timezone for individual feeds by adding the <code>tz="TIMEZONE"</code> parameter. You <em>must</em> use a valid <a href="https://www.php.net/manual/en/timezones.php" target="_blank">named timezone</a> value or the setting will be ignored and the site's local timezone setting will be used. If your calendar is displaying multiple feeds, you can assign each a separate timezone override, as with feed labels or colors, by entering multiple values, pipe-delimited, in the same order as the feeds in the <code>url</code> parameter, e.g. <code>tz="America/New_York|Europe/London|Pacific/Auckland"</code>. If you have multiple feeds but all are in the same timezone, you only need to enter the timezone once.</p>
					
				</div>
	
			</div>
		
			<div class="postbox hidden" id="all-parameters">

				<h3 class="hndle"><span>All Parameters</span></h3>
		
				<div class="inside">
				
					<h4><code>attach</code></h4>
					<p>Use the <code>attach="true"</code> parameter to display attachments with events. Attachments that are browser-friendly images (e.g. JPEG or PNG) will display directly on the page along with the event's description. Other attachments will display as a clickable download link. <strong>Note for Google Calendar users:</strong> Google Calendar handles all attachments as links to a Google Drive page, not direct file links, so images are treated as downloads. We hope to resolve this issue in a future update.</p>
	
					<h4><code>color</code></h4>
					<p>You can apply a color to events in your feed by using the <code>color</code> parameter. This is especially helpful if you have multiple feeds and you want to use color coding to distinguish the feeds within your calendar. Add hex color values to this parameter and they will be applied to your feeds in the same order as the feeds are entered in the <code>url</code> parameter. For example, if you have three feeds and you want to color them purple, green and orange, you could use <code>color="#800080 #008000 #ffa500"</code>. The base color will be used as a left border on each event, and a lighter tint of that color will be used as the background on the events. Use a tool like the <a href="https://www.w3schools.com/colors/colors_picker.asp" target="_blank">HTML Color Picker</a> to select hex values, if necessary. (Note: the <code>color</code> parameter supports either space- or pipe-delimited lists.)</p>

					<h4><code>columnlabels</code></h4>
					<p>By default the grid's column labels will be the full names of the days of the week. For tighter layouts you can add <code>columnlabels="short"</code> to use 3-letter abbreviations, or <code>columnlabels="min"</code> to use 1- or 2-letter abbreviations. (The full day names and abbreviations are in the plugin's translation files for all supported languages.) Applies to month and week views only.</p>

					<h4><code>count</code></h4>
					<p>Number of events to display, e.g. <code>count="5"</code>. By default, <em>all</em> upcoming events will be displayed. Applies in list view only.</p>
					
					<h4><code>customoptions</code></h4>
					<p>If you are writing your own custom code to extend the plugin's functionality, use <code>customoptions</code> to create your own configuration options for the shortcode. The value passed in this attribute is automatically converted into an array using the pipe character <code>|</code> as a delimiter. (Note that if no pipes are present in the value, it will still be converted into an array with one node.)

					<h4><code>debug</code></h4>					
					<p>Use <code>debug="true"</code> to turn on the debugger. Extended debugging output is available by setting <code>debug="2"</code>. Only Administrator-level users will see debugging code. When turned on, a panel will appear at the bottom of the screen with a raw dump of the ICS data array, and possibly additional debugging information. When debugging you may also want to set <code>reload="true"</code> to reload the feed on each page load.</p>

					<h4><code>description</code></h4>
					<p>Text string to display as a general description of the calendar. Displays above the calendar, just below <code>title</code>. If omitted, the feed's description will display (if any). Use <code>"false"</code> to display no description.</p>

					<h4><code>eventdesc</code></h4>
					<p>Use the <code>eventdesc="true"</code> parameter to display event descriptions. Note: In the month view, descriptions will display on hover; in the list view, descriptions will display in full on the page below the event title (and location/organizer, if shown). In the list view, you can choose to display an excerpt of the description by entering the number of words to show, e.g. <code>eventdesc="12"</code>. Hovering over the shortened description will show the full description in a tooltip. Month view always shows the full description.</p>

					<h4><code>feedlabel</code></h4>
					<p>By default, each calendar in the color key will be labeled using the title provided in that calendar's feed. You can override the titles by using <code>feedlabel</code>. Note that because feed labels may need to contain spaces, the values for this parameter are <em>pipe-delimited</em> <code>|</code> rather than space-delimited. You can provide custom labels for some feeds and use the default titles as labels for others. For example, if you had three feeds and wanted to keep the default title for the second one, you could use <code>feedlabel="Calendar Label 1||Calendar Label 3"</code>. (Note two pipes together; this is leaving the second delimited value empty.)</p>
					
					<h4><code>format</code></h4>
					<p>By default list view will display dates in the U.S. standard day-month-date format (e.g. "Thursday March 14"). To customize the format to your locale, you can use standard <a href="https://secure.php.net/manual/en/function.date.php" target="_blank">PHP date format strings</a> with the <code>format</code> parameter. For example, to use the day-month format (e.g. "14 March"), use <code>format="j F"</code>, or for an abbreviated numbered month/day format (e.g. "Thu 3/14"), use <code>format="D n/j"</code>.</p>
					
					<h4><code>formatmonthyear</code></h4>
					<p>In places where the month and year are displayed without the day number (e.g. headers and month selection dropdown menu in month view), the default format is <code>F Y</code> (e.g. "March 2020"). Use the <code>formatmonthyear</code> parameter with <a href="https://secure.php.net/manual/en/function.date.php" target="_blank">PHP date format strings</a> to customize the display. <strong>Note:</strong> This option <strong>only</strong> supports month and year characters (<em>F, m, M, n, Y, y</em>), plus spaces, hyphens, periods and slashes. All other formatting characters will be stripped from the output.</p>
					
					<h4><code>hidealldayindicator</code></h4>
					<p>Hides the "ALL DAY" label that appears above all-day events.</p>

					<h4><code>hidetimes</code></h4>
					<p>By default, start times are always displayed, and end times are displayed on hover. To hide all times (for instance, if the times are also in your event description), add the <code>hidetimes="true"</code> parameter.</p>

					<h4><code>legendinline</code></h4>
					<p><strong>Deprecated.</strong> Use <code>legendstyle="inline"</code> instead.</p>

					<h4><code>legendposition</code></h4>
					<p>Determines where to display the legend relative to the calendar. Valid values are <code>"above"</code> and <code>"below"</code>. If omitted or an invalid value, will default to above.</p>

					<h4><code>legendstyle</code></h4>
					<p>Determines how to display the legend. Valid values are <code>"block"</code>, <code>"inline"</code> and <code>"none"</code>. If omitted or an invalid value, will default to block.</p>

					<h4><code>limitdays</code></h4>
					<p>By default, the plugin limits the displayed date range to the farthest future event in your feed. Use <code>limitdays="NUMBER"</code> to override the default limit. Replace <code>NUMBER</code> with your desired number of days. Note: If your calendar has a very large number of events, setting this value above 365 may affect performance.</p>

					<h4><code>linktitles</code></h4>
					<p>If the event data contains a URL, the URL can be added to the display as a clickable link in one of two ways. Use the <code>linktitles="true"</code> parameter to make the <em>event title</em> into a clickable link to that URL. If <code>linktitles</code> is <em>not</em> used, and <code>eventdesc="true"</code> is used, then the URL will be displayed as a clickable link after the event description. These links will always open in a new tab/window. If you do <em>not</em> wish to have event URL links appear <em>at all,</em> use <code>nolink="true"</code>.</p>

					<h4><code>location</code></h4>
					<p>Use the <code>location="true"</code> parameter to display event locations (if available). Note: In the month view, locations will display on hover; in the list view, locations will display in full on the page below the event title.</p>

					<h4><code>maskinfo</code></h4>
					<p>In some cases, such as for vacation rental availability, you may <em>not</em> want to show any event details, but simply block out days and times. Use <code>maskinfo="MASK"</code>, replacing <code>MASK</code> with the text you wish to display in place of the event title. Event details, location and organizer will also be hidden automatically, regardless of any other settings.</p>
					
					<h4><code>monthnav</code></h4>
					<p>By default, the month view shows a dropdown (select) menu to navigate available months. Add <code>monthnav</code> with a value of <code>select</code>, <code>arrows</code>, <code>both</code> or <code>compact</code> (both, inline without header) to change how this is displayed. <em>Applies to month view only.</em></p>

					<h4><code>nolink</code></h4>
					<p>Suppresses display of event links. Useful if your calendar feed automatically inserts a default link on all events that you do not wish to display along with the event description.</p>

					<h4><code>nomobile</code></h4>
					<p>The standard treatment for month and week views on mobile is to stack the display in a list style, because the grid does not work well scaled to the small size of a mobile display. However, if you wish to retain the grid, add <code>nomobile="true"</code> to your shortcode. Note that you will <em>probably</em> need to add your own custom CSS to make this display usable. Be sure to wrap your CSS in <code>@media screen and (max-width: 782px) { }</code> and use <code>.ics-calendar.nomobile .ics-calendar-month-grid</code> in your CSS selectors.</p>

					<h4><code>organizer</code></h4>
					<p>Use the <code>organizer="true"</code> parameter to display event organizer (if available). Note: In the month view, organizers will display on hover; in the list view, locations will display in full on the page below the event title (and location, if shown).</p>
					
					<h4><code>pastdays</code></h4>
					<p>By default, list and month views do not include past dates (before the first of the current month, in month view) unless <code>startdate</code> is used to set an arbitrary start date. You can also set a <em>rolling</em> start by using <code>pastdays="NUMBER"</code> where <code>NUMBER</code> is replaced with the number of days back you wish to begin. For instance, to show 3 previous months you could enter <code>pastdays="90"</code>. This option has no effect in week view. <strong>Note:</strong> You may need to make adjustments to the `limitdays` option when this is used, as it calculates from the first displayed date, not the current date.</p>

					<h4><code>reload</code></h4>
					<p>By default the plugin uses WordPress transients to cache parsed calendar data for 10 minutes. This improves performance and avoids exceeding request limits that may be set on your calendar server. To <em>temporarily</em> bypass this caching while testing configuration changes, use <code>reload="true"</code>. <em>Please note: you should <strong>only</strong> use this feature when you need to force a reload for testing purposes. Do not leave this setting on permanently, especially if your site receives a large amount of traffic.</em>

					<h4><code>showendtimes</code></h4>
					<p>By default, start times are always displayed, and end times are displayed on hover. To <em>always</em> display end times (not just on hover), add the <code>showendtimes="true"</code> parameter.</p>

					<h4><code>skip</code></h4>
					<p>Add the <code>skip="NUMBER"</code> parameter in conjunction with the <code>count</code> parameter in list view to split a calendar across multiple shortcodes within a page (e.g. a multi-column layout). This <code>NUMBER</code> of events will be skipped in display. Should match the sum of the <code>count</code> value(s) from previous shortcode(s) on the page for the same feed.</p>

					<h4><code>skiprecurrence</code></h4>
					<p>Add the <code>skiprecurrence="true"</code> parameter to skip parsing recurring events. Use of this setting is discouraged in most cases, as it will prevent recurring events from displaying; however it may be useful for improved performance with extremely large calendars, if recurrences are not needed.</p>

					<h4><code>startdate</code></h4>
					<p>By default, the calendar display will start from the current date. To have the calendar start from an arbitrary date (either in the future or the past), use this parameter with the date in an 8-digit <code>"YYYYMMDD"</code> format.</p>

					<h4><code>title</code></h4>
					<p>The <code>title</code> parameter is optional. If omitted, the title provided by the calendar feed will be displayed. Use "false" (e.g. <code>title="false"</code>) to hide the title altogether.</p>

					<h4><code>toggle</code></h4>
					<p>If your event descriptions are long, you may wish to use <code>toggle="true"</code> to turn on click-to-toggle for descriptions. Users can click an event's title to view its description.  Applies in list view only. <strong>Deprecated:</strong> Use <code>eventdesc="NUMBER"</code> instead to show a short description excerpt that will show the full description on click. This feature will be removed in a future update.</p>
					
					<h4><code>tz</code></h4>
					<p>Version 6 introduces a new way of parsing date/time values from the feed that allows for timezone overrides. By default, the feed will display events with times adjusted for the local timezone configured under <strong>Settings &gt; General &gt; Timezone</strong>. You can override the site's timezone for individual feeds by adding the <code>tz="TIMEZONE"</code> parameter. You <em>must</em> use a valid <a href="https://www.php.net/manual/en/timezones.php" target="_blank">named timezone</a> value or the setting will be ignored and the site's local timezone setting will be used. If your calendar is displaying multiple feeds, you can assign each a separate timezone override, as with feed labels or colors, by entering multiple values, pipe-delimited, in the same order as the feeds in the <code>url</code> parameter, e.g. <code>tz="America/New_York|Europe/London|Pacific/Auckland"</code>. If you have multiple feeds but all are in the same timezone, you only need to enter the timezone once.</p>

					<h4><code>url</code></h4>
					<p>The ICS subscription URL for your feed. This must be a <em>subscription</em> URL, not a URL that displays your calendar in a web view. (Loading the URL directly in your browser's address bar should download an <code>.ics</code> file.) Enter multiple URLs, space- or pipe-delimited, to combine multiple feeds into one calendar display.</p>

					<h4><code>view</code></h4>
					<p>Determines which layout to use. View options included in the base plugin are <code>"month"</code>, <code>"week"</code> and <code>"list"</code>. Month view is the default, and this parameter can be omitted entirely. See <a href="#view-layout-options">View/Layout Options</a> for more details about each view. Additional view options are available in the <a href="https://icscalendar.com" target="_blank">Pro</a> version, and a future update will provide support for building your own custom views.</p>
		
				</div>

			</div>
			
			<div class="postbox hidden" id="developer">

				<h3 class="hndle"><span>Developer (Actions and Filters)</span></h3>
		
				<div class="inside">
				
					<p><strong>ICS Calendar</strong> includes a number of hooks that are used by <a href="https://icscalendar.com/pro/" target="_blank">ICS Calendar Pro</a> to extend its functionality. Many of these hooks are still in development and subject to change, but we will document them here as they become available for theme and add-on developers' use.</p>
					
					<h3>r34ics_display_calendar_exclude_event</h3>
					<p>This filter runs on the loop that parses events. Use it to write additional logic to determine whether or not an event should be displayed. Avoid redundant or processor-heavy logic in uses of the filter. (For example, if a query is being run, execute it outside of the filter and pass its results into the filter as global variable.)</p>
					
					<p><em>Input parameters:</em></p>
					
					<p><code>$exclude</code><br />
						Boolean. Indicates whether or not the event should be excluded from display.
					</p>
					
					<p><code>$event</code><br />
						Object. The current event object from the loop. Use this to evaluate details of the event in your logic.
					</p>
					
					<p><code>$args</code><br />
						Array. All attributes passed in the shortcode. Use this to determine the configuration of the shortcode. Include the <code>customoptions</code> attribute in your shortcode to introduce your own non-standard, pipe-delimited configuration options. Note: the plugin converts this attribute's value into an array based on the pipe delimiter.
					</p>
					
					<p><em>Return value:</em><br />
						Boolean. Used to determine whether or not to display the event.
					</p>
					
					<p><em>Example usage:</em></p>
					<div class="code-sample">
add_filter('r34ics_display_calendar_exclude_event', function($exclude, $event, $args) {
	// Add your logic to determine whether or not to exclude this event (set $exclude value)
	return $exclude;
}, 10, 3);
					</div>
					
					<h3>r34ics_display_calendar_filter_ics_data</h3>
					<p>This filter allows you to write your own customized code to manipulate the contents of the fully parsed ICS data array just prior to rendering the calendar output to the browser.</p>
					
					<p><em>Input parameters:</em></p>
					
					<p><code>$ics_data</code><br />
						Array. The full parsed data array. You may wish to turn on the debugger (add <code>debug="1"</code> to your shortcode) to see the structure of the array during development.
					</p>
					
					<p><em>Return value:</em></p>
						Array. Be sure that your manipulations do not modify the overall structure of the array, or the calendar will not display properly.
					</p>
					
					<p><em>Example usage:</em></p>
					<div class="code-sample">
add_filter('r34ics_display_calendar_filter_ics_data', function($ics_data) {
	// Add your logic to manipulate the data array
	return $ics_data;
}, 10, 1);
					</div>
				
				</div>
			</div>
	
			<?php
			if (isset($R34ICSPro)) {
				include_once($R34ICSPro->admin_user_guide_path);
			}
			?>

		</div>
	
		<div class="column-2">

			<?php
			if (isset($R34ICSPro)) {
				include_once($R34ICSPro->admin_sidebar_path);
			}
			else {
				include_once(plugin_dir_path(__FILE__) . 'sidebar.php');
			}
			?>
	
		</div>
	
	</div>

</div>
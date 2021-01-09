<div id="insert_r34ics">
	<div id="insert_r34ics_overlay"></div>
	<div id="insert_r34ics_window">

			<div id="insert_r34ics_header">
				<strong>Add ICS Calendar</strong>
				<div id="insert_r34ics_close" title="Close">&times;</div>
			</div>

			<div id="insert_r34ics_content">
				<form action="#" method="get" id="insert_r34ics_form">
				
					<?php do_action('r34ics_admin_add_calendar_settings_html'); ?>
					
					<p class="field-block">
						<label for="insert_r34ics_url">ICS Subscribe URL:</label><br />
						<input id="insert_r34ics_url" name="insert_r34ics_url" type="text" style="width: 100%;" /><br />
						<em><small>Be sure you are using a <strong>subscribe</strong> URL, not a <strong>web view</strong> URL.<br />
						(Entering the URL directly in your web browser should download an <code>.ics</code> file.)</small></em>
					</p>
					
					<p class="field-block">
						<label for="insert_r34ics_title">Calendar Title:</label><br />
						<input id="insert_r34ics_title" name="insert_r34ics_title" type="text" style="width: 100%;" /><br />
						<em><small>Leave empty to use calendar's default title. Enter <code>none</code> to omit title altogether.</small></em>
					</p>
					
					<p class="field-block">
						<label for="insert_r34ics_description">Calendar Description:</label><br />
						<input id="insert_r34ics_description" name="insert_r34ics_description" type="text" style="width: 100%;" /><br />
						<em><small>Leave empty to use calendar's default description. Enter <code>none</code> to omit description altogether.</small></em>
					</p>
					
					<p class="field-block">
						<label for="insert_r34ics_view">View:</label><br />
						<select id="insert_r34ics_view" name="insert_r34ics_view" onchange="if (jQuery(this).val() == 'list') { jQuery('#r34ics_list_view_options').show(); } else { jQuery('#r34ics_list_view_options').hide(); }">
							<option value="month">month</option>
							<option value="list">list</option>
							<option value="week">week</option>
							<option value="">custom</option>
						</select><br />
						<em><small>For <strong>custom</strong> views, enter the view name manually after inserting the shortcode in your content.</small></em>
					</p>
					
					<p class="field-block" id="r34ics_list_view_options" style="display: none;">
						<label for="insert_r34ics_count">Count:</label>
						<input id="insert_r34ics_count" name="insert_r34ics_count" type="number" min="1" step="1" />
						&nbsp;&nbsp;
						<label for="insert_r34ics_format">Format:</label>
						<input id="insert_r34ics_format" name="insert_r34ics_format" type="text" value="l, F j" /><br />
						<em><small>Leave <strong>Count</strong> blank to include all upcoming events. <strong>Format</strong> must be a standard <a href="https://secure.php.net/manual/en/function.date.php" target="_blank">PHP date format string</a>.</small></em>
					</p>
					
					<p class="field-block">
						<input id="insert_r34ics_eventdesc" name="insert_r34ics_eventdesc" type="checkbox" onchange="if (this.checked) { jQuery('#insert_r34ics_toggle_wrapper').show(); } else if (!this.checked && !jQuery('#insert_r34ics_organizer').prop('checked') && !jQuery('#insert_r34ics_location').prop('checked')) { jQuery('#insert_r34ics_toggle_wrapper').hide(); }" />
						<label for="insert_r34ics_eventdesc">Show event descriptions <em><small>(change to a number in inserted shortcode to set word limit)</small></em></label>
					</p>
				
					<p class="field-block">
						<input id="insert_r34ics_location" name="insert_r34ics_location" type="checkbox" onchange="if (this.checked) { jQuery('#insert_r34ics_toggle_wrapper').show(); } else if (!this.checked && !jQuery('#insert_r34ics_organizer').prop('checked') && !jQuery('#insert_r34ics_eventdesc').prop('checked')) { jQuery('#insert_r34ics_toggle_wrapper').hide(); }" />
						<label for="insert_r34ics_location">Show event locations <em><small>(if available)</small></em></label>
					</p>
					
					<p class="field-block">
						<input id="insert_r34ics_organizer" name="insert_r34ics_organizer" type="checkbox" onchange="if (this.checked) { jQuery('#insert_r34ics_toggle_wrapper').show(); } else if (!this.checked && !jQuery('#insert_r34ics_location').prop('checked') && !jQuery('#insert_r34ics_eventdesc').prop('checked')) { jQuery('#insert_r34ics_toggle_wrapper').hide(); }" />
						<label for="insert_r34ics_organizer">Show event organizers <em><small>(if available)</small></em></label>
					</p>
					
					<p class="field-block">
						<small><strong>Note:</strong> Additional <a href="admin.php?page=ics-calendar#event-display-options" target="_blank">display options</a> are available by manually editing the shortcode after insertion.</small>
					</p>
					
					<p style="text-align: right;">
						<input name="insert" type="submit" class="button button-primary button-large" value="Insert ICS Calendar" />
					</p>

				</form>
			</div>

	</div>
</div>

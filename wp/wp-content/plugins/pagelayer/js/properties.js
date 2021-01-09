
// The active pagelayer element
var pagelayer_active = {};

// List of pagelayer icons
var pagelayer_icons = {};

// The inline editor
var pagelayer_editor = {};

// The active pagelayer element
var pagelayer_active_tab = {};

// Loads the Data
function pagelayer_data(jEle, clean){
	
	var ret = new Object();
	
	// Get the data
	ret.tag = pagelayer_tag(jEle);
	ret.id = pagelayer_id(jEle);
	ret.$ = jEle;
	
	var ref_data = pagelayer_el_data_ref(jEle);
	
	// Parse the attributes
	ret.atts = JSON.parse(JSON.stringify(ref_data['attr']));
	ret.tmp = JSON.parse(JSON.stringify(ref_data['tmp']));
	
	//console.log(ret.atts);
	//console.log(ret.tmp);
	
	clean = clean || false;
	
	// Remove values which have 'req'. NOTE : 'show' ones will be allowed
	if(clean){
		
		var tag = ret.tag;
		
		// Anything to set ?
		ret.set = {};
		
		// Function to clear any att data
		var pagelayer_delete_atts = function(x){
			delete ret.atts[x];
			delete ret.atts[x+'_tablet'];// Any tablet and mobile values as well
			delete ret.atts[x+'_mobile'];
			delete ret.set[x];		
		}
		
		// All props
		var all_props = pagelayer_shortcodes[tag];
		
		// Loop through all props
		for(var i in pagelayer_tabs){
			
			var tab = pagelayer_tabs[i];

			for(var section in all_props[tab]){
				
				var props = section in pagelayer_shortcodes[tag] ? pagelayer_shortcodes[tag][section] : pagelayer_styles[section];
				
				// In case of widgets its possible !
				if(pagelayer_empty(props)){
					continue;
				}
				
				for(var x in props){
					
					var prop = props[x];
				
					// Any prop to skip ?
					if(!pagelayer_empty(all_props['skip_props']) && jQuery.inArray(x, all_props['skip_props']) > -1){
						pagelayer_delete_atts(x);
						continue;
					}
					
					// Are we to set this value ?
					if(!(x in ret.atts) && 'default' in prop && !pagelayer_empty(prop['default'])){
				
						// We need to make sure its not a PRO value
						if(!('pro' in prop && pagelayer_empty(pagelayer_pro))){
							
							var tmp_val = prop['default'];
							
							// If there is a unit and there is no unit suffix in atts value
							if('units' in prop){
								if(jQuery.isNumeric(prop['default'])){
									tmp_val = prop['default']+prop['units'][0];
								}else{
									var sep = 'sep' in prop ? prop['sep'] : ',';
									var tmp2 = prop['default'].split(sep);
									for(var k in tmp2){
										if(jQuery.isNumeric(tmp2[k])){
											tmp2[k] = tmp2[k]+prop['units'][0];
										}
									}
									tmp_val = tmp2.join(sep);
								}
							}
							
							//console.log(x+' - '+tmp_val);
							ret.set[x] = tmp_val;
							
						}
					}
					
					if(!('req' in prop)){
						continue;
					}
					
					//console.log('[pagelayer_data] Cleaning :'+x);
					
					// List of considerations
					var show = prop['req'];
					
					// We will hide by default
					var toShow = true;
					
					for(var showParam in show){
						var reqval = show[showParam];
						var except = showParam.substr(0, 1) == '!' ? true : false;
						showParam = except ? showParam.substr(1) : showParam;
						var val = ret.atts[showParam] || '';
						
						//console.log('Show '+x+' '+showParam+' '+reqval+' '+val);
						
						// Is the value not the same, then we can show
						if(except){
							
							if(typeof reqval == 'string' && reqval == val){
								toShow = false;
								break;
							}
							
							// Its an array and a value is found, then dont show
							if(typeof reqval != 'string' && reqval.indexOf(val) > -1){
								toShow = false;
								break;
							}
							
						// The value must be equal
						}else{
							
							 if(typeof reqval == 'string' && reqval != val){
								toShow = false;
								break;
							 }
							
							// Its an array and no value is found, then dont show
							if(typeof reqval != 'string' && reqval.indexOf(val) === -1){
								toShow = false;
								break;
							}
						}
						
					}
					
					// Are we to show ?
					if(!toShow){
						//console.log('Delete : '+x);
						pagelayer_delete_atts(x);
					}
				}
			}
		}
		
	}
	
	return ret;
	
};

// Setup the properties
function pagelayer_elpd_setup(){

	// The Dialag box of the element properties
	// pagelayer-ELPD - Element Properties Dialog
	pagelayer_elpd_html = '<div class="pagelayer-elpd-tabs">'+
			'<div class="pagelayer-elpd-tab" pagelayer-elpd-tab="settings" pagelayer-elpd-active-tab=1>Settings</div>'+
			//'<div class="pagelayer-elpd-tab" pagelayer-elpd-tab="styles">Style</div>'+
			'<div class="pagelayer-elpd-tab" pagelayer-elpd-tab="options">Options</div>'+
			'<div class="pagelayer-elpd-options">'+
				'<i class="pli pli-clone" ></i>'+
				'<i class="pli pli-trashcan" ></i>'+
			'</div>'+
		'</div>'+
		'<div class="pagelayer-elpd-body"></div>'+
		'<div class="pagelayer-elpd-holder"></div>';
	
	// Create the dialog box
	pagelayer.$$('#pagelayer-elpd').append(pagelayer_elpd_html);
	pagelayer_elpd = pagelayer.$$('#pagelayer-elpd');
	
	pagelayer.$$('.pagelayer-elpd-close').on('click', function(){
		pagelayer_leftbar_tab('pagelayer-shortcodes');
		pagelayer.$$('.pagelayer-elpd-header').hide();
		pagelayer.$$('.pagelayer-logo').show();
		pagelayer.$$('.pagelayer-elpd-body').removeAttr('pagelayer-element-id').empty();
		pagelayer_active = {};
	});
	
	// Copy
	pagelayer.$$('.pagelayer-elpd-options>.pli-clone').on('click', function(){
		pagelayer_copy_element(pagelayer_active.el.$);
	});
	
	// Delete
	pagelayer.$$('.pagelayer-elpd-options>.pli-trashcan').on('click', function(){
		pagelayer_delete_element(pagelayer_active.el.$);
		//pagelayer.$$('.pagelayer-elpd-close').click();
	});
	
	// The tabs
	pagelayer_elpd.find('.pagelayer-elpd-tab').on('click', function(){	
		var attr = 'pagelayer-elpd-active-tab';
		pagelayer_elpd.find('.pagelayer-elpd-tab').each(function(){
			jQuery(this).removeAttr(attr);
		});
		jQuery(this).attr(attr, 1);
		
		// Trigger the showing of rows
		pagelayer_elpd_show_rows();
	});
	
};

// Open the properties
function pagelayer_elpd_open(jEle){
	
	// Set pagelayer history FALSE
	pagelayer.history_action = false;
	
	// Set the position of the element and show
	//pagelayer_elpd.css('left', pagelayer_elpd_pos[0]);
	//pagelayer_elpd.css('top', pagelayer_elpd_pos[1]);
	pagelayer_leftbar_tab('pagelayer-elpd');
	pagelayer.$$('[pagelayer-elpd-tab=settings]').show();
	pagelayer.$$('.pagelayer-elpd-header').show();
	pagelayer.$$('.pagelayer-logo').hide();
	
	// The property holder
	var holder = pagelayer.$$('.pagelayer-elpd-body');
	holder.html(' ');
	
	var el = pagelayer_elpd_generate(jEle, holder);
	
	// Set the active element
	pagelayer_active.el = el;
	
	// Set the header
	pagelayer.$$('.pagelayer-elpd-title').html('Edit '+pagelayer_shortcodes[el.tag]['name']);
	
	// Set pagelayer history TRUE
	pagelayer.history_action = true;
	
	// Render tooltips for the ELPD
	pagelayer_tooltip_setup();
	
};

// Show the properties window
function pagelayer_elpd_generate(jEle, holder){
	
	// Get the id, tag, atts, data, etc
	var el = pagelayer_data(jEle);
	//console.log(el);
	
	// Is it a valid type ?
	if(pagelayer_empty(pagelayer_shortcodes[el.tag])){
		pagelayer_error('Could not find this shortcode : '+el.tag);
	}
	
	// Set the holder
	holder.attr('pagelayer-element-id', el.id);
	//console.log(el.id);
	
	var all_props = pagelayer_shortcodes[el.tag];
	
	var sec_open_class = 'pagelayer-elpd-section-open';
	
	for(var i in pagelayer_tabs){
		var tab = pagelayer_tabs[i];
		var section_close = false;// First section always open
		for(var section in all_props[tab]){
			//console.log(tab+' '+section);
	
			var props = section in pagelayer_shortcodes[el.tag] ? pagelayer_shortcodes[el.tag][section] : pagelayer_styles[section];
			//console.log(props);
			
			var sec = jQuery('<div class="pagelayer-elpd-section" section="'+section+'" pagelayer-show-tab="'+tab+'">'+
					'<div class="pagelayer-elpd-section-name '+sec_open_class+'"><i class="pli"></i>'+all_props[tab][section]+'</div>'+
					'<div class="pagelayer-elpd-section-rows"></div>'+
					'</div>');
			holder.append(sec);
			
			// The row holder
			sec = sec.find('.pagelayer-elpd-section-rows');
			
			// Close all except the first section
			if(section_close){
				sec.hide().prev().removeClass(sec_open_class);
			}
			section_close = true;
			
			if('widget' in all_props && section == 'params'){
				pagelayer_elpd_widget_settings(el, sec, true);
				continue;
			}
			
			var mode = pagelayer_get_screen_mode();
	
			// Reset / Create the cache
			for(var x in props){
				
				props[x]['c'] = new Object();
				props[x]['c']['val'] = '';// Blank Val		
				props[x]['c']['name'] = x;// Add the Name of the row i.e. attribute of the element
				var prop_name = x;
				
				// Do we have screen ?
				if('screen' in props[x] && mode != 'desktop'){
					prop_name = x +'_'+mode;
				}
				
				// Set default to value of attribute if any
				if(prop_name in el.atts){
					props[x]['c']['val'] = el.atts[prop_name];
				}
				
				// Set element
				props[x]['el'] = el;
				
				// Any prop to skip ?
				if(!pagelayer_empty(all_props['skip_props']) && jQuery.inArray(x, all_props['skip_props']) > -1){
					continue;
				}
		
				// Add the row
				pagelayer_elpd_row(sec, tab, section, props, x);
				
			}
			
			// Hide empty sections
			if(sec.html().length < 1){
				//console.log(section+' - '+sec.html().length);
				sec.parent().remove();
			}
		}
	}
	
	/*// Set the default values in the PROPERTIES
	var fn_load = window['pagelayer_load_elp_'+el.tag];
	
	if(typeof fn_load == 'function'){
		fn_load(el, props);
	}*/
	
	// Hide clone and delete options
	if(!pagelayer_empty(all_props['hide_active'])){
		pagelayer.$$('.pagelayer-elpd-options').addClass('pagelayer-hidden');
	}else{
		pagelayer.$$('.pagelayer-elpd-options').removeClass('pagelayer-hidden');
	}
	
	// Section open close
	holder.find('>.pagelayer-elpd-section>.pagelayer-elpd-section-name').on('click', function(){
		var _sec = jQuery(this);
		var par = _sec.parent();
		
		pagelayer_active_tab.id = el.id;
		pagelayer_active_tab.section = par.attr('section');
		
		// Get the active tab
		var active_tab = pagelayer_elpd.find('[pagelayer-elpd-active-tab]').attr('pagelayer-elpd-tab');
		
		// Close all but dont touch yourself
		holder.children().each(function (){
			var curSec = jQuery(this);
			if(par.is(curSec)) return;// Skip the current option
			if(curSec.attr('pagelayer-show-tab') != active_tab) return;// Skip the non active tabs as is
			curSec.find('.pagelayer-elpd-section-rows').hide().prev().removeClass(sec_open_class);
		});
		
		// Now toggle your self
		par.find('.pagelayer-elpd-section-rows').toggle();
		
		if(_sec.next().is(':visible')){
			_sec.addClass(sec_open_class);
		}else{
			_sec.removeClass(sec_open_class);
		}
		
	});
	
	if(!pagelayer_empty(pagelayer_active_tab) && pagelayer_active_tab.id == el.id){
		holder.find('>[section='+pagelayer_active_tab.section+']>.pagelayer-elpd-section-name').click();
	}
	
	// Handle the showing of rows
	pagelayer_elpd_show_rows();
	
	return el;
	
};

// Show a row
function pagelayer_elpd_row(holder, tab, section, props, name){

	// The Prop
	var prop = props[name];
	//console.log(tab+' '+name+' '+prop.el.tag);
	
	var fn = window['pagelayer_elp_'+prop['type']];
	
	if(typeof fn == 'function'){
		
		var row = jQuery('<div class="pagelayer-form-item" pagelayer-elp-name="'+name+'" />');
		
		// Append the row
		holder.append(row);
		
		if('group' in prop){
			row.attr('pagelayer-access-item', prop.group);
		}
		
		var fn_ui = window['pagelayer_elp_'+prop['type']+'_ui'];
		
		// Is there a UI Handler ?
		if(typeof fn_ui == 'function'){
			
			fn_ui(row, prop);
			
		// Use the default mechanism
		}else{
				
			// The label
			pagelayer_elp_label(row, prop);
			
			// The main property
			fn(row, prop);
			
			// Is there a description ?
			if(!pagelayer_empty(prop['desc'])){
				pagelayer_elp_desc(row, prop['desc']);
			}
			
		}
		
		return row;
		
	}
	
};

// Show the rows as per the active tab and also handle the rows that are supposed to be shown or not
function pagelayer_elpd_show_rows(){
	
	//console.log('Called');
	
	// Get the active tab
	var active_tab = pagelayer_elpd.find('[pagelayer-elpd-active-tab]').attr('pagelayer-elpd-tab');
	
	pagelayer_elpd.find('[pagelayer-show-tab]').each(function(){
		var sec = jQuery(this);
		
		// Is it the active tab ? 
		if(sec.attr('pagelayer-show-tab') != active_tab){
			sec.hide();
		}else{
			sec.show();
		}
	});
	
	// Find all Elements in the Property dialog and loop
	pagelayer_elpd.find('[pagelayer-element-id]').each(function(){
		
		var holder = jQuery(this);
		var id = holder.attr('pagelayer-element-id');
		var jEle = pagelayer_ele_by_id(id);
		var tag = pagelayer_tag(jEle);
		//console.log('Main : '+id+' - '+tag);
		//console.log(pagelayer_active);
		
		// All props
		var all_props = pagelayer_shortcodes[tag];
		
		// Loop through all props
		for(var i in pagelayer_tabs){
			
			var tab = pagelayer_tabs[i];

			for(var section in all_props[tab]){
				
				var props = section in pagelayer_shortcodes[tag] ? pagelayer_shortcodes[tag][section] : pagelayer_styles[section];
				
				for(var x in props){
					
					var prop = props[x];
					
					// If the prop is a group, we continue
					if(prop['type'] == 'group'){
						continue;
					}
					
					// Find the row
					var row = false;
					
					holder.find('[pagelayer-elp-name='+x+']').each(function(){
						var j = jQuery(this);
						var _id = j.closest('[pagelayer-element-id]').attr('pagelayer-element-id');
						//console.log(_id+' = '+id);
						
						// Is the parent the same ?
						if(_id == id){
							row = j;
						}
					});
					
					// Do you have a show or hide ?
					if(!row){
						//console.log('Not Found : '+x+' - '+id);
						continue;
					}
					
					// Is the row visible ?
					if(row.closest('[pagelayer-show-tab]').attr('pagelayer-show-tab') != active_tab){
						row.hide();
						continue;
					}
					
					// Now lets show or hide the element
					if(!('req' in prop || 'show' in prop)){
						row.show();
						continue;
					}
					
					// List of considerations
					var show = {};
					
					// We have both req and show, so lets just combine the values and then show
					// NOTE : We need to make an array and not just merge the 2 as they are references
					if('req' in prop && 'show' in prop){
						
						// Add the req values
						show = JSON.parse(JSON.stringify(prop['req']));
						
						// Now the show values need to be looped
						for(var t in prop['show']){
							show[t] = prop['show'][t];
						}
						
					}else{
						show = 'req' in prop ? prop['req'] : prop['show'];
					}
					
					// We will hide by default
					var toShow = true;
					
					for(var showParam in show){
						var reqval = show[showParam];
						var except = showParam.substr(0, 1) == '!' ? true : false;
						showParam = except ? showParam.substr(1) : showParam;
						var val = pagelayer_get_att(jEle, showParam) || '';
						
						//console.log('Show '+x+' '+showParam+' '+reqval+' '+val);
						
						// Is the value not the same, then we can show
						if(except){
							
							if(typeof reqval == 'string' && reqval == val){
								toShow = false;
								break;
							}
							
							// Its an array and a value is found, then dont show
							if(typeof reqval != 'string' && reqval.indexOf(val) > -1){
								toShow = false;
								break;
							}
							
						// The value must be equal
						}else{
							
							 if(typeof reqval == 'string' && reqval != val){
								toShow = false;
								break;
							 }
							
							// Its an array and no value is found, then dont show
							if(typeof reqval != 'string' && reqval.indexOf(val) === -1){
								toShow = false;
								break;
							}
						}
					}
					
					// Are we to show ?
					if(toShow){
						row.show();
					}else{
						row.hide();
					}
					
				}
				
			}
		}
	
	});
	
}; 

var pagelayer_widget_timer;
var pagelayer_widget_cache = {};

// Load the widget settings
function pagelayer_elpd_widget_settings(el, sec, onfocus){
	
	var show_form = function(html){
				
		sec.html('<form class="pagelayer-widgets-form">'+html+'</form>');
		
		// Handle on form data change
		sec.find('form :input').on('change', function(){					
			//console.log('Changed !');
			
			// Clear any previous timeout
			clearTimeout(pagelayer_widget_timer);
			
			// Set a timer for constant change
			pagelayer_widget_timer = setTimeout(function(){ 
				pagelayer_elpd_widget_settings(el, sec);
				//console.log('Calling');
			}, 500);
			
		});
	}
	
	// Is it onfocus ?
	onfocus = onfocus || false;
	
	// Its an onfocus
	if(onfocus && el.id in pagelayer_widget_cache){
		show_form(pagelayer_widget_cache[el.id]);
		return true;
	}
	
	var post = {};
	post['action'] = 'pagelayer_wp_widget';
	post['pagelayer_nonce']	= pagelayer_ajax_nonce;
	post['tag'] = el.tag;
	post['pagelayer-id'] = el.id;
	
	// Any atts ?
	if('widget_data' in el.atts){
		post['widget_data'] = el.atts['widget_data'];
	}
	
	// Post any existing data
	var form = sec.find('form');
  // Archive widget checkbox fix
	var inputCheckbox = form.find('input[type=checkbox]');
	for(var i=0; i<inputCheckbox.length; i++){
		if(inputCheckbox[i].value == 'on'){
			form.find('input[type=checkbox]')[i].value = 1;
		}
	}
	
	if(form.length > 0){
		//console.log(form.serialize());
		post['values'] = form.serialize();
	}
	
	jQuery.ajax({
		url: pagelayer_ajax_url,
		type: 'post',
		data: post,
		success: function(data) {
			//console.log('Widget Data');console.log(data);
			
			// Show the form
			if('form' in data){
				show_form(data['form']);
				
				// Store in cache
				pagelayer_widget_cache[el.id] = data['form'];
			}
			
			// Show the content
			if('html' in data){
				el.$.html(data['html']);
				pagelayer_sc_render(el.$);// Re-Render the CSS
			}
			
			// Any set attributes ?
			if('widget_data' in data){
				pagelayer_set_atts(el.$, 'widget_data', JSON.stringify(data['widget_data']));
			}
			
		},
		fail: function(data) {
			alert('Some error occured in getting the widget data');			
		}
	});
	
}

// Will set the attribute and also render
function _pagelayer_set_atts(row, val, no_default){
	var id = row.closest('[pagelayer-element-id]').attr('pagelayer-element-id');
	var jEle = jQuery('[pagelayer-id='+id+']');
	var tag = pagelayer_tag(jEle);
	var prop_name = row.attr('pagelayer-elp-name');
	
	// Is there a unit ?
	var uEle = row.find('.pagelayer-elp-units');
	if(uEle.length > 0){
		var unit = uEle.find('[selected]').html();
		if(Array.isArray(val)){
			for(var i in val){
				if(val[i].length < 1){
					continue;
				}
				val[i] = val[i]+unit;
			}
		}else{
			val = val+unit;
		}
	}
	
	// Are we in another mode ?
	var mEle = row.find('.pagelayer-elp-screen');
	var mode = mEle.length > 0 && pagelayer_get_screen_mode() != 'desktop' ? '_'+pagelayer_get_screen_mode() : '';
	
	pagelayer_set_atts(jEle, prop_name+mode, val);
	
	// Are we to skip setting defaults ?
	no_default = no_default || false;
	if(!no_default){
		
		// We need to set defaults for dependents
		var hasSet = pagelayer_set_default_atts(jEle, 5);
		
		// We need to reopen the left panel
		// Note : If two simultaneous calls are made, then this will cause problems
		// Also after this is called, ROW is destroyed and no other row related stuff will work i.e. set_atts in the same calls will fail
		if(hasSet){
			pagelayer_elpd_open(jEle);
		}
	}
	//console.trace();console.log('Setting Attr');
	
	// Render
	pagelayer_sc_render(jEle);
	
	if('onchange' in pagelayer.props_ref[tag][prop_name]){
		var fn = window[pagelayer.props_ref[tag][prop_name]['onchange']];
		if(typeof fn === 'function'){
			fn(jEle, row, val);
		}
	}
};

// Will set the attribute but not render
function _pagelayer_set_tmp_atts(row, suffix, val){
	var id = row.closest('[pagelayer-element-id]').attr('pagelayer-element-id');
	var jEle = jQuery('[pagelayer-id='+id+']');
	pagelayer_set_tmp_atts(jEle, row.attr('pagelayer-elp-name')+(suffix.length > 0 ? '-'+suffix : ''), val);
};

// Will clear the attribute but not render
function _pagelayer_clear_tmp_atts(row){
	var id = row.closest('[pagelayer-element-id]').attr('pagelayer-element-id');
	var jEle = jQuery('[pagelayer-id='+id+']');
	pagelayer_clear_tmp_atts(jEle, row.attr('pagelayer-elp-name'));
};

// Get the tmp att
function _pagelayer_get_tmp_att(row, suffix){
	var id = row.closest('[pagelayer-element-id]').attr('pagelayer-element-id');
	var jEle = jQuery('[pagelayer-id='+id+']');
	return pagelayer_get_tmp_att(jEle, row.attr('pagelayer-elp-name')+'-'+suffix);
};

// Create the Label
function pagelayer_elp_label(row, prop){
	row.append('<div class="pagelayer-elp-label-div" type="'+prop['type']+'"><label class="pagelayer-elp-label">'+prop['label']+'</label></div>');
	
	var label = row.children('.pagelayer-elp-label-div');
	
	// Do we have screen ?
	if('screen' in prop){
		var mode = pagelayer_get_screen_mode();
		var screen = '<div class="pagelayer-elp-screen">'+
			'<i class="pli pli-desktop" ></i>'+
			'<i class="pli pli-tablet" ></i>'+
			'<i class="pli pli-mobile" ></i>'+
			'<i class="pagelayer-prop-screen pli pli-'+mode+'" ></i>'+
		'</div>';
		label.append(screen);
		
		// Set screen mode on change
		label.find('.pli:not(.pagelayer-prop-screen)').on('click', function(){
			var mode = 'desktop';
			var jEle = jQuery(this);
			
			// Tablet ?
			if(jEle.hasClass('pli-tablet')){
				mode = 'tablet';
			}
			
			// Mobile ?
			if(jEle.hasClass('pli-mobile')){
				mode = 'mobile';
			}
			
			pagelayer_set_screen_mode(mode);
			label.find('.pagelayer-elp-screen .pli').removeClass('open');
			
		});
		
		// On change of screen handle the values
		label.find('.pagelayer-elp-screen').on('pagelayer-screen-changed', function(e){
			
			label.find('.pagelayer-elp-screen .pli').removeClass('open');
			var mode = pagelayer_get_screen_mode();
			var modes = {desktop: '', tablet: '_tablet', mobile: '_mobile'};
			
			// Get the current current new val
			prop.c['val'] = pagelayer_get_att(prop.el.$, prop.c['name']+modes[mode]);
			
			// Handle the amount
			if(pagelayer_empty(prop.c['val'])){
				prop.c['val'] = '';
			}
			
			// Remove the siblings
			label.siblings().each(function(){
				var j = jQuery(this);
				
				if(j.hasClass('pagelayer-elp-desc')){
					return;
				}
				
				j.remove();
			});
			
			// Create the vals again
			var fn = window['pagelayer_elp_'+prop['type']];
			
			// The main property
			fn(row, prop);
			
		});
		
		label.find('.pagelayer-elp-screen .pagelayer-prop-screen').on('click', function(e){
			jQuery(this).siblings().toggleClass('open');
		})
		
	}
	
	// Do we have pro version requirement ?
	if('pro' in prop && pagelayer_empty(pagelayer_pro)){
		var txt = prop['pro'].length > 1 ? prop['pro'] : pagelayer.pro_txt;
		var pro = jQuery('<div class="pagelayer-pro-req">Pro</div>');
		pro.attr('data-tlite', txt);
		label.append(pro);
	}
	
	// Do we have units ?
	if('units' in prop){
		
		var units = '';	
		var tmp_val = prop.c['val'];
		var default_unit = 0;
		
		// Get unit from value
		if(!(pagelayer_empty(tmp_val))){
			
			for(var i in prop['units']){
				if(tmp_val.search(prop['units'][i]) != -1){
					default_unit = i;
				}
			}
		}
		
		for(var i in prop['units']){
			units += '<span '+(i == default_unit ? 'selected' : '')+'>'+prop['units'][i]+'</span>';
		}
		
		label.append('<div class="pagelayer-elp-units">'+units+'</div>');
		
		// Set unit on change
		label.find('.pagelayer-elp-units span').on('click', function(){
			
			label.find('.pagelayer-elp-units span').each(function(){
				jQuery(this).removeAttr('selected');
			});
			
			jQuery(this).attr('selected', 1);
			
		});
		
	}
	
};

// Create the Description
function pagelayer_elp_desc(row, label){
	row.append('<div class="pagelayer-elp-desc">'+label+'</div>');
};

// The Text property
function pagelayer_elp_text(row, prop){
	
	var div = '<div class="pagelayer-elp-text-div">'+
				'<input type="text" class="pagelayer-elp-text" name="'+prop.c['name']+'" value="'+prop.c['val']+'"></input>'+
			'</div>';
	
	row.append(div);
	
	row.find('input').on('input', function(){
		_pagelayer_set_atts(row, jQuery(this).val());// Save and Render
	});
	
};

// The Select property
function pagelayer_elp_select(row, prop){
	
	var options = '';
	var option = function(val, lang){
		var selected = (val != prop.c['val']) ? '' : 'selected="selected"';
		return '<option class="pagelayer-elp-select-option" value="'+val+'" '+selected+'>'+lang+'</option>';
	}
	
	for (x in prop['list']){
		
		// Single item
		if(typeof prop['list'][x] == 'string'){
			options += option(x, prop['list'][x]);
		
		// Groups
		}else{
			options += '<optgroup label="'+x+'">';
			
			for(var y in prop['list'][x]){
				options += option(y, prop['list'][x][y]);
			}
			
			options += '</optgroup>';
		}
	}
	
	var div = '<div class="pagelayer-elp-select-div pagelayer-elp-pos-rel">'+
				'<select class="pagelayer-elp-select pagelayer-select" name="'+prop.c['name']+'">'+options+'</select>'+
  '</div>';
			
	row.append(div);
	
	row.find('select').on('change', function(){
		
		var sEle = jQuery(this);
		
		if(sEle.attr('name') == "animation"){
			_pagelayer_trigger_anim(row, sEle.val());
		}
		
		_pagelayer_set_atts(row, sEle.val());// Save and Render		
	
	});
	
}

// The MultiSelect property
function pagelayer_elp_multiselect(row, prop){
	
	var selection = [];
	if(!pagelayer_empty(prop.c['val'])){
		//selection = JSON.parse(prop.c['val']);
		selection = prop.c['val'].split(',');
	}
	
	var options = '';
	var option = function(val, lang){
		var selected = (jQuery.inArray(val,selection) == -1 ? '' : 'selected="selected"');
		return '<li class="pagelayer-elp-multiselect-option" data-val="'+val+'" '+selected+'>'+lang+'</li>';
	}
	
	var show_sel = function(val){
		var sel_html = '';
		jQuery.each(val, function(index, value){
			sel_html += '<span class="pagelayer-elp-multiselect-selected" data-val="'+value+'">'+prop['list'][value]+' <span class="pagelayer-elp-multiselect-remove">x</span></span>';
		});
		return sel_html;
	}
	
	var setup_remove = function(){
		row.find('.pagelayer-elp-multiselect-remove').on('click', function(){
			var sVal = jQuery(this).parent().attr('data-val');
			row.find('.pagelayer-elp-multiselect-option[data-val='+sVal+']').click();
		});
	}
	
	for (x in prop['list']){
		options += option(x, prop['list'][x]);
	}
	
	var div = '<div class="pagelayer-elp-multiselect-div pagelayer-elp-pos-rel">'+
				'<div class="pagelayer-elp-multiselect">'+show_sel(selection)+'</div>'+
				'<ul class="pagelayer-elp-multiselect-ul" name="'+prop.c['name']+'">'+options+'</ul>'+
			'</div>';
  
	row.append(div);
	setup_remove();
	
	row.find('.pagelayer-elp-multiselect-option').on('click', function(){
		
		var sVal = jQuery(this).attr('data-val');
		
		if(jQuery.inArray(sVal,selection) == -1){
			selection.push(sVal);
			row.find('[data-val="'+sVal+'"]').attr('selected','selected');
		}else{
			selection.splice(jQuery.inArray(sVal,selection),1);
			row.find('[data-val="'+sVal+'"]').removeAttr('selected');
		}
		
		//_pagelayer_set_atts(row,JSON.stringify(selection));// Save and Render
		_pagelayer_set_atts(row, selection.join(','));// Save and Render
		
		row.find('.pagelayer-elp-multiselect').html(show_sel(selection));		
		setup_remove();
		
	});
	
	// Open the selector
	row.find('.pagelayer-elp-multiselect').on('click', function(){
		row.find('.pagelayer-elp-multiselect-ul').slideToggle(100);
	});
	
}

function _pagelayer_trigger_anim(row, anim){
	var id = row.closest('[pagelayer-element-id]').attr('pagelayer-element-id');
	var classList = jQuery('[pagelayer-id='+id+']').attr('class');
	classList = classList.split(/\s+/);
	//console.log(classList);
	var options = [];
	row.find('option').each(function(){
		var found = jQuery.inArray( jQuery(this).val(), classList );
		if( found != -1){
			//var found = jQuery(this).val();
			jQuery('[pagelayer-id='+id+']').removeClass(jQuery(this).val());
			//break;
		}
		//options.push(jQuery(this).val());
	});
	jQuery('[pagelayer-id='+id+']').removeClass('pagelayer-wow').addClass(anim + ' animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
		jQuery(this).removeClass(anim+ ' animated');
	});
}

// The Checkbox property
function pagelayer_elp_checkbox(row, prop){
	
	var div = '<div class="pagelayer-elp-checkbox-div">'+
				'<input type="checkbox" name="'+prop.c['name']+'" class="pagelayer-elp-checkbox" />'+
			'</div>';
	
	row.append(div);

	if(prop.c['val'].length > 0){
		row.find('input').attr('checked', 'checked');
	}else{
		row.find('input').removeAttr('checked');
	}
	
	// When the change is called
	row.find('input').on('change', function(){
		
		// We set to string true or false
		var val = jQuery(this).is(':checked') ? 'true' : '';
		
		_pagelayer_set_atts(row, val);// Save and Render
	});
	
}

// The Radio property
function pagelayer_elp_radio(row, prop){
	
	var active = 'pagelayer-elp-radio-active';
	var div = '<div class="pagelayer-elp-radio-div">';
	
	for(var x in prop.list){		
		var addclass = (prop.c['val'] == x) ? active : '';
		div += '<a class="pagelayer-elp-radio '+addclass+'" val="'+x+'">'+prop.list[x]+'</a>';
	}
	
	div += '</div>';
	
	row.append(div);
	
	row.find('.pagelayer-elp-radio').each(function(){
		
		jQuery(this).on('click', function (){
			
			// Remove existing active class
			jQuery(this).parent().find('.'+active).removeClass(active);
			
			// Set active
			jQuery(this).addClass(active);
			
			_pagelayer_set_atts(row, jQuery(this).attr('val'));// Save and Render
			
		});
		
	});
	
}

// The Image Property
function pagelayer_elp_image(row, prop){

	var style = '';
	var tmp = prop.c['name']+'-url';
	var def = pagelayer.blank_img;
	var src = (tmp in prop.el.tmp) ? prop.el.tmp[tmp] : def;
	
	// Do we have a URL set ?
	style = 'style="background-image:url(\''+src+'\')"';
	
	var div = '<div class="pagelayer-elp-image-div">'+
				'<div class="pagelayer-elp-drop-zone">'+
					'<div>'+
						'<i class="fas fa-upload"></i>'+
						'<h4>'+pagelayer_l('drop_file')+'</h4>'+
						'<div class="pagelayer-elp-img-up-progress">'+
							'<div class="pagelayer-elp-img-up-bar"></div>'+
						'</div>'+
					'</div>'+
				'</div>'+
				'<div class="pagelayer-elp-image" '+style+'></div>'+
				'<div class="pagelayer-elp-image-delete"><i class="pli pli-trashcan" ></i></div>'+
			'</div>';
	
	row.append(div);
	
	// Set an Image
	row.find('.pagelayer-elp-image').on('click', function(){
	
		var button = jQuery(this);
		
		// Load the frame
		var frame = pagelayer_select_frame('image');
		
		// On select update the stuff
		frame.on({
			'select': function(){
				
				var state = frame.state();
				var id = url = '';
				
				// External URL
				if('props' in state){
					
					id = url = pagelayer_parse_theme_vars(state.props.attributes.url);
				
				// Internal from gallery
				}else{
				
					var attachment = frame.state().get('selection').first().toJSON();
					//console.log(attachment);
					
					// Set the new ID and URL
					id = attachment.id;
					url = attachment.url;
					
					// To remove past temp attr so that they are not involve in future temp values
					_pagelayer_clear_tmp_atts(row);
				
					// Keep a list of all sizes
					for(var x in attachment.sizes){
						_pagelayer_set_tmp_atts(row, x+'-url', attachment.sizes[x].url);
					}
				
				}
				
				// Update thumbnail
				button.css('background-image', 'url(\''+url+'\')');
				
				// Save and render
				_pagelayer_set_tmp_atts(row, 'url', url);
				_pagelayer_set_atts(row, id);
				
			},
			// On open select the appropriate images in the media manager
			'open': function() {			
				var selection =  frame.state().get('selection');
				var wp_id = pagelayer_get_att(prop.el.$, prop.c['name']);
				selection.reset( wp_id ? [ wp.media.attachment( wp_id ) ] : [] );
			}
		});

		frame.open(button);
		
		return false;
		
	});
	
	// Finding and assigning values in the variables
	var dropzoneParent = row.find('.pagelayer-elp-image-div');
	var dropZone = row.find('.pagelayer-elp-drop-zone');
	
	// Inserting values in image drag and drop function
	pagelayer_img_dragAndDrop(dropzoneParent, dropZone, '', row);	
	
	// Delete this
	row.find('.pagelayer-elp-image-delete').on('click', function(){
		
		// Update thumbnail
		row.find('.pagelayer-elp-image').css('background-image', 'url(\''+def+'\')');
		
		// Set to blank and render
		_pagelayer_set_atts(row, '', true);
		
		_pagelayer_set_tmp_atts(row, 'no-image-set', 1);
		_pagelayer_set_tmp_atts(row, 'url', def);
		_pagelayer_set_atts(row, def);
	});
	
}

// Main image drag and drop function
function pagelayer_img_dragAndDrop(dropzoneParent, dropZone, jEle, row){
	
	var reset_dragging = false;
	
	dropzoneParent.on('dragover', function(e){
		e.preventDefault();
		// Checking that the dragged element is a file or not
		var dt = e.originalEvent.dataTransfer;
		if(dt.types && (dt.types.indexOf ? dt.types.indexOf('Files') != -1 : dt.types.contains('Files'))){
			if(e.originalEvent.dataTransfer.items[0].type.search('image/')!=-1){
				dropZone.show();
				reset_dragging = true;				
			}
		}
	});
	
	dropzoneParent.on('dragleave', function(e){
		var rect = this.getBoundingClientRect();
		// Checking that the cursor is in the drag area or not
		if (e.clientX >= (rect.left + rect.width) || e.clientX <= rect.left || e.clientY >= (rect.top + rect.height) || e.clientY <= rect.top) {
			dropZone.hide();
			reset_dragging = false;
        }
	});
	
	dropzoneParent.on('drop', function(e){
		
		// Is not dropable?
		if(!reset_dragging){
			return;
		}
		
		e.preventDefault();
		var pagelayer_ajax_func = {};
		
		// This function for ajax success call back
		pagelayer_ajax_func['success'] = function(obj){
			
			if(obj['success']){
					
				// Set the new ID and URL
				id = obj['data']['id'];
				url = obj['data']['url'];
				
				if(row == ''){
					// Getting Id of jEle 
					var widgetid = jEle.closest('[pagelayer-id]').attr('pagelayer-id');
					
					// Finding widget image setting using id of jEle. Finding image editor setting from all of the other settings.
					row = pagelayer.$$('[pagelayer-element-id='+widgetid+']').find('.pagelayer-elp-image').eq(0).parent().parent();
				}
				
				row.find('.pagelayer-elp-image').css('background-image', 'url(\''+url+'\')');
				
				// To remove past temp attr so that they are not involve in future temp values
				_pagelayer_clear_tmp_atts(row);
				
				for(var x in obj['data']['sizes']){
					_pagelayer_set_tmp_atts(row, x+'-url', obj['data']['sizes'][x]['url']);
				}
				
				dropZone.find('.pagelayer-elp-img-up-bar').css('width', '3%');
				dropZone.hide();
				
				// Save and render
				_pagelayer_set_tmp_atts(row, 'url', url);
				_pagelayer_set_atts(row, id);
				
			}else{
				alert(obj['data']['message']);								
			}
		}
		
		// This function for ajax before send call back
		pagelayer_ajax_func['beforeSend'] = function(xhr){
			// It activate the image widget
			if(row == ''){
				jEle.click();							
			}
		}
		
		// This function for how much file is uploaded or for progress bar
		pagelayer_ajax_func['uploadProgress'] = function(xhr){
			xhr.upload.addEventListener("progress", function(evt) {
				if (evt.lengthComputable) {
					var percentComplete = evt.loaded / evt.total;
					percentComplete = parseInt(percentComplete * 100);
					
					if(row == ''){
						dropZone.find('.pagelayer-img-up-bar').css('width', percentComplete+'%');					
					}else{
						dropZone.find('.pagelayer-elp-img-up-bar').css('width', percentComplete+'%');											
					}
				}
			}, false);
			return xhr;
		}
		
		// Uploading image to the media library
		pagelayer_editable_paste_handler(e.originalEvent.dataTransfer.files[0], pagelayer_ajax_func);
		
		reset_dragging = false;
		
	});
}	

// The Multi Image Property
function pagelayer_elp_multi_image(row, prop){
	
	var div = '<div class="pagelayer-elp-multi_image-div">'+
				'<center><button class="pagelayer-elp-button">'+pagelayer_l('Add Images')+'</button></center>'+
				'<div class="pagelayer-elp-multi_image-thumbs"></div>'+
			'</div>';
			
	row.append(div);
	
	var tmp = prop.c['name']+'-urls';
	var ids = new Array();
	
	// Any IDs ?
	if(!pagelayer_empty(prop.c['val'])){
		ids = prop.c['val'].split(',');
		//console.log(ids);
	}
	
	// Do we have a URL set ?
	if(ids.length > 0 && tmp in prop.el.tmp){
		var images = JSON.parse(prop.el.tmp[tmp]);
		//console.log(images);
		
		for(var x in ids){
			row.find('.pagelayer-elp-multi_image-thumbs').append('<div class="pagelayer-elp-multi_image-thumb" style="background-image: url(\''+images['i'+ids[x]]+'\');"></div>');
		}
	}
	
	var pagelayer_init_frame = function(state){
	
		var button = row.find('.pagelayer-elp-multi_image-thumbs');
		//console.log(ids);
		
		// Load the frame
		var frame = pagelayer_select_frame('multi_image', state);
		
		frame.on({
			
			'select': function(){
				
				var state = frame.state();
				var id = url = '';
				var urls = {};
				
				// External URL
				if('props' in state){
					//console.log(state);
					var urls_str = state.props.attributes.url;
					
					var urls_arr = urls_str.split(',');
					//console.log(urls_arr);
					
					button.empty();
					
					// Add to current selection
					for(var i = 0; i < urls_arr.length; i++){
						var single_url = pagelayer_parse_theme_vars(urls_arr[i]);
						urls['i'+i] = single_url;
						
						// Create thumbnails
						button.append('<div class="pagelayer-elp-multi_image-thumb" style="background-image: url(\''+single_url+'\');"></div>');
					}
					urls_arr = Object.values(urls);
					
					_pagelayer_set_tmp_atts(row, 'urls', JSON.stringify(urls));
					_pagelayer_set_atts(row, urls_arr.join());
					
				}
			},
			
			// Set the current selection if any
			'open': function(){

				// Do we have anything
				if(ids.length > 0){
					
					var selection = '';
					
					if(state == 'gallery-edit'){
						selection = frame.state().get('library');
					}else if(state == 'gallery-library'){
						selection = frame.state().get('selection');
					}
					
					// Add to current selection
					if(!pagelayer_empty(selection)){
						for(var x in ids){
							attachment = wp.media.attachment(ids[x]);
							attachment.fetch();
							selection.add(attachment ? [ attachment ] : [] );
						}
					}
				}
			},
			
			// When images are selected
			'update': function(selection){
				
				//console.log(selection);
				
				// Remove thumbnails
				row.find('.pagelayer-elp-multi_image-thumb').remove();
				
				//Fetch selected images
				var attachments = selection.map(function(attachment){
					attachment.toJSON();
					return attachment;
				});
				
				//console.log(attachments);
				
				var img_ids = [];
				var urls = {};
				var img_urls = {};
				var titles = {};
				var links = {};
				var captions = {};
				
				for(var i = 0; i < attachments.length; ++i){
					
					// Add Id and urls to array
					var id = attachments[i].id;
					var _id = 'i'+id;
					img_ids.push(id);
					urls[_id] = attachments[i].attributes.url;
					
					// Create thumbnails
					button.append('<div class="pagelayer-elp-multi_image-thumb" style="background-image: url(\''+attachments[i].attributes.url+'\');"></div>');
					
					//get title
					titles[_id] = attachments[i].attributes.title;
					links[_id] = attachments[i].attributes.link;
					captions[_id] = attachments[i].attributes.caption;
					
					// Create a URL
					img_urls[_id] = {}
					
					for(var x in attachments[i].attributes.sizes){
						img_urls[_id][x] = attachments[i].attributes.sizes[x].url;
					}
					
				}
				
				//console.log(img_urls);
				
				// Save and render
				_pagelayer_set_tmp_atts(row, 'urls', JSON.stringify(urls));
				_pagelayer_set_tmp_atts(row, 'all-urls', JSON.stringify(img_urls));
				_pagelayer_set_tmp_atts(row, 'all-titles', JSON.stringify(titles));
				_pagelayer_set_tmp_atts(row, 'all-links', JSON.stringify(links));
				_pagelayer_set_tmp_atts(row, 'all-captions', JSON.stringify(captions));
				_pagelayer_set_atts(row, img_ids);
				
				// Update the IDs incase the user clicks on it again
				ids = img_ids;
				
			}
			
		});
		
		frame.open(button);
		
		return false;
		
	};
	
	row.find('.pagelayer-elp-multi_image-thumbs').on('click', function(){
		pagelayer_init_frame('gallery-edit');
	});
	
	row.find('.pagelayer-elp-button').on('click', function(){
		//console.log(ids.length);
		if(ids.length > 0){
			if(isNaN(ids[0])){
				pagelayer_init_frame('embed');
			}else{
				pagelayer_init_frame('gallery-library');
			}
		}else{
			pagelayer_init_frame('gallery');
		}		
	});
	
}

// The Video Property
function pagelayer_elp_video(row, prop){
	
	var tmp = prop.c['name']+'-url';
	var src = (tmp in prop.el.tmp) ? prop.el.tmp[tmp] : prop.c['val'];
	
	var div = '<div class="pagelayer-elp-video-div pagelayer-elp-input-icon">'+
				'<input class="pagelayer-elp-video" name="'+prop.c['name']+'" type="text" value="'+src+'">'+
				'<i class="pli pli-folder-open" ></i>'+
			'</input></div>';
			
	row.append(div);
	
	row.find('.pagelayer-elp-video-div .pli').on('click', function(){
	
		var button = jQuery(this);
		
		// Load the frame
		var frame = pagelayer_select_frame('video');
		
		// On select update the stuff
		frame.on({
			
			'select': function(){
				
				var state = frame.state();
				var id = url = '';
				
				// External URL
				if('props' in state){
					
					id = url = pagelayer_parse_theme_vars(state.props.attributes.url);
				
				// Internal from gallery
				}else{
				
					var attachment = frame.state().get('selection').first().toJSON();
					//console.log(attachment);
					
					id = attachment.id;
					url = attachment.url;
				
				}
				
				// Update URL
				button.prev().val(url);
				
				// Save and render
				_pagelayer_set_tmp_atts(row, 'url', url);
				_pagelayer_set_atts(row, id);
				
			}
			
		});

		frame.open(button);
		
		return false;
		
	});
	
	// Edited the video URL directly
	row.find('.pagelayer-elp-video').on('change', function(){
		
		var input = jQuery(this);
		
		// Set the new URL
		_pagelayer_set_tmp_atts(row, 'url', input.val());
		_pagelayer_set_atts(row, input.val());
		
	});
	
}


// The Audio Property
function pagelayer_elp_audio(row, prop){
	
	var tmp = prop.c['name']+'-url';
	var src = (tmp in prop.el.tmp) ? prop.el.tmp[tmp] : prop.c['val'];
	
	var div = '<div class="pagelayer-elp-audio-div pagelayer-elp-input-icon">'+
				'<input class="pagelayer-elp-audio" name="'+prop.c['name']+'" type="text" value="'+src+'" />'+
				'<i class="pli pli-menu" ></i>'+
			'</div>';
	
	row.append(div);
	
	// Choose from media
	row.find('.pagelayer-elp-audio-div .pli').on('click', function(){
		
		var button = jQuery(this);
		
		// Load the frame
		var frame = pagelayer_select_frame('audio');
		
		frame.on({
			
			'select': function(){
				
				var state = frame.state();
				var id = url = '';
				
				// External URL
				if('props' in state){
					
					id = url = pagelayer_parse_theme_vars(state.props.attributes.url);
				
				// Internal from gallery
				}else{
				
					var attachment = frame.state().get('selection').first().toJSON();
					//console.log(attachment);
					
					id = attachment.id;
					url = attachment.url;
				
				}
				
				// Update URL
				button.prev().val(url);
				
				// Save and render
				_pagelayer_set_tmp_atts(row, 'url', url);
				_pagelayer_set_atts(row, id);
				
			}
			
		});
		
		frame.open(button);
		
		return false;
		
	});
	
	// Edited the media URL directly
	row.find('.pagelayer-elp-audio').on('change', function(){
		
		var input = jQuery(this);
		
		// Set the new URL
		_pagelayer_set_tmp_atts(row, 'url', input.val());
		_pagelayer_set_atts(row, input.val());
		
	});
	
}

// The Media Property
function pagelayer_elp_media(row, prop){
	
	var tmp = prop.c['name']+'-url';
	var src = (tmp in prop.el.tmp) ? prop.el.tmp[tmp] : prop.c['val'];
	
	var div = '<div class="pagelayer-elp-media-div pagelayer-elp-input-icon">'+
				'<input class="pagelayer-elp-media" value="'+src+'" type="text" />'+
				'<i class="pli pli-menu" ></i>'+
			'</div>';
	
	row.append(div);
	
	row.find('.pagelayer-elp-media-div .pli-menu').on('click', function(){
		
		var button = jQuery(this);
		
		// Load the frame
		var frame = pagelayer_select_frame('media');
		
		frame.on({
			
			'select': function(){
				
				var state = frame.state();
				var id = url = '';
				
				// External URL
				if('props' in state){
					
					id = url = pagelayer_parse_theme_vars(state.props.attributes.url);
				
				// Internal from gallery
				}else{
				
					var attachment = frame.state().get('selection').first().toJSON();
					//console.log(attachment);
					
					id = attachment.id;
					url = attachment.url;
				
				}
				
				// Update URL
				button.prev().val(url);
				
				// Save and render
				_pagelayer_set_tmp_atts(row, 'url', url);
				_pagelayer_set_atts(row, id);
				
			}
			
		});
		
		frame.open(button);
		
		return false;
		
	});
	
	// Edited the media URL directly
	row.find('.pagelayer-elp-media').on('change', function(){
		
		var input = jQuery(this);
		
		// Set the new URL
		_pagelayer_set_tmp_atts(row, 'url', input.val());
		_pagelayer_set_atts(row, input.val());
		
	});
	
}

// The Slider Property
function pagelayer_elp_slider(row, prop){
	
	var div = '<div class="pagelayer-elp-slider-div">'+
				  '<input type="range" class="pagelayer-elp-slider" value="'+parseFloat(prop.c['val'])+'" min="'+prop['min']+'" max="'+prop['max']+'" step="'+prop['step']+'"/>'+
				  '<input type="number" class="pagelayer-elp-slider-value" value="'+parseFloat(prop.c['val'])+'" min="'+prop['min']+'" max="'+prop['max']+'" step="'+prop['step']+'"/>'+
				'</div>'+
			'</div>';
	
	row.append(div);
	
	// Set an value in span
	row.find('.pagelayer-elp-slider-div input').on('input', function(){
		var value = parseFloat(this.value);
		var max = parseFloat(this.max);
		
		if(!pagelayer_empty(max) && value > max){
			value = max;
		}
		row.find('.pagelayer-elp-slider-div input').val(value);
		
		_pagelayer_set_atts(row, value);// Save and Render
		
	});
	
}

// The Editor proprety
function pagelayer_elp_editor(row, prop){
	
	var div = '<div class="pagelayer-elp-editor-div">'+
				'<textarea class="pagelayer-elp-editor"></textarea>'+
			'</div>';
			
	row.append(div);
	
	var editor = row.find('.pagelayer-elp-editor');
	editor.val(prop.c['val']);
	
	// No SVG Icons for now
	jQuery.trumbowyg.svgPath = false;
	
	// Initiate the editor
	editor.trumbowyg({
		autogrow: false,
		hideButtonTexts: true,
		btns:[
			['viewHTML'],
			['wpmedia'],
			['fontfamily'],
			['formatting'],
			['undo', 'redo'], // Only supported in Blink browsers
			['fontsize'],
			['lineheight'],
			['foreColor', 'backColor',],
			['strong', 'em', 'del'],
			['horizontalRule'],
			['superscript', 'subscript'],
			['link'],
			['unorderedList', 'orderedList'],
			['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
			['removeformat'],
			['fullscreen']
		],
		plugins: {
			fontsize: {
				sizeList: ['12px','13px','14px','15px','16px','17px','18px','19px','20px','21px','22px','23px','24px','25px']
			}
		},
		imageWidthModalEdit: true,
		
	// Handle the changes made in the editor
	}).on('tbwchange', function(){
		_pagelayer_set_atts(row, editor.trumbowyg('html'));// Save and Render
	});
	
}

// The Link proprety
function pagelayer_elp_link(row, prop){
	
	var tmp = prop.c['name'];
	var link = (tmp in prop.el.tmp) ? prop.el.tmp[tmp] : prop.c['val'];
	var jEle = jQuery('[pagelayer-id='+prop.el.id+']');
	
	var div = '<div class="pagelayer-elp-link-div pagelayer-elp-input-icon">'+
				'<input class="pagelayer-elp-link" type="text" value="'+link+'" />'+
				'<i class="pli pli-link pagelayer-elp-link-icon" ></i>'+
				'<div class="pagelayer-elp-link-list">'+
				'</div>'+
			'</div>';
	
	row.append(div);
	
	var listWrap = row.find('.pagelayer-elp-link-list');
	var time = null;
		
	//Add ID
	var addID = function(permaID){
		permaID = permaID || false;
		
		var lDiv = row.closest('[pagelayer-elp-name]').find('.pagelayer-elp-label-div');
		if(permaID){
			lDiv.append('<span class="pagelayer-elp-link-id">ID : '+permaID+'</span>');
		}else{
			lDiv.find('.pagelayer-elp-link-id').remove();
		}
	};
	
	if(!isNaN(prop.c['val'])){
		addID(prop.c['val']);
	}
	
	// Set a Link
	row.find('.pagelayer-elp-link').on('change', function(){
		
		// Save and Render
		_pagelayer_set_tmp_atts(row, '', jQuery(this).val());
		_pagelayer_set_atts(row, jQuery(this).val());
		
		// Remove ID Holder
		addID();

	});
	
	// Set a Link
	row.find('.pagelayer-elp-link').on('input click', function(e){
		e.stopPropagation();
		
		if(!listWrap.is(':visible')){
			listWrap.show();
		}
		
		var val = jQuery(this).val();
		
		clearTimeout(time);
		time = setTimeout(function(){

			jQuery.ajax({
				url: pagelayer_ajax_url,
				type: 'post',
				data:{
					'action' : 'wp-link-ajax',
					'_ajax_linking_nonce' : pagelayer_internal_linking_nonce,
					'search' : val,
				},
				success: function(response) {
					
					var data = jQuery.parseJSON(response);
					var html = '';
					//console.log('Link Data');console.log(response);
					
					if(pagelayer_empty(data)){
						html = pagelayer_l('custom_url');
						// Remove ID Holder
						addID();
					}else if(typeof data === 'object'){
						
						for(var key in data){
							var vals = data[key];
							html += '<div class="pagelayer-elp-link-item"  data-id="'+vals['ID']+'" data-permalink="'+vals['permalink']+'">'+
								'<div class="pagelayer-elp-link-title">'+
									'<span class="pagelayer-elp-link-item-title" title="'+vals['title']+'">'+vals['title']+'</span>'+
									'<span class="pagelayer-elp-link-item-perma" title="'+vals['permalink']+'">'+vals['permalink']+'</span>'+
								'</div>'+
								'<div class="pagelayer-elp-link-info">'+
									'<span title="'+vals['info']+'">'+vals['info']+'</span>'+
								'</div>'+
							'</div>';
						}
					}
					
					listWrap.html(html);
				},
				fail: function(data) {
					listWrap.html('Some error occured in getting the link data');
				}
			});
			
		}, 200);
		
	});
	
	listWrap.on('click', function(e){
		e.stopPropagation();
		
		var lEle = jQuery(e.target).closest('.pagelayer-elp-link-item');
		
		// IF item not found
		if(lEle.length < 1){
			return;
		}
		
		var perma = lEle.attr('data-permalink');
		var ID = lEle.attr('data-id');
		
		// Save and Render
		row.find('.pagelayer-elp-link').val(perma);
		_pagelayer_set_tmp_atts(row, '', perma);
		_pagelayer_set_atts(row, ID);
		listWrap.hide();
		
		// Show ID
		addID(ID);
	});
	
	pagelayer.gDocument.on('click', function(e){
		listWrap.hide();
	});
  
}

// The Textarea property
function pagelayer_elp_textarea(row, prop){
	
	var rows = prop.rows ? 'rows="'+prop.rows+' "' : '';
	
	var div = '<div class="pagelayer-elp-textarea-div">'+
				'<textarea '+rows+'class="pagelayer-elp-textarea"></textarea>'+
			'</div>';
			
	row.append(div);
	row.find('.pagelayer-elp-textarea').val(prop.c['val']);
  
	// Handle on change
	row.find('.pagelayer-elp-textarea').on('input', function(){
		_pagelayer_set_atts(row, pagelayer_trim(jQuery(this).val()));// Save and Render
	});
};

// Clear all editable
function pagelayer_clear_editable(dontDestroy){
	
	// Destroy all
	for(var x in pagelayer_editor){
		if(dontDestroy == x){
			console.log('Skipping '+dontDestroy);
			continue;
		}
		pagelayer_editor[x].pen.destroy();
	}
	
};

// Makes a field editable in the DOM
function pagelayer_make_editable(jEle, e){
	
	// The parent element
	var pEle = jEle.closest('.pagelayer-ele, [pagelayer-ref-id]');
	
	// Mainly for editing table cells as pagelayer-ref-id is used by them
	if(!pEle.hasClass('pagelayer-ele')){
		var refID = pEle.attr('pagelayer-ref-id');
		pEle = jQuery('[pagelayer-id="'+refID+'"]');
	}
	
	var prop = jEle.attr('pagelayer-editable');
	var eId = pagelayer_id(pEle)+'|'+jEle.attr('pagelayer-editable');// Editing ID
	
	// Is it already setup ?
	if(jEle.hasClass('pagelayer-pen')){
		//console.log('Already Penned');
		//pagelayer_focus_editable(jEle, e, eId);
		return true;
	}
	
	// Destroy the existing pen
	/*if(!pagelayer_empty(pagelayer_editor[eId])){
		pagelayer_editor[eId].pen.destroy();
		pagelayer_editor[eId].$.removeClass('pagelayer-pen');
	}*/
	
	var options = {
		class: 'pagelayer-pen',
		editor: jEle[0],
		list: ['bold', 'italic', 'underline', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'strike'],
		stay: false
	}
	
	// Setup the editor	
	pagelayer_editor[eId] = {};
	pagelayer_editor[eId].pen = new Pen(options);
	pagelayer_editor[eId].$ = jEle;
	
	// Are we the clicked object, then set the focus
	if(e){
		var target = jQuery(e.target);
		if(target.is(jEle).length || jEle.find(target).length){
			jEle.focus();
		}
	}
	
	/*// Reverse setup the event
	jEle.on('blur', function(){
		//pagelayer_editor[eId].pen.destroy();
	});
	
	// Reverse setup the event
	jEle.on('focus', function(){
		//pagelayer_clear_editable(eId);
	});*/
	
	// Reverse setup the event
	jEle.on('input', function(){
		
		var val = pagelayer_trim(jEle.html());
		
		// Set the property as well
		pagelayer_set_atts(pEle, prop, val);
		
		// Update the property
		var input = pagelayer.$$('[pagelayer-elp-name='+prop+']').find('input,textarea,.trumbowyg-editor');
		//console.log(input);
		
		if(input.length > 0){
			if(input.hasClass('trumbowyg-editor')){
				input.html(val);
			}else{
				input.val(val);
			}
		}
	
	});
	
}

// The Icon Property
function pagelayer_elp_icon(row, prop){
	
	var $ = jQuery;
	var sets_html = '';
	
	pagelayer_loaded_icons.forEach(function(item){
		sets_html += '<option name="'+item+'" value="'+item+'">'+item+'</option>';
	});
	
	var icons = {};
	var cur_icon_set = pagelayer_loaded_icons[0];
	var sel_icon = prop.c['val'];
	var sel_name = prop.c['val'];
	var icon_type = '';
	var sorted_icons = {};
	
	// Handle the icon name 
	var icon_name = sel_icon.split(' fa-');
	sel_name = icon_name[1];
	
	// Is there a specific list
	if('list' in prop && prop.list.length > 0){
		
		for(var i in pagelayer_icons){
			
			icons[i] = {};
			
			for(var j in pagelayer_icons[i]){
				
				icons[i][j] = {};
				var list_icons = [];
				prop.list.forEach(function(item){
					if(pagelayer_icons[i][j]['icons'].includes(item)){
						list_icons.push(item);
					}
					
				});
				icons[i][j]['icons'] = list_icons;
				icons[i][j]['pre'] = j;
			}
			
		}
	
	}else{
		icons = pagelayer_icons;
	}
	
	// Icon function
	var icon_html = function(name, cat){
		return '<span class="pagelayer-elp-icon-span">'+
			'<i class="'+cat+' fa-'+name+'" icon="'+name+'" ></i> '+name+
		'</span>';
	}
	
	var div = '<div class="pagelayer-elp-icon-div">'+
		'<div class="pagelayer-elp-icon-preview">'+
			'<i class="'+sel_icon+'"></i>'+
			'<span class="pagelayer-elp-icon-name">'+
			(pagelayer_empty(sel_name)?'Choose icon':sel_name)+
			'</span>'+
		'</div>'+
		'<span class="pagelayer-elp-icon-open">▼</span>'+
		'<span class="pagelayer-elp-icon-close" '+(pagelayer_empty(sel_name)? 'style="display:none"': '')+'><b>&times;&nbsp;</b></span>'+
	'</div>';
	
	row.append(div);
	
	// Make all icons list
	var html = '<div class="pagelayer-elp-icon-selector">';
	
	if(pagelayer_loaded_icons.length > 1){
		html += '<select class="pagelayer-elp-icon-sets">'+sets_html+'</select>';
	}
	
	html += '<span class="pagelayer-elp-icon-type">'+
		'<p data-tab="fas" class="active">'+pagelayer_l('Solid')+'</p>'+
		'<p data-tab="far">'+pagelayer_l('Regular')+'</p>'+
		'<p data-tab="fab">'+pagelayer_l('Brand')+'</p>'+
	'</span>'+
	'<input type="text" class="pagelayer-elp-search-icon" name="search-icon" placeholder="'+pagelayer_l('search')+'">'+
	'<div class="pagelayer-elp-icon-list">';

	for(var y in icons[cur_icon_set]){
		//console.log(icons[x][y])
		for(var z in icons[cur_icon_set][y]['icons']){
			html += icon_html(icons[cur_icon_set][y]['icons'][z], y);
		}
	}
	
	html += '</div>'+
	'</div>';
	
	row.append(html);
	
	// Open the selector
	row.find('.pagelayer-elp-icon-div').on('click', function(){
		row.find('.pagelayer-elp-icon-selector').slideToggle();
	});
	
	/*// When the set changes
	row.find('.pagelayer-elp-icon-sets').on('change', function(){
		var v = cur_icon_set = jQuery(this).val();
		var span = '';
		
		for(var x in icons[v]){
		
			for(var z in icons[v][x]['icons']){
				span += icon_html(icons[v][x]['icons'][z], x);
			}
			
		}
		
		if(cur_icon_set == 'font-awesome5'){
			row.find('.pagelayer-elp-icon-type').show();
			sorted_icons = icons[cur_icon_set]['fas'];
			row.find('.pagelayer-elp-icon-type [data-tab="fas"]').click();
		}else{
			row.find('.pagelayer-elp-icon-type').hide();
		}
		
		row.find('.pagelayer-elp-icon-list').empty().html(span);
		
		if(row.find('.pagelayer-elp-search-icon').val() != ''){
			row.find('.pagelayer-elp-search-icon').keyup();
		}
		
	});*/
	
	// Handle type of icon
	row.find('.pagelayer-elp-icon-type p').on('click', function(){		
		jQuery(this).toggleClass('active');
		row.find('.pagelayer-elp-search-icon').keyup();
	});
	
	// Handle search of icon
	row.find('.pagelayer-elp-search-icon').on('keyup', function(){
	
		var v = this.value;
		var span = '';
		v = v.toLowerCase();
		v = v.replace(/\s+/g, '-');
		//console.log(sorted_icons);
		
		row.find('.pagelayer-elp-icon-type p.active').each(function(){				
			var tab = jQuery(this).data('tab');
			tab = tab.toLowerCase();
			
			var cat = icons['font-awesome5'][tab]['icons'];
			
			for(var x in cat){
				if(cat[x].includes(v) || v.length < 1){
					span += icon_html(cat[x], tab);
				}
			}
		});
		
		row.find('.pagelayer-elp-icon-list').empty().html(span);
		
	});
	
	// Handle click within the icon selector
	row.find('.pagelayer-elp-icon-list').on('click', function(e){
		
		var jEle = jQuery(e.target);
		var i = jEle.children().attr('class');
		var name = jEle.children().attr('icon');
		
		if(pagelayer_empty(name)){
			return false;
		}
		
		// Set the icon in this list
		row.find('.pagelayer-elp-icon-preview').html('<i class="'+i+'"></i><span class="pagelayer-elp-icon-name">'+name+'</span>');
		row.find('.pagelayer-elp-icon-selector').slideUp();
		
		_pagelayer_set_atts(row, i);// Save and Render
		
		row.find('.pagelayer-elp-icon-close').show();
		return false;
		
	});
	
	// Delete the icon
	row.find('.pagelayer-elp-icon-close').on('click', function(){
		
		// Set the icon in this list
		row.find('.pagelayer-elp-icon-preview').html('<i class=""></i><span class="pagelayer-elp-icon-name">'+pagelayer_l('choose_icon')+'</span>');
		
		// Save and Render
		_pagelayer_set_atts(row, '');
		jQuery(this).hide();
		return false;
	});
	
}

// The Access Property
function pagelayer_elp_access(row, prop){
	
	var div = '<div class="pagelayer-elp-access-div">'+
		'<span class="pagelayer-elp-access"><i class="pli pli-caret-right" ></i></span>'+
		'<div class="pagelayer-elp-access-holder"></div>'+
	'</div>';
	
	row.append(div);
	
	var holder = row.find('.pagelayer-elp-access-holder');
	
	row.find('.pagelayer-elp-access').on('click', function(){
		
		// Setup first
		if(holder.children().length < 1){
			var p = row.parent().find('[pagelayer-access-item='+prop.show_group+']').detach();
			p.appendTo(holder);
			p.addClass('pagelayer-access-item-visible');
		}
		
		// Show and hide
		if(holder.is(':visible')){
			holder.hide();
			row.find('.pli-caret-right').removeClass('pli-caret-open');
		}else{
			holder.show();
			row.find('.pli-caret-right').addClass('pli-caret-open');
		}
	});
	
};

// The Modal Property
function pagelayer_elp_modal(row, prop){
	
	var style = pagelayer_empty(prop.width) ? '' : 'style="width:'+prop.width+'"';
	
	var div = '<div class="pagelayer-elp-modal-div">'+
		'<span class="pagelayer-elp-modal"><i class="pli pli-window" ></i></span>'+
		'<div class="pagelayer-elp-modal-wrapper">'+
			'<div class="pagelayer-elp-modal-wrap" '+style+'>'+
				'<div class="pagelayer-elp-modal-header">'+
					prop.label +'<i class="pagelayer-elp-modal-close pli pli-cross" aria-hidden="true"></i>'+
				'</div><hr>'+
				'<div class="pagelayer-elp-modal-holder"></div>'+
			'</div>'+
		'</div>'+
	'</div>';
	
	row.append(div);
	
	var wrapper = row.find('.pagelayer-elp-modal-wrapper');
	var holder = row.find('.pagelayer-elp-modal-holder');
	
	row.find('.pagelayer-elp-modal').on('click', function(){
		
		// Setup first
		if(holder.children().length < 1){
			
			var p = row.parent().find('[pagelayer-access-item='+prop.show_group+']').detach();
			p.appendTo(holder);
			p.addClass('pagelayer-access-item-visible');
		}
		
		// Show and hide
		wrapper.show();
		
	});
	
	// Close Modal Property
	row.find('.pagelayer-elp-modal-close').on('click', function(){
		wrapper.hide();
	});
	
	// On click Pagelayer setting icon
	wrapper.on('click', function(event){
		var target = jQuery(event.target);
		
		if(target.closest('.pagelayer-elp-modal-wrap').length > 0){
			return;
		}
		
		wrapper.hide();
	});
  
};

// The Color Property
function pagelayer_elp_color(row, prop){
	
	var div = '<div class="pagelayer-elp-color-div">'+
		'<div class="pagelayer-elp-color-preview"></div>'+
		'<span class="pagelayer-elp-remove-color"><i class="pli pli-cross" ></i></span>'+
	'</div>';
	
	row.append(div);
	
	row.find('.pagelayer-elp-color-preview').css('background', prop.c['val']);
	
	var picker = new pagelayer_Picker({
		parent : row.find('.pagelayer-elp-color-div')[0],
		popup : 'left',
		color : prop.c['val'],
		doc: window.parent.document
	});
	
	var preview = row.find('.pagelayer-elp-color-preview');
	
	// If no val, then set blank
	if(pagelayer_empty(prop.c['val'])){
		preview.addClass('pagelayer-blank-preview');
	}
	
	var handle_white = function(col){	
		if(col.charAt(1) == 'f'){
			preview.addClass('pagelayer-white-border');
		}else{
			preview.removeClass('pagelayer-white-border');
		}
	}
	
	handle_white(prop.c['val']);
	
	// Handle selected color
	picker.onChange = function(color) {		
		preview.removeClass('pagelayer-blank-preview').css('background', color.rgbaString);
		handle_white(color.hex);
		_pagelayer_set_atts(row, color.hex);// Save and Render
	};
	
	picker.onOpen = picker.onChange;
	
	row.find('.pagelayer-elp-remove-color').on('click', function(event){
		event.stopPropagation();
		picker.setColor(prop.default, true);
		preview.addClass('pagelayer-blank-preview');		
		handle_white('');
		_pagelayer_set_atts(row, ' ');// Save and Render
	});
	
}

// The Spinner property
function pagelayer_elp_spinner(row, prop){
	
	var div = '<div class="pagelayer-elp-spinner-div">'+
				'<input type="number" class="pagelayer-elp-spinner" name="'+prop.c['name']+'"'+
				' min="'+prop['min']+'" max="'+prop['max']+'" step="'+prop['step']+'" value="'+parseFloat(prop.c['val'])+'"/>'+
			'</div>';
			
	row.append(div);
	
	row.find('input').on('input', function(){
		var value = parseFloat(this.value);
		var max = parseFloat(this.max);
		
		if(!pagelayer_empty(max) && value > max){
			value = max;
		}
		_pagelayer_set_atts(row, value);// Save and Render
	});
	
}

// The Group Property
function pagelayer_elp_group(row, prop){
	
	var btnHidden = '';
	
	// Hide button, clone and delete
	if(!pagelayer_empty(prop['hide'])){
		btnHidden = 'pagelayer-hidden';
	}
	
	// Remove the pagelayer-show-tab
	row.removeAttr('pagelayer-show-tab');
	
	var div = '<div class="pagelayer-elp-group-div"></div>'+
			'<center><button class="pagelayer-elp-button '+btnHidden+'">'+prop['text']+'</button></center>';
	
	row.append(div);
	
	// Add button
	var add_item = function(row){
		
		var ele_id = row.closest('[pagelayer-element-id]').attr('pagelayer-element-id') || '';
		var pEle = jQuery('[pagelayer-id="'+ele_id+'"]');
		
		// First add the element inside the group element
		var id = pagelayer_element_add_child(pEle, prop['sc']);
		//pagelayer_element_setup('[pagelayer-id='+id+']', true);
		
		show_item(id);
	
	};
	
	// Show the properties of the existing things
	var show_item = function(id, sel){
		
		// To append after an existing item
		sel = sel || false;
		
		// If pagelayer id empty then return
		if(pagelayer_empty(id)){
			return false;
		}
		
		// Since the element is added very fast, we reselect via jQuery for it to re-access the dom
		jEle = jQuery('[pagelayer-id="'+id+'"]');
		
		var label_param = prop['item_label']['param'] || '';
		var title = pagelayer_get_att(jEle, label_param) || prop['item_label']['default'];
		
		// We need to get the correct value for select based params which are the label
		var child_props = pagelayer_shortcodes[prop.sc];
		for(var section in child_props){
			for(var _param in child_props[section]){
				if(child_props[section][_param]['type'] == 'select'){
					if(title in child_props[section][_param]['list']){
						title = child_props[section][_param]['list'][title];
					}
				}
			}
		}
		
		// Create the HTML
		var holder = jQuery('<div class="pagelayer-elp-group-item" pagelayer-group-item-id="'+id+'">'+
				'<div class="pagelayer-elp-group-item-head">'+
					'<span class="pagelayer-elp-group-item-drag"><i class="pli pli-menu" ></i></span>'+
					'<span class="pagelayer-elp-group-item-title">'+title+'</span>'+
					'<span class="pagelayer-elp-group-item-clone '+btnHidden+'"><i class="pli pli-clone" ></i></span>'+
					'<span class="pagelayer-elp-group-item-del '+btnHidden+'"><i class="pli pli-trashcan" ></i></span>'+
				'</div>'+
				'<div class="pagelayer-elp-group-item-body"></div>'+
			'</div>');
		
		// Append to the row
		if(sel){
			row.find(sel).after(holder);
		}else{
			row.find('.pagelayer-elp-group-div').first().append(holder);
		}
		
		// Setup the toggle
		holder.find('.pagelayer-elp-group-item-title').first().on('click', function(){
			var rEle = holder.find('.pagelayer-elp-group-item-body').first();
			var r_id = holder.attr('pagelayer-group-item-id');
			
			// If the props are not already setup
			if(rEle.html().length < 1){
			
				pagelayer_elpd_generate(jQuery('[pagelayer-id="'+r_id+'"]'), rEle);
				
				// Change the group item title
				var tmp_title = holder.find('[pagelayer-elp-name="'+label_param+'"] [name="'+label_param+'"]');
		
				if(tmp_title.length > 0){
					jQuery(tmp_title).on('input', function(){						
						holder.find('.pagelayer-elp-group-item-title').html(tmp_title.val());
					});
				}
				
			}
			
			rEle.toggle('slow');
		});
		
		// Clone the item
		holder.find('.pagelayer-elp-group-item-head .pli-clone').on('click', function(){
			
			// If the element have any parent
			var jEle = jQuery('[pagelayer-id="'+id+'"]');
			var par = pagelayer_get_parent(jEle);
			var clone_ele = pagelayer_copy_element(jEle);
			//console.log(clone_ele);console.log('[pagelayer-group-item-id="'+id+'"]');
			show_item(clone_ele, '[pagelayer-group-item-id="'+id+'"]');
			
			if(par){
				pagelayer_sc_render(pagelayer_ele_by_id(par));
			}
		});
		
		// Delete the item
		holder.find('.pagelayer-elp-group-item-head .pli-trashcan').on('click', function(){
			
			// If the element have any parent
			var jEle = jQuery('[pagelayer-id="'+id+'"]');
			var par = pagelayer_get_parent(jEle);
			holder.remove();
			pagelayer_delete_element(jEle);
			
			if(par){
				pagelayer_sc_render(pagelayer_ele_by_id(par));
			}
		});
		
	};
		
	// Setup the drag
	pagelayer.$$(".pagelayer-elp-group-div").sortable({
		axis: 'y',
		nested : false,
		vertical : true,
		handle : ".pagelayer-elp-group-item-drag",
		start : function(event, ui) {
			var start_pos = ui.item.index();
			ui.item.data('start_pos', start_pos);
		},
		stop : function(event, ui){
			var end_pos = ui.item.index();
			var id = jQuery(ui.item).closest('[pagelayer-group-item-id]').attr('pagelayer-group-item-id');
			var jEle = jQuery('[pagelayer-id="'+id+'"]');
			pagelayer_moving_element(jEle, ui.item.data('start_pos'), end_pos);
			var par = pagelayer_get_parent(jEle);				
			if(par){
				pagelayer_sc_render(pagelayer_ele_by_id(par));
			}
		}
	});
	
	// Handle click of the group
	row.find('.pagelayer-elp-button').on('click', function(){
		if('pro' in prop && pagelayer_empty(pagelayer_pro)){
			pagelayer_pro_notice();
			return;
		}
		add_item(row);
	});
	
	// Find the existing items
	prop.el.$.find('[pagelayer-tag='+prop['sc']+']').each(function(){
		var jEle = jQuery(this);
		var id = pagelayer_assign_id(jEle);
		show_item(id);
	});
};

function pagelayer_pro_notice(){
	var div = pagelayer.$$('.pagelayer-pro-notice');
	
	div.find('.pagelayer-pro-x').click(function(){
		div.hide();
	});
	
	div.show();
}

// Moving an element
function pagelayer_moving_element(jEle, start_pos, end_pos){	
	if(start_pos==end_pos){
		return;
	}
	
	var id = pagelayer_assign_id(jEle);

	// Is there a wrap
	var wrap = pagelayer_wrap_by_id(id);

	var par = wrap.parent();
	var children = par.children("div");	
	
	var element = children.eq(start_pos).detach();
	if(end_pos < start_pos){
		children.eq(end_pos).before(element);
	}else{
		children.eq(end_pos).after(element);
	}		
}

// The Datetime Property
function pagelayer_elp_datetime(row, prop){
		
	var div = '<div class="pagelayer-elp-datetime-div">'+
				'<input type="date" class="pagelayer-elp-datetime" name="'+prop.c['name']+'" value="'+prop.c['val']+'" />'+
        '</div>';
	
	row.append(div);
	
	row.find('.pagelayer-elp-datetime').on('change', function(){
		_pagelayer_set_atts(row, jQuery(this).val());// Save and Render
	});
	
};

// The padding property
function pagelayer_elp_padding(row, prop){
	var val = ['', '', '', ''];
	
	if(prop.c['val'].length > 0){
		val = prop.c['val'].split(',');
		//console.log(val)
	}
	
	var div = '<div class="pagelayer-elp-padding-div">'+
				'<input type="number" class="pagelayer-elp-padding" value="'+parseFloat(val[0])+'"></input>'+
				'<input type="number" class="pagelayer-elp-padding" value="'+parseFloat(val[1])+'"></input>'+
				'<input type="number" class="pagelayer-elp-padding" value="'+parseFloat(val[2])+'"></input>'+
				'<input type="number" class="pagelayer-elp-padding" value="'+parseFloat(val[3])+'"></input>'+
				'<i class="pli pli-link" ></i>'+
			'</div>';
	
	row.append(div);
	
	// Is the value linked ?
	var link = row.find('.pagelayer-elp-padding-div i');
	var isLinked = 1;
	//isLinked = isLinked == 2 ? false : true;
	//console.log(isLinked);
	var tmp_val = val[0];
	
	for(var p_val in val){

		// Check if unlinked
		if(tmp_val != val[p_val] ){
			isLinked = 0;
		}
		tmp_val = val[p_val];
	}
	
	if(isLinked){
		link.addClass('pagelayer-elp-padding-linked');
	}else{
		link.removeClass('pagelayer-elp-padding-linked');
	}
	
	// Handle link on click
	link.on('click', function(){
		
		var linked = link.hasClass('pagelayer-elp-padding-linked');
		
		if(linked){
			link.removeClass('pagelayer-elp-padding-linked');
		}else{
			link.addClass('pagelayer-elp-padding-linked');
		}
		
	});
	
	row.find('input').on('input', function(){
		
		// Are the values linked
		var linked = row.find('.pagelayer-elp-padding-div .pli').hasClass('pagelayer-elp-padding-linked');
		
		if(linked){
			var val = jQuery(this).val();
			row.find('input').each(function(){
				jQuery(this).val(val);
			});
		}
		
		var vals = [];
		
		// Get all values
		row.find('input').each(function(){
			var val = jQuery(this).val();
			vals.push(val ? val : 0);
		});
		
		_pagelayer_set_atts(row, vals);// Save and Render
	});
	
};

// The shadow property
function pagelayer_elp_shadow(row, prop){
	
	var val =['','','',''];
	
	// Do we have a val ?
	if(!pagelayer_empty(prop.c['val'])){
		val = prop.c['val'].split(',');
	}
	
	//var val = {color: '', blur: '', horizontal: '', vertical: ''};
	
	var div = '<span class="pagelayer-prop-edit"><i class="pli pli-pencil"></i></span>'+
		'<div class="pagelayer-elp-shadow-div">'+
		'<div class="pagelayer-elp-prop-grp pagelayer-elp-shadow-horizontal">'+
			'<label class="pagelayer-elp-label">Horizontal</label>'+
			'<input class="pagelayer-elp-shadow-input" type="number" max="100" min="-100" step="1" class="pagelayer-elp-shadow-blur" value="'+val[0]+'"></input>'+
		'</div>'+
		'<div class="pagelayer-elp-prop-grp pagelayer-elp-shadow-vertical">'+
			'<label class="pagelayer-elp-label">Vertical</label>'+
			'<input class="pagelayer-elp-shadow-input" type="number" max="100" min="-100" step="1" class="pagelayer-elp-shadow-blur" value="'+val[1]+'"></input>'+
		'</div>'+
		'<div class="pagelayer-elp-prop-grp pagelayer-elp-shadow-blur">'+
			'<label class="pagelayer-elp-label">Blur</label>'+
			'<input class="pagelayer-elp-shadow-input" type="number" max="100" min="0" step="1" class="pagelayer-elp-shadow-blur" value="'+val[2]+'"></input>'+
		'</div>'+
		'<div class="pagelayer-elp-prop-grp pagelayer-elp-shadow-color">'+
			'<label class="pagelayer-elp-label">Color</label>'+
			'<div class="pagelayer-elp-color-div">'+
				'<div class="pagelayer-elp-color-preview"></div>'+
				'<span class="pagelayer-elp-remove-color"><i class="pli pli-cross" ></i></span>'+
			'</div>'+
		'</div>'+
	'</div>';
			
	row.append(div);
	
	row.find('.pagelayer-prop-edit').on('click', function(){
		row.find('.pagelayer-elp-shadow-div').toggleClass('pagelayer-prop-show');
	});
	
	var preview = row.find('.pagelayer-elp-color-preview');	
	preview.css('background', val[3]);
	
	var picker = new pagelayer_Picker({
		parent : row.find('.pagelayer-elp-color-div')[0],
		popup : 'left',
		color : val[3],
		doc: window.parent.document
	});
	
	// If no val, then set blank
	if(pagelayer_empty(val[3])){
		preview.addClass('pagelayer-blank-preview');
	}
	
	var handle_white = function(col){	
		if(col.charAt(1) == 'f'){
			preview.addClass('pagelayer-white-border');
		}else{
			preview.removeClass('pagelayer-white-border');
		}
	}
	
	handle_white(val[3]);
	
	// Handle selected color
	picker.onChange = function(color) {
		preview.removeClass('pagelayer-blank-preview').css('background', color.rgbaString);
		handle_white(color.hex);
		val[3] = (color.hex ? color.hex : '');
		_pagelayer_set_atts(row, val);
	};
	
	// Remove Color
	row.find('.pagelayer-elp-remove-color').on('click', function(event){
		event.stopPropagation();
		picker.setColor(prop.default, true);
		preview.addClass('pagelayer-blank-preview');		
		handle_white('');
		val[3] = '';
		_pagelayer_set_atts(row, val);
	});
	
	row.find('input').on('input', function(){
		var i = 0;
		row.find('.pagelayer-elp-shadow-input').each(function(){
			var value = jQuery(this).val();
			val[i] = (value ? value : '');
			i++;
		});
		_pagelayer_set_atts(row, val);
	});
	
}

// The box shadow property
function pagelayer_elp_box_shadow(row, prop){
	
	var val = ['','','','','',''];
	
	// Do we have a val ?
	if(!pagelayer_empty(prop.c['val'])){
		val = prop.c['val'].split(',');
	}
	
	var val_pos = ['horizontal','vertical','blur','color','spread','inset'];
	
	var div = '<span class="pagelayer-prop-edit"><i class="pli pli-pencil"></i></span>'+
		'<div class="pagelayer-elp-shadow-div">'+
		'<div class="pagelayer-elp-prop-grp pagelayer-elp-shadow-horizontal">'+
			'<label class="pagelayer-elp-label">Horizontal</label>'+
			'<input class="pagelayer-elp-shadow-input" type="number" max="100" min="-100" step="1" class="pagelayer-elp-shadow-blur" name="horizontal" value="'+val[0]+'"></input>'+
		'</div>'+
		'<div class="pagelayer-elp-prop-grp pagelayer-elp-shadow-vertical">'+
			'<label class="pagelayer-elp-label">Vertical</label>'+
			'<input class="pagelayer-elp-shadow-input" type="number" max="100" min="-100" step="1" class="pagelayer-elp-shadow-blur" name="vertical" value="'+val[1]+'"></input>'+
		'</div>'+
		'<div class="pagelayer-elp-prop-grp pagelayer-elp-shadow-blur">'+
			'<label class="pagelayer-elp-label">Blur</label>'+
			'<input class="pagelayer-elp-shadow-input" type="number" max="100" min="0" step="1" class="pagelayer-elp-shadow-blur" name="blur" value="'+val[2]+'"></input>'+
		'</div>'+
		'<div class="pagelayer-elp-prop-grp pagelayer-elp-shadow-spread">'+
			'<label class="pagelayer-elp-label">Spread</label>'+
			'<input class="pagelayer-elp-shadow-input" type="number" max="100" min="0" step="1" class="pagelayer-elp-shadow-spread" name="spread" value="'+(val[4] ? val[4] : 0 )+'"></input>'+
		'</div>'+
		'<div class="pagelayer-elp-prop-grp pagelayer-elp-shadow-color">'+
			'<label class="pagelayer-elp-label">Color</label>'+
			'<div class="pagelayer-elp-color-div">'+
				'<div class="pagelayer-elp-color-preview"></div>'+
				'<span class="pagelayer-elp-remove-color"><i class="pli pli-cross" ></i></span>'+
			'</div>'+
		'</div>'+
		'<div class="pagelayer-elp-prop-grp pagelayer-elp-shadow-inset">'+
			'<label class="pagelayer-elp-label">Shadow</label>'+
			'<select class="pagelayer-elp-shadow-input pagelayer-elp-select" name="inset" type="checkbox" class="pagelayer-elp-shadow-inset">'+
				'<option value="">Outset</option>'+
				'<option value="inset"'+(pagelayer_empty(val[5]) ? '' : ' selected' )+'>Inset</option>'+
			'</select>'+
		'</div>'+
	'</div>';
			
	row.append(div);
	
	row.find('.pagelayer-prop-edit').on('click', function(){
		row.find('.pagelayer-elp-shadow-div').toggleClass('pagelayer-prop-show');
	});
	
	var preview = row.find('.pagelayer-elp-color-preview');	
	preview.css('background', val[3]);
	
	var picker = new pagelayer_Picker({
		parent : row.find('.pagelayer-elp-color-div')[0],
		popup : 'left',
		color : val[3],
		doc: window.parent.document
	});
	
	// If no val, then set blank
	if(pagelayer_empty(val[3])){
		preview.addClass('pagelayer-blank-preview');
	}
	
	var handle_white = function(col){	
		if(col.charAt(1) == 'f'){
			preview.addClass('pagelayer-white-border');
		}else{
			preview.removeClass('pagelayer-white-border');
		}
	}
	
	handle_white(val[3]);
	
	// Handle selected color
	picker.onChange = function(color) {
		row.find('.pagelayer-elp-color-preview').removeClass('pagelayer-blank-preview').css('background', color.rgbaString);
		handle_white(color.hex);
		val[3] = (color.hex ? color.hex : '');
		_pagelayer_set_atts(row, val);
	};
	
	// Remove Color
	row.find('.pagelayer-elp-remove-color').on('click', function(event){
		event.stopPropagation();
		picker.setColor(prop.default, true);
		preview.addClass('pagelayer-blank-preview');		
		handle_white('');
		val[3] = '';
		_pagelayer_set_atts(row, val);
	});
	
	// Onchange set props
	row.find('.pagelayer-elp-shadow-input').on('input change', function(){
		//var i = 0;
		row.find('.pagelayer-elp-shadow-input').each(function(){
			var value = jQuery(this).val();
			var name = jQuery(this).attr('name');
			val[val_pos.indexOf(name)] = (value ? value : '');
			//i++;
		});
		_pagelayer_set_atts(row, val);
	});
	
}

// The filter property
function pagelayer_elp_filter(row, prop){
	
	var val = [0,100,100,0,0,100,100];
	
	// Do we have a val ?
	if(!pagelayer_empty(prop.c['val'])){
		val = prop.c['val'].split(',');
	}
	
	var filters = [['blur','10','0.1'],['brightness','200','1'],['contrast','200','1'],['grayscale','200','1'],['hue','360','1'],['opacity','100','1'],['saturate','200','1']];
	
	var div = '<span class="pagelayer-prop-edit"><i class="pli pli-pencil"></i></span>'+
		'<div class="pagelayer-elp-filter-div">';
		
		jQuery.each(val,function(key, value){
			div += '<div class="pagelayer-elp-prop-grp pagelayer-elp-filter-'+filters[key][0]+'">'+
				'<label class="pagelayer-elp-label">'+filters[key][0]+'</label>'+
				'<input class="pagelayer-elp-slider pagelayer-elp-filter-input" type="range" max="'+filters[key][1]+'" min="0" step="'+filters[key][2]+'" class="pagelayer-elp-filter-'+filters[key][0]+'" value="'+value+'"></input>'+
				'<span class="pagelayer-elp-filter-val">'+value+'</span>'+
			'</div>';
		});
		
	div += '</div>';
			
	row.append(div);
	
	row.find('.pagelayer-prop-edit').on('click', function(){
		row.find('.pagelayer-elp-filter-div').toggleClass('pagelayer-prop-show');
	});
	
	row.find('input').on('input', function(){
		var val = [];
		jQuery(this).parent().find('span').html(this.value);
		row.find('.pagelayer-elp-filter-input').each(function(){
			var value = jQuery(this).val();
			val.push(value ? value : 'none');
		});
		_pagelayer_set_atts(row, val);
	});
	
}

// The gradient property
function pagelayer_elp_gradient(row, prop){
	
	var val =['','','','','','',''];
	
	// Do we have a val ?
	if(!pagelayer_empty(prop.c['val'])){
		val = prop.c['val'].split(',');
	}
	
	//var val = {color: '', blur: '', horizontal: '', vertical: ''};
	
	var div = '<div class="pagelayer-elp-gradient-div">'+
		'<div class="pagelayer-elp-prop-grp pagelayer-elp-gradient-angle">'+
			'<label class="pagelayer-elp-label">Angle</label>'+
			'<input class="pagelayer-elp-gradient-input" type="number" max="360" min="0" step="1" class="pagelayer-elp-gradient-angle" value="'+val[0]+'"></input>'+
		'</div>'+
		'<div class="pagelayer-elp-prop-grp pagelayer-elp-gradient-color">'+
			'<label class="pagelayer-elp-label">Color 1</label>'+
			'<div class="pagelayer-elp-color-div">'+
				'<div class="pagelayer-elp-gradient-color1 pagelayer-elp-color-preview"></div>'+
			'</div>'+
		'</div>'+
		'<div class="pagelayer-elp-prop-grp pagelayer-elp-gradient-per1">'+
			'<label class="pagelayer-elp-label">Percentage 1</label>'+
			'<input class="pagelayer-elp-gradient-input" type="number" max="100" min="-100" step="1" class="pagelayer-elp-gradient-per1" value="'+val[2]+'"></input>'+
		'</div>'+
		'<div class="pagelayer-elp-prop-grp pagelayer-elp-gradient-color">'+
			'<label class="pagelayer-elp-label">Color 2</label>'+
			'<div class="pagelayer-elp-color-div">'+
				'<div class="pagelayer-elp-gradient-color2 pagelayer-elp-color-preview"></div>'+
			'</div>'+
		'</div>'+
		'<div class="pagelayer-elp-prop-grp pagelayer-elp-gradient-per2">'+
			'<label class="pagelayer-elp-label">Percentage 2</label>'+
			'<input class="pagelayer-elp-gradient-input" type="number" max="100" min="0" step="1" class="pagelayer-elp-gradient-per2" value="'+val[4]+'"></input>'+
		'</div>'+
		'<div class="pagelayer-elp-prop-grp pagelayer-elp-gradient-color">'+
			'<label class="pagelayer-elp-label">Color 3</label>'+
			'<div class="pagelayer-elp-color-div">'+
				'<div class="pagelayer-elp-gradient-color3 pagelayer-elp-color-preview"></div>'+
			'</div>'+
		'</div>'+
		'<div class="pagelayer-elp-prop-grp pagelayer-elp-gradient-per3">'+
			'<label class="pagelayer-elp-label">Percentage 3</label>'+
			'<input class="pagelayer-elp-gradient-input" type="number" max="100" min="0" step="1" class="pagelayer-elp-gradient-per3" value="'+val[6]+'"></input>'+
		'</div>'+
	'</div>';
			
	row.append(div);
	var i = 1;
	row.find('.pagelayer-elp-color-preview').each(function(){
		jQuery(this).css('background', val[i]);
		i = i+2;
	});
	
	var picker1 = new pagelayer_Picker({
		parent : row.find('.pagelayer-elp-gradient-color1')[0],
		popup : 'left',
		color : val[1],
		doc: window.parent.document
	});
	
	// Handle selected color
	picker1.onChange = function(color) {
		row.find('.pagelayer-elp-gradient-color1').css('background', color.rgbaString);
		val[1] = (color.hex ? color.hex : '');
		_pagelayer_set_atts(row, val);
	};
	
	var picker2 = new pagelayer_Picker({
		parent : row.find('.pagelayer-elp-gradient-color2')[0],
		popup : 'left',
		color : val[3],
		doc: window.parent.document
	});
	
	// Handle selected color
	picker2.onChange = function(color) {
		row.find('.pagelayer-elp-gradient-color2').css('background', color.rgbaString);
		val[3] = (color.hex ? color.hex : '');
		_pagelayer_set_atts(row, val);
	};
	
	var picker3 = new pagelayer_Picker({
		parent : row.find('.pagelayer-elp-gradient-color3')[0],
		popup : 'left',
		color : val[5],
		doc: window.parent.document
	});
	
	// Handle selected color
	picker3.onChange = function(color) {
		row.find('.pagelayer-elp-gradient-color3').css('background', color.rgbaString);
		val[5] = (color.hex ? color.hex : '');
		_pagelayer_set_atts(row, val);
	};
	
	row.find('input').on('input', function(){
		var i = 0;
		row.find('.pagelayer-elp-gradient-input').each(function(){
			var value = jQuery(this).val();
			val[i] = (value ? value : '');
			i = i+2;
		});
		_pagelayer_set_atts(row, val);
	});
	
}

function pagelayer_elp_font_family(row, prop){
	
	var options = '';
	var option = function(val, lang){
		var selected = (val != prop.c['val']) ? '' : 'selected="selected"';
		var lang = pagelayer_empty(val) ? 'Default' : val;
		return '<option class="pagelayer-elp-select-option" value="'+val+'" '+selected+'>'+lang+'</option>';
	}
	
	for (x in pagelayer_fonts){
		options += option(pagelayer_fonts[x], pagelayer_fonts[x]);
	}
	
	var div = '<div class="pagelayer-elp-select-div pagelayer-elp-pos-rel">'+
				'<select class="pagelayer-elp-select pagelayer-select" name="'+prop.c['name']+'">'+options+'</select>'+
  '</div>';
			
	row.append(div);
	
	row.find('select').on('change', function(){
		
		var sEle = jQuery(this);
		var value = sEle.val();
		
		if(sEle.val() == 'Default'){
			return;
		}
		
		value = value.replace(' ', '+');
		
		if(jQuery('#pagelayer-google-fonts').length == 0){
			
			jQuery('head').append('<link id="pagelayer-google-fonts" href="https://fonts.googleapis.com/css?family='+value+':100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">');
			
		}else{
			
			var url = jQuery('#pagelayer-google-fonts').attr('href');
			if(url.indexOf(value) == -1){
				url = url+'|'+value+':100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i';
				jQuery('#pagelayer-google-fonts').attr('href', url);
			}
			
		}
		
		_pagelayer_set_atts(row, sEle.val());// Save and Render		
	
	});
	
}

// The typography property
function pagelayer_elp_typography(row, prop){
	
	var val =['','','','','','','','','',''];
	
	// Do we have a val ?
	if(!pagelayer_empty(prop.c['val'])){
		val = prop.c['val'].split(',');
	}
	
	var select = { 'style' : ['', 'Normal', 'Italic', 'Oblique'],
		'weight' : ['', '100', '200', '300', '400', '500', '600', '700', '800', '900', 'normal', 'lighter', 'bold', 'bolder', 'unset'],
		'variant' : ['', 'Normal', 'Small-caps'],
		'deco-line' : ['', 'None', 'Overline', 'Line-through', 'Underline', 'Underline Overline'],
		'deco-style' : ['Solid', 'Double', 'Dotted', 'Dashed', 'Wavy'],
		'transform' : ['', 'Capitalize', 'Uppercase', 'Lowercase'],
		'fonts' : pagelayer_fonts,
	}
	
	var option = function(val, setVal){
		var selected = (val != setVal) ? '' : 'selected="selected"';
		var lang = pagelayer_empty(val) ? 'Default' : val;
		return '<option value="'+val+'" '+selected+'>'+ lang +'</option>';
	}
	
	var font_option = function(val, setVal){
		var selected = (val != setVal) ? '' : 'selected="selected"';
		var lang = pagelayer_empty(val) ? 'Default' : val;
		return '<span value="'+val+'" '+selected+'>'+ lang +'</span>';
	}
	
	var div = '<span class="pagelayer-prop-edit"><i class="pli pli-pencil"></i></span>'+
		'<div class="pagelayer-elp-typo-div">'+
		'<div class="pagelayer-elp-typo pagelayer-elp-typo-fonts">'+
			'<label class="pagelayer-elp-label">'+pagelayer_l('font_family')+'</label>'+
			'<div class="pagelayer-elp-typo-sele" data-val="'+val[0]+'">'+val[0]+'</div>'+
			'<div class="pagelayer-ele-type-sec">'+
			'<input class="pagelayer-elp-typo-search" placeholder="Search here..."></input>'+
			'<div class="pagelayer-elp-typo-container">';
	
	jQuery.each(select['fonts'],function(key, value){
		div += font_option(value, val[0]);
	});
	
	div +='</div></div>'+
		'</div>'+
		'<div class="pagelayer-elp-typo pagelayer-elp-typo-size">'+
			'<label class="pagelayer-elp-label">'+pagelayer_l('font_size')+'</label>'+
			'<input class="pagelayer-elp-typo-input" type="number" max="200" min="0" step="1" value="'+val[1]+'"></input>'+
		'</div>'+
		'<div class="pagelayer-elp-typo pagelayer-elp-typo-style">'+
			'<label class="pagelayer-elp-label">'+pagelayer_l('font_style')+'</label>'+
			'<select class="pagelayer-elp-typo-input pagelayer-elp-select">';
	
	jQuery.each(select['style'],function(key, value){
		div += option(value, val[2]);
	});
			div +='</select>'+
		'</div>'+
		'<div class="pagelayer-elp-typo pagelayer-elp-typo-weight">'+
			'<label class="pagelayer-elp-label">'+pagelayer_l('font_weight')+'</label>'+
			'<select class="pagelayer-elp-typo-input pagelayer-elp-select">';
	jQuery.each(select['weight'],function(key, value){
		div += option(value, val[3]);
	});
			
			div += '</select>'+
		'</div>'+
		'<div class="pagelayer-elp-typo pagelayer-elp-typo-variant">'+
			'<label class="pagelayer-elp-label">'+pagelayer_l('font_variant')+'</label>'+
			'<select class="pagelayer-elp-typo-input pagelayer-elp-select">';
	jQuery.each(select['variant'],function(key, value){
		div += option(value, val[4]);
	});
				
			div += '</select>'+
		'</div>'+
		'<div class="pagelayer-elp-typo pagelayer-elp-typo-deco-line">'+
			'<label class="pagelayer-elp-label">'+pagelayer_l('decoration_line')+'</label>'+
			'<select class="pagelayer-elp-typo-input pagelayer-elp-select">';
	jQuery.each(select['deco-line'],function(key, value){
		div += option(value, val[5]);
	});
				
			div += '</select>'+
		'</div>'+
		'<div class="pagelayer-elp-typo pagelayer-elp-typo-deco-style">'+
			'<label class="pagelayer-elp-label">'+pagelayer_l('decoration_style')+'</label>'+
			'<select class="pagelayer-elp-typo-input pagelayer-elp-select">';
	jQuery.each(select['deco-style'],function(key, value){
		div += option(value, val[6]);
	});
				
			div += '</select>'+
		'</div>'+
		'<div class="pagelayer-elp-typo pagelayer-elp-typo-height">'+
			'<label class="pagelayer-elp-label">'+pagelayer_l('line_height')+'</label>'+
			'<input class="pagelayer-elp-typo-input" type="number" max="15" min="0" step="0.1" value="'+val[7]+'"></input>'+
		'</div>'+
		'<div class="pagelayer-elp-typo pagelayer-elp-typo-transform">'+
			'<label class="pagelayer-elp-label">'+pagelayer_l('text_transform')+'</label>'+
			'<select class="pagelayer-elp-typo-input pagelayer-elp-select">';
	jQuery.each(select['transform'],function(key, value){
		div += option(value, val[8]);
	});
				
			div += '</select>'+
		'</div>'+
		'<div class="pagelayer-elp-typo pagelayer-elp-typo-lspacing">'+
			'<label class="pagelayer-elp-label">'+pagelayer_l('text_spacing')+'</label>'+
			'<input class="pagelayer-elp-typo-input" type="number" max="10" min="-10" step="0.1" value="'+val[9]+'"></input>'+
		'</div>'+
		'<div class="pagelayer-elp-typo pagelayer-elp-typo-wspacing">'+
			'<label class="pagelayer-elp-label">'+pagelayer_l('word_spacing')+'</label>'+
			'<input class="pagelayer-elp-typo-input" type="number" max="50" min="0" step="1" value="'+val[10]+'"></input>'+
		'</div>'+
	'</div>';
			
	row.append(div);
	
	if(pagelayer_empty(val[5]) || val[5]=='none'){
		row.find('.pagelayer-elp-typo-deco-style').hide();
	}
	
	row.find('.pagelayer-prop-edit').on('click', function(){
		row.find('.pagelayer-elp-typo-div').toggleClass('pagelayer-prop-show');
	});
	
	row.find('.pagelayer-elp-typo-sele').on('click', function(){
		row.find('.pagelayer-ele-type-sec').slideToggle();
	});
	
	row.find('.pagelayer-elp-typo-container').on('click', function(e){
		var jEle = jQuery(e.target);
		var set_val = jEle.attr('value');
		row.find('.pagelayer-elp-typo-sele').data('val',set_val).html(set_val);
		row.find('.pagelayer-ele-type-sec').slideUp();
		val = [];
		val[0] = set_val;
		row.find('.pagelayer-elp-typo-input').each(function(){
			var value = jQuery(this).val();
			val.push(value ? value : '');
		});
		_pagelayer_set_atts(row, val);
	});
	
	row.find('.pagelayer-elp-typo-search').on('input', function(){
		var val = jQuery(this).val().toLowerCase();
		//console.log(val);
		var html = '';
		jQuery.each(select['fonts'],function(key, value){
			//value = value.toLowerCase();
			if(value.toLowerCase().includes(val)){
				html += font_option(value, val[0]);
			}
		});
		row.find('.pagelayer-elp-typo-container').html(html);
		
	});
	
	
	row.find('.pagelayer-elp-typo-input').on('change', function(){
		val = [];
		val[0] = row.find('.pagelayer-elp-typo-sele').data('val');
		row.find('.pagelayer-elp-typo-input').each(function(){
			var value = jQuery(this).val();
			val.push(value ? value : '');
		});
		_pagelayer_set_atts(row, val);
	});
	
	row.find('.pagelayer-elp-typo-container').on('click', function(e){
		var jEle = jQuery(e.target);
		var value = jEle.attr('value');
		value = value.replace(' ', '+');
		
		if(jQuery('#pagelayer-google-fonts').length == 0){
			
			jQuery('head').append('<link id="pagelayer-google-fonts" href="https://fonts.googleapis.com/css?family='+value+':100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">');
			
		}else{
			
			var url = jQuery('#pagelayer-google-fonts').attr('href');
			if(url.indexOf(value) == -1){
				url = url+'|'+value+':100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i';
				jQuery('#pagelayer-google-fonts').attr('href', url);
			}
			
		}
	
	});
	
	row.find('.pagelayer-elp-typo-deco-line select').on('change', function(){
		var value = jQuery(this).val();
		if(pagelayer_empty(value) || value=='none'){
			row.find('.pagelayer-elp-typo-deco-style').hide();
		}else{
			row.find('.pagelayer-elp-typo-deco-style').show();
		}
	});
	
}

// The dimension property
function pagelayer_elp_dimension(row, prop){
	
	var val = ['', ''];
	
	if(prop.c['val'].length > 0){
		val = prop.c['val'].split(',');
		//console.log(val)
	}
	
	var div = '<div class="pagelayer-elp-dimension-div">'+
		'<input type="number" class="pagelayer-elp-dimension" value="'+parseFloat(val[0])+'"></input>'+
		'<input type="number" class="pagelayer-elp-dimension" value="'+parseFloat(val[1])+'"></input>'+
		'<i class="pli pli-link" ></i>'+
	'</div>';
	
	row.append(div);
	
	// Is the value linked ?
	var link = row.find('.pagelayer-elp-dimension-div .pli');
	var isLinked = 1;
	var tmp_val = val[0];
	
	for(var p_val in val){

		// Check if unlinked
		if(tmp_val != val[p_val] ){
			isLinked = 0;
		}
		tmp_val = val[p_val];
	}
	
	if(isLinked){
		link.addClass('pagelayer-elp-dimension-linked');
	}else{
		link.removeClass('pagelayer-elp-dimension-linked');
	}
	
	// Handle link on click
	link.on('click', function(){
		
		var linked = link.hasClass('pagelayer-elp-dimension-linked');
		
		if(linked){
			link.removeClass('pagelayer-elp-dimension-linked');
		}else{
			link.addClass('pagelayer-elp-dimension-linked');
		}
				
	});
	
	row.find('input').on('input', function(){
		
		// Are the values linked
		var linked = row.find('.pagelayer-elp-dimension-div .pli').hasClass('pagelayer-elp-dimension-linked');
		
		if(linked){
			var val = jQuery(this).val();
			row.find('input').each(function(){
				jQuery(this).val(val);
			});
		}
		
		var vals = [];
		
		// Get all values
		row.find('input').each(function(){
			var val = jQuery(this).val();
			vals.push(val ? val : 0);
		});
		
		_pagelayer_set_atts(row, vals);// Save and Render
	});
	
};

// Select frame to upload media
function pagelayer_select_frame(tag, state){
	
	var state = state || '';
	//console.log(state);
	
	var frame;
	
	switch(tag){
		
		// Multi image selection frame
		case 'multi_image':
		
			frame = wp.media({
				
				id: 'pagelayer-wp-multi-image-library',
				frame: 'post',
				state: state,
				title: pagelayer_l('frame_multi_image'),
				multiple: true,
				library: wp.media.query({type: 'image'}),
				button: {
					text: pagelayer_l('insert')
				},
				
			});
			
			break;
		
		// Media selection frame
		case 'media':
		
			frame = wp.media({
				
				id: 'pagelayer-wp-media-library',
				frame: 'post',
				state: 'pagelayer-media',
				title: pagelayer_l('frame_media'),
				multiple: false,
				states: [
					new wp.media.controller.Library({
						id: 'pagelayer-media',
						title: pagelayer_l('frame_media'),
						multiple: false,
						date: true
					})
				],
				button: {
					text: pagelayer_l('insert')
				},
				
			});
			
			break;
		
		//Default frame(for image, video, audio)
		default:
		
			frame = wp.media({
				
				id: 'pagelayer-wp-'+tag+'-library',
				frame: 'post',
				state: 'pagelayer-'+tag,
				title: pagelayer_l('frame_media'),
				multiple: false,
				library: wp.media.query({type: tag}),
				states: [
					new wp.media.controller.Library({
						id: 'pagelayer-'+tag,
						title: pagelayer_l('frame_media'),
						library: wp.media.query( { type: tag } ),
						multiple: false,
						date: true
					})
				],
				button: {
					text: pagelayer_l('insert')
				},
				
			});
			
			break;
	}
	
	frame.on({
		'menu:render:default': function(view){
			view.unset('insert');
			view.unset('gallery');
			view.unset('featured-image');
			view.unset('playlist');
			view.unset('video-playlist');
		},
	}, this);
	
	return frame;
	
}

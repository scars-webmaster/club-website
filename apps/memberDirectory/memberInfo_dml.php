<?php

// Data functions (insert, update, delete, form) for table memberInfo

// This script and data application were generated by AppGini 5.71
// Download AppGini for free from https://bigprof.com/appgini/download/

function memberInfo_insert(){
	global $Translation;

	// mm: can member insert record?
	$arrPerm=getTablePermissions('memberInfo');
	if(!$arrPerm[1]){
		return false;
	}

	$data['fname'] = makeSafe($_REQUEST['fname']);
		if($data['fname'] == empty_lookup_value){ $data['fname'] = ''; }
	$data['lname'] = makeSafe($_REQUEST['lname']);
		if($data['lname'] == empty_lookup_value){ $data['lname'] = ''; }
	$data['suffix'] = makeSafe($_REQUEST['suffix']);
		if($data['suffix'] == empty_lookup_value){ $data['suffix'] = ''; }
	$data['middle'] = makeSafe($_REQUEST['middle']);
		if($data['middle'] == empty_lookup_value){ $data['middle'] = ''; }
	$data['memberDate'] = makeSafe($_REQUEST['memberDate']);
		if($data['memberDate'] == empty_lookup_value){ $data['memberDate'] = ''; }
	$data['homePhone'] = makeSafe($_REQUEST['homePhone']);
		if($data['homePhone'] == empty_lookup_value){ $data['homePhone'] = ''; }
	$data['workPhone'] = makeSafe($_REQUEST['workPhone']);
		if($data['workPhone'] == empty_lookup_value){ $data['workPhone'] = ''; }
	$data['mobilePhone'] = makeSafe($_REQUEST['mobilePhone']);
		if($data['mobilePhone'] == empty_lookup_value){ $data['mobilePhone'] = ''; }
	$data['emailPreferred'] = makeSafe($_REQUEST['emailPreferred']);
		if($data['emailPreferred'] == empty_lookup_value){ $data['emailPreferred'] = ''; }
	$data['emailOther'] = makeSafe($_REQUEST['emailOther']);
		if($data['emailOther'] == empty_lookup_value){ $data['emailOther'] = ''; }
	$data['addressLine1'] = makeSafe($_REQUEST['addressLine1']);
		if($data['addressLine1'] == empty_lookup_value){ $data['addressLine1'] = ''; }
	$data['addressLine2'] = makeSafe($_REQUEST['addressLine2']);
		if($data['addressLine2'] == empty_lookup_value){ $data['addressLine2'] = ''; }
	$data['city'] = makeSafe($_REQUEST['city']);
		if($data['city'] == empty_lookup_value){ $data['city'] = ''; }
	$data['state'] = makeSafe($_REQUEST['state']);
		if($data['state'] == empty_lookup_value){ $data['state'] = ''; }
	$data['zip'] = makeSafe($_REQUEST['zip']);
		if($data['zip'] == empty_lookup_value){ $data['zip'] = ''; }

	// hook: memberInfo_before_insert
	if(function_exists('memberInfo_before_insert')){
		$args=array();
		if(!memberInfo_before_insert($data, getMemberInfo(), $args)){ return false; }
	}

	$o = array('silentErrors' => true);
	sql('insert into `memberInfo` set       `fname`=' . (($data['fname'] !== '' && $data['fname'] !== NULL) ? "'{$data['fname']}'" : 'NULL') . ', `lname`=' . (($data['lname'] !== '' && $data['lname'] !== NULL) ? "'{$data['lname']}'" : 'NULL') . ', `suffix`=' . (($data['suffix'] !== '' && $data['suffix'] !== NULL) ? "'{$data['suffix']}'" : 'NULL') . ', `middle`=' . (($data['middle'] !== '' && $data['middle'] !== NULL) ? "'{$data['middle']}'" : 'NULL') . ', `memberDate`=' . (($data['memberDate'] !== '' && $data['memberDate'] !== NULL) ? "'{$data['memberDate']}'" : 'NULL') . ', `homePhone`=' . (($data['homePhone'] !== '' && $data['homePhone'] !== NULL) ? "'{$data['homePhone']}'" : 'NULL') . ', `workPhone`=' . (($data['workPhone'] !== '' && $data['workPhone'] !== NULL) ? "'{$data['workPhone']}'" : 'NULL') . ', `mobilePhone`=' . (($data['mobilePhone'] !== '' && $data['mobilePhone'] !== NULL) ? "'{$data['mobilePhone']}'" : 'NULL') . ', `emailPreferred`=' . (($data['emailPreferred'] !== '' && $data['emailPreferred'] !== NULL) ? "'{$data['emailPreferred']}'" : 'NULL') . ', `emailOther`=' . (($data['emailOther'] !== '' && $data['emailOther'] !== NULL) ? "'{$data['emailOther']}'" : 'NULL') . ', `addressLine1`=' . (($data['addressLine1'] !== '' && $data['addressLine1'] !== NULL) ? "'{$data['addressLine1']}'" : 'NULL') . ', `addressLine2`=' . (($data['addressLine2'] !== '' && $data['addressLine2'] !== NULL) ? "'{$data['addressLine2']}'" : 'NULL') . ', `city`=' . (($data['city'] !== '' && $data['city'] !== NULL) ? "'{$data['city']}'" : 'NULL') . ', `state`=' . (($data['state'] !== '' && $data['state'] !== NULL) ? "'{$data['state']}'" : 'NULL') . ', `zip`=' . (($data['zip'] !== '' && $data['zip'] !== NULL) ? "'{$data['zip']}'" : 'NULL'), $o);
	if($o['error']!=''){
		echo $o['error'];
		echo "<a href=\"memberInfo_view.php?addNew_x=1\">{$Translation['< back']}</a>";
		exit;
	}

	$recID = db_insert_id(db_link());

	// hook: memberInfo_after_insert
	if(function_exists('memberInfo_after_insert')){
		$res = sql("select * from `memberInfo` where `id`='" . makeSafe($recID, false) . "' limit 1", $eo);
		if($row = db_fetch_assoc($res)){
			$data = array_map('makeSafe', $row);
		}
		$data['selectedID'] = makeSafe($recID, false);
		$args=array();
		if(!memberInfo_after_insert($data, getMemberInfo(), $args)){ return $recID; }
	}

	// mm: save ownership data
	set_record_owner('memberInfo', $recID, getLoggedMemberID());

	return $recID;
}

function memberInfo_delete($selected_id, $AllowDeleteOfParents=false, $skipChecks=false){
	// insure referential integrity ...
	global $Translation;
	$selected_id=makeSafe($selected_id);

	// mm: can member delete record?
	$arrPerm=getTablePermissions('memberInfo');
	$ownerGroupID=sqlValue("select groupID from membership_userrecords where tableName='memberInfo' and pkValue='$selected_id'");
	$ownerMemberID=sqlValue("select lcase(memberID) from membership_userrecords where tableName='memberInfo' and pkValue='$selected_id'");
	if(($arrPerm[4]==1 && $ownerMemberID==getLoggedMemberID()) || ($arrPerm[4]==2 && $ownerGroupID==getLoggedGroupID()) || $arrPerm[4]==3){ // allow delete?
		// delete allowed, so continue ...
	}else{
		return $Translation['You don\'t have enough permissions to delete this record'];
	}

	// hook: memberInfo_before_delete
	if(function_exists('memberInfo_before_delete')){
		$args=array();
		if(!memberInfo_before_delete($selected_id, $skipChecks, getMemberInfo(), $args))
			return $Translation['Couldn\'t delete this record'];
	}

	sql("delete from `memberInfo` where `id`='$selected_id'", $eo);

	// hook: memberInfo_after_delete
	if(function_exists('memberInfo_after_delete')){
		$args=array();
		memberInfo_after_delete($selected_id, getMemberInfo(), $args);
	}

	// mm: delete ownership data
	sql("delete from membership_userrecords where tableName='memberInfo' and pkValue='$selected_id'", $eo);
}

function memberInfo_update($selected_id){
	global $Translation;

	// mm: can member edit record?
	$arrPerm=getTablePermissions('memberInfo');
	$ownerGroupID=sqlValue("select groupID from membership_userrecords where tableName='memberInfo' and pkValue='".makeSafe($selected_id)."'");
	$ownerMemberID=sqlValue("select lcase(memberID) from membership_userrecords where tableName='memberInfo' and pkValue='".makeSafe($selected_id)."'");
	if(($arrPerm[3]==1 && $ownerMemberID==getLoggedMemberID()) || ($arrPerm[3]==2 && $ownerGroupID==getLoggedGroupID()) || $arrPerm[3]==3){ // allow update?
		// update allowed, so continue ...
	}else{
		return false;
	}

	$data['fname'] = makeSafe($_REQUEST['fname']);
		if($data['fname'] == empty_lookup_value){ $data['fname'] = ''; }
	$data['lname'] = makeSafe($_REQUEST['lname']);
		if($data['lname'] == empty_lookup_value){ $data['lname'] = ''; }
	$data['suffix'] = makeSafe($_REQUEST['suffix']);
		if($data['suffix'] == empty_lookup_value){ $data['suffix'] = ''; }
	$data['middle'] = makeSafe($_REQUEST['middle']);
		if($data['middle'] == empty_lookup_value){ $data['middle'] = ''; }
	$data['memberDate'] = makeSafe($_REQUEST['memberDate']);
		if($data['memberDate'] == empty_lookup_value){ $data['memberDate'] = ''; }
	$data['homePhone'] = makeSafe($_REQUEST['homePhone']);
		if($data['homePhone'] == empty_lookup_value){ $data['homePhone'] = ''; }
	$data['workPhone'] = makeSafe($_REQUEST['workPhone']);
		if($data['workPhone'] == empty_lookup_value){ $data['workPhone'] = ''; }
	$data['mobilePhone'] = makeSafe($_REQUEST['mobilePhone']);
		if($data['mobilePhone'] == empty_lookup_value){ $data['mobilePhone'] = ''; }
	$data['emailPreferred'] = makeSafe($_REQUEST['emailPreferred']);
		if($data['emailPreferred'] == empty_lookup_value){ $data['emailPreferred'] = ''; }
	$data['emailOther'] = makeSafe($_REQUEST['emailOther']);
		if($data['emailOther'] == empty_lookup_value){ $data['emailOther'] = ''; }
	$data['addressLine1'] = makeSafe($_REQUEST['addressLine1']);
		if($data['addressLine1'] == empty_lookup_value){ $data['addressLine1'] = ''; }
	$data['addressLine2'] = makeSafe($_REQUEST['addressLine2']);
		if($data['addressLine2'] == empty_lookup_value){ $data['addressLine2'] = ''; }
	$data['city'] = makeSafe($_REQUEST['city']);
		if($data['city'] == empty_lookup_value){ $data['city'] = ''; }
	$data['state'] = makeSafe($_REQUEST['state']);
		if($data['state'] == empty_lookup_value){ $data['state'] = ''; }
	$data['zip'] = makeSafe($_REQUEST['zip']);
		if($data['zip'] == empty_lookup_value){ $data['zip'] = ''; }
	$data['selectedID']=makeSafe($selected_id);

	// hook: memberInfo_before_update
	if(function_exists('memberInfo_before_update')){
		$args=array();
		if(!memberInfo_before_update($data, getMemberInfo(), $args)){ return false; }
	}

	$o=array('silentErrors' => true);
	sql('update `memberInfo` set       `fname`=' . (($data['fname'] !== '' && $data['fname'] !== NULL) ? "'{$data['fname']}'" : 'NULL') . ', `lname`=' . (($data['lname'] !== '' && $data['lname'] !== NULL) ? "'{$data['lname']}'" : 'NULL') . ', `suffix`=' . (($data['suffix'] !== '' && $data['suffix'] !== NULL) ? "'{$data['suffix']}'" : 'NULL') . ', `middle`=' . (($data['middle'] !== '' && $data['middle'] !== NULL) ? "'{$data['middle']}'" : 'NULL') . ', `memberDate`=' . (($data['memberDate'] !== '' && $data['memberDate'] !== NULL) ? "'{$data['memberDate']}'" : 'NULL') . ', `homePhone`=' . (($data['homePhone'] !== '' && $data['homePhone'] !== NULL) ? "'{$data['homePhone']}'" : 'NULL') . ', `workPhone`=' . (($data['workPhone'] !== '' && $data['workPhone'] !== NULL) ? "'{$data['workPhone']}'" : 'NULL') . ', `mobilePhone`=' . (($data['mobilePhone'] !== '' && $data['mobilePhone'] !== NULL) ? "'{$data['mobilePhone']}'" : 'NULL') . ', `emailPreferred`=' . (($data['emailPreferred'] !== '' && $data['emailPreferred'] !== NULL) ? "'{$data['emailPreferred']}'" : 'NULL') . ', `emailOther`=' . (($data['emailOther'] !== '' && $data['emailOther'] !== NULL) ? "'{$data['emailOther']}'" : 'NULL') . ', `addressLine1`=' . (($data['addressLine1'] !== '' && $data['addressLine1'] !== NULL) ? "'{$data['addressLine1']}'" : 'NULL') . ', `addressLine2`=' . (($data['addressLine2'] !== '' && $data['addressLine2'] !== NULL) ? "'{$data['addressLine2']}'" : 'NULL') . ', `city`=' . (($data['city'] !== '' && $data['city'] !== NULL) ? "'{$data['city']}'" : 'NULL') . ', `state`=' . (($data['state'] !== '' && $data['state'] !== NULL) ? "'{$data['state']}'" : 'NULL') . ', `zip`=' . (($data['zip'] !== '' && $data['zip'] !== NULL) ? "'{$data['zip']}'" : 'NULL') . " where `id`='".makeSafe($selected_id)."'", $o);
	if($o['error']!=''){
		echo $o['error'];
		echo '<a href="memberInfo_view.php?SelectedID='.urlencode($selected_id)."\">{$Translation['< back']}</a>";
		exit;
	}


	// hook: memberInfo_after_update
	if(function_exists('memberInfo_after_update')){
		$res = sql("SELECT * FROM `memberInfo` WHERE `id`='{$data['selectedID']}' LIMIT 1", $eo);
		if($row = db_fetch_assoc($res)){
			$data = array_map('makeSafe', $row);
		}
		$data['selectedID'] = $data['id'];
		$args = array();
		if(!memberInfo_after_update($data, getMemberInfo(), $args)){ return; }
	}

	// mm: update ownership data
	sql("update membership_userrecords set dateUpdated='".time()."' where tableName='memberInfo' and pkValue='".makeSafe($selected_id)."'", $eo);

}

function memberInfo_form($selected_id = '', $AllowUpdate = 1, $AllowInsert = 1, $AllowDelete = 1, $ShowCancel = 0, $TemplateDV = '', $TemplateDVP = ''){
	// function to return an editable form for a table records
	// and fill it with data of record whose ID is $selected_id. If $selected_id
	// is empty, an empty form is shown, with only an 'Add New'
	// button displayed.

	global $Translation;

	// mm: get table permissions
	$arrPerm=getTablePermissions('memberInfo');
	if(!$arrPerm[1] && $selected_id==''){ return ''; }
	$AllowInsert = ($arrPerm[1] ? true : false);
	// print preview?
	$dvprint = false;
	if($selected_id && $_REQUEST['dvprint_x'] != ''){
		$dvprint = true;
	}


	// populate filterers, starting from children to grand-parents

	// unique random identifier
	$rnd1 = ($dvprint ? rand(1000000, 9999999) : '');

	if($selected_id){
		// mm: check member permissions
		if(!$arrPerm[2]){
			return "";
		}
		// mm: who is the owner?
		$ownerGroupID=sqlValue("select groupID from membership_userrecords where tableName='memberInfo' and pkValue='".makeSafe($selected_id)."'");
		$ownerMemberID=sqlValue("select lcase(memberID) from membership_userrecords where tableName='memberInfo' and pkValue='".makeSafe($selected_id)."'");
		if($arrPerm[2]==1 && getLoggedMemberID()!=$ownerMemberID){
			return "";
		}
		if($arrPerm[2]==2 && getLoggedGroupID()!=$ownerGroupID){
			return "";
		}

		// can edit?
		if(($arrPerm[3]==1 && $ownerMemberID==getLoggedMemberID()) || ($arrPerm[3]==2 && $ownerGroupID==getLoggedGroupID()) || $arrPerm[3]==3){
			$AllowUpdate=1;
		}else{
			$AllowUpdate=0;
		}

		$res = sql("select * from `memberInfo` where `id`='".makeSafe($selected_id)."'", $eo);
		if(!($row = db_fetch_array($res))){
			return error_message($Translation['No records found'], 'memberInfo_view.php', false);
		}
		$urow = $row; /* unsanitized data */
		$hc = new CI_Input();
		$row = $hc->xss_clean($row); /* sanitize data */
	}else{
	}

	// code for template based detail view forms

	// open the detail view template
	if($dvprint){
		$template_file = is_file("./{$TemplateDVP}") ? "./{$TemplateDVP}" : './templates/memberInfo_templateDVP.html';
		$templateCode = @file_get_contents($template_file);
	}else{
		$template_file = is_file("./{$TemplateDV}") ? "./{$TemplateDV}" : './templates/memberInfo_templateDV.html';
		$templateCode = @file_get_contents($template_file);
	}

	// process form title
	$templateCode = str_replace('<%%DETAIL_VIEW_TITLE%%>', 'MemberInfo details', $templateCode);
	$templateCode = str_replace('<%%RND1%%>', $rnd1, $templateCode);
	$templateCode = str_replace('<%%EMBEDDED%%>', ($_REQUEST['Embedded'] ? 'Embedded=1' : ''), $templateCode);
	// process buttons
	if($AllowInsert){
		if(!$selected_id) $templateCode = str_replace('<%%INSERT_BUTTON%%>', '<button type="submit" class="btn btn-success" id="insert" name="insert_x" value="1" onclick="return memberInfo_validateData();"><i class="glyphicon glyphicon-plus-sign"></i> ' . $Translation['Save New'] . '</button>', $templateCode);
		$templateCode = str_replace('<%%INSERT_BUTTON%%>', '<button type="submit" class="btn btn-default" id="insert" name="insert_x" value="1" onclick="return memberInfo_validateData();"><i class="glyphicon glyphicon-plus-sign"></i> ' . $Translation['Save As Copy'] . '</button>', $templateCode);
	}else{
		$templateCode = str_replace('<%%INSERT_BUTTON%%>', '', $templateCode);
	}

	// 'Back' button action
	if($_REQUEST['Embedded']){
		$backAction = 'AppGini.closeParentModal(); return false;';
	}else{
		$backAction = '$j(\'form\').eq(0).attr(\'novalidate\', \'novalidate\'); document.myform.reset(); return true;';
	}

	if($selected_id){
		if(!$_REQUEST['Embedded']) $templateCode = str_replace('<%%DVPRINT_BUTTON%%>', '<button type="submit" class="btn btn-default" id="dvprint" name="dvprint_x" value="1" onclick="$$(\'form\')[0].writeAttribute(\'novalidate\', \'novalidate\'); document.myform.reset(); return true;" title="' . html_attr($Translation['Print Preview']) . '"><i class="glyphicon glyphicon-print"></i> ' . $Translation['Print Preview'] . '</button>', $templateCode);
		if($AllowUpdate){
			$templateCode = str_replace('<%%UPDATE_BUTTON%%>', '<button type="submit" class="btn btn-success btn-lg" id="update" name="update_x" value="1" onclick="return memberInfo_validateData();" title="' . html_attr($Translation['Save Changes']) . '"><i class="glyphicon glyphicon-ok"></i> ' . $Translation['Save Changes'] . '</button>', $templateCode);
		}else{
			$templateCode = str_replace('<%%UPDATE_BUTTON%%>', '', $templateCode);
		}
		if(($arrPerm[4]==1 && $ownerMemberID==getLoggedMemberID()) || ($arrPerm[4]==2 && $ownerGroupID==getLoggedGroupID()) || $arrPerm[4]==3){ // allow delete?
			$templateCode = str_replace('<%%DELETE_BUTTON%%>', '<button type="submit" class="btn btn-danger" id="delete" name="delete_x" value="1" onclick="return confirm(\'' . $Translation['are you sure?'] . '\');" title="' . html_attr($Translation['Delete']) . '"><i class="glyphicon glyphicon-trash"></i> ' . $Translation['Delete'] . '</button>', $templateCode);
		}else{
			$templateCode = str_replace('<%%DELETE_BUTTON%%>', '', $templateCode);
		}
		$templateCode = str_replace('<%%DESELECT_BUTTON%%>', '<button type="submit" class="btn btn-default" id="deselect" name="deselect_x" value="1" onclick="' . $backAction . '" title="' . html_attr($Translation['Back']) . '"><i class="glyphicon glyphicon-chevron-left"></i> ' . $Translation['Back'] . '</button>', $templateCode);
	}else{
		$templateCode = str_replace('<%%UPDATE_BUTTON%%>', '', $templateCode);
		$templateCode = str_replace('<%%DELETE_BUTTON%%>', '', $templateCode);
		$templateCode = str_replace('<%%DESELECT_BUTTON%%>', ($ShowCancel ? '<button type="submit" class="btn btn-default" id="deselect" name="deselect_x" value="1" onclick="' . $backAction . '" title="' . html_attr($Translation['Back']) . '"><i class="glyphicon glyphicon-chevron-left"></i> ' . $Translation['Back'] . '</button>' : ''), $templateCode);
	}

	// set records to read only if user can't insert new records and can't edit current record
	if(($selected_id && !$AllowUpdate && !$AllowInsert) || (!$selected_id && !$AllowInsert)){
		$jsReadOnly .= "\tjQuery('#fname').replaceWith('<div class=\"form-control-static\" id=\"fname\">' + (jQuery('#fname').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('#lname').replaceWith('<div class=\"form-control-static\" id=\"lname\">' + (jQuery('#lname').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('#suffix').replaceWith('<div class=\"form-control-static\" id=\"suffix\">' + (jQuery('#suffix').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('#middle').replaceWith('<div class=\"form-control-static\" id=\"middle\">' + (jQuery('#middle').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('#memberDate').replaceWith('<div class=\"form-control-static\" id=\"memberDate\">' + (jQuery('#memberDate').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('#homePhone').replaceWith('<div class=\"form-control-static\" id=\"homePhone\">' + (jQuery('#homePhone').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('#workPhone').replaceWith('<div class=\"form-control-static\" id=\"workPhone\">' + (jQuery('#workPhone').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('#mobilePhone').replaceWith('<div class=\"form-control-static\" id=\"mobilePhone\">' + (jQuery('#mobilePhone').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('#emailPreferred').replaceWith('<div class=\"form-control-static\" id=\"emailPreferred\">' + (jQuery('#emailPreferred').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('#emailOther').replaceWith('<div class=\"form-control-static\" id=\"emailOther\">' + (jQuery('#emailOther').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('#addressLine1').replaceWith('<div class=\"form-control-static\" id=\"addressLine1\">' + (jQuery('#addressLine1').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('#addressLine2').replaceWith('<div class=\"form-control-static\" id=\"addressLine2\">' + (jQuery('#addressLine2').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('#city').replaceWith('<div class=\"form-control-static\" id=\"city\">' + (jQuery('#city').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('#state').replaceWith('<div class=\"form-control-static\" id=\"state\">' + (jQuery('#state').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('#zip').replaceWith('<div class=\"form-control-static\" id=\"zip\">' + (jQuery('#zip').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('.select2-container').hide();\n";

		$noUploads = true;
	}elseif($AllowInsert){
		$jsEditable .= "\tjQuery('form').eq(0).data('already_changed', true);"; // temporarily disable form change handler
			$jsEditable .= "\tjQuery('form').eq(0).data('already_changed', false);"; // re-enable form change handler
	}

	// process combos

	/* lookup fields array: 'lookup field name' => array('parent table name', 'lookup field caption') */
	$lookup_fields = array();
	foreach($lookup_fields as $luf => $ptfc){
		$pt_perm = getTablePermissions($ptfc[0]);

		// process foreign key links
		if($pt_perm['view'] || $pt_perm['edit']){
			$templateCode = str_replace("<%%PLINK({$luf})%%>", '<button type="button" class="btn btn-default view_parent hspacer-md" id="' . $ptfc[0] . '_view_parent" title="' . html_attr($Translation['View'] . ' ' . $ptfc[1]) . '"><i class="glyphicon glyphicon-eye-open"></i></button>', $templateCode);
		}

		// if user has insert permission to parent table of a lookup field, put an add new button
		if($pt_perm['insert'] && !$_REQUEST['Embedded']){
			$templateCode = str_replace("<%%ADDNEW({$ptfc[0]})%%>", '<button type="button" class="btn btn-success add_new_parent hspacer-md" id="' . $ptfc[0] . '_add_new" title="' . html_attr($Translation['Add New'] . ' ' . $ptfc[1]) . '"><i class="glyphicon glyphicon-plus-sign"></i></button>', $templateCode);
		}
	}

	// process images
	$templateCode = str_replace('<%%UPLOADFILE(id)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(fname)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(lname)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(suffix)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(middle)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(memberDate)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(homePhone)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(workPhone)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(mobilePhone)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(emailPreferred)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(emailOther)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(addressLine1)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(addressLine2)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(city)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(state)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(zip)%%>', '', $templateCode);

	// process values
	if($selected_id){
		if( $dvprint) $templateCode = str_replace('<%%VALUE(id)%%>', safe_html($urow['id']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(id)%%>', html_attr($row['id']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(id)%%>', urlencode($urow['id']), $templateCode);
		if( $dvprint) $templateCode = str_replace('<%%VALUE(fname)%%>', safe_html($urow['fname']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(fname)%%>', html_attr($row['fname']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(fname)%%>', urlencode($urow['fname']), $templateCode);
		if( $dvprint) $templateCode = str_replace('<%%VALUE(lname)%%>', safe_html($urow['lname']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(lname)%%>', html_attr($row['lname']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(lname)%%>', urlencode($urow['lname']), $templateCode);
		if( $dvprint) $templateCode = str_replace('<%%VALUE(suffix)%%>', safe_html($urow['suffix']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(suffix)%%>', html_attr($row['suffix']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(suffix)%%>', urlencode($urow['suffix']), $templateCode);
		if( $dvprint) $templateCode = str_replace('<%%VALUE(middle)%%>', safe_html($urow['middle']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(middle)%%>', html_attr($row['middle']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(middle)%%>', urlencode($urow['middle']), $templateCode);
		if( $dvprint) $templateCode = str_replace('<%%VALUE(memberDate)%%>', safe_html($urow['memberDate']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(memberDate)%%>', html_attr($row['memberDate']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(memberDate)%%>', urlencode($urow['memberDate']), $templateCode);
		if( $dvprint) $templateCode = str_replace('<%%VALUE(homePhone)%%>', safe_html($urow['homePhone']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(homePhone)%%>', html_attr($row['homePhone']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(homePhone)%%>', urlencode($urow['homePhone']), $templateCode);
		if( $dvprint) $templateCode = str_replace('<%%VALUE(workPhone)%%>', safe_html($urow['workPhone']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(workPhone)%%>', html_attr($row['workPhone']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(workPhone)%%>', urlencode($urow['workPhone']), $templateCode);
		if( $dvprint) $templateCode = str_replace('<%%VALUE(mobilePhone)%%>', safe_html($urow['mobilePhone']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(mobilePhone)%%>', html_attr($row['mobilePhone']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(mobilePhone)%%>', urlencode($urow['mobilePhone']), $templateCode);
		if( $dvprint) $templateCode = str_replace('<%%VALUE(emailPreferred)%%>', safe_html($urow['emailPreferred']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(emailPreferred)%%>', html_attr($row['emailPreferred']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(emailPreferred)%%>', urlencode($urow['emailPreferred']), $templateCode);
		if( $dvprint) $templateCode = str_replace('<%%VALUE(emailOther)%%>', safe_html($urow['emailOther']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(emailOther)%%>', html_attr($row['emailOther']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(emailOther)%%>', urlencode($urow['emailOther']), $templateCode);
		if( $dvprint) $templateCode = str_replace('<%%VALUE(addressLine1)%%>', safe_html($urow['addressLine1']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(addressLine1)%%>', html_attr($row['addressLine1']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(addressLine1)%%>', urlencode($urow['addressLine1']), $templateCode);
		if( $dvprint) $templateCode = str_replace('<%%VALUE(addressLine2)%%>', safe_html($urow['addressLine2']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(addressLine2)%%>', html_attr($row['addressLine2']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(addressLine2)%%>', urlencode($urow['addressLine2']), $templateCode);
		if( $dvprint) $templateCode = str_replace('<%%VALUE(city)%%>', safe_html($urow['city']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(city)%%>', html_attr($row['city']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(city)%%>', urlencode($urow['city']), $templateCode);
		if( $dvprint) $templateCode = str_replace('<%%VALUE(state)%%>', safe_html($urow['state']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(state)%%>', html_attr($row['state']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(state)%%>', urlencode($urow['state']), $templateCode);
		if( $dvprint) $templateCode = str_replace('<%%VALUE(zip)%%>', safe_html($urow['zip']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(zip)%%>', html_attr($row['zip']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(zip)%%>', urlencode($urow['zip']), $templateCode);
	}else{
		$templateCode = str_replace('<%%VALUE(id)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(id)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(fname)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(fname)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(lname)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(lname)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(suffix)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(suffix)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(middle)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(middle)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(memberDate)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(memberDate)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(homePhone)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(homePhone)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(workPhone)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(workPhone)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(mobilePhone)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(mobilePhone)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(emailPreferred)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(emailPreferred)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(emailOther)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(emailOther)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(addressLine1)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(addressLine1)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(addressLine2)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(addressLine2)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(city)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(city)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(state)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(state)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(zip)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(zip)%%>', urlencode(''), $templateCode);
	}

	// process translations
	foreach($Translation as $symbol=>$trans){
		$templateCode = str_replace("<%%TRANSLATION($symbol)%%>", $trans, $templateCode);
	}

	// clear scrap
	$templateCode = str_replace('<%%', '<!-- ', $templateCode);
	$templateCode = str_replace('%%>', ' -->', $templateCode);

	// hide links to inaccessible tables
	if($_REQUEST['dvprint_x'] == ''){
		$templateCode .= "\n\n<script>\$j(function(){\n";
		$arrTables = getTableList();
		foreach($arrTables as $name => $caption){
			$templateCode .= "\t\$j('#{$name}_link').removeClass('hidden');\n";
			$templateCode .= "\t\$j('#xs_{$name}_link').removeClass('hidden');\n";
		}

		$templateCode .= $jsReadOnly;
		$templateCode .= $jsEditable;

		if(!$selected_id){
		}

		$templateCode.="\n});</script>\n";
	}

	// ajaxed auto-fill fields
	$templateCode .= '<script>';
	$templateCode .= '$j(function() {';


	$templateCode.="});";
	$templateCode.="</script>";
	$templateCode .= $lookups;

	// handle enforced parent values for read-only lookup fields

	// don't include blank images in lightbox gallery
	$templateCode = preg_replace('/blank.gif" data-lightbox=".*?"/', 'blank.gif"', $templateCode);

	// don't display empty email links
	$templateCode=preg_replace('/<a .*?href="mailto:".*?<\/a>/', '', $templateCode);

	/* default field values */
	$rdata = $jdata = get_defaults('memberInfo');
	if($selected_id){
		$jdata = get_joined_record('memberInfo', $selected_id);
		if($jdata === false) $jdata = get_defaults('memberInfo');
		$rdata = $row;
	}
	$cache_data = array(
		'rdata' => array_map('nl2br', array_map('html_attr_tags_ok', $rdata)),
		'jdata' => array_map('nl2br', array_map('html_attr_tags_ok', $jdata))
	);
	$templateCode .= loadView('memberInfo-ajax-cache', $cache_data);

	// hook: memberInfo_dv
	if(function_exists('memberInfo_dv')){
		$args=array();
		memberInfo_dv(($selected_id ? $selected_id : FALSE), getMemberInfo(), $templateCode, $args);
	}

	return $templateCode;
}
?>
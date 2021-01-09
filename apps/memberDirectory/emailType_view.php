<?php
// This script and data application were generated by AppGini 5.71
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");
	@include("$currDir/hooks/emailType.php");
	include("$currDir/emailType_dml.php");

	// mm: can the current member access this page?
	$perm=getTablePermissions('emailType');
	if(!$perm[0]){
		echo error_message($Translation['tableAccessDenied'], false);
		echo '<script>setTimeout("window.location=\'index.php?signOut=1\'", 2000);</script>';
		exit;
	}

	$x = new DataList;
	$x->TableName = "emailType";

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = array(   
		"`emailType`.`id`" => "id",
		"`emailType`.`emailTypeCode`" => "emailTypeCode",
		"`emailType`.`emailTypeDesc`" => "emailTypeDesc"
	);
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = array(   
		1 => '`emailType`.`id`',
		2 => 2,
		3 => 3
	);

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = array(   
		"`emailType`.`id`" => "id",
		"`emailType`.`emailTypeCode`" => "emailTypeCode",
		"`emailType`.`emailTypeDesc`" => "emailTypeDesc"
	);
	// Fields that can be filtered
	$x->QueryFieldsFilters = array(   
		"`emailType`.`id`" => "ID",
		"`emailType`.`emailTypeCode`" => "EmailTypeCode",
		"`emailType`.`emailTypeDesc`" => "EmailTypeDesc"
	);

	// Fields that can be quick searched
	$x->QueryFieldsQS = array(   
		"`emailType`.`id`" => "id",
		"`emailType`.`emailTypeCode`" => "emailTypeCode",
		"`emailType`.`emailTypeDesc`" => "emailTypeDesc"
	);

	// Lookup fields that can be used as filterers
	$x->filterers = array();

	$x->QueryFrom = "`emailType` ";
	$x->QueryWhere = '';
	$x->QueryOrder = '';

	$x->AllowSelection = 1;
	$x->HideTableView = ($perm[2]==0 ? 1 : 0);
	$x->AllowDelete = $perm[4];
	$x->AllowMassDelete = false;
	$x->AllowInsert = $perm[1];
	$x->AllowUpdate = $perm[3];
	$x->SeparateDV = 1;
	$x->AllowDeleteOfParents = 0;
	$x->AllowFilters = 1;
	$x->AllowSavingFilters = 0;
	$x->AllowSorting = 1;
	$x->AllowNavigation = 1;
	$x->AllowPrinting = 1;
	$x->AllowCSV = 1;
	$x->RecordsPerPage = 10;
	$x->QuickSearch = 1;
	$x->QuickSearchText = $Translation["quick search"];
	$x->ScriptFileName = "emailType_view.php";
	$x->RedirectAfterInsert = "emailType_view.php?SelectedID=#ID#";
	$x->TableTitle = "EmailType";
	$x->TableIcon = "table.gif";
	$x->PrimaryKey = "`emailType`.`id`";

	$x->ColWidth   = array(  150, 150);
	$x->ColCaption = array("EmailTypeCode", "EmailTypeDesc");
	$x->ColFieldName = array('emailTypeCode', 'emailTypeDesc');
	$x->ColNumber  = array(2, 3);

	// template paths below are based on the app main directory
	$x->Template = 'templates/emailType_templateTV.html';
	$x->SelectedTemplate = 'templates/emailType_templateTVS.html';
	$x->TemplateDV = 'templates/emailType_templateDV.html';
	$x->TemplateDVP = 'templates/emailType_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HighlightColor = '#FFF0C2';

	// mm: build the query based on current member's permissions
	$DisplayRecords = $_REQUEST['DisplayRecords'];
	if(!in_array($DisplayRecords, array('user', 'group'))){ $DisplayRecords = 'all'; }
	if($perm[2]==1 || ($perm[2]>1 && $DisplayRecords=='user' && !$_REQUEST['NoFilter_x'])){ // view owner only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `emailType`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='emailType' and lcase(membership_userrecords.memberID)='".getLoggedMemberID()."'";
	}elseif($perm[2]==2 || ($perm[2]>2 && $DisplayRecords=='group' && !$_REQUEST['NoFilter_x'])){ // view group only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `emailType`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='emailType' and membership_userrecords.groupID='".getLoggedGroupID()."'";
	}elseif($perm[2]==3){ // view all
		// no further action
	}elseif($perm[2]==0){ // view none
		$x->QueryFields = array("Not enough permissions" => "NEP");
		$x->QueryFrom = '`emailType`';
		$x->QueryWhere = '';
		$x->DefaultSortField = '';
	}
	// hook: emailType_init
	$render=TRUE;
	if(function_exists('emailType_init')){
		$args=array();
		$render=emailType_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: emailType_header
	$headerCode='';
	if(function_exists('emailType_header')){
		$args=array();
		$headerCode=emailType_header($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$headerCode){
		include_once("$currDir/header.php"); 
	}else{
		ob_start(); include_once("$currDir/header.php"); $dHeader=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%HEADER%%>', $dHeader, $headerCode);
	}

	echo $x->HTML;
	// hook: emailType_footer
	$footerCode='';
	if(function_exists('emailType_footer')){
		$args=array();
		$footerCode=emailType_footer($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$footerCode){
		include_once("$currDir/footer.php"); 
	}else{
		ob_start(); include_once("$currDir/footer.php"); $dFooter=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%FOOTER%%>', $dFooter, $footerCode);
	}
?>
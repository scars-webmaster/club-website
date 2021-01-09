<script>
	$j(function(){
		var tn = 'email';

		/* data for selected record, or defaults if none is selected */
		var data = {
			emailType: <?php echo json_encode(array('id' => $rdata['emailType'], 'value' => $rdata['emailType'], 'text' => $jdata['emailType'])); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		cache.start();
	});
</script>


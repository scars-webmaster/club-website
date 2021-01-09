<script>
	$j(function(){
		var tn = 'phone';

		/* data for selected record, or defaults if none is selected */
		var data = {
			phoneType: <?php echo json_encode(array('id' => $rdata['phoneType'], 'value' => $rdata['phoneType'], 'text' => $jdata['phoneType'])); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		cache.start();
	});
</script>


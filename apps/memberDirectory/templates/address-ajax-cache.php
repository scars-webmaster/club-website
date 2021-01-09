<script>
	$j(function(){
		var tn = 'address';

		/* data for selected record, or defaults if none is selected */
		var data = {
			addressType: <?php echo json_encode(array('id' => $rdata['addressType'], 'value' => $rdata['addressType'], 'text' => $jdata['addressType'])); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		cache.start();
	});
</script>


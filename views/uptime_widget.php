<div class="col-lg-4 col-md-6">
	<div class="card" id="uptime-widget">
		<div class="card-heading" data-container="body">
			<i class="fa fa-power-off"></i>
			<span data-i18n="machine.uptime.title"></span>
			<a href="/show/listing/reportdata/clients" class="pull-right"><i class="fa fa-list"></i></a>
		</div>
		<div class="card-body text-center">
			<a tag="oneweekplus" class="btn btn-danger disabled">
				<span class="bigger-150"> 0 </span><br>
				7 <span data-i18n="date.day_plural"></span> +
			</a>
			<a tag="oneweek" class="btn btn-warning disabled">
				<span class="bigger-150"> 0 </span><br>
				< 7 <span data-i18n="date.day_plural"></span>
			</a>
			<a tag="oneday" class="btn btn-success disabled">
				<span class="bigger-150"> 0 </span><br>
				< 1 <span data-i18n="date.day"></span>
			</a>
		</div>
	</div><!-- /card -->
</div><!-- /col -->

<script>
$(document).on('appReady', function(e, lang) {

	var panelBody = $('#uptime-widget div.card-body');

	$(document).on('appUpdate', function(e, lang) {

	    $.getJSON( appUrl + '/module/reportdata/getUptimeStats', function( data ) {

	    	if(data.error){
	    		//alert(data.error);
	    		return;
	    	}
			var uptimeList = [
				{tag: 'oneday', search: 'uptime < 1d'},
				{tag: 'oneweek', search: '1d uptime 7d'},
				{tag: 'oneweekplus', search: 'uptime > 7d'}
			]
			$.each(uptimeList, function(i, item){
				panelBody.find('a[tag="'+item.tag+'"]')
					.attr('href', appUrl + '/show/listing/reportdata/clients#' + item.search)
					.toggleClass('disabled', !data[item.tag])
					.find('span.bigger-150').text(data[item.tag] || 0)
			})
	    });
	});
});

</script>

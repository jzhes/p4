// Getting HTML/A View as a result and just throwing it in to the response div
$('#search-html').click(function() {
	$.ajax({
		type: 'POST',
		url: '/gift/search',
		success: function(response) {
			$('#results').html(response);
		},
		data: {
			format: 'html',
		    query: $('input[name=query]').val(),
		    _token: $('input[name=_token]').val(),
		},
	});
});
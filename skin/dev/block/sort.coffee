$('#sortable').sortable()
$('#dosort').click ->
	sorted = []
	$('#sortable li').each ->
		sorted.push($(this).attr('data-id'))
	$.post location.href,{sorted:sorted},(ret)->
		unless ret.code
			alert 'success'
	,'json'

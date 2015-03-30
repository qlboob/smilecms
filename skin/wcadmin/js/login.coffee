setInterval ->
	$.getJSON location.href,(ret)->
		if 0==ret.code
			location.href = ret.data.url
,4000
src = $('#qrcodeimg').attr 'src'
setInterval ->
	$('#qrcodeimg').attr 'src',src+"?#{Math.random()}"
,5*60*1000


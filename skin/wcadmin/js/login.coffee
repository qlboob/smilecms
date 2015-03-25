setInterval ->
	$.getJSON __initData.heat,(ret)->
		if 0==ret.code
			location.href = __initData.redirect
,4000
src = $('#qrcodeimg').attr 'src'
setInterval ->
	$('#qrcodeimg').attr 'src',src+"?#{Math.random()}"
,5*60*1000


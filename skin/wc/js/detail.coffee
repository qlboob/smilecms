$('#upload').click ->
	uploadData={x:1}
	if document.getElementById('washinner').checked
		uploadData.tdl_innerwash=1
	$.getJSON location.href,uploadData,(ret)->
		alert ret.msg

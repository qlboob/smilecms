$('#addLine').click ->
	newDom = $('.form-horizontal .form-group:first').clone()
	$('input,textarea',newDom).val('')
	$('.form-horizontal .form-group:last').before(newDom)

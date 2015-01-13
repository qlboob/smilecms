$('nav.tppage').each ->
	#$(this).hasClass('')
	inHtml =''
	$('a,span',this).each ->
		liClassStr=''
		if $(this).hasClass('current')
			liClassStr = ' class="active"'
		inHtml+="""
			<li#{liClassStr}>#{this.outerHTML}</li>
		"""
	inHtml = """
	<ul class="pagination">#{inHtml}</ul>
	"""
	this.innerHTML = inHtml
	$(this).addClass 'pull-right'

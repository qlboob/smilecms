jsApiList = ['chooseImage','uploadImage']
config = __initData.sign
#config.debug=on
config.jsApiList=jsApiList
wx.config config
#alert JSON.stringify(config)
wx.ready ->
	$('#mybtn').click ->
		wx.chooseImage {
			success:(imgRes)->
				img = new Image()
				img.onload = ->
					dom = document.getElementById('c')
					maxH = 400
					maxW = 400
					if img.width/maxW >img.height/maxH
						img.width=maxW
						newW = maxW
						newH = img.height/img.width*maxW
					else
						img.height=maxH
					$(dom).height img.height
					cxt=dom.getContext("2d")
					cxt.drawImage img,0,0,300,300
					if dom.toDataURL
						setTimeout ->
							$('#nop').attr('src',dom.toDataURL('image/jpeg',0.8))
							alert(dom.toDataURL('image/jpeg').length)
						,3000
					else
						alert 'no'
					#$.post location.href,{x:dom.toDataURL('image/jpeg')}
					$('#show').html dom.toDataURL('image/jpeg')
					alert $('#show').html()
					alert cxt.toDataURL('image/jpeg')
				img.src = imgRes.localIds[0]
		}

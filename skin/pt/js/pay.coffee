jsApiList = ['chooseImage','uploadImage']
config={jsApiList:jsApiList}
$.extend config,__initData.sign
wx.config config
wx.ready ->
	wx.checkJsApi {
		jsApiList:jsApiList
		success:(res)->
			for v in jsApiList
				unless res.checkResult[v]
					return no
			$('#imgRow').removeClass 'hide'
			uploadImageBtn = $('#imgRow button')
			uploadImageBtn.click ->
				wx.chooseImage {
					success:(ret)->
						html=[]
						for localId in ret.localIds
							wx.uploadImage {
								localId:localId
								isShowProgressTips:1
								success:(serverImgRes)->
									imgItem = """
										<img class="img-responsive" src="#{localId}" />
										<input type="hide" name="wxid[]" value="#{serverImgRes.serverId}" />
									"""
									array_push html,imgItem
									if html.length==ret.localIds
										$('#imgList').html html.join('')
							}
				}
	}


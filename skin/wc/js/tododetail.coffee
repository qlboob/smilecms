jsApiList = ['chooseImage','uploadImage']
config = __initData.sign
config.debug=on
config.jsApiList=jsApiList
wx.config config
#alert JSON.stringify(config)
wx.ready ->
	wx.checkJsApi {
		jsApiList:jsApiList
		success:(res)->
			canUse = on
			for k,v of res.checkResult
				unless v
					canUse = no
					break
			if canUse
				$('#upload').click ->
					wx.chooseImage {
						success:(imgRes)->
							alert JSON.stringify(imgRes.localIds)
							if imgRes.localIds
								if imgRes.localIds.length>1
									alert '只能选一张图片'
								else
									for id in imgRes.localIds
										html = """
										<img src="#{id}" width="100%" />
										"""
										$('#imgshow').html html
										wx.uploadImage {
											localId:id
											isShowProgressTips:1
											success:(uploadRes)->
												serverId = uploadRes.serverId
												$.getJSON location.href,{tdi_id:serverId},(ret)->
													alert ret.msg
													unless ret.code
														$('#upload').addClass 'hide'
										}
					}
			else
				alert '你的微信版本不支持上传图片'
			

	}

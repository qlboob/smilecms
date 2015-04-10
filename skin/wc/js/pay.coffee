jsApiList = ['chooseWXPay']
config = __initData.sign
#config.debug=on
config.jsApiList=jsApiList
wx.config config
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
				$('#payBtn').click ->
					payObj = __initData.payParam
					#alert(JSON.stringify(payObj))
					payObj.success=(res)->
						location.href=__initData.redirect
					wx.chooseWXPay payObj
			else
				alert '你的手机不支持微信支付'
	}

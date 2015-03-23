jsApiList = ['chooseWXPay']
config={jsApiList:jsApiList}
$.extend config,__initData.sign
wx.config config
wx.ready ->
	wx.checkJsApi {
		jsApiList:jsApiList
		success:(res)->
			for v in jsApiList
				unless res.checkResult[v]
					alert '你的微信版本不支持微信支付'
					return no
			payBtn = $('#paynew')
			payBtn.click ->
				payObj = __initData.jsPayParam
				payObj.success = (ret)->
					alert '支付成功'
				wx.chooseWXPay payObj
	}


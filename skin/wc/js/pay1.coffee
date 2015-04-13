$('#payBtn').click ->
	jsApiCall=->
		WeixinJSBridge.invoke 'getBrandWCPayRequest',__initData.payParam,(res)->
			if res.err_msg == "get_brand_wcpay_request:ok"
				location.href=__initData.redirect
			else if res.err_msg == "get_brand_wcpay_request:cancel"
				alert '你已经取消付款'

	if typeof WeixinJSBridge == "undefined"
		if document.addEventListener
			document.addEventListener('WeixinJSBridgeReady', jsApiCall, false)
		else if document.attachEvent
			document.attachEvent('WeixinJSBridgeReady', jsApiCall)
			document.attachEvent('onWeixinJSBridgeReady', jsApiCall)
	else
		jsApiCall()


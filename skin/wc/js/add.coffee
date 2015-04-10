#展示套餐说明
jTcId = $('[name=tc_id]')
showTaocanDesc=->
	$('#tcDesc').html __initData.descMap[jTcId.val()]
jTcId.change showTaocanDesc
showTaocanDesc()

#展示价格
jPriceRow = $('#priceRow')
priceDepend = ['ctp_id','prd_id','tc_id']
showPrice = ->
	isHide = no
	for v in priceDepend
		unless $("[name=#{v}]").val()
			jPriceRow.addClass 'hide'
			isHide=on
			break
	unless isHide
		for priceItem in __initData.priceLists
			find = true
			for v in priceDepend
				if priceItem[v]!=$("[name=#{v}]").val()
					find = no
					break
				if find
					jPriceRow.removeClass 'hide'
					$('#money').html('￥'+priceItem.prc_money/100+'元')
			if find
				break
		unless find
			jPriceRow.addClass 'hide'
#绑定事件(影响价格元素)
for v in priceDepend
	$("[name=#{v}]").change showPrice
showPrice()


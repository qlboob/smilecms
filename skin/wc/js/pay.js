// Generated by CoffeeScript 1.7.1
(function() {
  var config, jsApiList;

  jsApiList = ['chooseWXPay'];

  config = __initData.sign;

  config.jsApiList = jsApiList;

  wx.config(config);

  wx.ready(function() {
    return wx.checkJsApi({
      jsApiList: jsApiList,
      success: function(res) {
        var canUse, k, v, _ref;
        canUse = true;
        _ref = res.checkResult;
        for (k in _ref) {
          v = _ref[k];
          if (!v) {
            canUse = false;
            break;
          }
        }
        if (canUse) {
          return $('#payBtn').click(function() {
            var payObj;
            payObj = __initData.payParam;
            payObj.success = function(res) {
              return location.href = __initData.redirect;
            };
            return wx.chooseWXPay(payObj);
          });
        } else {
          return alert('你的手机不支持微信支付');
        }
      }
    });
  });

}).call(this);

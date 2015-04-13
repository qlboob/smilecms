// Generated by CoffeeScript 1.7.1
(function() {
  var config, jsApiList;

  jsApiList = ['chooseImage', 'uploadImage'];

  config = __initData.sign;

  config.jsApiList = jsApiList;

  wx.config(config);

  wx.ready(function() {
    return $('#mybtn').click(function() {
      return wx.chooseImage({
        success: function(imgRes) {
          var img;
          img = new Image();
          img.onload = function() {
            var cxt, dom, maxH, maxW, newH, newW;
            dom = document.getElementById('c');
            maxH = 400;
            maxW = 400;
            if (img.width / maxW > img.height / maxH) {
              img.width = maxW;
              newW = maxW;
              newH = img.height / img.width * maxW;
            } else {
              img.height = maxH;
            }
            $(dom).height(img.height);
            cxt = dom.getContext("2d");
            cxt.drawImage(img, 0, 0, 300, 300);
            if (dom.toDataURL) {
              setTimeout(function() {
                $('#nop').attr('src', dom.toDataURL('image/jpeg', 0.8));
                return alert(dom.toDataURL('image/jpeg').length);
              }, 3000);
            } else {
              alert('no');
            }
            $('#show').html(dom.toDataURL('image/jpeg'));
            alert($('#show').html());
            return alert(cxt.toDataURL('image/jpeg'));
          };
          return img.src = imgRes.localIds[0];
        }
      });
    });
  });

}).call(this);
// Generated by CoffeeScript 1.7.1
(function() {
  var src;

  setInterval(function() {
    return $.getJSON(location.href, function(ret) {
      if (0 === ret.code) {
        return location.href = ret.data.url;
      }
    });
  }, 4000);

  src = $('#qrcodeimg').attr('src');

  setInterval(function() {
    return $('#qrcodeimg').attr('src', src + ("?" + (Math.random())));
  }, 5 * 60 * 1000);

}).call(this);

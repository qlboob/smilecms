// Generated by CoffeeScript 1.7.1
(function() {
  $('#upload').click(function() {
    var uploadData;
    uploadData = {
      x: 1
    };
    if (document.getElementById('washinner').checked) {
      uploadData.tdl_innerwash = 1;
    }
    return $.getJSON(location.href, uploadData, function(ret) {
      return alert(ret.msg);
    });
  });

}).call(this);

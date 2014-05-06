(function($) {
  $(document).ready(function() {
    if (!window.lms) window.lms = {};
    bind();
    link();
  });
  
  /* bind hotkey to open login box */
  function bind() {
    $(document).keydown(function(e) {
      if ((e.ctrlKey) && (e.keyCode == 77) && (!lms.islogged)) {
        loginBox();
      }
    });
  }
  
  /* shows login box */
  function loginBox() {
    var d;
    if ($('#login-box').length < 1) {
      var _ = $('<div id="login-box" class="_dialog" style="width: 250px;"></div>');
      _.html('<h2 class="_title">Login</h2><div class="_close"></div><form method="post" id="login-box-form"><div class="_content"><input type="hidden" name="action" value="login">'+
        '<div class="_wrap"><div class="_label">Username</div><input type="text" title="Username" name="login" required="required" class="_lr _processed" value=""></div>'+
        '<div class="_wrap"><div class="_label">Password</div><input type="password" title="Username" name="password" required="required" class="_lr _processed" value=""></div>'+
      '</div><div class="_footer"><div class="_button __submit">Login</div></div></form>');
      $('body').append(_);
      _.click(function(e) {
        var t = $(e.target);
        if (t.is('.__submit')) _.find('form').submit();
        if (t.is('._close')) _.hide();
      });
      _.keyup(function(e) {
        if (e.keyCode == 13) _.find('form').submit();
      });
    }
    d = $('#login-box');
    d.show().css({ left: (($(window).width() - d.outerWidth())/2)+'px', top: (($(window).height() - d.outerHeight())/2+$(window).scrollTop())+'px' });
    d.find('input[name="login"]').focus();
  }
  
  function link() {
    $('#__admin').click(function() {
      loginBox();
      return false;
    });
  }
  
})(jQuery);
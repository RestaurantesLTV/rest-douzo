(function($) {
  $(document).ready(function() {
    if (window.location.hash) processHash(window.location.hash.substring(1));
    if (lms && lms.error) msg(lms.error, 'Error');
    if (lms && lms.msg) msg(lms.msg, 'Message');
    versions();
  });
  
  /* check browser versions and add a body class */
  function versions() {
    if ($.browser.msie) {
      if (parseInt($.browser.version, 10) < 8) $('body').addClass('browser-msie-7');
      else if (parseInt($.browser.version, 10) < 9) $('body').addClass('browser-msie-8');
      else $('body').addClass('browser-msie-9');
    }

    
  }
  
  /* processes hash part of url */
  function processHash(hash) {
    var _ = hash.split(';');
    hash = {};
    for (var i in _) {
      var __ = _[i].split('=');
      hash[__[0]] = __[1];
    }
    checkHash(hash);
  }
  
  /* checks hash for patterns */
  function checkHash(hash) {
    if (hash.msg) msg(hash.msg, 'Message');
    if (hash.error) msg(hash.error, 'Error');
  }
  
  /* fires message */
  function msg(m, type, cls) {
    alert(m);
  }
  
})(jQuery);

String.prototype.namespace = function(separator){
  var ns = this.split(separator || '.')
  var o = window;
  for(var i=0, len=ns.length; i<len; i++){
    o = o[ns[i]] = o[ns[i]] || {};
  }
  return o;
};

String.prototype.strip_tags = function(){
  return this.replace(/<\/?[^>]+>/gi, '');
}

if(!String.prototype.trim) {  
  String.prototype.trim = function () {  
    return this.replace(/^\s+|\s+$/g,'');  
  };  
}  

/*
   Timer functions overrride, added pause and resume functions
   Required to control child timers from NUI interface
   All stoppable (effects) timers should go under lms.timers.fx
*/
window._setTimeout = window.setTimeout;
window._clearTimeout = window.clearTimeout;
window._setInterval = window.setInterval;
window._clearInterval = window.clearInterval;


Timer = new function() {
  
  this.startI = function(callback, delay) {  return Timer.start(callback, delay, true); }
  this.start = function(callback, delay, interval) {
    var $start = new Date();
    if (interval) return { timer: window._setInterval(callback, delay), start: $start, state: 'active', callback: callback, delay: delay, interval: true };
    else return { timer: window._setTimeout(callback, delay), start: $start, state: 'active', callback: callback, delay: delay };
  }
  
  this.clear = function(obj) {
    if (!obj) return;
    if (obj.interval) window._clearInterval(obj.timer);
    else window._clearTimeout(obj.timer);
    delete obj;
  }

  this.pause = function(obj) {
    if (obj.interval) {
      window._clearInterval(obj.timer);
    }
    else {
      window._clearTimeout(obj.timer);
      obj.remaining = new Date() - obj.start;
    }
    obj.state = 'paused';
  }

  this.resume = function(obj) {
    if (obj.interval) {
      obj.timer = window._setInterval(obj.callback, obj.delay);
    }
    else {
      obj.timer = window._setTimeout(obj.callback, obj.remaining || obj.delay);
    }
    obj.state = 'active';
  }
  
}

window.setTimeout = Timer.start;
window.clearTimeout = Timer.clear;
window.setInterval = Timer.startI;
window.clearInterval = Timer.clear;


'lms'.namespace();
'lms.timers'.namespace();

lms.log = function(msg) {
  if (console && console.log) console.log(msg);
}

lms.inform = function(msg) {
  alert(msg);
}

jQuery.fn.serializeJSON=function() {
  var json = {};
  jQuery.map(jQuery(this).serializeArray(), function(n, i){
    var _ = n.name.indexOf('[');
    if (_ > -1) {
      var o = json;
      _name = n.name.replace(/\]/gi, '').split('[');
      for (var i=0, len=_name.length; i<len; i++) {
        if (i == len-1) {
          if (o[_name[i]]) {
            if (typeof o[_name[i]] == 'string') {
              o[_name[i]] = [o[_name[i]]];
            }
            o[_name[i]].push(n['value']);
          }
          else o[_name[i]] = n['value'];
        }
        else o = o[_name[i]] = o[_name[i]] || {};
      }
    }
    else json[n['name']] = n['value'];
  });
  return json;
};

/* Translates html string into parameters */
function translate(html) {
  var _ = {};
  var __ = html.split(';');
  for (var i in __) {
    var pos;
    __[i] = trim(__[i]);
    pos = __[i].indexOf('=');
    if (pos == -1) continue;
    _[trim(__[i].substr(0, pos))] = trim(__[i].substr(pos+1, __[i].length-pos-1));
  }
  return _;
}

function trim(s) {
  if(!String.prototype.trim) {  
    return s.replace(/^\s+|\s+$/g,'');  
  }
  else return s.trim();      
}

function pInt(a) { if (isNaN(parseInt(a, 10))) return 0; return parseInt(a, 10) }

function getCookie (name) {
  var cookie = " " + document.cookie;
  var search = " " + name + "=";
  var setStr = null;
  var offset = 0;
  var end = 0;
  if (cookie.length > 0) {
      offset = cookie.indexOf(search);
      if (offset != -1) {
          offset += search.length;
          end = cookie.indexOf(";", offset)
          if (end == -1) {
              end = cookie.length;
          }
          setStr = unescape(cookie.substring(offset, end));
      }
  }
  return(setStr);
}

function setCookie(name, value, expires, path, domain, secure) {    // Send a cookie
    expires instanceof Date ? expires = expires.toGMTString() : typeof(expires) == 'number' && (expires = (new Date(+(new Date) + expires * 1e3)).toGMTString());
    var r = [name + "=" + escape(value)], s, i;
    for(i in s = {expires: expires, path: path, domain: domain}){
        s[i] && r.push(i + "=" + s[i]);
    }
    return secure && r.push("secure"), document.cookie = r.join(";"), true;
}

function number_format(number, decimals, dec_point, thousands_sep) {
  var i, j, kw, kd, km;
  if (isNaN(decimals = Math.abs(decimals))) decimals = 2;
  if (dec_point == undefined) dec_point = ",";
  if (thousands_sep == undefined) thousands_sep = " ";
  i = parseInt(number = (+number || 0).toFixed(decimals)) + "";
  if ((j = i.length) > 3) j = j % 3; else j = 0;
  km = (j ? i.substr(0, j) + thousands_sep : "");
  kw = i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands_sep);
  kd = (decimals ? dec_point + Math.abs(number - i).toFixed(decimals).replace(/-/, 0).slice(2) : "");
  return km + kw + kd;
}

var JSON = JSON || {};
JSON.stringify = JSON.stringify || function (obj) {
  var t = typeof (obj);
  if (t != "object" || obj === null) {
    if (t == "string") obj = '"'+obj+'"';
    return String(obj);
  }
  else {
    var n, v, json = [], arr = (obj && obj.constructor == Array);
    for (n in obj) {
      v = obj[n]; t = typeof(v);
      if (t == "string") v = '"'+v+'"';
      else if (t == "object" && v !== null) v = JSON.stringify(v);
      json.push((arr ? "" : '"' + n + '":') + String(v));
    }
    return (arr ? "[" : "{") + String(json) + (arr ? "]" : "}");
  }
};
JSON.parse = JSON.parse || function (str) {
  if (str === "") str = '""';
  eval("var p=" + str + ";");
  return p;
};

/* Loading method to show progress */
function loading(show, desc, synchronous, timer) {
  if (lms && lms.core && lms.core.nui && lms.core.nui.main && lms.core.nui.main.loading) {
    lms.core.nui.main.loading(show, desc, synchronous, timer);
  }
}

/* Shows hint&actions in progressbar */
function status(action, timer) {
  if (lms && lms.core && lms.core.nui && lms.core.nui.main && lms.core.nui.main.action) {
    lms.core.nui.main.action(action, timer);
  }
}

/* console.log */
if (!window.console && !console.log) {
  window.console = {};
  window.console.log = function(msg) {
    
  }
}

/* AJAX handler for all request */
function ajax(data, success, error, block) {
  var dataType = 'json';
  data.action = 'ajax';
  if (data.dataType) dataType = data.dataType;
  loading(1, 'Communicating with server', (block)?true:false);
  jQuery.ajax({ type: "POST", url: lms.ajax_url, data: data, dataType: dataType, 
    success: [
      function(sdata) {
        if (sdata) {
          if (sdata.action) eval(sdata.action);
          else if (sdata.redirect) window.location.href = sdata.redirect;
        }
        loading(0, '', null);
      },
      success
    ],
    error: [
      function(jqXHR, textStatus, errorThrown) {
        lms.inform("Following error has occured:\n"+errorThrown);
        lms.log(errorThrown);
        loading(0, 'An error occured: '+errorThrown, null);
      },
      error
    ],  
    statusCode: {
      203: function(data) { // there has been some minor error, lets show it to client;
        if (data && data.error) lms.inform("Following minor error has occured:\n"+data.error);
      }
    }

  });
  
}

function _t(str) {
  return str;
}


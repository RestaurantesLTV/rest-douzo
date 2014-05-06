'lms.plugins'.namespace();

lms.plugins.comments = new function() {
  var $ = jQuery;

  var init = function() {
    $('div.comment-spot:not(".processed")').each(function() {
      var el = $(this);
      process(el);
      processForm(el);
      el.addClass('.processed');
    });
    events();
  }
  
  function process(el) {
    var id = el.attr('id').replace('comment-spot-', '');
    el.html('<h2>Comments</h2><ul></ul>');
    ajax({ ref: 'comments/get', id: id },
      function(data) {
        if (data) for (var i in data) {
          add(el, data[i]);
        }
      }
    );
  }
  
  function add(el, comment) {
    var ul = el.find('ul');
    ul.append('<li><h4>'+comment.name+'</h4><div class="text">'+comment.text+'</div><div class="date">'+comment.time_+'</div></li>');
  }

  function processForm(el) {
    el.append('<div class="comment-form"><form><h2>Comment me!</h2>'+
      '<div><label>Your name:</label><input type="text" name="form[name]" value="" title="Your name" required="required" /></div>'+
      '<div><label>Your message:</label><textarea name="form[text]" title="Your message" required="required"></textarea></div>'+
      '<div><input type="button" value="Send" class="transition-05 button" /></div>'+
    '</form></div>');
  }
  
  function events() {
    $('body').on('click', 'div.comment-form input.button', function() {
      var parent = $(this).parents('div.comment-spot'), id = parent.attr('id').replace('comment-spot-', ''), form = $(this).parents('form');
      form.find('.error').removeClass('error');
      form.find('[required]').each(function() {
        if ($(this).val() == '') $(this).addClass('error');
      });
      if (form.find('.error').length > 0) return;
      ajax({ ref: 'comments/send', id: id, data: form.serializeJSON() }, 
        function(data) {
          if (data) add(parent, data);
          form.find('[required]').val('');
        }
      );
      return false;
    });
  }
  
  $(document).ready(function() {
    init();
  });

};

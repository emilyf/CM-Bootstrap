(function ($) {
  $(function () {
    if (window.location.pathname == '/node/add/cm-show' && screen.width > 767) {
      var submit = $('#edit-submit');
      $("#cm-show-node-form .vertical-tabs-list").append("<li></li>");
      submit.appendTo($("#cm-show-node-form .vertical-tabs-list li:last-child"));
    }
  });
})(jQuery);
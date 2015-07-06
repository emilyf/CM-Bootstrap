(function ($, Drupal) { 
  $(window).load(function () {
    $(".cf-spectrum").spectrum({
      showInitial: true,
      showInput: true,
      preferredFormat: "hex",
    });
  });
})(jQuery, Drupal);
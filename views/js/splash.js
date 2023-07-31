$(function() {
  $(document).ready(function() {
    $("#menuIcon").on("click", function() {
      $("#navLinks").toggleClass("responsive");
    });
  });

  $(document).ready(function () {
    const images = $("#splash-gif img");
    let currentImageIndex = 0;

    function fadeNextImage() {
        images.removeClass('active'); // Remove 'active' class from all images
        images.eq(currentImageIndex).addClass('active'); // Add 'active' class to the current image
        currentImageIndex = (currentImageIndex + 1) % images.length;
    }

    setInterval(fadeNextImage, 2500);
  });

  $(document).ready(function() {
      $(window).scroll(function() {
          var header = $("header");
          header.toggleClass("sticky", $(window).scrollTop() > 0);
      });
  });
});
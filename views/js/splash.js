$(function() {
    $(document).ready(function() {
        const images = $("#splash-gif img");
        let currentImageIndex = 0;

        images.eq(currentImageIndex).css("opacity", "1");
      
        function fadeNextImage() {
          images.eq(currentImageIndex).animate({ opacity: 0 }, 1000, function() {
            currentImageIndex = (currentImageIndex + 1) % images.length;
            images.eq(currentImageIndex).animate({ opacity: 1 }, 1000);
          });
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
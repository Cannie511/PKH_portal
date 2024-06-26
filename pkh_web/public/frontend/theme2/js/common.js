(function( $ ) {
    "use strict";
  
    $(function() {
      var qrcode = new QRCode("qrcode", {
            text: "https://www.phankhangco.com",
            width: 124,
            height: 124,
            colorDark : "#000000",
            colorLight : "#ffffff",
            correctLevel : QRCode.CorrectLevel.H,
            logo: "/frontend/theme2/images/pkh-small-qr.png"
        });
    });
  
}(jQuery));
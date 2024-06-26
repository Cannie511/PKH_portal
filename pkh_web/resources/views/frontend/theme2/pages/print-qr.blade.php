<html>

<head>
<script
			src="//code.jquery.com/jquery-3.4.1.min.js"
			integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
			crossorigin="anonymous"></script>
<!-- <script type="text/javascript" src='<% asset_url("frontend/theme2/js/davidshimjs/qrcode.min.js") %>'></script> -->
<script type="text/javascript" src='<% asset_url("frontend/theme2/js/EasyQRCodeJS/dist/easy.qrcode.min.js") %>'></script>

<style type="text/css">
.qr-code {
    padding: 5px;
    border: 1px solid #333;
    /* border-radius: 2px; */
    display: inline-block;
    margin: 5px;
}
</style>
</head>
<body>

    <?php 
        $prefixUrl = env('URL_WWW','https://wwww.phankhangco.com');
    ?>

    <?php foreach ($listCode as $code):?>
        <h3><?php echo $code; ?></h3>
        <?php for($i=0; $i < $amount; $i++){ ?>
            <div class="qr-code" id='<?php echo "$code-$i";?>'></div>
        <?php } ?>
        <hr/>
    <?php endforeach; ?>

    <script type="text/javascript">

(function( $ ) {
    "use strict";
  
    $(function() {
        var prefixUrl = "<?php echo env('URL_WWW','https://wwww.phankhangco.com'); ?>";
        var logoUrl = "/frontend/theme2/images/pkh-small-qr.png";
        var size = <?php echo $size; ?>;
        var amount = <?php echo $amount; ?>;
        var listCode = <?php echo json_encode($listCode); ?>;

        console.log('size', size);
        console.log('amount', amount);
        console.log('listCode', listCode);

        listCode.forEach((code) => {
            console.log(code);
            for(let i = 0 ; i < amount ;i++) {
                let id = code + "-" + i;
                let text = prefixUrl + "/bao-hanh/" + code;
                console.log(id, text);
                // create qr
                new QRCode(id, {
                    text: text,
                    width: size,
                    height: size,
                    colorDark : "#000000",
                    colorLight : "#ffffff",
                    correctLevel : QRCode.CorrectLevel.H,
                    logo: logoUrl
                });
            }
        })
    });
    
}(jQuery));

    </script>
</body>
</html>
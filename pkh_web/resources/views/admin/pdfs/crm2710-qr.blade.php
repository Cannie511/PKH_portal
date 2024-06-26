<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" /> 
        <style type="text/css">
            body {
                font-family: "DejaVu Sans";
                font-size: 12px;
                margin-bottom: 50px;
            }
             #logo {
                width: 200px;
            }
            .table {
                width: 100%;
                border: 1px solid #000;
                margin_bottom: 10px;
            }
            .table th {
                vertical-align: middle;
                text-align: center;
                font-weight: bold;
            }
            .table th, td {
                border: 1px solid #000;   
            }
            .text-center{
                text-align: center;
            }
            .text-right{
                text-align: right;
            }

            .table1{
                  border: 1px solid black;
            }

            span{
                 font-weight: bold;
            }

            #store_info th {
              
                text-align: left;
            }
            #store_info th,
            #store_info td {
                padding-left: 3px;
                padding-right: 3px;
            }
            #store_info #center{
              
            }

             #store_info #comment{
                background-color :#dbdde6;
                text-align: center;
                
            }
            .text-left{
                text-align: left !important;
            }

            .table.no-border,
            .table.no-border tr,
            .table.no-border td {
                border: none;
            }
        </style>
    </head>
    <body>
        <script type="text/php">
        if ( isset($pdf) ) { 
            $pdf->page_script('
                if ($PAGE_COUNT > 1) {
                    //$font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                    $font = $fontMetrics->get_font("DejaVu Sans", "normal");
                    $size = 8;
                    $pageText = $PAGE_NUM . " / " . $PAGE_COUNT;
                    $y = 750;
                    $x = 520;
                    $pdf->text($x, $y, $pageText, $font, $size);
                } 
            ');
        }
        </script>


        this is my tst
        Size: [[$size]]
        <br/>
        Size: [[$amount]]
        <br/>
        Code: <?php echo print_r($listCode, true);?>

        <div class="visible-print text-center">
            {!! QrCode::size(100)->generate("temp"); !!}
            <p>Scan me to return to the original page.</p>
        </div>

    </body>
</html>
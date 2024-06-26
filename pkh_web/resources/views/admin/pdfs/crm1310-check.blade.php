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

            #store_info th {
              
                text-align: left;
            }
            #store_info th,
            #store_info td {
                padding-left: 3px;
                padding-right: 3px;
            }
            #store_info #center{
                background-color :#033192;
                text-align: center;
                color: #f5fffa;
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
        <table class="table no-border" cellpadding="0" cellspacing="0">
            <tr>
                <td style="padding-left: 5px">
                    <span>Name: PHAN KHANG HOME</span><br/>
                    <span>Adddress:No.63, Street 30, Ward Tan Phong, District 7, HCMC, Vietnam</span><br/>
                    <span>Phone: (84) 543 33716</span><br/>
                    <span>Website: www.phankhangco.com</span>
                </td>
                <td class="text-right">
                    <span></span>
                    <img id="logo" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAdEAAADICAYAAAC3bdt8AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAA/FpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNS1jMDIxIDc5LjE1NTc3MiwgMjAxNC8wMS8xMy0xOTo0NDowMCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtbG5zOmRjPSJodHRwOi8vcHVybC5vcmcvZGMvZWxlbWVudHMvMS4xLyIgeG1wTU06T3JpZ2luYWxEb2N1bWVudElEPSJ1dWlkOjVEMjA4OTI0OTNCRkRCMTE5MTRBODU5MEQzMTUwOEM4IiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOjk1MzgzNzcyNzczNjExRTY4QTMxQ0RCODMxQTNCNDFDIiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOjk1MzgzNzcxNzczNjExRTY4QTMxQ0RCODMxQTNCNDFDIiB4bXA6Q3JlYXRvclRvb2w9IkFkb2JlIElsbHVzdHJhdG9yIENTNiAoV2luZG93cykiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0idXVpZDo0ZjJlYzVjMy1jOWU3LTQ2MzEtYWRhMy0zNmNhZjdjY2NjZDAiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6MkJBNTI0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" alt="" />
                    <br/>
                   
                </td>
            </tr>
             <tr>
                <td colspan="2" class="text-center">
                    <h2>PURCHASE ORDER </h2>
                </td>
            </tr>
        </table>
        
        <!--Vendor-->
        <table id="store_info" class="table" cellpadding="0" cellspacing="0">
            <tr>
                <th colspan="4" id="center">VENDOR</th>
            </tr>
            <tr>
                <th>Name</th>
                <td colspan="3">WATERTEC (MALAYSIA) SDN BHD</td>
            </tr>
            <tr>
                <th>Address</th>
                <td colspan="3">Lot 3, Jalan Halba Satu 16/16A, Section 16, 402000 Shah Alam, Selangor Darul Ehsan, Malaysia</td>
            </tr>
            <tr>
                <th>Phone</th>
                <td colspan="3">60 3 5510 7808</td>
            </tr>
            <tr>
                <th>Website</th>
                <td colspan="3"> www.watertec.biz</td>
            </tr>
        </table>

        <!--Shipping to-->
        <table id="store_info" class="table" cellpadding="0" cellspacing="0">
            <tr>
                <th colspan="4" id="center">SHIPPING TO</th>
            </tr>
            <tr>
                <th>Name</th>
                <td colspan="3">PHAN KHANG HOME COMPANY</td>
            </tr>
            <tr>
                <th>Address</th>
                <td colspan="3">No.63, Street 30, Ward Tan Phong, District 7, Hochiminh City, Vietnam</td>
            </tr>
            <tr>
                <th>Phone</th>
                <td colspan="3">(84) 543 33716</td>
            </tr>
            <tr>
                <th>Website</th>
                <td colspan="3">www.phankhangco.com</td>
            </tr>
        </table>
       

        <!-- -->
        <table id="store_info" class="table" cellpadding="0" cellspacing="0">
            <tr>
                <th colspan="1" id="center">REQUISITIONER</th>
                <th colspan="1" id="center">SHIP VIA</th>
                <th colspan="1" id="center">F.O.B.</th>
                <th colspan="1" id="center">SHIPPING TERMS</th>
              
            </tr>
            <tr>
                <td colspan="1">_</td>
                <td colspan="1">_</td>
                <td colspan="1">_</td>
                <td colspan="1">_</td>
            </tr>
        </table>

        


        <!--List product -->
        <table id="store_info" class="table" cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th id="center" style="width: 20px">No</th>
                    <th id="center">FACTORY CODE</th>
                    <th id="center">DESCRIPTION</th>
                    <th id="center" style="width: 70px">COLOR</th>
                    <th id="center" style="width: 70px">PACKAGE</th>
                    <th id="center" style="width: 70px">QUANTITY</th>
                    <th id="center" style="width: 30px">NOTE</th>
                </tr>
            </thred>
            <tbody>
                <?php $index = 1; ?>
                <?php foreach($orders as $dDetail): ?>

                <tr>
                    <td class="text-center"><?php echo $index++; ?></td>
                    <td>[[$dDetail->stock_code]]</td>
                    <td>[[$dDetail->product_name]]</td>
                    <td>[[$dDetail->color]]</td>
                    <td class="text-right">[[$dDetail->standard_packing]]</td>
                    <td class="text-right">[[number_format($dDetail->amount)]]</td>
                    <td>_</td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!--Footer-->
        <table id="store_info" class="table" cellpadding="0" cellspacing="0">
            <tr>
                <th id="comment">Comments or Special Instructions</th>
            </tr>
            <tr>
                <td>_</td>
            </tr>           
        </table>

        <table id="store_info" class="table" cellpadding="0" cellspacing="0">
         
            <tr>
                <th >SUBTOTAL</th>
                <td >_</td>
            </tr>
            <tr>
                <th >TAX</th>
                <td >_</td>
            </tr>
            <tr>
                <th >SHIPPING</th>
                <td >_</td>
            </tr>
            <tr>
                <th >OTHER</th>
                <td >_</td>
            </tr>
             <tr>
                <th >TOTAL</th>
                <td >$_</td>
            </tr>
                
        </table>

        <table class="table no-border" cellpadding="0" cellspacing="0">
            <tr>
                <td class="text-center" >If you have any questions about this purchase order, please contact PHAN KHANG HOME COMPANY<b>Email: cs@phankhangco.com</b></td>
               
            </tr>
        </table>

    </body>
</html>
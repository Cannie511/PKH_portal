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
        <?php $contract = $form[0]->contract_no ?>
        <table id="store_info" class="table no-border" cellpadding="0" cellspacing="0">
             <tr>
                <td colspan="2" class="text-center">
                    <h2>SALES CONTRACT </h2>
                </td>
              
            </tr>
            <tr>
                <td >
                    DATE : [[$day]]<sup>[[$mark]]</sup> [[$month]], [[$year]] 
                </td>       
            </tr>

            <tr>
                <td>
                      CONTRACT NO : [[$contract]]
                </td>        
            </tr>
        </table>
        
        <div class="table1">
            <table id="store_info" class="table no-border" cellpadding="0" cellspacing="0">
                <tr>
                    <td >
                        <h3>PHAN KHANG HOME CO.,LTD</h3>
                    </td>             
                </tr>
                <tr>                   
                    <td >
                    <span> Business Registration No.:</span> 0313993571	  
                    </td>       
                </tr>

                <tr>
                    <td  >
                    <span>Registed Add.:</span> 147/1A Tran Quang Khai Str., Tan Dinh Ward, Dist. 1, Hochiminh City, Vietnam
                    </td>        
                </tr>
                <tr>
                    <td  >
                    <span>Deposit type:</span> TG KKH TCTKT 
                    </td>        
                </tr>
                <tr>
                    <td  >
                    <span>CIF No.:</span> 117325365  -	 		Effective date: 09.09.2016
                    </td>        
                </tr>
                <tr>
                    <td  >
                    <span>Account No.:</span> 100714851027680  -   	Effective date: 09.09.2016
                    </td>        
                </tr>
                <tr>
                    <td  >
                    <span>Bank:</span> VIETNAM EXIMBANK - HOA BINH 
                    </td>        
                </tr>
                <tr>
                    <td  >
                    <span>Branch</span>       	Swiff: 	<span>EBVIVNVXHBH</span>
                    </td>        
                </tr>
                <tr>
                    <td  >
                    <span>Address:</span> 78 Nguyen Trai Str., Ward 3, District 5, Hochiminh City, Vietnam
                    </td>        
                </tr>
            </table>
        </div>

        <p>Herein after called the “BUYER”	 AND</p>

        <div class="table1">
            <table id="store_info" class="table no-border" cellpadding="0" cellspacing="0">
                <tr>
                    <td >
                        <h3>WATERTEC (MALAYSIA) SDN BHD</h3>
                    </td>             
                </tr>
                      
                <tr>
                    <td  >
                    <span>Address:</span> Lot 3, Jalan Halba Satu 16/16A, Section 16 40200 Shah Alam Selangor Darul Ehsan Malaysia

                    </td>        
                </tr>
                <tr>
                    <td  >
                    <span>Tel:</span>+ 60 (3) 5510 7808 

                    </td>        
                </tr>
                 <tr>
                    <td  >
                    <span>Fax:</span>+ 60 (3) 5510 7782 

                    </td>        
                </tr>
            </table>
        </div>

        <p>Herein after called the “SELLER”	</p>

        <p>It has been agreed that the buyer buys and the Seller sells the commodity and the terms and conditions specified here under: </p>

        <h3>ARTICLE 1: COMMODITY & SPECIFICATION, QUANTITY, PRICE: </h3>
             


        <!--List product -->
        <table id="store_info" class="table" cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th id="center" style="width: 20px">No</th>
                    <th id="center">STOCK CODE</th>
                    <th id="center">ITEM  DESCRIPTION</th>
                    <th id="center" style="width: 70px">COLOUR</th>
                    <th id="center" colspan="2" style="width: 70px">STANDARD PACKING </th>
                    <th id="center" colspan="2" style="width: 70px">ORDERED QUANTITY </th>
                    <th id="center" style="width: 30px">UNIT PRICE</th>
                    <th id="center" style="width: 30px">AMOUNT</th>
                </tr>
            </thred>
            <tbody>
                <?php $index = 1;
                      $sum =0;  
                      $freightCost = $form[0]->frieght_cost;
                      $total=0;
                     
                ?>
                
                <?php foreach($orders as $dDetail): ?>

                <tr>
                    <td class="text-center"><?php echo $index++; ?></td>
                    <td>[[$dDetail->stock_code]]</td>
                    <td>[[$dDetail->product_name]]</td>
                    <td>[[$dDetail->color]]</td>
                    <td class="text-right">[[$dDetail->standard_packing]]</td>
                    <td>pcs</td>
                    <td class="text-right">[[number_format($dDetail->amount)]]</td>
                    <td>pcs</td>
                    <td class="text-right">[[number_format($dDetail->unit_price,2)]]</td>
                    <td class="text-right">[[number_format($dDetail->unit_price*$dDetail->amount,2)]]</td>
                </tr>
                <?php $sum = $sum + $dDetail->unit_price*$dDetail->amount ?>
                <?php endforeach; ?>
            </tbody>
           
        </table>
        <?php $total = $sum + $freightCost ?>
        <!--Footer-->
        <table id="store_info" class="table" cellpadding="0" cellspacing="0">
                 <tr>
                    <th>AMOUNT</th>
                    <td class="text-right">[[ number_format($sum,2) ]]</td>
                </tr>
                <tr>
                    <th>FREIGHT COST</th>
                    <td class="text-right"> [[number_format($freightCost,2) ]]</td>
                </tr>
                <tr>
                    <th>TOTAL AMOUNT</th>
                    <td class="text-right">[[ number_format($total,2) ]] </td>
                </tr>
        </table>

      
        <table class="table no-border" cellpadding="0" cellspacing="0">
            <tr>
                <td>
                    <span>Commodity:  WaterTec Faucet Fittings</span>
                </td>
            </tr>
            <tr>
                <td>
                 Total value:  <b> [[ number_format($total,2) ]] USD </b>
                 </td>
            </tr>
            <?php $ahihi= $payment_desc ?>
             <tr>
                <td>
                    <span>([[$ahihi]])</span>
                </td>
            </tr>
            <tr>
                <td>
                    <span>(C.F.R PORT KLANG, INCOTERM 2000)</span>
                </td>
            </tr>
        </table>

        <h3>ARTICLE 2: ORIGIN & QUALITY</h3>
        <table class="table no-border" cellpadding="0" cellspacing="0">
            <tr>
                <td>
                   Origin: Malaysia 
                </td>
            </tr>
            <tr>
                <td>
                 Quality: according to manufacturer standard, 100% brand new goods
                 </td>
            </tr>       
        </table>


         <h3>ARTICLE 3: PACKING AND MARKING</h3>
         <table class="table no-border" cellpadding="0" cellspacing="0">
            <tr>
                <td>
                   - Packing: complying with international Export Standard. Goods shall be packed in strong and adequate cartons for long distant transport.
                </td>
            </tr>
            <tr>
                <td>
                -	Marking: Phuong Hoang Co., ltd
                 </td>
            </tr>       
        </table>
        <?php $payment_1_percent= $form[0]->payment_1_percent; 
            $payment1 = $payment_1_percent * $total /100;
        ?>
        <h3>ARTICLE 4: SHIPMENT</h3>
          <table class="table no-border" cellpadding="0" cellspacing="0">
            <tr>
                <td>
                  - The shipments: Within 05 days after receipt of [[$payment_1_percent]]%, all the goods must be loaded on board. The Seller must fax or email to the Buyer the full documents within 3 days after the date of shipment.
                </td>
            </tr>
            <tr>
                <td>
               - Port of Loading	: MALAYSIA PORT KLANG.
                 </td>
            </tr>    
            <tr>
                <td>
             - Port of Destination:  Cat Lai Port, VIETNAM 
                 </td>
            </tr>      
             <tr>
                <td>
            - Partial shipment	   :  allowed.
                 </td>
            </tr>      
               <tr>
                <td>
            - Transshipment	   : allowed.
                 </td>
            </tr>       
        </table>
        <?php $payment_2_duration= $form[0]->payment_2_duration ?>
        <h3>ARTICLE 5: PAYMENT</h3>
         <table class="table no-border" cellpadding="0" cellspacing="0">
            <tr>
                <td>
                The amount USD [[number_format($payment1,2)]] via Telegraphic Transfer before delivery of goods and the balance will be paid [[$payment_2_duration]] days from date of the Bill of Lading.
                 </td>
            </tr>      
            <tr>
                <td>
                    BANKING INFORMATION 
                 </td>
            </tr>       
            <tr>
                <th class="text-left">
                1.BENEFICIARY : WATERTEC (MALAYSIA) SDN BHD
                </th>
            </tr>
            <tr>
                <th class="text-left">
               2.ADD: Lot 3, Jalan Halba 16/16, Section 16 40200 Shah Alam Selangor Darul Ehsan Malaysia
                </th>
            </tr>
            <tr>
                <th class="text-left">
             3. BANK NAME :  HSBC BANK MALAYSIA BERHAD 2,LEBOH AMPANG,50100 KUALA LUMPUR MALAYSIA
                </th>
            </tr>
            <tr>
                <th class="text-left">
            4. ACCOUNT NO. : 301-349155-001
                </th>
            </tr>
            <tr>
                <th class="text-left">
                 5.SWIFT: MT 100 TO HBMBMYKL 
                         -  MT 202 TO MRM DU533 AC OF HBMBMYKL
                </th>
            </tr>
        </table>

        <h3>ARTICLE 6: DOCUMENTS</h3>
         <table class="table no-border" cellpadding="0" cellspacing="0">
            <tr>
                <td>
                  - Signed commercial invoice in triplicate.
                </td>
            </tr>
            <tr>
                <td>
              - Detailed packing in triplicate.
                 </td>
            </tr>    
            <tr>
                <td>
             - Quality certificate in duplicate
                 </td>
            </tr>      
             <tr>
                <td>
           - Certificate of Origin FORM D issued by <span>MITI (MINISTRY OF INTERNATIONAL TRADE AND INDUSTRY) </span>
                 </td>
            </tr>      
                 
        </table>


        <h3>ARTICLE 7: PENALTY</h3>
          <table class="table no-border" cellpadding="0" cellspacing="0">
            <tr>
                <td>
                In case the Seller’s product is not same catalogue had sent, the Buyer’s will immediately inform situation of the goods to the Seller to solve problems to the guaranty condition or compensate for the damage which out of the Buyer’s control.
                </td>
            </tr>
                 
        </table>

         <h3>ARTICLE 8: GUARANTY</h3>
          <table class="table no-border" cellpadding="0" cellspacing="0">
            <tr>
                <td>
              The guaranty for each product from one (01) years to six (06) years base on standard of manufacture from date of receiving goods at Vietnam for all damages caused by the fault of technical from manufacturing.
                </td>
            </tr>
             <tr>
                <td>
             This guaranty does not apply to products failure due to accident, abuse, mishandling, improper installation, alteration, acts of nature, or improper usage. The Seller will not liable for damages resulting from third party device that causes the products to fail. The Seller is also not responsible for damages or failures of any third party equipment, even if Seller has been advised of the possibility.
                </td>
            </tr>   
            <tr>
                <td>
             The warranty will be informed to The Seller each four (04) months for replacement new one. The fee is on the Seller’s account. 
                </td>
            </tr>   
        </table>


        <h3>ARTICLE 9: ARBITRATION</h3>
          <table class="table no-border" cellpadding="0" cellspacing="0">
            <tr>
                <td>
               Any discrepancy and or dispute arising in our commerce with this contract, if not being settled amicable, shall be referred to the Vietnam International Arbitration centre located next to the Chamber of Commerce and Industry of Viet Nam.
                </td>
            </tr>
                 
        </table>

         <h3>ARTICLE 10: GENERAL CONDITION.</h3>
          <table class="table no-border" cellpadding="0" cellspacing="0">
            <tr>
                <td>
               Any amendment of this contract must be made out in writing and or fax confirmed by both parties. This contract come into effect from each party keep two.
                </td>
            </tr>
                 
        </table>

         <table class="table no-border" cellpadding="0" cellspacing="0">
            <tr>
                <td class="text-center" style="width:50%"><b>FOR THE BUYER</b></td>
                <td class="text-center" style="width:50%"><b>FOR THE SELLER</b></td>
            </tr>
           
        </table>
         <table class="table no-border" style="padding-top: 2.5cm;" cellpadding="0" cellspacing="0">
          
            <tr >
                <td class="text-center" style="width:50%"><b>PHAN HUU CHIEN</b></td>
                <td class="text-center" style="width:50%"><b>CHEONG WAN HAN</b></td>
            </tr>
        </table>

    </body>
</html>
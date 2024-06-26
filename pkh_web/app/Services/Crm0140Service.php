<?php

namespace App\Services;

use DB;
use Log;

/**
 * Crm0140Service class
 */
class Crm0140Service extends BaseService
{
    /**
     * @param $productCode
     * @return mixed
     */
    public function selectProductByCode($productCode)
    {
        // Log::debug('**************selectProductByCode************');
        $sqlParam = [];
        $sql      = "
			select
                a.product_code
                , a.supplier_id
                , a.name
                , a.warranty_year
                , a.color
                , a.standard_packing
                , a.selling_price
                , a.warning_qty
			from
			  mst_product a
			where
			  a.active_flg = '1'
			  and a.product_code like ?";

        $sqlParam[] = $productCode . '%';

        $result = DB::select(DB::raw($sql), $sqlParam);

        if (isset($result) && count($result) > 0) {
            return $result[0];
        }

        return $result;
    }

    /**
     * @param $crmPriceList
     * @return mixed
     */
    public function selectListPrice($crmPriceList)
    {
        // Log::debug('**************selectListPrice************');
        $list    = [];
        $value   = [];
        $level   = [];
        $note    = [];
        $product = [];
        $stt     = [];
        $i       = 0;
        $NO      = 0;
        $text    = trim($crmPriceList);
        $textAr  = explode("\n", $text); // remove the last \n or whitespace character
        $textAr  = array_filter($textAr, 'trim');

// remove any extra \r characters left behind

// Log::debug(print_r($crmPriceList, true));

// Log::debug("array:");
        foreach ($textAr as $line) {
            // processing here.
            $line     = trim($line);
            $php_pot2 = stripos($line, '##');

            if (false !== $php_pot2) {
                $line = substr($line, 2, strlen($line) - 1);
                Log::debug('  chuỗi cấp 2');
                $level[$i] = 2;
            } else {
                $php_pot1 = stripos($line, '#');

                if (false !== $php_pot1) {
                    $line = substr($line, 1, strlen($line) - 0);
                    Log::debug('chuỗi cấp 1');
                    $level[$i] = 1;
                } else {
                    $php_pot3 = stripos($line, '-');

                    if (false !== $php_pot3) {
                        $line = substr($line, 1, strlen($line) - 0);
                        Log::debug('    chuỗi cấp 3');
                        $line        = trim($line);
                        $level[$i]   = 3;
                        $stt[$i]     = ++$NO;
                        $productCode = substr($line, 0, 6);
                        Log::debug(print_r($productCode, true));

                        if (strlen($line) > 6) {
                            $note[$i] = substr($line, 7, strlen($line) - 6);
                            Log::debug(print_r($note, true));
                        }

                        $product[$i] = $this->selectProductByCode($productCode);
                        // Log::debug(print_r($product[$i], true));
                    }

                }

            }

            $line      = trim($line);
            $value[$i] = $line;

            // Log::debug(print_r($line, true));
            $i++;
            // processing here.
        }

// Log::debug('*****************************');

        /////////////////////////////////////////////////////////////////
        $sqlParam = array();
        $sql      = "";

// $result = array();
        //$result =  $this->pagination($sql, $sqlParam, $param);
        $result = [
            'stt'     => $stt,
            'value'   => $value,
            'level'   => $level,
            'product' => $product,
            'note'    => $note,
        ];

// Log::debug(print_r($product, true));
        // Log::debug(print_r($result, true));

        return $result;
    }

}

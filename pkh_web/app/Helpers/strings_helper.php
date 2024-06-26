<?php

/**
 * String helper function
 * Prefix: sh_
 * Author: Nguyen Phu Cuong
 */

if (!function_exists('sh_num2Str')) {
    /**
     * Number to string code
     * @param  [type] $num [description]
     * @return [type]      [description]
     */
    function sh_num2Str(
        $num,
        $round = true
    ) {

        $ACCEPT_CHARS = [
            '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'J', 'K', 'M', 'N', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
        ];

        $result  = "";
        $num     = intval($num);
        $maxChar = count($ACCEPT_CHARS);

        while ($num > 0) {
            $temp   = $num % $maxChar;
            $result = $ACCEPT_CHARS[$temp] . $result;
            $num    = floor($num / $maxChar);
        }

        return $result;
    }

}

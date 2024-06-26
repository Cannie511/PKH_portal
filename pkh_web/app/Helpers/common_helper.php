<?php

if (!function_exists('getSubDomain')) {
    /**
     * Get sub domain
     * @return [type] [description]
     */
    function getSubDomain()
    {
        $host      = Request::getHost();
        $parts     = explode('.', $host);
        $subdomain = null;

        if (count($parts) > 0) {
            $subdomain = $parts[0];
        }

        return $subdomain;
    }

}

if (!function_exists('md5Array')) {
    /**
     * Create md5 key from array
     * @param  Array $param [description]
     * @return String
     */
    function md5Array($param)
    {

        if (is_array($param) || is_object($param)) {
            //Generate URL-encoded query string
            $key = http_build_query($param);

            return md5($key);
        }

        return md5($param);
    }

}

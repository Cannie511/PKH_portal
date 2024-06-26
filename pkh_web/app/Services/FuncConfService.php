<?php

namespace App\Services;

use App\Models\MstFuncConf;

class FuncConfService extends BaseService
{
    const CMS_HOME_MARQUEE     = "CMS_HOME_MARQUEE";
    const CMS_HOME_MARQUEE_2   = "CMS_HOME_MARQUEE_2";
    const CRM_PRICE_LIST       = "CRM_PRICE_LIST";
    const CMS_HOME_TOP_PRODUCT = "CMS_HOME_TOP_PRODUCT";
    const CMS_HOME_NEW_PRODUCT = "CMS_HOME_NEW_PRODUCT";
    const DELIVERY_ALLOW_EMPTY = "delivery_allow_empty";

    const PROP_NAME = [
        
// "print_delivery_page_1",

// "print_delivery_page_2",

// "print_delivery_page_3",

// "print_delivery_page_4",
        // "print_delivery_page_5"
    ];

    /**
     * Select value of config by key
     * @param  String        $key      [description]
     * @param  String|string $propName [description]
     * @return [type]                  [description]
     */
    public function selectByKey(
        $key,
        $propName = 'chr_val'
    ) {
        $func   = MstFuncConf::where('func_key', $key)->first();
        $result = null;

        if (isset($func)) {
            $result = $func->getAttribute($propName);
        }

        return $result;
    }

    /**
     * Update value of config by key
     * @param  String $key      [description]
     * @param  [type] $value    [description]
     * @param  string $propName [description]
     * @return [type]           [description]
     */
    public function updateByKey(
        $key,
        $value,
        $propName = 'chr_val'
    ) {
        $result = MstFuncConf::where('func_key', $key)
            ->update([$propName => $value]);

        if ($result < 1) {
            return $this->createByKey($key, $value, $propName);
        }

        return $result;
    }

    /**
     * Create by key
     * @param  String        $key      [description]
     * @param  [type]        $value    [description]
     * @param  String|string $propName [description]
     * @return [type]                  [description]
     */
    public function createByKey(
        $key,
        $value,
        $propName = 'chr_val'
    ) {
        $entity           = new MstFuncConf();
        $entity->func_key = $key;
        $entity->setAttribute($propName, $value);
        $entity->active_flg = '1';
        $entity->version_no = 1;

        return $entity->save();
    }

    /**
     * Get prop name
     *
     * @param [type] $key
     * @return void
     */
    public function getPropName(
        $key,
        $defaultName = 'chr_val'
    ) {

        if (isset(self::PROP_NAME[$key])) {
            return self::PROP_NAME[$key];
        }

        return $defaultName;
    }

}

<?php

namespace App\Services;

use Log;

/**
 * Adm0500Service class
 */
class Adm0500Service extends BaseService
{
    const FORM_DATA = [
        "PRINT_DELIVERY" => [
            "print_delivery_page_size",
            "print_delivery_page_1",
            "print_delivery_page_2",
            "print_delivery_page_3",
            "print_delivery_page_4",
            "print_delivery_page_5",
        ],
        "DELIVERY"       => [
            "delivery_allow_empty",
        ],
        "ESMS"          => [
            "esms_api_key",
            "esms_secret_key", 
            "oa_id",
        ],
        "OA"          => [
            "oa_api_id",
            "oa_app_secret", 
            "oa_access_token",
        ],
    ];

    /**
     * @param FuncConfService $funcConfService
     */
    public function __construct(FuncConfService $funcConfService)
    {
        $this->funcConfService = $funcConfService;
    }

    /**
     * @param $formName
     * @return mixed
     */
    public function load($formName)
    {
        $result = [];
        $list   = self::FORM_DATA[$formName];

        foreach ($list as $key) {
            if ($formName == "ESMS" ||$formName == "OA"  ) {
                $type  = "txt_val";
            } else {
                $type  = $this->funcConfService->getPropName($key);
            }
            $value = $this->funcConfService->selectByKey($key, $type);

            if (isset($value)) {
                $result[$key] = $value;
            } else {
                $result[$key] = null;
            }

        }

        return $result;
    }

    /**
     * @param $param
     */
    public function save($param)
    {
        $listKey = $param["data"];
        $formId  = $param["formId"];
        Log::debug('listKey: ' . print_r($listKey, true));

        foreach ($listKey as $key => $value) {
            if ($formId == "ESMS" ||$formId == "OA") {
                $this->funcConfService->updateByKey($key, $value,"txt_val");
            } else {
                $this->funcConfService->updateByKey($key, $value);
            }
        }

    }

}

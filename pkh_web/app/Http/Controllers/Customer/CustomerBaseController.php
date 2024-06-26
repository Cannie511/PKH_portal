<?php

namespace App\Http\Controllers\Customer;

use Dingo\Api\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Dingo\Api\Exception\ValidationHttpException;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CustomerBaseController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    /**
     * @var string
     */
    protected $viewFolder = "customer.";

/*Fixes dingo/api form request validation https://github.com/dingo/api/wiki/Errors-And-Error-Responses#form-requests*/
    /**
     * @param Request $request
     * @param array $rules
     * @param array $messages
     * @param array $customAttributes
     */
    public function validate(
        Request $request,
        array $rules,
        array $messages = [],
        array $customAttributes = []
    ) {
        $validator = $this->getValidationFactory()->make($request->all(), $rules, $messages, $customAttributes);

        if ($validator->fails()) {
            throw new ValidationHttpException($validator->errors());
        }

    }

}

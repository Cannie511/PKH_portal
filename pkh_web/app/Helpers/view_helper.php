<?php

/**
 * View helper
 * Prefix: vh_
 * Author: Nguyen Phu Cuong
 */

/**
 * Add input textbox
 *    - $fieldName
 *    - $labelName
 *    - options:
 *         + required: BOOLEAN
 */
function vh_textbox(
    $fieldName,
    $labelName,
    $options = null
) {
    $text =
        "<div class=\"form-group\" ng-class=\"{ 'has-error': form.$fieldName.\$invalid && ( vm.formSubmitted || form.$fieldName.\$touched) }\"> " .
        "	<label class=\"col-sm-2 control-label required\">$labelName</label> " .
        "	<div class=\"col-sm-10\">" .
        "		<input type=\"text\" class=\"form-control\" ng-model=\"vm.m.form.$fieldName\" name=\"$fieldName\" placeholder=\"\" required>" .
        "		<p ng-show=\"form.$fieldName.\$error.required && ( vm.formSubmitted || form.$fieldName.\$touched)\" class=\"help-block\">Vui lòng nhập Tên</p>" .
        "	</div>" .
        "</div>";

    return $text;
}

/**
 * @param $path
 */
function asset_url($path)
{
    $useHttp = env("USE_HTTPS", false);

    return asset($path, $useHttp);
}

/**
 * @param $arr setting
 * @param $options 
 *  - cssClass
 *  - placeholder
 *  - ngModel
 *  - showAll 
 */
function vh_dropdownlist($arr, $options = []) {
    $text = "<select ";

    if (isset($options['cssClass'])) {
        $text .= " class='" . $options['cssClass'] . "'";
    }

    if (isset($options['ngModel'])) {
        $text .= " ng-model='" . $options['ngModel'] . "'";
    }

    $text .= ">";

    if (isset($options['showAll']) && $options['showAll'] == true) {
        $text .= '<option value="">Tất cả</option>';
    }

    if( count($arr) > 0) {
        foreach($arr as $item) {
            $text .= '<option value="' . $item["id"] . '">' . $item["name"] . '</option>';
        }
    }

    $text .= "</select>";
    return $text;
}
/**
 * ValidationUtils
 * @author Nguyen Phu Cuong
 */
var ValidationUtils = {

    /**
     * Match regular expression
     * @param  {[type]}  value   [description]
     * @param  {[type]}  matcher [description]
     * @return {Boolean}         [description]
     */
    isMatch: function(value, matcher) {

        return matcher.test(value);
    },

    /**
     * Valid text require
     * @param  {[type]}  value [description]
     * @return {Boolean}       [description]
     */
    isValidTextRequired: function(value) {

        var str = TextUtils.trimEnd(value);
        if (TextUtils.isEmpty(str)) {
            return false;
        } else {
            return value.length > 0;
        }
    },

    /**
     * Valid text length from lower to upper
     * @param  {[type]}  value [description]
     * @param  {[type]}  lower [description]
     * @param  {[type]}  upper [description]
     * @return {Boolean}       [description]
     */
    isValidTextLength: function(value, lower, upper) {

        var str = TextUtils.trimEnd(value);
        if (TextUtils.isEmpty(str)) {
            return true;
        }

        if (upper == undefined) {
            upper = lower;
        }
        return lower <= str.length && str.length <= upper;
    },

    /**
     * Valid numeric text
     * @param  {[type]}  value [description]
     * @return {Boolean}       [description]
     */
    isValidTextNumeric: function(value) {

        var str = TextUtils.trimEnd(value);
        if (TextUtils.isEmpty(str)) {
            return true;
        }

        return this.isMatch(str, /^[\d]*$/);
    },

    /**
     * Valid text number (include minus)
     * @param  {[type]}  value [description]
     * @return {Boolean}       [description]
     */
    isValidTextNumber: function(value) {

        var str = TextUtils.trimEnd(value);
        if (TextUtils.isEmpty(str)) {
            return true;
        }

        return this.isMatch(str, /^[\d-\u002E]*$/) && isFinite(str);
    },

    /**
     * Valid text float
     * @param  {[type]}  value     [description]
     * @param  {[type]}  precision [description]
     * @param  {[type]}  scale     [description]
     * @return {Boolean}           [description]
     */
    isValidTextNumberScale: function(value, precision, scale) {

        var str = TextUtils.trimEnd(value);
        if (TextUtils.isEmpty(str)) {
            return true;
        }

        if (!this.isValidTextNumber(str) || parseFloat(str) < 0) {
            return false;
        }

        var valOver = 0;
        var valUnder = 0;

        if (str.indexOf('.') < 0) {
            valOver = str.length;
        } else {
            var data = str.split('.');
            valOver = data[0].length;
            valUnder = data[1].length;
        }

        if (precision - scale < valOver || scale < valUnder) {
            return false;
        }

        return true;
    },

    /**
     * Valid alphabet text only
     * @param  {[type]}  value [description]
     * @return {Boolean}       [description]
     */
    isValidTextAlpha: function(value) {

        var str = TextUtils.trimEnd(value);
        if (TextUtils.isEmpty(str)) {
            return true;
        }

        return this.isMatch(str, /^[A-Za-z]*$/);
    },

    /**
     * Valid text contain only text and numeric
     * @param  {[type]}  value [description]
     * @return {Boolean}       [description]
     */
    isValidTextAlphaNumeric: function(value) {

        var str = TextUtils.trimEnd(value);
        if (TextUtils.isEmpty(str)) {
            return true;
        }

        return this.isMatch(str, /^[A-Za-z\d]*$/);
    },

    /**
     * Valid text contain half char only (include symbol)
     * @param  {[type]}  value [description]
     * @return {Boolean}       [description]
     */
    isValidTextHalf: function(value) {

        var str = TextUtils.trimEnd(value);
        if (TextUtils.isEmpty(str)) {
            return true;
        }

        var validCharsHalf = ' -/:-@¥[-`{-~';
        var reg = new RegExp('^[A-Za-z\\d' + validCharsHalf + ']*$');
        return this.isMatch(str, reg);
    },

    /**
     * Valid input date
     * @param  {[type]}  value [description]
     * @return {Boolean}       [description]
     */
    isValidTextDate: function(value) {

        var str = TextUtils.trimEnd(value);
        if (TextUtils.isEmpty(str)) {
            return true;
        }

        if (this.isMatch(str, /^\d{4}\-\d{2}\-\d{2}$/)) {
            var date = new Date(str);
            var array = str.split('-');
            return date.getFullYear() === +array[0] && date.getMonth() + 1 === +array[1] && date.getDate() === +array[2];
        }

        return false;
    },

    /**
     * Valid tel no
     * @param  {[type]}  value [description]
     * @return {Boolean}       [description]
     */
    isValidTextTelNo: function(value) {

        var str = TextUtils.trimEnd(value);
        if (TextUtils.isEmpty(str)) {
            return true;
        }

        if (false == this.isMatch(str, /^[0-9-]*$/)) {
            return false;
        }

        if (true == this.isMatch(str, /^-.*/)) {
            return false;
        }

        if (true == this.isMatch(str, /.*-$/)) {
            return false;
        }

        return true;
    },

    /**
     * Valid byte length
     * @param  {[type]}  value [description]
     * @param  {[type]}  size  [description]
     * @return {Boolean}       [description]
     */
    isValidBytesLength: function(value, size) {

        var str = TextUtils.trimEnd(value);
        if (TextUtils.isEmpty(str)) {
            return true;
        }

        if ((new Blob([str], {
                type: 'text/plain'
            })).size > size) {
            return false;
        }

        return true;
    },
};

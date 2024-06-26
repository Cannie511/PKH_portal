/**
 * TextUtils
 * @author Nguyen Phu Cuong
 */
var TextUtils = {
    /**
     * Check string empty
     * @param  {[type]}  value [description]
     * @return {Boolean}       [description]
     */
    isEmpty: function(value) {

        return (value == undefined || value == null || value == '');
    },

    /**
     * Trim end space
     * @param  {[type]} value [description]
     * @return {[type]}       [description]
     */
    trimEnd: function(value) {
        if (TextUtils.isEmpty(value)) {
            return value;
        }

        return value.replace(/\s+$/g, '');
    }
};

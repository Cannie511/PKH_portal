/**
 * DateUtils
 * @author Nguyen Phu Cuong
 */
// var DateUtils = {

// 	/**
//      * Get Dislay time to write log
//      * @return {String} yyyy/MM/dd HH:mm:ss.sss
//      */
//     getNowString: function() {
//         var now = new Date();
//         return now.toLocaleDateString() + ' ' + now.toLocaleTimeString() + '.' + now.getMilliseconds();
//     },

//     /**
//      * Formate time to yyyy/MM/dd HH:mm:ss.sss
//      * @param  {Date} time time
//      * @return {String}    yyyy/MM/dd HH:mm:ss.sss
//      */
//     formatTimestamp: function(time) {
//         return time.toLocaleDateString() + ' ' + time.toLocaleTimeString() + '.' + time.getMilliseconds();
//     }
// };
export class DateUtils {

    static isDate(str, format) {
        var d = moment(str, format);
        if(d == null || !d.isValid()) return false;
        return str.indexOf(d.format(format)) >= 0;
    }
}

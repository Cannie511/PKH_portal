export class UtilsService {
    constructor() {
        'ngInject';
    }

    /**
     * Get Order by
     * @param  {[type]} newOrderBy            [description]
     * @param  {[type]} currentOrderBy        [description]
     * @param  {[type]} currentOrderDirection [description]
     * @return {[type]}                       [description]
     */
    getOrderBy(newOrderBy, currentOrderBy, currentOrderDirection) {
        var result = {
            orderBy: currentOrderBy,
            orderDirection: currentOrderDirection
        };

        if ( newOrderBy === currentOrderBy) {
            if ( currentOrderDirection !== 'asc') {
                result.orderDirection = "asc";
            } else {
                result.orderDirection = "desc";
            }
        } else {
            result.orderBy = newOrderBy;
            result.orderDirection = "asc";
        }

        return result;
    }

    joinMessageList( list ) {
        var result = "";
        if( angular.isDefined(list) && list != null ) {
            var isFirst = true;
            angular.forEach(list, function(value){
                if (isFirst) {
                    result = value;
                } else {
                    result = result + "\r\n" + value;
                }
            });
        }
        return result;
    }
}
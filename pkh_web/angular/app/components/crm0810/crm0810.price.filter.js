export function Crm0810PriceFilter() {
    'ngInject'

    return function(list, selling) {
        let result = [];

        let price = 0;
        if (selling == false || selling == 0) {
            price = -1;
        }

        angular.forEach(list, function(item) {
            if (item.selling_price > price) {
                result.push(item);
            }
        });

        return result;
    }
}
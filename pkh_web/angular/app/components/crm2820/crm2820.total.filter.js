export function Crm2820TotalFilter() {
    'ngInject'

    return function(list) {
        let result = [];
        console.log('list :', list);
        
        let price = 0;

        angular.forEach(list, function(item) {
            price += item.amount * item.selling_price;
        });

        return price;
    }
}
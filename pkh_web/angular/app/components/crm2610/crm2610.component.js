class Crm2610Controller{
    constructor($scope, $state, $compile, $log, AclService, API, UtilsService, $stateParams, ClientService) {
        'ngInject'

        this.$scope = $scope;
        this.$state = $state;
        this.$compile = $compile;
        this.$log = $log;
        this.AclService = AclService;
        this.can = AclService.can;
        this.API = API;
        this.UtilsService = UtilsService;
        this.ClientService = ClientService;
        this.$stateParams = $stateParams;

        this.m = {
            store_id: this.$stateParams.store_id,
            filter: {
                from_date: moment(new Date()).add(-12, 'M'),
                to_date: moment(new Date())
            },
            datetimepicker_options: {
                viewMode: 'days',
                format: 'YYYY-MM-DD'
            }
        }

    }

    $onInit(){
        this.search();
    }

    resetFilter() {
        this.m.filter = {
            from_date: moment(new Date()).add(12, 'M'),
            to_date: moment(new Date())
        };
    }

    search() {
        this.doSearch(1);
    }

    doSearch(page) {
        // Get list product 
        let searchService = this.API.service('search', this.API.all('crm2610'));
        let param = angular.copy(this.m.filter);

        if (param.from_date) {
            param.from_date = moment(param.from_date).format('YYYY-MM-DD');
        }

        if (param.to_date) {
            param.to_date = moment(param.to_date).format('YYYY-MM-DD');
        }

        param.page = page;
        param.store_id = this.m.store_id;
        sessionStorage.crm2610 = angular.toJson(param);
        searchService.post(param)
            .then((response) => {
                let data = response.plain().data;
                this.m.list = this.mergeData(data.products, data.soldProducts);
            });
    }

    mergeData(products, solds) {

        for(let i = 0; i < solds.length; i++) {
            for ( let j = 0 ; j < products.length; j++) {
                if ( solds[i].product_id == products[j].product_id) {
                    products[j].amount = solds[i].amount;
                    products[j].money = solds[i].money;
                    j = products.length;
                }
            }
        }

        return products;
    }
}

export const Crm2610Component = {
    //templateUrl: './views/app/components/crm2610/crm2610.component.html',
    templateUrl: '/views/admin.crm2610',
    controller: Crm2610Controller,
    controllerAs: 'vm',
    bindings: {}
}

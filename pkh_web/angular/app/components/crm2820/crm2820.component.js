class Crm2820Controller{
    constructor($scope, $state, $compile, $log, AclService, API, UtilsService, $stateParams, ClientService, RouteService) {
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
        this.RouteService = RouteService;

        this.m = {
            init: {},
            form: {
                // changed_date: moment(new Date())
            },
            dateOptions: {
                format: 'YYYY-MM-DD'
            }
        }
        // THIS IS DEFAULT TEMPLATE
    }

    $onInit(){
        this.m.kpi_id = this.$stateParams.kpi_id;
        this.m.month = this.$stateParams.month;
        this.loadInitData();
    }

    /**
     * Load init data
     */
    loadInitData() {
        let service = this.API.service('init-data', this.API.all('crm2820'));
        service.post({kpi_id : this.m.kpi_id})
            .then((response) => {
                let id = this.m.init.id;

                let listProduct = response.data.listProduct;
                listProduct.forEach(item => {
                    item.amount = 0;
                });
                this.m.form.listProduct = listProduct;
                this.m.form.kpi = response.data.kpi;
                console.log('this.m.form :', this.m.form);
                
                // this.m.init.id = id;

                this.load(this.m.kpi_id, this.m.month);
            });
    }

    /**
     * Load entity
     * @param {int} id Entity id
     */
    load(kpi_id, month) {
        let service = this.API.service('load', this.API.all('crm2820'));
        let param = { kpi_id: kpi_id, month: month };
        service.post(param)
            .then((response) => {
                let listTargetProduct = response.data.listTargetProduct;
                // let mapping
                let mapProduct = [];
                listTargetProduct.forEach(item => {
                    mapProduct[item.product_id] = item;
                });
                console.log('mapProduct :', mapProduct);
                

                let listProduct = angular.copy(this.m.form.listProduct);
                listProduct.forEach(item => {
                    if (mapProduct[item.product_id] != undefined) {
                        item.amount = mapProduct[item.product_id].amount;
                    }
                });

                this.m.form.listProduct = listProduct;
            });

    }

    validate(model, form) {
        //if( model.start_date == null || model.start_date == undefined ) {
        //    this.ClientService.warning("Vui lòng nhập Ngày bắt đầu");
        //    return false;
        //}

        return true;
    }

    /**
     * Load entity
     * @param {int} id Entity id
     */

    save(isValid, form) {
        if(this.validate(this.m.form, form)) {
            let listProduct = [];

            this.m.form.listProduct.forEach(product => {
                if(product.amount > 0) {
                    listProduct.push({
                        product_id: product.product_id,
                        amount: product.amount
                    });
                }
            });

            console.log('listProduct :', listProduct);
            let param = {
                kpi_id: this.m.kpi_id,
                month: this.m.month,
                listProduct: listProduct
            };

            // convert moment to date 'YYYY-MM-DD'
            // let dateFields = ["dob", "start_date", "end_date", "probation_start_date", "probation_end_date", "card_id_issue_on"];
            // dateFields.forEach((item) => {
            //     if (param[item] != null ) {
            //         param[item] = param[item].format('YYYY-MM-DD');
            //     }
            // });

            let service = this.API.service('save', this.API.all('crm2820'));
            service.post(param)
                .then((response) => {
                    console.log('response.data :', response.data);
                    
                    let result = response.data;
                    if( result.rtnCd == true ) {
                        this.ClientService.success(result.msg);
                    } else {
                        this.ClientService.error(result.msg);
                    }
                }, (response) => {
                    this.m.errors = response.data.errors;
                });
        }
    }
}

export const Crm2820Component = {
    //templateUrl: './views/app/components/crm2820/crm2820.component.html',
    templateUrl: '/views/admin.crm2820',
    controller: Crm2820Controller,
    controllerAs: 'vm',
    bindings: {}
}

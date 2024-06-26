export class Crm0100SetupPriceController {
    constructor($scope, $log, API, AclService, DialogService, UtilsService, ClientService, params) {
        'ngInject';

        this.$scope = $scope;
        this.$log = $log;
        this.API = API;
        this.can = AclService.can;
        this.DialogService = DialogService;
        this.UtilsService = UtilsService;
        this.ClientService = ClientService;

        this.m = {
            product: params.product,
            form: {
                import_price: parseFloat(params.product.purchase_price),
                selling_price: parseInt(params.product.selling_price),
              
            },
            errors: null
        }
    }

    save() {

        // Clear error
        this.m.errors = null;

        let thisClass = this;
        let service = this.API.service('update-price', this.API.all('crm0100'));
        let param = angular.copy(this.m.form);
        param.product_id = this.m.product.product_id;

        service.post(param)
            .then((response) => {
                thisClass.$log.info(response.plain().data);
                this.m.data = response.plain().data;
                let result = response.plain().data;
                if (result.rtnCd) {
                    thisClass.ClientService.success(result.msg);
                    thisClass.DialogService.close(this.params);
                }
            }, (response) => {
                thisClass.$log.info('ng response', response);
                this.m.errors = response.data.errors;
            });
    }

    cancel() {
        this.DialogService.cancel();
    }
}
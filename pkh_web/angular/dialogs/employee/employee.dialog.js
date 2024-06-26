export class EmployeeController{
    constructor($scope, $log, API, AclService, DialogService, UtilsService, ClientService, params){
        'ngInject';

        this.$scope = $scope;
        this.$log = $log;
        this.API = API;
        this.can = AclService.can;
        this.DialogService = DialogService;
        this.UtilsService = UtilsService;
        this.ClientService = ClientService;

        this.m = {
            params : params,
            form: {
                selling_price: parseInt(params.product.selling_price),
                selling_price_sample: parseInt(params.product.selling_price_sample),
                selling_price_tax: parseInt(params.product.selling_price_tax)
            },
            errors: null
        }
    }

    save(){
        //Logic here
        this.DialogService.hide();
    }

    cancel(){
        this.DialogService.cancel();
    }
}
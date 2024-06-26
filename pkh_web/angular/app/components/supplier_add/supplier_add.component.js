class SupplierAddController {
    constructor(API, $state, $stateParams, $log, RouteService, ClientService) {
        'ngInject'

        this.$state = $state
        this.formSubmitted = false
        this.API = API
        this.alerts = []
        this.$log = $log
        this.RouteService = RouteService
        this.ClientService = ClientService

        if ($stateParams.alerts) {
            this.alerts.push($stateParams.alerts)
        }
    }

    save(isValid) {

        let $log = this.$log
        let alerts = this.alerts
        let RouteService = this.RouteService
        let ClientService = this.ClientService

        if (isValid) {
            let supplierService = this.API.service('suppliers')
            let $state = this.$state

            supplierService.post({
                'name': this.name, 
                'supplier_code': this.short_name
            }).then(function(response) {
                //let alert = { type: 'success', 'title': 'Success!', msg: 'Supplier has been added.' }
                //RouteService.goState('app.supplierlist', { alerts: alert })
                ClientService.success('Supplier has been added.')
                RouteService.goState('app.supplierlist')
            }, function(response) {
                let alert = { type: 'error', 'title': 'Error!', msg: response.data.message }
                RouteService.goState('app.supplierlist', { alerts: alert })
            })
        } else {
            this.formSubmitted = true
        }
    }

    $onInit() {}
}

export const SupplierAddComponent = {
    templateUrl: './views/app/components/supplier_add/supplier_add.component.html',
    controller: SupplierAddController,
    controllerAs: 'vm',
    bindings: {}
}

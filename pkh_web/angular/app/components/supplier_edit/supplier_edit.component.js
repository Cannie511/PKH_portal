class SupplierEditController {
    constructor($stateParams, $state, API, RouteService, ClientService, $filter, $translate) {
        'ngInject'
 
        this.$state = $state
        this.formSubmitted = false
        this.RouteService = RouteService
        this.ClientService = ClientService
        this.$translate = $translate

        let suppliersService = API.service('show', API.all('suppliers'))
        let id = $stateParams.id

        suppliersService.one(id).get()
            .then((response) => {
                this.model = API.copy(response)
            })
    }

    save(isValid) {
        let ClientService = this.ClientService
        let $translate = this.$translate

        this.errors = null

        if (isValid) {
            let $state = this.$state
            let RouteService = this.RouteService
            this.model.put()
                .then(() => {
                    ClientService.success($translate.instant("MSG_I000001", {name: $translate.instant('MODEL_SUPPLIER')}))
                    RouteService.goState($state.current) 
                }, (response) => {
                    if(response.status === 422 ) {
                        ClientService.error($translate.instant("MSG_E000001"))
                        this.errors = response.data.errors
                    }
                })
        } else {
            this.formSubmitted = true
        }
    }

    $onInit() {}
}

export const SupplierEditComponent = {
    templateUrl: './views/app/components/supplier_edit/supplier_edit.component.html',
    controller: SupplierEditController,
    controllerAs: 'vm',
    bindings: {}
}

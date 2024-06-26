class SupplierListsController {
    constructor($scope, $state, $stateParams, $compile, DTOptionsBuilder, DTColumnBuilder, API) {
        'ngInject'
        this.API = API
        this.$state = $state
        this.alerts = [] 

        if ($stateParams.alerts) {
            this.alerts.push($stateParams.alerts)
        }

        let Suppliers = this.API.service('suppliers')

        Suppliers.getList()
            .then((response) => {
                let dataSet = response.plain()
                
                this.dtOptions = DTOptionsBuilder.newOptions()
                    .withOption('data', dataSet)
                    .withOption('createdRow', createdRow)
                    .withOption('responsive', true)
                    .withBootstrap()

                this.dtColumns = [
                    DTColumnBuilder.newColumn('supplier_id').withTitle('ID'),
                    DTColumnBuilder.newColumn('supplier_code').withTitle('Supplier Code'),
                    DTColumnBuilder.newColumn('name').withTitle('Name'),
                    DTColumnBuilder.newColumn(null).withTitle('Actions').notSortable()
                    .renderWith(actionsHtml)
                ]

                this.displayTable = true
            })

        let createdRow = (row) => {
            $compile(angular.element(row).contents())($scope)
        }

        let actionsHtml = (data) => {
            return `
                <a class="btn btn-xs btn-warning" ui-sref="app.supplieredit({id: ${data.id}})">
                    <i class="fa fa-edit"></i>
                </a>
                &nbsp
                <button class="btn btn-xs btn-danger" ng-click="vm.delete(${data.id})">
                    <i class="fa fa-trash-o"></i>
                </button>`
        }
    }

    delete(id) {
        let API = this.API
        let $state = this.$state

        swal({
            title: 'Are you sure?',
            text: 'You will not be able to recover this data!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes, delete it!',
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
            html: false
        }, function() {
            API.one('suppliers').one('item', id).remove()
                .then(() => {
                    swal({
                        title: 'Deleted!',
                        text: 'Supplier has been deleted.',
                        type: 'success',
                        confirmButtonText: 'OK',
                        closeOnConfirm: true
                    }, function() {
                        $state.reload()
                    })
                })
        })
    }

    $onInit() {}
}

export const SupplierListsComponent = {
    templateUrl: './views/app/components/supplier_lists/supplier_lists.component.html',
    controller: SupplierListsController,
    controllerAs: 'vm',
    bindings: {}
}

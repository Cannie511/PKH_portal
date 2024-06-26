// import { StoreDialogController } from '../../../dialogs/store_dialog/store_dialog.dialog'

class Crm0900Controller {
    constructor($scope, $state, API, $log, UtilsService, ClientService, DialogService, $uibModal) {
        'ngInject'

        this.API = API;
        this.$state = $state;
        this.$log = $log;
        this.UtilsService = UtilsService;
        this.ClientService = ClientService;
        this.DialogService = DialogService;
        this.$uibModal = $uibModal
        this.m = {
            filter: {},
            list: null,
            dateOptions: {
                // formatYear: 'yy',
                startingDay: 1
            }
        }

        this.search();
    }

    search() {
        this.m.filter.orderBy = null;
        this.m.filter.orderDirection = null;
        this.doSearch(1);

        this.$log.debug('start search ');
        // this.DialogService.fromTemplate('store_dialog');

        // let modalOption = {
        //     controller: StoreDialogController
        // };
        // this.DialogService.open('store_dialog', modalOption);

        // var modalInstance = this.$uibModal.open({
        //     animation: true,
        //     templateUrl: '/views/admin.dialogs.store_dialog',
        //     controller: this.modalcontroller,
        //     controllerAs: 'mvm',
        //     size: 300,
        //     // resolve: {
        //     //     items: () => {
        //     //         return items
        //     //     }
        //     // }
        // })
    }

    modalcontroller($scope, $uibModalInstance) {
        'ngInject'

        // this.items = items

        // $scope.selected = {
        //     item: items[0]
        // }
        this.m = {
            msg: 'this is my model  2'
        }

        this.ok = () => {
            // $uibModalInstance.close($scope.selected.item)
        }

        this.cancel = () => {
            $uibModalInstance.dismiss('cancel')
        }
    }

    resetFilter() {
        this.m.filter = {
            orderBy: this.m.filter.orderBy,
            orderDirection: this.m.filter.orderDirection
        };
    }

    sort(orderBy) {
        let orderOption = this.UtilsService.getOrderBy(orderBy, this.m.filter.orderBy, this.m.filter.orderDirection);
        this.m.filter.orderBy = orderOption.orderBy;
        this.m.filter.orderDirection = orderOption.orderDirection;

        this.doSearch(1);
    }

    doSearch(page) {
        // Get list product 
        let searchService = this.API.service('search', this.API.all('crm0900'));
        let param = angular.copy(this.m.filter);

        param.page = page;
        //param.pageSize = $scope.m.paginationInfo.pageSize;

        searchService.post(param)
            .then((response) => {
                this.$log.info(response);

                let list = response.plain().data;

                angular.forEach(list, function(item) {
                    item.result = parseInt(item.in_num) - parseInt(item.out_num) + parseInt(item.in_num_edit) - parseInt(item.out_num_edit);
                });

                this.m.list = list;
            });
    }

    $onInit() {

    }
}

export const Crm0900Component = {
    // templateUrl: './views/app/components/crm0900/crm0900.component.html',
    templateUrl: '/views/admin.crm0900',
    controller: Crm0900Controller,
    controllerAs: 'vm',
    bindings: {}
}
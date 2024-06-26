class Crm0912Controller {
    constructor($scope, $state, $compile, $log, AclService, API, UtilsService, ClientService) {
        'ngInject'

        this.$scope = $scope;
        this.$state = $state;
        this.$compile = $compile;
        this.$log = $log;
        this.AclService = AclService;
        this.API = API;
        this.UtilsService = UtilsService;
        this.can = AclService.can;
        this.ClientService = ClientService;

        this.m = {
            filter: {
                days: 0
            },
            totalMoney: 0,
            list: null
        }
    }

    $onInit() {
        this.loadInit();
        // this.search();
    }

    loadInit(){
        let loadService = this.API.service('load-init', this.API.all('crm0912'));
        let param = angular.copy(this.m.filter);

        loadService.post(param)
            .then((response) => {
                this.m.init  = response.plain().data;
               
                this.search();
            });
    }

    resetFilter() {
        this.m.filter = {
            days: 0,
            orderBy: this.m.filter.orderBy,
            orderDirection: this.m.filter.orderDirection
        };
    }

    search() {
        this.m.filter.orderBy = null;
        this.m.filter.orderDirection = null;
        this.doSearch(1);
    }

    doSearch(page) {
        // Get list product 
        let searchService = this.API.service('search', this.API.all('crm0912'));
        let param = angular.copy(this.m.filter);

        param.page = page;
        searchService.post(param)
            .then((response) => {
                let list = response.plain().data.data;

                // Cal sum
                this.calSum(list);
                this.m.list = list;
            });
    }

    calSum(list) {
        let totalMoney = 0;
        list.forEach(item => {
            totalMoney += parseInt(item.selling_price) * parseInt(item.remain);
        });
        this.m.totalMoney = totalMoney;
    }

    download() {
        let param = angular.copy(this.m.filter);
        let service = this.API.service('download', this.API.all('crm0912'));
        service.post(param)
            .then((response) => {
                this.$log.info(response.data);
                this.ClientService.downloadFileOneTime(response.data.file);
            });
    }

    run() {
        let self = this;
        swal({
            title: "Bạn có muốn tính lại số ngày tồn kho không?",
            text: "Quá trình này sẽ mất vài phút",
            type: "warning",
            showCancelButton: true,
            closeOnConfirm: true
                // confirmButtonColor: "#DD6B55"
        }, function() {

            let service = self.API.service('exec', self.API.all('crm0912'));
            service.post()
                .then((res) => {
                    self.ClientService.success(res.data.msg);
                });
        });
    }
}

export const Crm0912Component = {
    //templateUrl: './views/app/components/crm0912/crm0912.component.html',
    templateUrl: '/views/admin.crm0912',
    controller: Crm0912Controller,
    controllerAs: 'vm',
    bindings: {}
}
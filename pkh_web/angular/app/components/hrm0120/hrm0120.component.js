class Hrm0120Controller {
    constructor($scope, $state, API, $log, UtilsService, ClientService) {
        'ngInject';

        this.API = API;
        this.$state = $state;
        this.$log = $log;
        this.UtilsService = UtilsService;
        this.ClientService = ClientService;
        this.m = {
                filter: {},
                list: null,
                dateOptions: {
                    // formatYear: 'yy',
                    startingDay: 1
                }
            }
            // this.search();
        this.init();
    }

    $onInit() {}

    init() {
        let $log = this.$log;
        let searchService = this.API.service('init', this.API.all('hrm0120'));

        searchService.post({})
            .then((response) => {
                this.m.init = response.plain().data;
                $log.info('this.m.init: ', this.m.init);
                this.search();
            });
    }

    search() {
        this.m.filter.orderBy = null;
        this.m.filter.orderDirection = null;
        this.doSearch(1);
    }

    resetFilter() {
        this.m.filter = {
            orderBy: this.m.filter.orderBy,
            orderDirection: this.m.filter.orderDirection
        };
    }

    sort(orderBy) {
        let orderOption = this.UtilsService.getOrderBy(orderBy, $scope.m.filter.orderBy, $scope.m.filter.orderDirection);
        this.m.filter.orderBy = orderOption.orderBy;
        this.m.filter.orderDirection = orderOption.orderDirection;

        this.doSearch(1);
    }

    doSearch(page) {
        let $log = this.$log;

        // Get list product 
        let searchService = this.API.service('search', this.API.all('hrm0120'));
        let param = angular.copy(this.m.filter);

        param.page = page;
        //param.pageSize = $scope.m.paginationInfo.pageSize;

        searchService.post(param)
            .then((response) => {
                this.$log.info(response);
                var data = response.plain().data;
                var list = data.data;
                angular.forEach(list, function(value) {
                    list.check = false;
                });
                // this.m.list = list;
                this.m.data = data;
            });
    }

    accept(item) {
        let that = this;
        this.$log.debug(item);
        swal({
            title: "Bạn có muốn chấp nhận đơn xin này?",
            text: "",
            type: "input",
            showCancelButton: true,
            closeOnConfirm: true,
            inputPlaceholder: "Lý do"
        }, function(inputValue) {
            if (inputValue === false) return false;
            if (inputValue === "") {
                swal.showInputError("You need to write something!");
                return false;
            }

            var param = {
                id: item.id,
                notes: inputValue
            };

            let service = that.API.service('accept', that.API.all('hrm0120'));
            service.post(param)
                .then((res) => {
                    if (res.data.rtnCd == 0) {
                        that.ClientService.success(res.data.msg);
                        that.search();
                    } else {
                        that.ClientService.error(res.data.msg);
                    }
                });
        });
    }

    deny(item) {
        let that = this;
        this.$log.debug(item);
        swal({
            title: "Bạn có muốn từ chối đơn xin này?",
            text: "",
            type: "input",
            showCancelButton: true,
            closeOnConfirm: true,
            inputPlaceholder: "Lý do",
            confirmButtonColor: "#DD6B55"
        }, function(inputValue) {
            if (inputValue === false) return false;
            if (inputValue === "") {
                swal.showInputError("You need to write something!");
                return false;
            }

            var param = {
                id: item.id,
                notes: inputValue
            };

            let service = that.API.service('deny', that.API.all('hrm0120'));
            service.post(param)
                .then((res) => {
                    if (res.data.rtnCd == 0) {
                        that.ClientService.success(res.data.msg);
                        that.search();
                    } else {
                        that.ClientService.error(res.data.msg);
                    }
                });
        });
    }

    download() {
        let param = angular.copy(this.m.filter);

        let service = this.API.service('download', this.API.all('hrm0120'));
        service.post(param)
            .then((response) => {
                this.$log.info(response.data);
                this.ClientService.downloadFileOneTime(response.data.file);
            });
    }

}

export const Hrm0120Component = {
    //templateUrl: './views/app/components/hrm0120/hrm0120.component.html',
    templateUrl: '/views/admin.hrm0120',
    controller: Hrm0120Controller,
    controllerAs: 'vm',
    bindings: {}
}
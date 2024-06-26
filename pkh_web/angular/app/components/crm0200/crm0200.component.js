class Crm0200Controller {
    constructor($scope, $state, API, $log, AclService, UtilsService, ClientService, $window, $stateParams) {
        'ngInject'

        this.API = API;
        this.$state = $state;
        this.$log = $log;
        this.can = AclService.can;
        this.UtilsService = UtilsService;
        this.ClientService = ClientService;
        this.$window = $window;
        this.$stateParams = $stateParams;

        this.m = {
            activeFlag: 2,
            list: null,
            dateOptions: {
                // formatYear: 'yy',
                startingDay: 1
            },
            datetimepicker_options: {
                viewMode: 'days',
                format: 'YYYY-MM-DD'
            }
        }
    }

    $onInit() {
        this.title = ["Mới", "Đang xử lý", "Hoàn tất", "Huỷ", "Huỷ còn lại","","","Xác nhận"];
        this.code =  {0:2,
            2:3,
            4:4,
            5:5,
            6:6,
            8:8
           };
        for (var i=2; i<9; i++) {
            this.m[i] = {
                filter:{
                    orderBy: 'updated_at'
                    , orderDirection :'desc'
                },
                data:{
                    total : 0  
                }
                , title : this.title[i-2]
            }
        }
        
        this.loadInit();

        if( this.$stateParams.store_id != null) {
            for (var i=2; i<7; i++) {
                this.m[i].filter.store_id = this.$stateParams.store_id;
            }
            this.m[8].filter.store_id = this.$stateParams.store_id;
            this.doSearch(2,1);
        } else {
            let previousSearch = sessionStorage.crm0200;
            
            if (angular.isUndefined(previousSearch)) {
                this.doSearch(2,1);
                return;
            }

            previousSearch = angular.fromJson(previousSearch);
            var page = previousSearch.page;
            var index = previousSearch.index;

            this.m.activeFlag = index;
            delete previousSearch['page'];
            delete previousSearch['index'];
            this.m[index].filter = angular.copy(previousSearch);
            this.doSearch(index,page);
        }
    }

    loadInit() {
        let that  = this;
        let service = this.API.service('load-promotion', this.API.all('crm0200'));
        service.post()
            .then((response) => {
                let promotionList = response.data.promotionList;
                let salesmanList  = response.data.salesmanList;
                let statusList    = response.data.statusList;
                let branchList    = response.data.branchList;
                let reportStatus  = response.data.reportStatus;
                this.m.supplierList= response.data.supplierList;

                if (promotionList != null) {
                    this.m.listPromotion = promotionList;
                }
                if (salesmanList != null) {
                    this.m.listSalesman = salesmanList;
                }
                if (statusList != null) {
                    this.m.statusList = statusList;
                }
                if (branchList != null) {
                    this.m.branchList = branchList;
                }
                if (reportStatus != null) {
                    this.m.reportStatus = reportStatus;
                   
                    angular.forEach(this.m.reportStatus, function(value) {
                        // total += parseFloat(value.unit_price) * parseFloat(value.amountExport);
                        let num= parseInt(value["order_sts"], 10);
                        if (num!=7 && num!=1){
                            let count =  value["count"];
                            let id = that.code[num];
                            that.m[id].data.total = count;
                        }
                       
                    });
                }
                // this.$log.info("check status: ", this.m);
            });
    }

    search() {
        this.doSearch(2,1);
    }

    resetFilter(index) {
        if (index < 1 || index > 9) {
            return;
        }
        this.m[index].filter = {
            orderBy:  'updated_at',
            orderDirection: 'desc'
        };
        this.doSearch(index, 1);
    }


    chooseTab(index) {
        if (index < 1 || index > 9) {
            return;
        }
        // this.$log.info('check : ',this.m);
        this.m.activeFlag = index;
        this.doSearch(index,1)
    }


    sort(index, orderBy) {
        let orderOption = this.UtilsService.getOrderBy(orderBy, this.m[index].filter.orderBy, this.m[index].filter.orderDirection);
        this.m[index].filter.orderBy = orderOption.orderBy;
        this.m[index].filter.orderDirection = orderOption.orderDirection;

        this.doSearch(index,1);
    }


    doSearch(index, page) {
        // Get list product 
        let searchService = this.API.service('search', this.API.all('crm0200'));
        let param = angular.copy(this.m[index].filter);
        if (param.from_date) {
            param.from_date = moment(param.from_date).format('YYYY-MM-DD');
        }
        if (param.to_date) {
            param.to_date = moment(param.to_date).format('YYYY-MM-DD');
        }
        
        param.index = index;
        param.page = page;
        sessionStorage.crm0200 = angular.toJson(param);
        //param.pageSize = $scope.m.paginationInfo.pageSize;
        searchService.post(param)
            .then((response) => {
                this.$log.info(this.m);
                var data = response.plain().data;
                var list = data.data;
                angular.forEach(list, function(value) {
                    value.check = false;
                });
                // this.m.list = list;
                this.m[index].data = data;
            });
    }

    clickPrintCheck(index) {
        let thisClass = this;
        var selectedIds = [];
        angular.forEach(this.m[index].data.data, function(value) {
            if (value.check === true) {
                selectedIds.push(value.store_order_id);
            }
        });

        if (selectedIds.length == 0) {
            this.ClientService.warning("Vui lòng chọn đơn hàng.");
            return;
        }

        var param = {
            store_order_ids: selectedIds
        };

        let service = this.API.service('print-check', this.API.all('crm0210'));
        service.post(param)
            .then((res) => {
                if (res.data.rtnCd == true) {
                    this.ClientService.success(res.data.url);
                    thisClass.$window.open(res.data.url);
                } else {
                    this.ClientService.error('Không tải được tập tin.');
                }
            });
    }

    download(index) {
        let param = angular.copy(this.m[index].filter);
        if (param.from_date) {
            param.from_date = moment(param.from_date).format('YYYY-MM-DD');
        }
        if (param.to_date) {
            param.to_date = moment(param.to_date).format('YYYY-MM-DD');
        }
        param.index = index;
        param.down = 1;

        let service = this.API.service('download', this.API.all('crm0200'));
        service.post(param)
            .then((response) => {
                this.$log.info(response.data);
                this.ClientService.downloadFileOneTime(response.data.file);
            });
    }


}

export const Crm0200Component = {
    // templateUrl: './views/app/components/crm0200/crm0200.component.html',
    templateUrl: '/views/admin.crm0200.crm0200',
    controller: Crm0200Controller,
    controllerAs: 'vm',
    bindings: {}
}
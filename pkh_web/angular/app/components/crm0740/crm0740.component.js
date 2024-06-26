class Crm0740Controller {
    constructor($scope, $state, $compile, $log, AclService, API, UtilsService, $stateParams, ClientService) {
        'ngInject'

        this.$scope = $scope;
        this.$state = $state;
        this.$compile = $compile;
        this.$log = $log;
        this.AclService = AclService;
        this.API = API;
        this.UtilsService = UtilsService;
        this.ClientService = ClientService;

        this.m = {
            order: {}
        }
        this.m.message = "";
        this.m.store_order_id = $stateParams.store_order_id;
        this.m.store_delivery_id = $stateParams.store_delivery_id;
        this.m.canEdit = true;
        this.loadInitData();
    }

    loadInitData() {
        // let $log = this.$log;

        let param = {
            store_order_id: this.m.store_order_id,
            store_delivery_id: this.m.store_delivery_id
        };

        let service = this.API.service('load-init', this.API.all('crm0740'));
        service.post(param)
            .then((response) => {
                if (response.data.store != null) {
                    this.m.store = response.data.store;
                }
                this.m.order.asked_money = parseInt(response.data.delivery.total_with_discount);
                this.m.orderDetail = response.data.orderDetail;
                this.$log.info('ahihi', this.m.orderDetail);
                this.calcOrderTotal();

            });
    }

    searchProduct() {
        let $log = this.$log;

        //$log.info(this.m);

        // Get list product 
        let searchService = this.API.service('search-product', this.API.all('crm0740'));
        let param = angular.copy(this.m.filter);

        var thisClass = this;
        searchService.post(param)
            .then((response) => {
                var list = response.plain().data.list;
                if (thisClass.m.orderDetail != null && thisClass.m.orderDetail.length > 0) {
                    angular.forEach(list, function(value, key) {
                        var hide = false;
                        for (var i = 0; i < thisClass.m.orderDetail.length; i++) {
                            if (thisClass.m.orderDetail[i].product_id == value.product_id) {
                                hide = true;
                                break;
                            }
                        }
                        value.hide = hide;
                    });
                }

                this.m.productList = list;
                //this.$log.info('ahihi', this.m.productList);
            });
    }

    addProduct(product) {
        if (this.m.orderDetail == null) {
            this.m.orderDetail = [];
        }

        var newProduct = {
            product_id: product.product_id,
            product_code: product.product_code,
            name: product.product_cat_name,
            product_name: product.name,
            standard_packing: product.standard_packing,
            unit_price: parseInt(product.accountant_price),
            balance: 0,
            amount: 0,
            version_no: 0
        };

        this.m.orderDetail.push(newProduct);
        product.hide = true;
        this.calcOrderTotal();
    }

    removeProduct(product) {
        var index = this.m.orderDetail.indexOf(product);
        if (index >= 0) {
            this.m.orderDetail.splice(index, 1);
            this.calcOrderTotal();

            for (var i = 0; i < this.m.productList.length; i++) {
                if (this.m.productList[i].product_id == product.product_id) {
                    this.m.productList[i].hide = false;
                }
            }
        }
        this.calcOrderTotal();
    }

    calcOrderTotal() {

        var total = 0;
        angular.forEach(this.m.orderDetail, function(value) {
            total += parseFloat(value.unit_price) * parseFloat(value.amount);
        });

        this.m.order.result_money = total;
    }

    clickCreate() {
        this.m.message = "";
        if (!this.m.order.asked_money) {
            return;
        }

        if (this.m.orderDetail == null) {
            this.m.message = "Chưa nhập danh sách sản phẩm ";
            return;
        }

        for (var i = 0; i < this.m.orderDetail.length; i++) {
            if (this.m.orderDetail[i].unit_price == 0) {
                this.m.message = "Sản phẩm " + this.m.orderDetail[i].product_code + " chưa có giá tiền";
                return;
            }
        }

        for (var i = 0; i < this.m.orderDetail.length; i++) {
            if (this.m.orderDetail[i].amount > this.m.orderDetail[i].balance) {
                this.m.message = "Sản phẩm " + this.m.orderDetail[i].product_code + " có tồn nhỏ hơn xuất";
                return;
            }
        }


        let totalMoney = parseInt(this.m.order.asked_money);

        let createService = this.API.service('create-one', this.API.all('crm0740'));
        let param = {
            orderDetail: this.m.orderDetail,
            totalMoney: totalMoney
        }
        createService.post(param)
            .then((response) => {
                this.m.orderDetail = response.plain().data.list;
                this.calcOrderTotal();
            });
    }

    download() {
        let param = {
            list: this.m.orderDetail
        }
        let service = this.API.service('download', this.API.all('crm0740'));

        service.post(param)
            .then((response) => {
                //this.$log.info(response.data);
                this.ClientService.downloadFileOneTime(response.data.file);
            });
    }

    $onInit() {}
}

export const Crm0740Component = {
    //templateUrl: './views/app/components/crm0740/crm0740.component.html',
    templateUrl: '/views/admin.crm0740',
    controller: Crm0740Controller,
    controllerAs: 'vm',
    bindings: {}
}
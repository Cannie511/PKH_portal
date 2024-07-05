class Crm0210Controller {
    constructor($scope, $state, $compile, $log, ClientService, AclService, API, UtilsService, RouteService, $stateParams) {
        'ngInject'

        this.$scope = $scope;
        this.$state = $state;
        this.$compile = $compile;
        this.$log = $log;
        this.AclService = AclService;
        this.API = API;
        this.UtilsService = UtilsService;
        this.ClientService = ClientService;
        this.RouteService = RouteService;
        this.m = {
            order: {

            },
            init: {},
            orderDetail: [],
            form: {}
        }
        this.m.canEdit = true;
        this.m.test = [0, 0]; //test form of supplier and rate
        this.m.store_order_id = $stateParams.store_order_id;
        this.m.store_id = $stateParams.store_id;
        this.loadInitData();
    }


    loadInitData() {
        
        this.m.order.notes = null;
        let $log = this.$log;
        let param = {
                store_order_id: this.m.store_order_id,
                store_id : this.m.store_id
            }
            //$log.info('supplier_id', this.m.supplier_order_id);
        this.m.store_id = param.store_id;
            //param.supplier_order_id = this.m.supplier_order_id;
        let initService = this.API.service("search-product", this.API.all("crm0210"));
        initService.post(param)
        .then((response) => {
            this.m.init = response.data;
            //$log.info('ahihi', this.m.init.order);
            if (response.data.store != null) {
                this.m.store = response.data.store;
            }
            if (this.m.store_order_id != null) {
                this.m.orderDetail = this.m.init.orderDetail;
                this.m.order = this.m.init.order;
                this.m.order.total = this.m.init.order[0].total;
                this.m.order.discount = this.m.init.order[0].discount;
                this.m.order.total_with_discount = this.m.init.order[0].total_with_discount;
            }
            this.$log.info("check data search: ", this.m);
        });
    }

    searchProduct() {
        let $log = this.$log;

        //this.$log.info(this.m);

        // Get list product 
        let searchService = this.API.service('search-product', this.API.all('crm0210'));
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
                // $log.debug('this.m.list', this.m.productList);
            });
    }

    addProduct(product) {
        if (this.m.orderDetail == null) {
            this.m.orderDetail = [];
        }

        var newProduct = {
            product_id: product.product_id,
            product_code: product.product_code,
            product_name: product.product_name,
            pakaging: product.pakaging,
            unit_price: product.selling_price,
            pakaging_type : product.pakagingType,
            describes: product.describes,
            amount: 0,
            store_order_id: 0,
            version_no: 0
                //cần thêm giá vốn
                // cần thêm thể tích thùng

        };

        this.m.orderDetail.push(newProduct);
        product.hide = true;
        this.calcOrderTotal();
    }

    calcOrderTotal() {
        if (this.m.order == null)
            return;
        var total = 0;
        var discount = this.m.order.discount;
        var total_with_discount = 0;
        angular.forEach(this.m.orderDetail, function(value) {
            total += parseFloat(value.unit_price) * parseFloat(value.amount);
            
        });
        total_with_discount = total - (total * (discount / 100) );
        
        this.m.discount = discount;
        this.m.order.total = total;
        this.m.order.total_with_discount = total_with_discount;
     
        //show tổng thể tích và tiền vốn
    }

    
    roundUp(number) {
        return Math.ceil(number);
    }

    checkValidForm() {

        let oke = true;
        if (this.m.form.supplier_id == null) {
            this.m.test[0] = 1;
            oke = false;
        } else {
            this.m.test[0] = 0
        }
        if (this.m.form.rate == null || this.m.form.rate == "") {
            this.m.test[1] = 1;
            oke = false;
        } else {
            this.m.test[1] = 0
        }
        return oke;
    }

    clickSave() {
        var orderDetail = [];

        
        angular.forEach(this.m.orderDetail, function(value, key) {
            orderDetail.push({
                product_id: value.product_id,
                amount: value.amount,
                unit_price: value.unit_price,
                pakaging: value.pakaging,
                describes: value.describes,
                pakaging_type : value.pakaging_type,
                product_name : value.product_name
                

            });
        });


        //this.$log.info('order', this.m.order);
        var param = {
            mode: 'SAVE',
            store_id: this.m.store_id,
            notes: this.m.order.notes,
            carton: this.m.order.carton,
            orderDetail: orderDetail,
            supplier_order_id: this.m.supplier_order_id,
            store_order_id: this.m.store_order_id,
            total: this.m.order.total,
            total_with_discount: this.m.order.total_with_discount,
            discount: this.m.order.discount,
            payment_money: this.m.cpayment_money
            
        };
        //this.$log.info('param', param);
        let service = this.API.service('save', this.API.all('crm0210'));
        service.post(param)
            .then((response) => {
                //this.$log.info('response.data', response.data);
                this.ClientService.success("Lưu thành công");
                this.m.supplier_order_id = response.data.supplierOrderId;
                this.RouteService.goState("app.crm1920");
            });
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

    clickPrintCheck() {
        var param = {
            supplier_order_id: this.m.supplier_order_id
        };

        // this.$log.debug('download');
        // this.ClientService.downloadFile('api/crm0210/print-check', param);
        let service = this.API.service('print-check', this.API.all('crm0210'));
        service.post(param)
            .then((res) => {
                if (res.data.rtnCd == true) {
                    this.m.form.send_po_date = res.data.send_po_date;
                    window.open(res.data.url);
                    this.loadInitData();
                } else {
                    this.ClientService.error('Không tải được tập tin.');
                }
            });
    }

    clickCreateExport() {
        let that = this;
        swal({
            title: "Bạn có muốn xuất đơn hàng này?",
            text: "Đơn hàng sau khi xuất sẽ không thể sửa đổi.",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Đồng ý',
            closeOnConfirm: true,
            showLoaderOnConfirm: true,
            html: false
        }, function() {
            var param = {
                supplier_order_id: that.m.supplier_order_id
            };

            that.RouteService.goState("app.crm1610", param);
        });
    }

    $onInit() {}

  
}

export const Crm0210Component = {
    //templateUrl: './views/app/components/crm0210/crm0210.component.html',
    templateUrl: '/views/admin.crm0210',
    controller: Crm0210Controller,
    controllerAs: 'vm',
    bindings: {}
}
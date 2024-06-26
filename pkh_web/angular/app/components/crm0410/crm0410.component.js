class Crm0410Controller {
    constructor($scope, $state, API, $log, $stateParams, RouteService, ClientService, $window, AclService) {
        'ngInject';

        this.API = API;
        this.$state = $state;
        this.$log = $log;
        this.ClientService = ClientService;
        this.$scope = $scope;
        this.RouteService = RouteService;
        this.$window = $window;
        this.can = AclService.can;

        this.m = {
            order: {
                // discount_1: 0, 
                // discount_2: 0,
                // notes: 0,
                // store_id: 0,
                // store_order_id:0,
                // version_no: 0
            },
            orderDetail: [], 
            form: {
                publishDate: moment(),
               file: null
            },
            formUpload: {
                file: null,
               images: []
            },
        }

        this.m.isUploaded = false;

        this.m.store_order_id = $stateParams.store_order_id;
        this.m.store_delivery_id = $stateParams.store_delivery_id;
        this.m.form.id = this.m.store_delivery_id;
        if ((this.m.store_order_id == null || this.m.store_order_id <= 0) &&
            (this.m.store_delivery_id == null || this.m.store_delivery_id <= 0)) {
            this.ClientService.warning("Vui lòng chọn phiếu xuất");
            this.RouteService.goState("app.crm0400");
            return;
        }

    }

    $onInit() {
        this._setupFileUpload("fileUpload", this.m.formUpload);
        this.loadInitData();
        this.loadImageList();
    }

    _setupFileUpload(fileControlId, formModel) {
        var self = this;
        let fileControl = angular.element("#" + fileControlId);
        fileControl.on('change', function() {
            var filesSelected = fileControl[0].files;
            if (filesSelected.length > 0) {
                var fileToLoad = filesSelected[0];
                var fileReader = new FileReader();

                fileReader.onload = function(fileLoadedEvent) {
                    var srcData = fileLoadedEvent.target.result; // <--- data: base64 
                    self.$scope.$apply(function() {
                        formModel.file = srcData;
                    });
                }
                fileReader.readAsDataURL(fileToLoad);
            }
        });
    }

    loadInitData() {
        // let $log = this.$log;

        let param = {
            store_order_id: this.m.store_order_id,
            store_delivery_id: this.m.store_delivery_id
        };

        let service = this.API.service('load-init', this.API.all('crm0410'));
        service.post(param)
            .then((response) => {
                if (response.data.store != null) {
                    this.m.store = response.data.store;
                }

                //this.$log.info('store', this.m.store);

                if (response.data.order != null) {
                    response.data.order.discount_1 = parseInt(response.data.order.discount_1);
                    response.data.order.discount_2 = parseInt(response.data.order.discount_2);
                    response.data.order.total = parseInt(response.data.order.total);
                    this.m.order = response.data.order;
                }
                this.m.warehouseList = response.data.warehouseList;

                this.m.delivery = response.data.delivery;
                this.m.orderDetail = response.data.orderDetail;
                this.m.requestList = response.data.requestList;
                this.m.statusList = response.data.statusList;
                this.m.shippingList = response.data.shippingList;
                this.m.signList = response.data.signList;
                this.m.storeSignList = response.data.storeSignList;

                this.calcOrderTotal();

                this.m.canEdit = true;
                if (this.m.order != null) {
                    if (this.m.order.delivery_sts == '5') {
                        this.m.canEdit = false;
                    }
                }
                this.$log.info('check init', this.m);

            });
    }

    calcOrderTotal() {
        if (this.m.order == null)
            return;
        var total = 0;
        var volume = 0;
        var carton = 0;
        angular.forEach(this.m.orderDetail, function(value) {
            total += parseFloat(value.unit_price) * parseFloat(value.amountExport);
            volume += parseFloat(value.volume) * parseFloat(value.amountExport)/ parseFloat(value.standard_packing);
            carton += parseFloat(value.amountExport)/ parseFloat(value.standard_packing);

        });
        this.m.order.total  = total;
        this.m.order.volume = volume;
        this.m.order.carton = carton;
    }


    checkValidWarehouse(){
        let oke = true;
        let msg = "";
        if (this.m.order.warehouse_id == null || this.m.order.warehouse_id == "") {
            msg = "Vui lòng chọn kho để nhập.";
            oke = false;
        } 
        
        if (!oke) {
            this.ClientService.error(msg);
        }
        return oke;
    }
    
    clickSave(print, type) {
        var self = this;
        if (!this.checkValidWarehouse()) {
            return;
        }
        if ( isNaN(self.m.order.volume) ){
            self.ClientService.error('Vui lòng cập nhật thể tích cho sản phẩm');
            return ;
        }
        swal({
            title: "Bạn có muốn lưu",
            text: "Vui lòng kiểm tra kĩ thông tin kho được xuất.",
            type: "warning",
            showCancelButton: true,
            // confirmButtonColor: '#DD6B55', 
            confirmButtonText: 'Đồng ý',
            closeOnConfirm: true,
            showLoaderOnConfirm: true,
            html: false
        }, function() {
           self.save(print, type);
        });
    }

    save(print, type){
        var self = this;
        var orderDetail = [];
        var ok = true;
        self.m.canEdit = false;
        if (type == 1) {
            angular.forEach(self.m.orderDetail, function(value) {
                /*if (value.amountExport > value.amount || value.amount < 0) {
                    self.ClientService.error('Vui lòng nhập lại số lượng xuất');
                    ok = false;
                    return;
                }*/
                orderDetail.push({
                    product_id: value.product_id,
                    amount: value.amountExport
                });
            });
        } else if (type == 2) {
            angular.forEach(self.m.orderDetail, function(value) {
                if (value.amountConfirm > value.amountExport || value.amountConfirm < 0) {
                    self.ClientService.error('Vui lòng nhập lại số lượng xác nhận');
                    ok = false;
                    return;
                }
                orderDetail.push({
                    product_id: value.product_id,
                    amount: value.amountConfirm
                });
            });
        }
        if (!ok) {
            return;
        }

            // self.$log.info('check ok', ok);
        var store_order_id = null;
        var store_delivery_id = null;
        if (self.m.store_order_id > 0) {
            store_order_id = self.m.store_order_id;
        } else if (self.m.order != null && self.m.order.store_order_id > 0) {
            store_order_id = self.m.order.store_order_id;
        }

        if (self.m.store_delivery_id > 0) {
            store_delivery_id = self.m.store_delivery_id;
        } else if (self.m.order != null && self.m.order.store_delivery_id > 0) {
            store_delivery_id = self.m.order.store_delivery_id;
        }

        var param = {
            mode: 'SAVE',
            store_id: self.m.store_id,
            order: {
                store_order_id: store_order_id,
                store_delivery_id: store_delivery_id,
                store_id: self.m.order.store_id,
                warehouse_id : self.m.order.warehouse_id,
                discount_1: self.m.order.discount_1,
                discount_2: self.m.order.discount_2,
                volume: self.m.order.volume,
                carton: self.m.order.carton,
                notes: self.m.order.notes,
                version_no: self.m.order.version_no
            },
            orderDetail: orderDetail
        };

        let service = self.API.service('save', self.API.all('crm0410'));
        service.post(param)
            .then((response) => {
                // this.$log.info('response.data', response.data);
                self.m.canEdit = true;
                if (response.data.rtnCd == true) {
                    self.ClientService.success("Lưu thành công");
                    self.m.store_delivery_id = response.data.storeDeliveryId;
                    self.loadInitData();

                    if (print) {
                        var param = {
                            store_delivery_ids: [self.m.store_delivery_id]
                        };

                        // this.$log.debug('download');
                        // this.ClientService.downloadFile('api/crm0210/print-check', param);
                        let service = self.API.service('print', self.API.all('crm0410'));
                        service.post(param)
                            .then((res) => {
                                if (res.data.rtnCd == true) {
                                    angular.forEach(res.data.urls, function(item) {
                                        self.$window.open(item);
                                    });
                                } else {
                                    self.ClientService.error('Không tải được tập tin.');
                                }
                            });
                    }
                } else {
                    self.ClientService.error(response.data.rtnMsg);
                }
            });
    }

    clickPrintPacking() {
        // this.clickSave(true);
        var self = this;
        this.m.canEdit = false;
        this.$log.info('check print packing');
        swal({
            title: "Bạn có muốn in phiếu soạn hàng này?",
            text: "Vui lòng kiểm tra kĩ thông tin kho được xuất và số lượng sản phẩm xuất. Sau khi in sẽ không thể chỉnh sửa được nữa",
            type: "warning",
            showCancelButton: true,
            // confirmButtonColor: '#DD6B55', 
            confirmButtonText: 'Đồng ý',
            closeOnConfirm: true,
            showLoaderOnConfirm: true,
            html: false
        }, function() {
            var param = {
                store_delivery_id: self.m.store_delivery_id,
                store_order_id: self.m.store_order_id
            };

            // this.$log.debug('download');
            // this.ClientService.downloadFile('api/crm0210/print-check', param);
            let service = self.API.service('print-packing', self.API.all('crm0410'));
            service.post(param)
                .then((res) => {
                    if (res.data.rtnCd == true) {
                        angular.forEach(res.data.url, function(item) {
                            self.$window.open(item);
                        });
                        self.loadInitData();
                    } else {
                        self.ClientService.error('Không tải được tập tin.');
                    }
                });
        });
    }

    clickPrintDelivery() {
        // this.clickSave(true);
        var self = this;
        this.m.canEdit = false;
        swal({
            title: "Bạn có muốn in phiếu xuất này?",
            text: "Sau khi in sẽ chuyển sang trạng thái giao hàng",
            type: "warning",
            showCancelButton: true,
            // confirmButtonColor: '#DD6B55', 
            confirmButtonText: 'Đồng ý',
            closeOnConfirm: true,
            showLoaderOnConfirm: true,
            html: false
        }, function() {
            var param = {
                store_delivery_id: self.m.store_delivery_id
            };

            // this.$log.debug('download');
            // this.ClientService.downloadFile('api/crm0210/print-check', param);
            let service = self.API.service('print', self.API.all('crm0410'));
            service.post(param)
                .then((res) => {
                    if (res.data.rtnCd == true) {
                        angular.forEach(res.data.url, function(item) {
                            self.$window.open(item);
                            self.loadInitData();
                        });
                    } else {
                        self.ClientService.error('Không tải được tập tin.');
                    }
                });
        });
    }

    clickConfirm() {
        // this.clickSave(true);
        var self = this;
        this.m.canEdit = false;
        swal({
            title: "Bạn có muốn xác nhận số lượng soạn hàng này",
            text: "Sau khi xác nhận sẽ không thể chỉnh sửa được nữa",
            type: "warning",
            showCancelButton: true,
            // confirmButtonColor: '#DD6B55', 
            confirmButtonText: 'Đồng ý',
            closeOnConfirm: true,
            showLoaderOnConfirm: true,
            html: false
        }, function() {
            self.save(false, 2);
        });
    }

    clickShipping() {
        // this.clickSave(true);
        var self = this;
        this.m.canEdit = false;
        swal({
            title: "Bạn có muốn xác nhận vận chuyển?",
            text: "Sau khi bấm nút sẽ chuyển sang trạng thái vận chuyển",
            type: "warning",
            showCancelButton: true,
            // confirmButtonColor: '#DD6B55', 
            confirmButtonText: 'Đồng ý',
            closeOnConfirm: true,
            showLoaderOnConfirm: true,
            html: false
        }, function() {
            var param = {
                store_delivery_id: self.m.store_delivery_id,
                shipping_id: self.m.filter.shipping_id
            };


            let service = self.API.service('shipping', self.API.all('crm0410'));
            service.post(param)
                .then((res) => {
                    if (res.data.rtnCd == true) {
                        self.loadInitData();
                    } else {
                        self.ClientService.error('Không xác nhận trạng thái vận chuyển được');
                    }
                });
        });
    }

    clickReceive() {
        // this.clickSave(true);
        var self = this;
        this.m.canEdit = false;
        swal({
            title: "Bạn có muốn xác nhận khách nhận?",
            text: "Sau khi bấm nút sẽ chuyển sang trạng thái khách nhận",
            type: "warning",
            showCancelButton: true,
            // confirmButtonColor: '#DD6B55', 
            confirmButtonText: 'Đồng ý',
            closeOnConfirm: true,
            showLoaderOnConfirm: true,
            html: false
        }, function() {
            self.m.delivery.contact_mobile1 = self.m.store.contact_mobile1;
            var param = {
                store_delivery_id: self.m.store_delivery_id,
                item: self.m.delivery
            };

            let service = self.API.service('receive', self.API.all('crm0410'));
            service.post(param)
                .then((res) => {
                    if (res.data.rtnCd == true) {
                        self.loadInitData();
                    } else {
                        self.ClientService.error('Không xác nhận trạng thái khách nhận được');
                    }
                });
        });
    }

    clickCancel() {
        let that = this;
        swal({
            title: "Bạn có muốn hủy phiếu xuất?",
            text: "Phiếu xuất sau khi hủy sẽ không thể phục hồi.",
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
                store_delivery_id: that.m.store_delivery_id,
                notes: inputValue
            };

            let service = that.API.service('cancel', that.API.all('crm0410'));
            service.post(param)
                .then((res) => {
                    if (res.data.rtnCd == true) {
                        that.ClientService.success(res.data.msg);
                    } else {
                        that.ClientService.error(res.data.msg);
                    }
                });
        });
    }

    clickRequestCancel() {
        let that = this;
        swal({
            title: "Bạn có muốn hủy phiếu xuất?",
            text: "Phiếu xuất sau khi hủy sẽ không thể phục hồi.",
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
                store_delivery_id: that.m.store_delivery_id,
                notes: inputValue
            };

            let service = that.API.service('request-cancel', that.API.all('crm0410'));
            service.post(param)
                .then((res) => {
                    if (res.data.rtnCd == true) {
                        that.ClientService.success(res.data.msg);
                    } else {
                        that.ClientService.error(res.data.msg);
                    }
                });
        });
    }

    clickFinish() {
        let that = this;
        swal({
            title: "Bạn có muốn hoàn tất phiếu xuất này?",
            text: "Hoàn tất khi đã hoàn thành thanh toán. Phiếu xuất sau hoàn tất sẽ không thể sửa và in được nữa.",
            type: "warning",
            showCancelButton: true,
            // confirmButtonColor: '#DD6B55', 
            confirmButtonText: 'Đồng ý',
            closeOnConfirm: true,
            showLoaderOnConfirm: true,
            html: false
        }, function() {

            var param = {
                store_delivery_id: that.m.store_delivery_id
            };

            let service = that.API.service('finish', that.API.all('crm0410'));
            service.post(param)
                .then((res) => {
                    if (res.data.rtnCd == true) {
                        that.ClientService.success(res.data.msg);
                        that.loadInitData();
                    } else {
                        that.ClientService.error(res.data.msg);
                    }
                });
        });
    }

    getSumMoneyDiscount() {
        let result = this.m.order.total * (this.m.order.discount_1 + this.m.order.discount_2) / 100;
        result = Math.floor(result / 1000) * 1000;
        return result;
    }

    accept(item) {
        let that = this;
        this.$log.debug(item);
        swal({
            title: "Bạn có muốn chấp nhận yêu cầu này?",
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
                request_id: item.request_id,
                notes: inputValue
            };

            let service = that.API.service('accept', that.API.all('crm0410'));
            service.post(param)
                .then((res) => {
                    if (res.data.rtnCd == true) {
                        that.ClientService.success(res.data.msg);
                        that.loadInitData();
                        // that.search();
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
            title: "Bạn có muốn từ chối yêu cầu này?",
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
                request_id: item.request_id,
                notes: inputValue
            };

            let service = that.API.service('deny', that.API.all('crm0410'));
            service.post(param)
                .then((res) => {
                    if (res.data.rtnCd == true) {
                        that.ClientService.success(res.data.msg);
                        that.loadInitData();
                        // that.search();
                    } else {
                        that.ClientService.error(res.data.msg);
                    }
                });
        });
    }

    clickCreateExport() {
        let that = this;
        swal({
            title: "Bạn có muốn hỗ trợ xuất đơn hàng này?",

            type: "warning",
            showCancelButton: true,
            // confirmButtonColor: '#DD6B55', 
            confirmButtonText: 'Đồng ý',
            closeOnConfirm: true,
            showLoaderOnConfirm: true,
            html: false
        }, function() {
            var param = {
                store_order_id: that.m.store_order_id,
                store_delivery_id: that.m.store_delivery_id
            };

            that.RouteService.goState("app.crm0740", param);
        });
    }
    
    upload() {
        let self = this;
        let service = this.API.service('upload', this.API.all('crm0410'));
        

        if (self.m.isUploaded == true) {
            swal("Đang xử lý!");
            return;
        }

        self.m.isUploaded = true;
        let param = {
            id: this.m.form.id,
            file: this.m.formUpload.file
        }

        if ( param.id > 0) {
            service.post(param)
            .then(function(response) {
                if (response.data.rtnCd == true) {
                    self.m.formUpload.file = null;
                    self.ClientService.success('Thêm hình ảnh  thành công');
                    self.loadImageList();
                } else {
                    self.ClientService.error('Không thể thêm hình ảnh');
                }
                self.m.isUploaded = false;
            });
        }
    }


    loadImageList() {
        let self = this;
        let param = {
            id: this.m.form.id
        };

        if ( param.id > 0) {
            let service = this.API.service('load-images', this.API.all('crm0410'));
            
            service.post(param)
                .then(function(response) {
                    if (response.data.rtnCd == true) {
                        self.m.formUpload.images =response.data.list;
                    } else {
                        self.ClientService.error('Có lỗi khi tải hình ảnh');
                    }
                });
            }
        }
    }


export const Crm0410Component = {
    // templateUrl: './views/app/components/crm0410/crm0410.component.html',
    templateUrl: '/views/admin.crm0410',
    controller: Crm0410Controller,
    controllerAs: 'vm',
    bindings: {}
}
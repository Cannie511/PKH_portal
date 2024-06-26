class Crm0751Controller {
    constructor($scope, $state, API, $log, UtilsService, ClientService, $stateParams, RouteService, AclService) {
        'ngInject'

        this.API = API;
        this.$state = $state;
        this.$log = $log;
        this.$scope = $scope;
        this.UtilsService = UtilsService;
        this.ClientService = ClientService;
        this.RouteService = RouteService;
        this.can = AclService.can;
        this.m = {
            filter: {},
            list: null,
            dateOptions: {
                // formatYear: 'yy',
                startingDay: 1
            },
            formUpload: {
                file: null,
               images: []
            }
        }
        this.m.isUploaded = false; // upload image 
        this.m.store_order_id = $stateParams.store_order_id;
        this.m.payment_id = $stateParams.payment_id;

        this._setupFileUpload("fileUpload", this.m.formUpload);
    }

    $onInit() {
        if (this.m.store_order_id == null || this.m.store_order_id <= 0) {
            this.ClientService.warning("Vui lòng chọn đơn hàng");
            this.RouteService.goState("app.crm0200");
            return;
        }
        if (this.m.payment_id == null) {
            this.m.filter.payment_date = new Date();
            this.m.filter.bank_account_id = null;
            this.m.filter.notes = null;
            this.m.filter.salesman_id = 0;
            this.m.filter.store_order_id = null;
        }

        this.m.filter.payment_date = new Date();
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

    sort(orderBy) {
        let orderOption = this.UtilsService.getOrderBy(orderBy, $scope.m.filter.orderBy, $scope.m.filter.orderDirection);
        this.m.filter.orderBy = orderOption.orderBy;
        this.m.filter.orderDirection = orderOption.orderDirection;

        this.doSearch(1);
    }

    save() {
        let that = this;
        let $log = this.$log;
        //$log.info('aihihihihi', this.m.filter);
        let alerts = this.alerts;
        let RouteService = this.RouteService;
        let ClientService = this.ClientService;
        let saveService = this.API.service('save', this.API.all('crm0751'));
        let param = angular.copy(this.m.filter);

        if (this.m.payment_id == null) {
            param.payment_id = null;
        } else {
            param.payment_id = this.m.payment_id;
        }

        saveService.post(param)
            .then(function(response) {

                if (param.payment_id == null) {
                    ClientService.success('Thêm mới thanh toán trước thành công');

                } else {
                    ClientService.success('Cập nhật thanh toán trước thành công');

                }
                RouteService.goState('app.crm0750');
                // that.loadInitData();

            });

    }

    loadInitData() {
        let param = {
            store_order_id: this.m.store_order_id,
            payment_id: this.m.payment_id
        };
        let log = this.$log;

        let service = this.API.service('load-init', this.API.all('crm0751'));
        service.post(param)
            .then((response) => {
                this.m.init = response.data; //initiate list of bank account
                // let statusList    = response.data.statusList;
                // if (statusList != null) {
                //     this.m.statusList = statusList;
                // }
                if (this.m.init.inforPayment == null) {
                    this.m.order = this.m.init.order; 
                    log.info("check order ", this.m);
                    this.m.filter.store_order_id        = this.m.order.store_order_id; // send to insert
                    this.m.filter.store_order_code      = this.m.order.store_order_code; // show on screen  
                    this.m.filter.address               = this.m.order.address; //show on screen  
                    this.m.filter.total                 = this.m.order.total; //show on screen  
                    this.m.filter.discount_1            = this.m.order.discount_1; //show on screen  
                    this.m.filter.order_sts             = this.m.order.order_sts; //show on screen  
                    this.m.filter.order_date            = new Date(this.m.order.order_date); //show on screen  
                    this.m.filter.delivery_date         = new Date(this.m.order.delivery_date);
                    this.m.filter.payment_sts             = this.m.order.payment_sts ; //show on screen  

                    this.m.filter.total_with_discount   = this.m.order.total_with_discount; //show on screen  
                    this.m.filter.name                  = this.m.order.name; //show on screen 
                    this.m.filter.salesman_id           = this.m.order.salesman_id; // send to insert
                    
                    this.m.filter.payment_money         =  Math.round(parseFloat(this.m.order.total)*1/100*99/100/1000)*1000;
                    if (this.m.filter.salesman_id == null) this.m.filter.salesman_id = 0;
                    this.m.filter.salesman_name = this.m.order.salesman_name; //show on screen 
                }
                //log.info('init: ', this.m.init);
                if (this.m.init.inforPayment != null) {
                    this.m.filter.payment_date          = new Date(this.m.init.inforPayment[0].payment_date);
                    this.m.filter.bank_account_id       = this.m.init.inforPayment[0].bank_account_id;
                    this.m.filter.payment_money         = parseInt(this.m.init.inforPayment[0].payment_money);
                    this.m.filter.payment_type          = this.m.init.inforPayment[0].payment_type.toString();
                    this.m.filter.notes                 = this.m.init.inforPayment[0].notes;
                    // Show saleman_name , address , store_name
                    this.m.filter.salesman_name         = this.m.init.inforPayment[0].salesman_name;
                    this.m.filter.address               = this.m.init.inforPayment[0].store_address;
                    this.m.filter.name                  = this.m.init.inforPayment[0].store_name;
                    if (this.m.init.inforPayment[0].delivery_date){
                        this.m.filter.delivery_date     = new Date(this.m.init.inforPayment[0].delivery_date);
                    }
                    this.m.filter.order_date            = new Date(this.m.init.inforPayment[0].order_date);
                    this.m.filter.store_order_id        = this.m.init.inforPayment[0].store_order_id; // send to insert
                    this.m.filter.store_order_code      = this.m.init.inforPayment[0].store_order_code; // show on screen  
                    this.m.filter.total                 = this.m.init.inforPayment[0].total; //show on screen  
                    this.m.filter.discount_1            = this.m.init.inforPayment[0].discount_1; //show on screen  
                    this.m.filter.order_sts             = this.m.init.inforPayment[0].order_sts; //show on screen  
                    this.m.filter.payment_sts           = this.m.init.inforPayment[0].payment_sts ; //show on screen  

                    this.m.filter.store_id              = this.m.init.inforPayment[0].store_id; // show on screen  
                    this.m.filter.salesman_id           = this.m.init.inforPayment[0].salesman_id; // show on screen 
                    // this.m.filter.order_date            = this.m.init.inforPayment[0].order_date; //show on screen  
                    this.m.filter.total_with_discount   = this.m.init.inforPayment[0].total_with_discount; //show on screen  
                }
                //log.info('filter: ', this.m.filter);

            });
    }

    upload() {
        let self = this;
        let service = this.API.service('upload', this.API.all('crm0751'));
        

        if (self.m.isUploaded == true) {
            swal("Đang xử lý!");
            return;
        }

        self.m.isUploaded = true;
        let param = {
            id: this.m.payment_id,
            file: this.m.formUpload.file
        }

        if ( param.id > 0) {
            service.post(param)
            .then(function(response) {
                if (response.data.rtnCd == true) {
                    self.m.formUpload.file = null;
                    self.ClientService.success('Thêm hình ảnh thành công');
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
            id: this.m.payment_id
        };

        if ( param.id > 0) {
            let service = this.API.service('load-images', this.API.all('crm0751'));
            
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

    sendRequest(){
        let that = this;
        let param = angular.copy(that.m.filter);
        param.payment_id = this.m.payment_id;
        let ClientService = that.ClientService;
        if (that.m.formUpload.images.length == 0  ){
            that.ClientService.error("chưa nhập chứng từ");
            return; 
        }

        swal({
            title: "Bạn có muốn đề xuất duyệt thưởng thanh toán trước này",
            text: "Thông tin không thể sửa sau khi đề xuất",
            type: "warning",
            showCancelButton: true,
            // confirmButtonColor: '#DD6B55', 
            confirmButtonText: 'Đồng ý',
            closeOnConfirm: true,
            showLoaderOnConfirm: true,
            html: false
        }, function() {
            let saveService = that.API.service('send-request', that.API.all('crm0751'));
            saveService.post(param)
                .then(function(response) {
                    let msg = response.data;
                    ClientService.success(msg);
                    // RouteService.goState('app.crm1830');
                    that.loadInitData();
                });
        });
    }

    accpet(){
        let that = this;
        let param = angular.copy(that.m.filter);
        param.payment_id = this.m.payment_id;
        let ClientService = that.ClientService;
        swal({
            title: "Bạn có muốn duyệt xuất duyệt chi phí này",
            text: "Thông tin sau khi duyệt sẽ được bộ phận kế toán chi trả ",
            type: "warning",
            showCancelButton: true,
            // confirmButtonColor: '#DD6B55', 
            confirmButtonText: 'Đồng ý',
            closeOnConfirm: true,
            showLoaderOnConfirm: true,
            html: false
        }, function() {
            let saveService = that.API.service('accept', that.API.all('crm0751'));
            saveService.post(param)
                .then(function(response) {
                    let msg = response.data;
                    ClientService.success(msg);
                    // RouteService.goState('app.crm1830');
                    that.loadInitData();
                });
        });
    }

    deny(){
        let that = this;
        let param = angular.copy(that.m.filter);
        param.payment_id  = this.m.payment_id;
        let ClientService = that.ClientService;
        swal({
            title: "Bạn có muốn không duyệt xuất duyệt chi phí này",
            text: "Thông tin không thể sửa sau khi đề xuất",
            type: "warning",
            showCancelButton: true,
            // confirmButtonColor: '#DD6B55', 
            confirmButtonText: 'Đồng ý',
            closeOnConfirm: true,
            showLoaderOnConfirm: true,
            html: false
        }, function() {
            let saveService = that.API.service('deny', that.API.all('crm0751'));
            saveService.post(param)
                .then(function(response) {
                    let msg = response.data;
                    ClientService.success(msg);
                    // RouteService.goState('app.crm1830');
                    that.loadInitData();
                });
        });
    }

    accountantConfirm(){
        let that = this;
        let param = angular.copy(that.m.filter);
        param.payment_id  = this.m.payment_id;
        let RouteService = this.RouteService;
        let ClientService = that.ClientService;
        swal({
            title: "Bạn có muốn xác nhận thưởng thanh toán",
            text: "Thông tin không thể sửa sau khi đề xuất",
            type: "warning",
            showCancelButton: true,
            // confirmButtonColor: '#DD6B55', 
            confirmButtonText: 'Đồng ý',
            closeOnConfirm: true,
            showLoaderOnConfirm: true,
            html: false
        }, function() {
            let saveService = that.API.service('acc-confirm', that.API.all('crm0751'));
            saveService.post(param)
                .then(function(response) {
                    let msg = response.data;
                    ClientService.success(msg);
                    RouteService.goState('app.crm0700');
                    // that.loadInitData();
                    // RouteService.goState('app.crm0700');
                });
        });
    }

    clickRequestCancel(){
        let that = this;
        let param = angular.copy(that.m.filter);
        param.payment_id  = this.m.payment_id;
        let ClientService = that.ClientService;
        swal({
            title: "Bạn có muốn huỷ đề xuất thưởng thanh toán này",
            text: "Thông tin không thể sửa sau khi đề xuất",
            type: "warning",
            showCancelButton: true,
            // confirmButtonColor: '#DD6B55', 
            confirmButtonText: 'Đồng ý',
            closeOnConfirm: true,
            showLoaderOnConfirm: true,
            html: false
        }, function() {
            let saveService = that.API.service('cancel', that.API.all('crm0751'));
            saveService.post(param)
                .then(function(response) {
                    let msg = response.data;
                    ClientService.success(msg);
                    // RouteService.goState('app.crm1830');
                    that.loadInit();
                });
        });
    }
}



export const Crm0751Component = {
    // templateUrl: './views/app/components/crm0700/crm0700.component.html',
    templateUrl: '/views/admin.crm0751',
    controller: Crm0751Controller,
    controllerAs: 'vm',
    bindings: {}
}
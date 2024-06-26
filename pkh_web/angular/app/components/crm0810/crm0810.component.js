class Crm0810Controller {
    constructor($scope, $state, $stateParams, $compile, AclService, DTOptionsBuilder, DTColumnBuilder, API, $log, UtilsService, RouteService, ClientService) {
        'ngInject'

        this.API = API;
        this.$state = $state;
        this.$log = $log;
        this.UtilsService = UtilsService;
        this.alerts = [];
        this.RouteService = RouteService;
        this.ClientService = ClientService;
        this.AclService = AclService;
        this.can = AclService.can;
        this.$scope = $scope;
        // this.$log.info('this can: ', this.can);
        this.m = {
            checkWarehouseId: null,
            checkWarehouseNote: null,
            productActive: 0,
            checkDate: moment(),
            list: null,
            dateOptions: {
                viewMode: 'days',
                format: 'YYYY-MM-DD'
            },
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

        if ($stateParams.checkWarehouseId > 0) {
            this.m.checkWarehouseId = $stateParams.checkWarehouseId;
        } else {
            this.m.checkWarehouseId = 0;
        }
        this.m.form.id = this.m.checkWarehouseId ;

        if ($stateParams.alerts) {
            this.alerts.push($stateParams.alerts)
        }
    }

    $onInit() {
        this._setupFileUpload("fileUpload", this.m.formUpload);
        this.loadImageList();
        this.doSearch();
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

    doSearch() {
        // Get list product 
        //this.$log.info('productActive', this.m.productActive);
        let self = this;
        if (this.m.checkWarehouseId > 0) {
            let service = this.API.service('load', this.API.all('crm0810'));
            let param = { checkWarehouseId: self.m.checkWarehouseId, productActive: self.m.productActive };
            service.post(param)
                .then(function(response) {
                    self.m.list = response.plain().data.list;
                    self.m.info = response.plain().data.info[0];
                    self.m.warehouseList = response.plain().data.warehouseList;
                    self.m.warehouse_id = self.m.info.warehouse_id;
                    self.m.checkWarehouseNote = response.plain().data.info[0].notes;
                    self.m.checkDate = moment(response.plain().data.info[0].check_date).format('YYYY-MM-DD');
                    //self.$log.info('info:', self.m.checkDate);
                });
        } else {
            let searchService = this.API.service('search', this.API.all('crm0810'));
            let param = { productActive: self.m.productActive };
            searchService.post(param)
                .then((response) => {
                    self.m.warehouseList = response.plain().data.warehouseList;
                    self.m.list = response.plain().data.list;
                });
        }
    }

    checkValidWarehouse(){
        let oke = true;
        let msg = "";
        if (this.m.warehouse_id == null || this.m.warehouse_id == "") {
            msg = "Vui lòng chọn kho để nhập.";
            oke = false;
        } 
        
        if (!oke) {
            this.ClientService.error(msg);
        }
        return oke;
    }
    
    

    save() {
        let $log = this.$log;
        let RouteService = this.RouteService;
        let ClientService = this.ClientService;
        let self = this;

        if (!this.checkValidWarehouse()) {
            return;
        }
        swal({
            title: "Bạn có muốn lưu lại lần kiểm kho này?",
            text: "Trong lần tạo đầu tiên, vui lòng kiểm tra kĩ các thông tin sau vì bạn sẽ không thể chỉnh sửa: ngày kiểm và thông tin kho kiểm.\
                     \r\n   Bạn được quyền chỉnh sửa trong vòng 4 ngày kể từ ngày tạo đơn: số lượng sản phẩm, ghi chú sản phẩm và ghi chú.",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: 'Đồng ý',
            closeOnConfirm: true,
            showLoaderOnConfirm: true,
            html: false
        }, function() {
           //$log.info('send', self);
            let crm0810Service = self.API.service('save', self.API.all('crm0810'));
            let param = {};
            let index = 1;
            param.checkWarehouseId = self.m.checkWarehouseId;

            // Format date for check date
            let checkDate = moment(new Date().toISOString()).format('YYYY-MM-DD');
            if (self.m.checkDate != null && self.m.checkDate != undefined) {
                checkDate = moment(self.m.checkDate).format('YYYY-MM-DD');
            }
            param.checkDate = checkDate;

            // Add note to param.
            param.sumary_note = self.m.checkWarehouseNote;

            //Add warehouse id to param
            param.warehouse_id  = self.m.warehouse_id;
            param.data = [];
            angular.forEach(self.m.list, function(item) {
                if (!item.amount) {
                    item.amount = 0;
                }
                param.data.push({
                    product_id: item.product_id,
                    seq_no: index++,
                    amount: item.amount,
                    unit_price: item.selling_price,
                    notes: item.notes
                });
            });
           
            //$log.info('param', param);
            crm0810Service.post(param)
                .then((response) =>  {
                    status = response.plain().data.status;
                    if (status == 1) {
                        ClientService.success('Thêm mới chi tiết kho thành công');
                    } else if (status == 2) {
                        ClientService.success('Cập nhật chi tiết kho thành công');
                    }else if (status == -1) {
                        ClientService.error("Bạn đã quá thời hạn được chỉnh sửa");
                    }else if (status == -2) {
                        ClientService.error("Không được nhập kiểm kho quá 1 lần cho cùng 1 ngày cho cùng 1 warehouse");
                    } 
                    RouteService.goState('app.crm0800')
                    
                });
        });
        
     

    }

    download() {
        // let param = angular.copy(this.m.filter);
        let param = { checkWarehouseId: this.m.checkWarehouseId, productActive: this.m.productActive };
        let service = this.API.service('download', this.API.all('crm0810'));
        service.post(param)
            .then((response) => {
                // this.$log.info(response.data);
                this.ClientService.downloadFileOneTime(response.data.file);
            });
    }

    clickCancel() {
        let that = this;
        swal({
            title: "Bạn có muốn hủy đợt kiểm hàng?",
            text: " sau khi hủy sẽ không thể phục hồi.",
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
                check_warehouse_id: that.m.checkWarehouseId,
                notes: inputValue
            };

            let service = that.API.service('cancel', that.API.all('crm0810'));
            service.post(param)
                .then((res) => {
                    if (res.data.rtnCd == true) {
                        that.ClientService.success(res.data.msg);
                        that.doSearch();
                    } else {
                        that.ClientService.error(res.data.msg);
                    }
                });
        });
    }
    upload() {
        let self = this;
        let service = this.API.service('upload', this.API.all('crm0810'));
        

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
                    self.ClientService.success('Thêm hình ảnh tin tức thành công');
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
            let service = this.API.service('load-images', this.API.all('crm0810'));
            
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

export const Crm0810Component = {
    templateUrl: '/views/admin.crm0810',
    controller: Crm0810Controller,
    controllerAs: 'vm',
    bindings: {}
}
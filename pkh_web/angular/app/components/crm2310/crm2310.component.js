class Crm2310Controller{
    constructor($scope, $state, $compile, $log, AclService, API, UtilsService, $stateParams, ClientService, RouteService) {
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
            warehouseDetail: [],
            warehouse: {
               
            }
            ,
            form: {
                publishDate: moment(),
                file: null
            },
            formUpload: {
                file: null,
                images: []
            },
        }
        // There are two types: warehouse_import_id and warehouse_export_id       

        // Check import or export has been created. determine type of instance based on type 
        this.m.warehouse_exim_id = $stateParams.warehouse_exim_id;
        this.m.isUploaded = false;
        this.m.form.id = this.m.warehouse_exim_id ;

        this.hide = false;
        this.m.canEdit = true;
    }

    $onInit(){
        this._setupFileUpload("fileUpload", this.m.formUpload);
        this.loadImageList();
        this.loadInitData();
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



    updateState(){
        if (this.m.warehouse.exim_sts && this.m.warehouse.exim_sts!=0){
            this.m.canEdit = false;

        }
    }

    loadInitData() {

        let param = {
            
        };
        // Load init there are two cases:
        // Case 1: New export. 
        // Case 2: open old export.
        // Case 3: New import.
        // Case 4: open old import.

        //Initialize param for load init 
        param.warehouse_exim_id = this.m.warehouse_exim_id // if type =1, warehouse_export_id else warehouse_import_id
        this.m.warehouse.notes = "";
        let service = this.API.service('load-init', this.API.all('crm2310'));
        service.post(param)
            .then((response) => {
               
                if (response.data.warehouse != null) {
                    this.m.warehouse = response.data.warehouse[0];
                }
                this.m.warehouseDetail = response.data.warehouseDetail;
                // Get list of product
                let productList = response.data.productList;
                // this.m.productList = productList;
                // Get list of warehouse
                this.m.warehouseList = response.data.warehouseList;
                this.m.eximStatusList = response.data.eximStatusList;
                this.m.requestList = response.data.requestList;

                this.calcWarehouseTotal();
                this.$log.info('this.m', response.data);
                this.updateState();

                // if (this.m.store_order_id > 0 && parseInt(this.m.order.order_sts) > 0) {
                //     this.m.canEdit = false;
                // } else {
                //     this.m.canEdit = true;
                // }

            });
    }

    addProduct(product) {
        if (this.m.warehouseDetail == null) {
            this.m.warehouseDetail = [];
        }

        var newProduct = {
            product_id: product.product_id,
            product_code: product.product_code,
            name: product.product_cat_name,
            product_name: product.name,
            standard_packing: product.standard_packing,
            product_cat_id: product.product_cat_id,
            unit_price: product.selling_price,
            amount: 0,
            store_order_id: 0,
            version_no: 0,
            volume: product.volume
        };

        this.m.warehouseDetail.push(newProduct);
        product.hide = true;
        this.calcWarehouseTotal();
    }

    removeProduct(product) {
        if (this.m.warehouse.exim_sts!=0)
        {
            return;
        }
        var index = this.m.warehouseDetail.indexOf(product);
        if (index >= 0) {
            this.m.warehouseDetail.splice(index, 1);
            this.calcOrderTotal();

            for (var i = 0; i < this.m.productList.length; i++) {
                if (this.m.productList[i].product_id == product.product_id) {
                    this.m.productList[i].hide = false;
                }
            }
        }
        this.calcWarehouseTotal();
    }

    searchProduct() {
        let $log = this.$log;

        //$log.info(this.m);

        // Get list product 
        let searchService = this.API.service('search-product', this.API.all('crm0210'));
        let param = angular.copy(this.m.filter);
        

        var self = this;
        self.$log.info('this.m', self.m);

        searchService.post(param)
            .then((response) => {
                var list = response.plain().data.list;
                if (self.m.warehouseDetail != null && self.m.warehouseDetail.length > 0) {
                    angular.forEach(list, function(value) {
                        var hide = false;
                        for (var i = 0; i < self.m.warehouseDetail.length; i++) {
                            if (self.m.warehouseDetail[i].product_id == value.product_id) {
                                hide = true;
                                break;
                            }
                        }
                        value.hide = hide;
                    });
                }

                self.m.productList = list;
                self.$log.info('this.m.list', self.m.productList);

            });
    }

    calcWarehouseTotal() {
        if (this.m.warehouse== null)
            return;
        var total = 0; 
        var volume = 0 ;
        var carton  = 0 ;
        angular.forEach(this.m.warehouseDetail, function(value) {
            total += parseFloat(value.unit_price) * parseFloat(value.amount);
            volume += parseFloat(value.volume) * parseFloat(value.amount)/ parseFloat(value.standard_packing);
            carton += parseFloat(value.amount)/ parseFloat(value.standard_packing);
        });

        this.m.warehouse.total = total;
        this.m.warehouse.volume = volume;
        this.m.warehouse.carton = carton;
    }

    checkValidWarehouse(){
        let oke = true;
        let msg = "";
        if (this.m.warehouse.from_warehouse_id == null || this.m.warehouse.from_warehouse_id == "") {
            msg = "Vui lòng chọn kho để xuất.";
            this.ClientService.error(msg);
            return false;
        } 

        if (this.m.warehouse.to_warehouse_id == null || this.m.warehouse.to_warehouse_id == "") {
            msg = "Vui lòng chọn kho để nhập.";
            this.ClientService.error(msg);
            return false;
        } 

        if (this.m.warehouse.from_warehouse_id == this.m.warehouse.to_warehouse_id) {
            msg = "Kho nhập và xuất phải khác nhau";
            this.ClientService.error(msg);
            return false;
        } 

        return oke;
    }

    createWarehouseDetail(){
        var warehouseDetail = [];
        angular.forEach(this.m.warehouseDetail, function(value, key) {
            warehouseDetail.push({
                product_id: value.product_id,
                unit_price: value.unit_price,
                amount: value.amount
            });
        });
        return warehouseDetail;
    }

    clickSave() {

        let self = this;

        if (!this.checkValidWarehouse()) {
            return;
        }

        if (self.m.isSaved == true) {
            swal("Đang xử lý!")
            return;
        }

        self.m.isSaved = true;
        var warehouseDetail = this.createWarehouseDetail();
        

        //warehouse_x_id can be warehouse_export_id if type = 1 or warehouse_import_id if type = 2.
        var warehouse_exim_id = 0;
       
        if (this.m.warehouse_exim_id && this.m.warehouse_exim_id>0){
            warehouse_exim_id = this.m.warehouse_exim_id;
        }
      
        var param = {
            mode: 'SAVE',
            type: this.m.type,
            warehouse: {
                warehouse_exim_id: warehouse_exim_id,
                from_warehouse_id: this.m.warehouse.from_warehouse_id,
                to_warehouse_id: this.m.warehouse.to_warehouse_id,
                notes: this.m.warehouse.notes,
                volume: this.m.warehouse.volume,
                carton: this.m.warehouse.carton,
            },
            warehouseDetail: warehouseDetail
        };
        self.$log.info('check save param: ', param);

        let service = this.API.service('save', this.API.all('crm2310'));
        service.post(param)
            .then((response) => {
                
                // this.m.store_order_id = response.data.storeOrderId;
                this.m.msg_error = response.data.msg;
                this.m.warehouse_exim_id = response.data.warehouse_exim_id;

                if (response.data.error != -1) {
                    this.ClientService.success("Lưu thành công");
                    this.loadInitData();
                } else {
                    this.ClientService.warning("Something is wrong! Cannot save");
                }

                self.m.isSaved = false;
            });
    }

    
    createExport(){
        let $log = this.$log;
        var self = this;

     
        swal({
            title: "Bạn có xuất kho?",
            text: "Sau khi bấm nút xuất, lượng hàng này sẽ được trừ trực tiếp vào kho bán hàng của kho xuất. Kể từ lúc đồng ý xuất kho bạn sẽ không được quyền thay đổi bất kỳ thông tin nào.",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: 'Đồng ý',
            closeOnConfirm: true,
            showLoaderOnConfirm: true,
            html: false
        }, function() {
            //$log.info(this.m);
            var warehouseDetail = self.createWarehouseDetail();
            if (self.m.isExport == true) {
                swal("Đang xử lý!")
                return;
            }
    
            self.m.isExport = true;
            // Get list product 
            var param = {
                mode: 'EXPORT',
                warehouse_exim_id: self.m.warehouse_exim_id,
                from_warehouse_id: self.m.warehouse.from_warehouse_id,
                detail: warehouseDetail
            };
            let exportService = self.API.service('create-export', self.API.all('crm2310'));        

            // self.$log.info('this.m', self.m);

            exportService.post(param)
                .then((response) => {
                    // var list = response.plain().data;
                    self.loadInitData();
                    self.m.isExport = false;

                });

        });
       
    }

    createImport(){
        let $log = this.$log;
        var self = this;
      
        swal({
            title: "Bạn có muốn nhập kho?",
            text: "Sau khi bấm nút nhập, lượng hàng này sẽ được cộng trực tiếp vào kho bán hàng của kho nhập.",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: 'Đồng ý',
            closeOnConfirm: true,
            showLoaderOnConfirm: true,
            html: false
        }, function() {
            //$log.info(this.m);
            var warehouseDetail = self.createWarehouseDetail();
            if (self.m.isImport == true) {
                swal("Đang xử lý!")
                return;
            }
    
            self.m.isImport = true;
            // Get list product 
            var param = {
                mode: 'IMPORT',
                warehouse_exim_id: self.m.warehouse_exim_id,
                to_warehouse_id: self.m.warehouse.to_warehouse_id,
                detail: warehouseDetail
            };
            let importService = self.API.service('create-import', self.API.all('crm2310'));        

            // self.$log.info('this.m', self.m);

            importService.post(param)
                .then((response) => {
                    // var list = response.plain().data;
                    self.m.isImport = true;
                    self.loadInitData();

                });
        });
    }

    clickRequestCancel(){
        let that = this;
        swal({
            title: "Bạn có muốn hủy phiếu nhập xuất kho này?",
            text: "phiếu khi hủy sẽ không thể phục hồi.",
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
                warehouse_exim_id: that.m.warehouse_exim_id,
                notes: inputValue
            };

            let service = that.API.service('request-cancel', that.API.all('crm2310'));
            service.post(param)
                .then((res) => {
                    if (res.data.rtnCd == true) {
                        that.ClientService.success(res.data.msg);
                        //that.loadInitData();
                        that.m.requestList = res.data.requestList;
                        that.loadInitData();

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

            let service = that.API.service('deny', that.API.all('crm2310'));
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

            let service = that.API.service('accept', that.API.all('crm2310'));
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

    upload() {
        let self = this;
        let service = this.API.service('upload', this.API.all('crm2310'));
        

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
            id: this.m.form.id
        };

        if ( param.id > 0) {
            let service = this.API.service('load-images', this.API.all('crm2310'));
            
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

export const Crm2310Component = {
    //templateUrl: './views/app/components/crm2310/crm2310.component.html',
    templateUrl: '/views/admin.crm2310',
    controller: Crm2310Controller,
    controllerAs: 'vm',
    bindings: {}
}

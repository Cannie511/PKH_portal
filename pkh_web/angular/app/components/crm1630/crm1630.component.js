class Crm1630Controller {

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
        this.can = AclService.can;
        this.m = {
            importDetail: [],
            infor: {},
            importWhStore: {},
            importWhFac: {},
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
        this.m.canEdit = true;
        this.m.store_id = $stateParams.store_id;
        this.m.supplier_delivery_id = $stateParams.supplier_delivery_id;
        this.m.import_type = $stateParams.import_type;
        this.m.type = $stateParams.type;
       
        // 1 la lay thong so tu nhap hang tu nha may
        // 2 la2 lay thong so nhap hang (bao hanh - tra lai) tu cua hang 
        if (this.m.type != null) {
            if (this.m.type == 1) {
                this.m.import_wh_factory_id = $stateParams.import_wh_id;
                this.m.form.id = this.m.import_wh_factory_id;
            } else {
                this.m.import_wh_store_id = $stateParams.import_wh_id;
            }
        }

        // this.$log.info('ahihihi', this.m);

        
    }

    $onInit() {
    
        this._setupFileUpload("fileUpload", this.m.formUpload);
        this.loadImageList();
        
        this.chooseInit();
        
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

    chooseInit() {
        //TH1: Khoi tạo record tổng để thủ kho nhập kho (vào từ crm1600) tham số đầu vào: supplier_delivery_id
        //TH2: Mở nhà máy (vào từ crm1640) tham số đầu vào: import_wh_fac_id
        //TH3: Khoi tao bao hanh - nhap kho moi (vào từ crm0300) tham số đầu vào: store_id, import_type
        //TH4: Mo bao hanh - nhap kho cu (vào từ crm1640) tham số đầu vào: import_wh_store_id
        if (this.m.import_wh_factory_id == null && this.m.import_wh_store_id == null) {

            if (this.m.import_type == null || this.m.import_type <= 0) {
                this.ClientService.warning("Vui lòng chọn cửa hàng");
                this.RouteService.goState("app.crm0300");
                return;
            }
            this.loadInitData(3);
        } else
        if (this.m.import_wh_factory_id != null && this.m.import_wh_store_id == null) {

            this.loadInitData(1);
        } else
        if (this.m.import_wh_store_id != null && this.m.import_wh_factory_id == null) {
            this.m.canEdit = false;
            this.loadInitData(4);
        }
    }

    loadInitData(type) {
        let $log = this.$log;
        let param = {
            store_id: this.m.store_id,
            supplier_delivery_id: this.m.supplier_delivery_id,
            import_wh_store_id: this.m.import_wh_store_id,
            import_wh_factory_id: this.m.import_wh_factory_id,
            type: type
        };

        let service = this.API.service('load-init', this.API.all('crm1630'));
        service.post(param)
            .then((response) => {
                if (response.data.store != null) {
                    this.m.infor.store = response.data.store;
                }
                if (response.data.supplier != null) {
                    this.m.infor.supplier = response.data.supplier[0];
                }
                this.m.requestList = response.data.requestList;
                if (response.data.importWhStore != null) {
                    this.m.importWhStore = response.data.importWhStore;
                    this.m.import_type = this.m.importWhStore.import_type;
                    this.m.store_id = this.m.importWhStore.store_id;
                    this.m.importDetail = response.data.importDetail;
                    this.m.warehouse_id = this.m.importWhStore.warehouse_id;
                    this.m.notes = this.m.importWhStore.notes;
                }

                if (response.data.importWhFac != null) {
                    this.m.importWhFac = response.data.importWhFac;
                    this.m.importDetail = response.data.importDetail;
                    this.m.infor.supplier = response.data.supplier;
                    this.m.warehouse_id = this.m.importWhFac.warehouse_id;
                    this.m.notes = this.m.importWhFac.notes;

                    if (this.m.importWhFac.active_flg == 1) {
                        this.m.canEdit = false;
                    }
                }
                this.m.warehouseList = response.data.warehouseList;
                //$log.info('ahihi test response', this.m);
            });
    }

    searchProduct() {
        // Get list product 
        let searchService = this.API.service('search-product', this.API.all('crm1630'));
        let param = angular.copy(this.m.filter);
        var thisClass = this;
        let $log = this.$log;
        searchService.post(param)
            .then((response) => {
                var list = response.plain().data.list;
                //$log.info('product search ', list);
                angular.forEach(list, function(value, key) {
                    var hide = false;
                    for (var i = 0; i < thisClass.m.importDetail.length; i++) {
                        if (thisClass.m.importDetail[i].product_id == value.product_id) {
                            hide = true;
                            break;
                        }
                    }
                    value.hide = hide;
                });
                thisClass.m.productList = list;

            });
    }

    addProduct(product) {
        if (this.m.importDetail == null) {
            this.m.importDetail = [];
        }
        var newProduct = {
            product_id: product.product_id,
            product_code: product.product_code,
            name: product.product_cat_name,
            stock_code: product.stock_code,
            product_name: product.name,
            standard_packing: product.standard_packing,
            product_cat_id: product.product_cat_id,
            unit_price: product.selling_price,
            length: product.length,
            width: product.width,
            height: product.height,
            packaging: product.packaging,
            amount: 0,
            store_order_id: 0,
            version_no: 0

        };
        this.m.importDetail.push(newProduct);
        product.hide = true;
        //this.calcOrderTotal();
    }

    removeProduct(product) {
        var index = this.m.importDetail.indexOf(product);
        if (index >= 0) {
            this.m.importDetail.splice(index, 1);
            //this.calcOrderTotal();
            for (var i = 0; i < this.m.productList.length; i++) {
                if (this.m.productList[i].product_id == product.product_id) {
                    this.m.productList[i].hide = false;
                }
            }
        }
        //this.calcOrderTotal();
    }

    clickSave() {
        var detail = [];
        let that = this;
        if (that.m.warehouse_id == null){
            that.ClientService.error("Vui lòng chọn kho.");
            return;
        }
        
        swal({
            title: "Bạn có muốn lưu lại lần nhập hàng này",
            text: "Sau khi bấm nút lưu sẽ không chỉnh sửa được nữa. Lưu ý vui lòng chọn kho để nhập chính xác.",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: 'Đồng ý',
            closeOnConfirm: true,
            showLoaderOnConfirm: true,
            html: false
        }, function() {
            angular.forEach(that.m.importDetail, function(value, key) {
                detail.push({
                    product_id: value.product_id,
                    amount: value.amount
                });
            });
            var salesman_id;

            if (that.m.infor.store == null) {
                salesman_id = null;
            } else {
                salesman_id = that.m.infor.store.salesman_id;
            }

            var param = {
                mode: 'SAVE',
                import_type: that.m.import_type,
                notes: that.m.notes,
                warehouse_id: that.m.warehouse_id,
                store_id: that.m.store_id,
                detail: detail,
                salesman_id: salesman_id,
                supplier_delivery_id: that.m.supplier_delivery_id,
                import_wh_store_id: that.m.importWhStore.import_wh_store_id,
                import_wh_factory_id: that.m.importWhFac.import_wh_factory_id
            };
            //this.$log.info('param', param);
            let service = that.API.service('save', that.API.all('crm1630'));
            service.post(param)
                .then((response) => {
                    //this.$log.info('response.data', response.data);
                    that.ClientService.success("Lưu thành công");
                    that.RouteService.goState("app.crm1640");
                });
        });
    }

    /*
     * send request import this product to warehouse on portal
     * type : 1 - fac, 2 - store
     */
    requestImport() {
        //  check this is valid request by checking 2 type of id.
        if (!this.m.import_wh_factory_id && !this.m.import_wh_store_id) {
            return;
        }
        // For import store if confirm amount is larger than original amount than don't create request import
        if (this.m.import_wh_store_id) {
            for (var i = 0; i < this.m.importDetail.length; i++) {
                if (this.m.importDetail[i].amountImport == null || this.m.importDetail[i].amountImport < 0 ||
                    this.m.importDetail[i].amountImport > this.m.importDetail[i].amount) {
                    this.ClientService.error("Dữ liệu không hợp lệ");
                    return;
                }
            }
        }
        
        let $log = this.$log;
        let param = {
            detail: this.m.importDetail,
            infoStore: this.m.importWhStore,
            warehouse_id: this.m.warehouse_id,
            infoFac: this.m.importWhFac,
            type: this.m.type, // 1 - fac , 2 - store
            import_type: this.m.import_type // 1- nhap bao hanh, 2- nhap tra lai
        };
        //$log.info('param request', param);
        let service = this.API.service('request-import', this.API.all('crm1630'));
        service.post(param)
            .then((response) => {
                var res = response.plain().data;
                if (res.sts == true){
                    this.ClientService.success(res.msg);
                } else{
                    this.ClientService.error(res.msg);

                }
                this.chooseInit();
            });
    }

    accept(item) {
        let that = this;
        //this.$log.debug(item);
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
                notes: inputValue,
                detail: that.m.importDetail
            };

            let service = that.API.service('accept', that.API.all('crm1630'));
            service.post(param)
                .then((res) => {
                    if (res.data.rtnCd == true) {
                        that.ClientService.success(res.data.msg);
                        that.loadInitData();
                        // that.search();
                    } else {
                        that.ClientService.error(res.data.msg);
                    }
                    that.chooseInit();
                });
        });
    }

    deny(item) {
        let that = this;
        //this.$log.debug(item);
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

            let service = that.API.service('deny', that.API.all('crm1630'));
            service.post(param)
                .then((res) => {
                    if (res.data.rtnCd == true) {
                        that.ClientService.success(res.data.msg);
                        that.chooseInit();
                        // that.search();
                    } else {
                        that.ClientService.error(res.data.msg);
                    }

                });
        });
    }

    upload() {
        let self = this;
        let service = this.API.service('upload', this.API.all('crm1630'));
        

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
                    self.ClientService.success('Thêm chứng từ nhập hàng thành công');
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
            let service = this.API.service('load-images', this.API.all('crm1630'));
            
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

export const Crm1630Component = {
    //templateUrl: './views/app/components/crm1630/crm1630.component.html',
    templateUrl: '/views/admin.crm1630',
    controller: Crm1630Controller,
    controllerAs: 'vm',
    bindings: {}
}